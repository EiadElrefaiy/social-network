function previewImage(input) {
    var file = input.files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
            $('.file-upload').val(''); // Reset the input value
        };

        reader.readAsDataURL(file);
    }
}
