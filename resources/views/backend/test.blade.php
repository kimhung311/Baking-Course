<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Timymce</title>
</head>

<body>
    <form action="#" method="post" enctype="multipart/form-data">
        @csrf
        <textarea class="tinymce" name="tinymce"></textarea>
        <button type="submit">Submit</button>
    </form>
    <script src="{{ mix('/dist/js/backend/app.js') }}"></script>
    <script>
        tinymce.baseURL = "js/tinymce";
        tinymce.init({
            // height: "500",
            selector: 'textarea.tinymce',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback: function(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document
                    .getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;
    
                let type = 'image' === meta.filetype ? 'Images' : 'Files',
                    url = '/laravel-filemanager?editor=tinymce5&type=' + type;
    
                tinymce.activeEditor.windowManager.openUrl({
                    url: url,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        });
    
    </script>
    
    
    
</body>

</html>
