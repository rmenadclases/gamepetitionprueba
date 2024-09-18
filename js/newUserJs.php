<script>
    $("#btnNewUser").click(function() {
        if (validarUser()) {
            $.ajax({
                url: 'app/setNewUser.php',
                type: 'post',
                data: {
                    username: $("#userName").val(),
                    name: $("#nameSurname").val(),
                    email: $("#email").val(),
                    pass: $("#password2").val(),
                    domicilio: $("#domicilio").val(),
                    telefono: $("#telefono").val(),
                    newsCheck: $("#newsCheck").is(':checked')
                },
                dataType: 'json',
                success: function(response) {
                    if (response['RESPONSE'] == 'SUCCESS') {
                        borrarCampos()
                        $("#successNewUser").show();
                    }
                    if (response['RESPONSE'] == 'ERROR') {
                        $("#alertNewUser").show();
                        $("#" + response['ERROR']).show()
                    }
                }
            });
        }
    });

    function borrarCampos() {
        $("#userName").val('')
        $("#nameSurname").val('')
        $("#email").val('')
        $("#password").val('')
        $("#password2").val('')
        $("#domicilio").val('')
        $("#telefono").val('')
        $("#newsCheck").prop('checked', false);
    }

    function clearAlert() {
        $("#alertNewUser").hide();
        $("#email_registered").hide();
        $("#username_registered").hide();
    }

    function validarUser() {
        clearAlert()
        valido = true
        if (validaruserName() == false) {
            valido = false
        }
        if (validarnameSurname() == false) {
            valido = false
        }
        if (validaremail() == false) {
            valido = false
        }
        if (validarpassword2() == false) {
            valido = false
        }
        if (validardomicilio() == false) {
            valido = false
        }
        if (validartelefono() == false) {
            valido = false
        }
        return valido
    }

    function validaruserName() {
        userName = true
        var ar = /^[^']+$/;
        if (ar.test($("#userName").val()) === false) {
            $("#userName").addClass("is-invalid");
            $("#userNameValidate").show();
            userName = false
        } else {
            $("#userNameValidate").hide();
        }
        if ($("#userName").val().length > 30 || $("#userName").val().length < 1) {
            $("#userName").addClass("is-invalid");
            $("#userNameValidateLong").show();
            userName = false
        } else {
            $("#userNameValidateLong").hide();
        }
        if (userName) {
            $("#userName").removeClass("is-invalid");
        }
        return (userName)
    };
    $('#userName').on('focusout', function() {
        validaruserName()
    });

    function validarnameSurname() {
        nameSurname = true
        var ar = /^[^']+$/;
        if (ar.test($("#nameSurname").val()) === false) {
            $("#nameSurname").addClass("is-invalid");
            $("#nameSurnameValidate").show();
            nameSurname = false
        } else {
            $("#nameSurnameValidate").hide();
        }
        if ($("#nameSurname").val().length > 50 || $("#nameSurname").val().length < 1) {
            $("#nameSurname").addClass("is-invalid");
            $("#nameSurnameValidateLong").show();
            nameSurname = false
        } else {
            $("#nameSurnameValidateLong").hide();
        }
        if (nameSurname) {
            $("#nameSurname").removeClass("is-invalid");
        }
        return (nameSurname)
    };
    $('#nameSurname').on('focusout', function() {
        validarnameSurname()
    });

    function validaremail() {
        email = true
        var ar = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (ar.test($("#email").val()) === false) {
            $("#email").addClass("is-invalid");
            $("#emailValidate").show();
            email = false
        } else {
            $("#emailValidate").hide();
        }
        if ($("#email").val().length > 50 || $("#email").val().length < 1) {
            $("#email").addClass("is-invalid");
            $("#emailValidateLong").show();
            email = false
        } else {
            $("#emailValidateLong").hide();
        }
        if (email) {
            $("#email").removeClass("is-invalid");
        }
        return (email)
    };
    $('#email').on('focusout', function() {
        validaremail()
    });

    function validarpassword2() {
        password2 = true
        if ($("#password2").val() !== $("#password").val() || $("#password2").val() == '') {
            $("#password2").addClass("is-invalid");
            $("#password2Validate").show();
            password2 = false
        } else {
            $("#password2Validate").hide();
        }
        if (password2) {
            $("#password2").removeClass("is-invalid");
        }
        return (password2)
    };
    $('#password2').on('focusout', function() {
        validarpassword2()
    });

    function validardomicilio() {
        domicilio = true
        if ($("#domicilio").val() != '') {
            var ar = /^[^']+$/;
            if (ar.test($("#domicilio").val()) === false) {
                $("#domicilio").addClass("is-invalid");
                $("#domicilioValidate").show();
                domicilio = false
            } else {
                $("#domicilioValidate").hide();
            }
        }
        if ($("#domicilio").val().length > 100) {
            $("#domicilio").addClass("is-invalid");
            $("#domicilioValidateLong").show();
            domicilio = false
        } else {
            $("#domicilioValidateLong").hide();
        }
        if (domicilio) {
            $("#domicilio").removeClass("is-invalid");
        }
        return (domicilio)
    };
    $('#domicilio').on('focusout', function() {
        validardomicilio()
    });

    function validartelefono() {
        telefono = true
        if ($("#telefono").val() != '') {
            var ar = /^[^']+$/;
            if (ar.test($("#telefono").val()) === false) {
                $("#telefono").addClass("is-invalid");
                $("#telefonoValidate").show();
                telefono = false
            } else {
                $("#telefonoValidate").hide();
            }
        }
        if ($("#telefono").val().length > 10) {
            $("#telefono").addClass("is-invalid");
            $("#telefonoValidateLong").show();
            telefono = false
        } else {
            $("#telefonoValidateLong").hide();
        }
        if (telefono) {
            $("#telefono").removeClass("is-invalid");
        }
        return (telefono)
    };
    $('#telefono').on('focusout', function() {
        validartelefono()
    });
</script>