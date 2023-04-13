<form action="{{ $url }}" role="form" method="POST" enctype="multipart/form-data">
    @csrf
    @method("$method")
    <div class="card-body">
        <input hidden type="text" name="id" value="{{ isset($course) ? $course->id : '' }}">
        <div class="form-group">
            <label for="courseName">{{ __('string.backend.table.course.column_name') }}</label>
            <input type="text" name="name" class="form-control" id="courseName"
                value="{{ isset($course) ? $course->name : old('name') }}">
        </div>
        <div class="form-group">
            <label for="courseContent">{{ __('string.backend.table.course.column_content') }}</label>
            <textarea class="tinymce" name="content" class="form-control"
                id="courseContent">{{ isset($course) ? $course->content : old('content') }}</textarea>
        </div>
        <div class="form-group">
            <label for="courseDescription">{{ __('string.backend.table.course.column_description') }}</label>
            <input type="text" name="description" class="form-control" id="courseDescription"
                value="{{ isset($course) ? $course->description : old('description') }}">
        </div>
        <div class="form-group">
            <label for="courseAnnounce">{{ __('string.backend.table.course.column_announce') }}</label>
            <input type="text" name="announce" class="form-control" id="courseAnnounce"
                value="{{ isset($course) ? $course->announce : old('announce') }}">
        </div>
        <div class="form-group">
            <label for="courseInformation">{{ __('string.backend.table.course.column_information') }}</label>
            <input type="text" name="information" class="form-control" id="courseInformation"
                value="{{ isset($course) ? $course->information : old('information') }}">
        </div>

        <div class="form-group">
            <label for="">{{ __('string.backend.table.course.column_thumbnail') }}</label>
            <div class="custom-file">
                <input type="file" name="images" class="custom-file-input" id="customFile">
                <label class="custom-file-label"
                    for="customFile">{{ __('string.backend.table.course.label_upload_file') }}</label>
            </div>
            <div class="gallery" style="text-align: center">
                <div class="img-wrap">
                    <span class="close">&times;</span>
                </div>
                @if (isset($course) && isset($course->image))
                    <div class="img-wrap">
                        <span class="close">&times;</span>
                        <img src="/storage/users/{{ $course->created_by }}/course/{{ $course->id }}/thumbnail/{{ $course->image->url }}"
                            style="width:200px; margin: 10px" data-id="{{ $course->image->id }}" />
                    </div>
                    <input type="hidden" name="imageID" value="{{ $course->image->id }}" id="imagesDelete">
                    <input type="hidden" name="isRemoveImage" value="" id="isRemoveImage">
                @endif
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">
            {{ __('string.backend.table.course.btn_submit') }}
        </button>
    </div>
</form>

@push('after-js')
    <script>
        $(document).on('change', '#customFile', function() {
            imagesPreview(this, 'div.gallery', false);
        });

        const imagesPreview = function(input, placeToInsertImagePreview, isMultiple) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        if (!isMultiple) {
                            $(placeToInsertImagePreview).find('img').parent().remove();
                        }
                        $('#isRemoveImage').val('');
                        setImageFrame(event.target.result).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        };

        const setImageFrame = (src) => {
            let img = $('.img-wrap').first().clone();
            $($.parseHTML('<img>')).attr('src', src).appendTo(img);
            return img;
        }

        $('.gallery').on('click', '.img-wrap .close', function() {
            $(this).closest('.img-wrap').remove();
            const idDelete = $(this).next('img').data('id');
            console.log(idDelete);
            if (idDelete) {
                $('#isRemoveImage').val(idDelete);
            }
        });

    </script>
@endpush
