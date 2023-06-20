<link rel="stylesheet" href="/contens/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="/contens/iziToast-master/dist/css/iziToast.min.css">
<script src="/contens/jquery/jquery.min.js"></script>
<script src="/contens/axios/axios.min.js"></script>
<style>
    .Login {
        width: 100dwh;
        height: 100dvh;
    }

    .Login .container {
        height: inherit;
    }

    .container .loginContainer {
        width: inherit;
        height: inherit;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
    }

    .loginContainer .card {
        width: 400px;
        height: 450;
        box-shadow: 10px 10px 5px lightblue;
        border: 1px solid #0dcaf0;
    }

    .loginContainer .card-header {
        color: #0dcaf0;
        border-bottom: 1px solid;
    }

    .loginContainer .card-footer {
        color: #0dcaf0;
        border-top: 1px solid #0dcaf0;
    }

    .captcha-container {
        position: relative;
    }

    .captcha-container input {
        padding-left: 4.1rem;
    }

    .sing_in {
        width: 100%;
        color: white;
    }

    .captchaSource {
        position: absolute;
        left: 10px;
        top: 7px;
        font-weight: bold;
        font-size: large;
    }

    .form-control:focus {
        color: var(--bs-body-color);
        background-color: var(--bs-body-bg);
        border-color: #0dcaf0ad;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgb(0 184 221 / 23%);
    }
</style>
<!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image"> -->

<div class="Login">
    <div class="container">
        <div class="loginContainer">
            <div class="card ">
                <div class="card-header text-center">
                    <h3>Sign In</h3>
                </div>
                <div class="card-body">
                    <form class="mt-2" action="">
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input class="form-control" type="text" name="username" id="username">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Password</label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Captcha</label>
                            <div class="captcha-container">
                                <span class="captchaSource" id="captchaSource"></span>
                                <input class="form-control" type="text" name="captcha" id="captcha">
                            </div>
                        </div>
                        <div class="form-gorup text-center mt-3">
                            <button type="button" id="sing_in" class="btn btn-info sing_in">Sign In</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted text-center">
                    <small>Power by KG</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/contens/bootstrap/bootstrap.bundle.min.js"></script>
<script src="/contens/iziToast-master/dist/js/iziToast.min.js"></script>
<script>
    $(document).ready(function() {
        function iziToastSuccess(title = "Success", smg) {
            iziToast.success({
                title: title,
                message: smg,
                position: 'topRight'
            });
        }

        function iziToastError(title = "Error", smg = "Somethings went wrong") {
            iziToast.error({
                title: title,
                message: smg,
                position: 'topRight'
            });
        }

        //create captcha
        var captchaSource = "";
        const characters = "0123456789";
        const charactersLength = characters.length;
        for (let i = 0; i < 4; i++) {
            captchaSource += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        $("#captchaSource").html(`${captchaSource} - `);


        $('#sing_in').click(function() {
            let username = $("#username");
            let password = $("#password");
            let captcha = $("#captcha");
            if (!username.val()) {
                iziToastError("User Name", "Please Input Username")
                username.focus();
                return;
            }
            if (!password.val()) {
                iziToastError("Password", "Please Input Password");
                password.focus();
                return;
            }
            if (!captcha.val() || captcha.val() != captchaSource) {
                iziToastError("Captcha", "Please Input Captcha")
                captcha.focus();
                return;
            }

            axios.post('http://telegrambotadmin/login_submiter.php', {
                username: username.val(),
                password: password.val(),
            }).then(function(res) {
                console.log("Res data => ", res.data)
                if (res.data.code == 1) {
                    console.log('success')
                    iziToastSuccess("Success", "Login Succesful")
                    setTimeout(() => {
                        window.location.href = "/";
                    }, 1000);

                }
            }).catch(function(error) {
                console.log(error);
            })

        })

    });
</script>