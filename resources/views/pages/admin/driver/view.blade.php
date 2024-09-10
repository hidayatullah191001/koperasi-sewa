<!-- Modal for View Supir -->
@foreach ($drivers as $item)
<div id="view-driver-{{ $item->id }}-modal" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="view-driver-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white" id="view-driver-modalLabel">Detail Driver {{ $item->nama }}</h4>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-4 px-3">
                        @if ($item->photo_profile == 'default.png')
                            <img src="{{ asset('assets/images/default.png') }}" alt=""
                                class="img-rounded img-fluid w-100 object-cover h-100">
                        @else
                            <img src="{{ asset('storage/' . $item->photo_profile) }}" alt=""
                                class="img-rounded img-fluid w-100 object-cover h-100">
                        @endif
                    </div>
                    <div class="col">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nama:</td>
                                    <td>{{ $item->nama }}</td>
                                </tr>
                                <tr>
                                    <td>No ID Card:</td>
                                    <td>{{ $item->no_id_card }}</td>
                                </tr>
                                <tr>
                                    <td>NIK:</td>
                                    <td>{{ $item->nik }}</td>
                                </tr>
                                <tr>
                                    <td>No Telepon:</td>
                                    <td>{{ $item->no_telepon }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat :</td>
                                    <td>{{ $item->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir :</td>
                                    <td>{{ $item->tanggal_lahir }}</td>
                                </tr>
                                <tr>
                                    <td>Umur :</td>
                                    <td>{{ $item->umur }}</td>
                                </tr>
                                <tr>
                                    <td>Umur :</td>
                                    <td>{{ $item->agama }}</td>
                                </tr>
                                <tr>
                                    <td>Status Kawin :</td>
                                    <td>{{ $item->status_kawin }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis SIM :</td>
                                    <td>{{ $item->jenis_sim }}</td>
                                </tr>
                                <tr>
                                    <td>Created At:</td>
                                    <td>{{ App\Helpers\MyHelpers::ubahFormatTimestamp($item->created_at) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('driver.edit', MyHelpers::encode($item->id)) }}" class="btn btn-info"><i class="fas fa-pencil-alt"></i> Edit Data</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endforeach
<!-- End Modal for View Supir -->