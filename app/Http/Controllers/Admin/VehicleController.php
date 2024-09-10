<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('pages.admin.vehicle.index', [
            'vehicles' => $vehicles,
        ]);
    }

    public function create()
    {
        return view('pages.admin.vehicle.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'warna' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:0',
            'nomor_polisi' => 'required|string|max:255',
            'full_ac' => 'required|in:Tersedia,Tidak tersedia',
            'musik' => 'required|in:Tersedia,Tidak tersedia',
        ]);

        $vehicle = Vehicle::create($request->all());

        return redirect()
            ->route('vehicle.media', $vehicle->id)
            ->with('success', 'Vehicle created successfully.');
    }

    public function createMedia($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('pages.admin.vehicle.upload_photo', [
            'vehicle' => $vehicle,
        ]);
    }

    public function storeFile(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/vehicles'), $fileName);
            $pathFile = 'storage/uploads/vehicles/' . $fileName;
            VehicleFile::create([
                'vehicle_id' => $vehicle->id,
                'file_path' => $pathFile,
            ]);
            return response()->json(['message' => 'File uploaded successfully']);
        } else {
            return response()->json(['message' => 'No file uploaded'], 400);
        }
    }

    public function show($id)
    {
        $vehicle = Vehicle::with('files')->findOrFail($id);
        return view('pages.admin.vehicle.show', compact('vehicle'));
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicleFiles = VehicleFile::where('vehicle_id', $id)->get();
        return view('pages.admin.vehicle.edit', [
            'vehicle' => $vehicle,
            'vehicleFiles' => $vehicleFiles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'merk' => 'required|string|max:255',
            'warna' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:0',
            'nomor_polisi' => 'required|string|max:255',
            'full_ac' => 'required|in:Tersedia,Tidak tersedia',
            'musik' => 'required|in:Tersedia,Tidak tersedia',
            'file.*' => 'sometimes|file|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
        ]);

        $vehicle->update($request->all());

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $path = $file->store('vehicle_files', 'public');
                VehicleFile::create([
                    'vehicle_id' => $vehicle->id,
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicleFiles = VehicleFile::where('vehicle_id', $id)->get();
        foreach ($vehicleFiles as $vehicleFile) {
            Storage::delete($vehicleFile->file_path);
            $vehicleFile->delete();
        }
        $vehicle->delete();

        return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully.');
    }

    public function deleteVehicleFile($id)
    {
        $vehicleFile = VehicleFile::findOrFail($id);
        // Hapus file dari file sistem
        Storage::delete($vehicleFile->file_path);

        // Hapus data dari database
        $vehicleFile->delete();

        return response()->json(['success' => 'File removed successfully'], 200);
    }

    public function uploadVehicleFile(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        if ($request->hasFile('new_files')) {
            foreach ($request->file('new_files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/uploads/vehicles'), $fileName);
                $pathFile = 'storage/uploads/vehicles/' . $fileName;
                VehicleFile::create([
                    'vehicle_id' => $vehicle->id,
                    'file_path' => $pathFile,
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'File uploaded successfully']);
    }

    public function getVehicleFiles($id)
    {
        $vehicleFiles = VehicleFile::where('vehicle_id', $id)->get();

        $html = view('partials.vehicle_files', compact('vehicleFiles'))->render();

        return response()->json(['html' => $html]);
    }
}
