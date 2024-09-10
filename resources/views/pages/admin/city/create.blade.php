<!-- Standard modal content -->
<div id="create-city-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="standard-modalLabel">Create new City</h4>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('city.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="form-group mb-3">
                    <label for="nama" class="form-label">Nama Kota</label>
                    <input type="text" id="nama" name="nama"
                        class="form-control @error('nama') is_invalid @enderror" placeholder="Nama Kota" value="{{ old('nama') }}" required>
                    @error('nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" id="type" data-toggle="select2" data-width="100%">
                        <option disabled selected>Pilih type kota</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
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

