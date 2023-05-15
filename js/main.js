
$(document).ready(function () {
    $("form").submit(function (event) {

        $('#msgSuccess').hide();
        $('#msgSuccess').text('');
        $('#msgError').text('');
        $('#msgError').hide();


        const formData = {
            firstName: $("#InputFirstName").val(),
            secondName: $("#InputLastName").val(),
            email: $("#InputEmail").val(),
            password: $("#InputPassword").val(),
            passwordRepeat: $("#InputPasswordRepeat").val(),
        };


        if (formData.password != formData.passwordRepeat) {
            $('#msgError').text('password not eq');
            $('#msgError').show();
            return false;
        }

        $.ajax({
            type: "POST",
            url: "/api/index.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (data.error) {
                $('#msgError').text(data.message);
                $('#msgError').show();
            } else {
                $('#msgSuccess').text(data.message);
                $('#msgSuccess').show();
                $("form").hide();
            }
        });

        event.preventDefault();
    });


});