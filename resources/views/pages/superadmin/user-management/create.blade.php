<!-- Standard modal content -->
<div id="create-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="standard-modalLabel">Create new User</h4>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('superadmin-user-store') }}" method="POST"  class="needs-validation" novalidate>
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name"
                        class="form-control @error('name') is_invalid @enderror" placeholder="Enter name account..." value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" id="email" name="email"
                        class="form-control @error('email') is_invalid @enderror" placeholder="Enter email account..." value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role_id" class="form-label">Role</label>
                    <select name="role_id" id="role_id" class="form-control @error('role_id') is_invalid
                    @enderror">
                        <option selected disabled>Select role user...</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                    </select>
                    @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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