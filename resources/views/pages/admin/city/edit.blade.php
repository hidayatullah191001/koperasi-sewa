@foreach ($cities as $item)
<div id="edit-city-{{ $item->id }}-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="standard-modalLabel">Edit City {{ $item->nama }}</h4>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('city.update', $item) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('put')
                <div class="form-group mb-3">
                    <label for="nama" class="form-label">Nama Kota</label>
                    <input type="text" id="nama" name="nama"
                        class="form-control @error('nama') is_invalid @enderror" placeholder="Nama Kota" value="{{ $item->nama }}" required>
                    @error('nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" id="type" class="form-control" data-toggle="select2" data-width="100%">
                        <option disabled>Pilih type kota</option>
                        @foreach ($types as $type)
                            @if($type == $item->type)
                                <option selected value="{{ $type }}">{{ $type }}</option>
                            @else
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endforeach