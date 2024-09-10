<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MyHelpers;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::all();
        return view('pages.admin.driver.index', [
            'drivers' => $drivers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $religions = ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'];

        $simTypes = ['SIM A', 'SIM A Umum', 'SIM B1', 'SIM B1 Umum', 'SIM B2', 'SIM B2 Umum', 'SIM C', 'SIM D', 'SIM Internasional'];
        return view('pages.admin.driver.create', [
            'religions' => $religions,
            'simTypes' => $simTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'no_id_card' => 'required|string|unique:drivers,no_id_card',
                'nik' => 'required|string|size:16|unique:drivers,nik|regex:/^[0-9]+$/',
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|string|max:50',
                'status_kawin' => 'required|string|max:50',
                'jenis_sim' => 'required|string|max:50',
            ]);

            if ($validation->fails()) {
                return redirect()->route('driver.create')->withErrors($validation)->withInput();
            }

            $umur = MyHelpers::calculateAge($request->input('tanggal_lahir'));

            $photo_profile_path = 'default.png';
            if ($request->hasFile('photo_profile')) {
                $photo_profile_path = $request->file('photo_profile')->store('driver', 'public');
            }

            $data = [
                'no_id_card' => $request->input('no_id_card'),
                'nik' => $request->input('nik'),
                'nama' => $request->input('nama'),
                'alamat' => $request->input('alamat'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'umur' => $umur,
                'agama' => $request->input('agama'),
                'status_kawin' => $request->input('status_kawin'),
                'jenis_sim' => $request->input('jenis_sim'),
                'no_telepon' => $request->input('no_telepon'),
                'photo_profile' => $photo_profile_path,
            ];

            Driver::create($data);

            return redirect()->route('driver.index')->with('success', 'Data driver successfully created.');
        } catch (Exception $e) {
            return redirect()->route('driver.create')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptId)
    {
        $id = MyHelpers::decode($encryptId);
        $driver = Driver::findOrFail($id);
        $religions = ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'];

        $simTypes = ['SIM A', 'SIM A Umum', 'SIM B1', 'SIM B1 Umum', 'SIM B2', 'SIM B2 Umum', 'SIM C', 'SIM D', 'SIM Internasional'];

        return view('pages.admin.driver.edit', [
            'driver' => $driver,
            'religions' => $religions,
            'simTypes' => $simTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        try {
            $id = $driver->id;
            $validation = Validator::make($request->all(), [
                'no_id_card' => ['required','string', Rule::unique('drivers')->ignore($id)],
                'nik' => ['required','string','size:16',Rule::unique('drivers')->ignore($id)],
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|string|max:50',
                'status_kawin' => 'required|string|max:50',
                'jenis_sim' => 'required|string|max:50',
            ]);

            if ($validation->fails()) {

                return redirect()->route('driver.edit')->withErrors($validation)->withInput();
            }

            $umur = MyHelpers::calculateAge($request->input('tanggal_lahir'));

            $photo_profile_path = 'default.png';
            if ($request->hasFile('photo_profile')) {
                if($driver->photo_profile == 'default.png'){
                    $photo_profile_path = $request->file('photo_profile')->store('driver', 'public');
                }else{
                    $photo_profile_path = $request->file('photo_profile')->store('driver', 'public');
                    Storage::delete($driver->photo_profile);
                }
            }

            $data = [
                'no_id_card' => $request->input('no_id_card'),
                'nik' => $request->input('nik'),
                'nama' => $request->input('nama'),
                'alamat' => $request->input('alamat'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'umur' => $umur,
                'agama' => $request->input('agama'),
                'status_kawin' => $request->input('status_kawin'),
                'jenis_sim' => $request->input('jenis_sim'),
                'no_telepon' => $request->input('no_telepon'),
                'photo_profile' => $photo_profile_path,
            ];

            $driver->update($data);

            return redirect()->route('driver.index')->with('success', 'Data driver successfully updated.');
        } catch (Exception $e) {
            return redirect()->route('driver.edit')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        try {
            Storage::delete($driver->photo_profile);
            $driver->delete();

            return redirect()->route('driver.index')->with('success', 'Data driver successfully deleted.');
        } catch (Exception $e) {
            return redirect()->route('driver.index')->with('error', $e->getMessage());
        }
    }
}
