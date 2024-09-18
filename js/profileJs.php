<script>
    $(document).ready(function() {
        getProfile(0)
    });
    $("#inputFile").change(function() {
        var fd = new FormData();
        var files = $('#inputFile')[0].files[0];
        fd.append('file', files);
        $.ajax({
            url: 'resources/uploadAvatar.php',
            type: 'post',
            data: fd,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response["ERROR"] === 'SESION') {
                    window.location.href = '/logout.php'
                } else {
                    getProfile(0)
                }
            },
        });
    });

    function getProfile(id) {
        $.ajax({
            url: 'app/getProfile.php',
            type: 'post',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function(response) {
                if (response['RESPONSE'] == 'SUCCESS') {
                    d = new Date();
                    $("#avatarPrf").attr('src', response['AVATAR'] + '?' + d.getTime())
                }
                if (response['RESPONSE'] == 'ERROR') {}
            }
        });
    }
</script>