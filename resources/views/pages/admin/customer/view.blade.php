@foreach ($customers as $item)
<div id="view-customer-{{ $item->id }}-modal" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="view-customer-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white" id="view-customer-modalLabel">Detail ticket customer {{ $item->nama }}</h4>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-4 px-3">
                        <img src="{{ asset('storage/' . $item->photo_ktp) }}" alt="{{ $item->nama }}"
                        class="img-rounded img-fluid w-100 object-cover h-100 rounded">
                    </div>
                    <div class="col">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Tanggal:</th>
                                    <td>{{ $item->tanggal }}</td>
                                </tr>
                                <tr>
                                    <th>NIK:</th>
                                    <td>{{ $item->nik }}</td>
                                </tr>
                                <tr>
                                    <th>Nama:</th>
                                    <td>{{ $item->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin:</th>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th>Umur:</th>
                                    <td>{{ $item->umur }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Alamat:</th>
                            <td>{{ $item->alamat }}</td>
                        </tr>
                        <tr>
                            <th>No Telephone:</th>
                            <td>{{ $item->no_telephone }}</td>
                        </tr>
                        <tr>
                            <th>Kota Asal:</th>
                            <td>{{ $item->asal->nama }}</td>
                        </tr>
                        <tr>
                            <th>Kota Tujuan:</th>
                            <td>{{ $item->tujuan->nama }}</td>
                        </tr>
                        <tr>
                            <th>Harga Tiket:</th>
                            <td>{{ MyHelpers::changeIntegertoRupiah($item->harga_tiket) }}</td>
                        </tr>
                        <tr>
                            <th>Harga Bagasi:</th>
                            <td>{{ MyHelpers::changeIntegertoRupiah($item->harga_bekasi) }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan Bagasi:</th>
                            <td>{{ $item->keterangan_bagasi }}</td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ App\Helpers\MyHelpers::ubahFormatTimestamp($item->created_at) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('customer.edit', MyHelpers::encode($item->id)) }}" class="btn btn-info"><i class="fas fa-pencil-alt"></i> Edit Data</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endforeach