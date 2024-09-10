<script src="{{ asset('assets') }}/libs/dropify/js/dropify.min.js"></script>
@foreach ($vehicleFiles as $item)
    <div class="col-lg-4 text-center">
        <img src="{{ asset($item->file_path) }}" alt="Vehicle Image" style="width: 100%; height: 200px; object-fit: cover"
            class="rounded" />
        <button type="button" class="btn btn-link remove-file" data-id="{{ $item->id }}">Remove</button>
    </div>
@endforeach

<script src="{{ asset('assets') }}/js/pages/form-fileuploads.init.js"></script>

<script>
    $(document).ready(function() {
        // Handle remove button for existing files
        $('.remove-file').click(function() {
            var fileId = $(this).data('id');
            var removeUrl = "{{ route('vehicle.file.delete', ':id') }}".replace(':id',
                fileId); // URL untuk menghapus gambar
            $.ajax({
                url: removeUrl,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Remove file input and button
                    $('button[data-id="' + fileId + '"]').closest('.col-lg-4').remove();
                    Swal.fire({
                        icon: "success",
                        title: "Good job!",
                        text: 'Gambar berhasil dihapus!',
                    });
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>
