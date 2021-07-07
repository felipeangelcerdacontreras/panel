<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('app/views/default/link.html'); ?>

<head>
    <title>Panel redzpot</title>

    <?php require_once('app/views/default/head.html'); ?>
    <?php require_once('app/views/default/script_h.html'); ?>
    <style>
    .may {
        -webkit-border-radius: 10px 10px;
        /* Safari  */
        -moz-border-radius: 10px 10px;
        /* Firefox */
    }

    #may {
        padding: 1px 77px;
        background: #FF0;
        box-shadow: 8px 9px 4px #a5a5a5;
        border-radius: 37px;
        color: #fff;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function(e) {
        $("#may").hide();

        $("#usr, #pass").keyup(function(event) {
            var tecla = event.keyCode;
            if (tecla == 13) {
                Login();
            }
        });

        $("#btnLogin").click(function(e) {
            //Alert("boton login");
            Login();
        });

        $('#pass').keypress(function(e) {
            kc = e.keyCode ? e.keyCode : e.which;
            sk = e.shiftKey ? e.shiftKey : ((kc == 16) ? true : false);
            if (((kc >= 65 && kc <= 90) && !sk) || ((kc >= 97 && kc <= 122) && sk)) {
                $("#may").show();
            } else {
                $("#may").hide();
            }
        });

    });

    function Login() {
        var jsonDatos = {
            "usr": $("#usr").val(),
            "pass": $("#pass").val(),
            "accion": "LOGIN"
        };

        $.ajax({
            data: jsonDatos,
            type: "post",
            dataType: "json",
            url: "app/views/default/modules/login/m.login_procesa.php",
            beforeSend: function() {},
            success: function(datos) {
                if (datos.valido === true) {
                    Alert("Bienvenido", "", "success");
                    document.location = datos.msg;
                } else
                    Alert("Error acceso", datos.msg, "error");
            }

        });
    }

    function Alert(tit, msg, iconn) {
        swal({
            title: tit,
            text: msg,
            icon: iconn,
        })
    }
    </script>

<body class="bg-gradient-info">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-5 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="p-5">
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                aria-describedby="emailHelp" name="usr" id="usr"
                                                placeholder="usuario@dominio.com" required="required">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                placeholder="Password" id="pass" name='pass'>
                                        </div>
                                        <div class="clearfix" id="may">
                                            <h4 class="pull-right" style="color:#FF0000;font-size:20px;">Bloq Mayús
                                                activado.</h4>
                                        </div><br>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input type="button" id="btnLogin"
                                            class="btn bg-gradient-info btn-user btn-block" name="btnLogin"
                                            value="Login" style="color:#000;">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="navbar-default navbar-fixed-bottom">
            <div class="text-center footer" style="color:#000;">Copyright © <script>
                document.write(new Date().getFullYear());
                </script> Code Redzpot. All Right Reserved.</div>
        </div>
    </div>
    <?php require_once('app/views/default/script_f.html'); ?>
</body>

</html>