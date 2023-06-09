<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title> Evaluation System | PHP MVC </title>
    <link rel="manifest" href="views/dist/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="views/dist/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="views/dist/vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="views/dist/css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="views/dist/css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="views/dist/css/examples.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center text-center">
                <img class="mb-3" src="views/vendors/images/logo.png" style="width: 230px; height: 200px;"/>
                <h1>Kolehiyo ng Lungsod ng Dasmariñas<br>Faculty Evaluation System</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <div class="card-body">
                                <form id="login">
                                    <h3>Login</h3>
                                    <p class="text-medium-emphasis">Sign in to your account</p>
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <svg class="icon">
                                                <img src="views/vendors/@coreui/icons/svg/free/cil-envelope-closed.svg"/>
                                            </svg></span>
                                        <input class="form-control" type="text" name="username" id="username" placeholder="Username">
                                    </div>
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <svg class="icon">
                                                <img src="views/vendors/@coreui/icons/svg/free/cil-lock-locked.svg"/>
                                            </svg></span>
                                        <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                                    </div>
                                    <div class="input-group mb-4"><span class="input-group-text">
                                            <svg class="icon">
                                                <img src="views/vendors/@coreui/icons/svg/free/cil-group.svg"/>
                                            </svg></span>
                                        <select class="form-select" name="role" id="role">
                                            <option value="3">Student</option>
                                            <option value="2">Professor</option>
                                            <option value="1">Admin</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-success text-white px-4" type="submit">Login</button>
                                        </div>
                                        <!-- <div class="col-6 text-end">
                                            <button class="btn btn-link px-0" type="button">Forgot password?</button>
                                        </div> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- <div class="card col-md-5 text-white bg-primary py-5">
                            <div class="card-body text-center">
                                <div>
                                    <h2>Sign up</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.</p>
                                    <button class="btn btn-lg btn-outline-light mt-3" type="button">Register
                                        Now!</button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="views/dist/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="views/dist/vendors/simplebar/js/simplebar.min.js"></script>
    <script src="views/dist/js/sweet_alert.min.js"></script>
    <script>
        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control',
                popup: 'custom-width'
            },
        });

        $("#login").submit(function(event){
        event.preventDefault();

        var formData = $(this).serialize();
        swalInit.fire({
            position: 'top-end',
            toast: true,
            text: 'Please wait...',
            allowOutsideClick: false,
            showConfirmButton: false,
            timer: 3000
        });

        $.ajax({
            url: '/login_ajax',
            method: 'POST',
            data: formData,
            success: function(data){
                data = JSON.parse(data);
                if(data.success === 'false'){
                    swalInit.close();
                    swalInit.fire({
                        text: 'Login failed!',
                        icon: 'error',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else if(data.success === 'admin') {
                    swalInit.close();
                    swalInit.fire({
                        text: 'Logged in successfully!',
                        icon: 'success',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location = '/admin/dashboard';
                    });
                } else if(data.success === 'professor') {
                    swalInit.close();
                    swalInit.fire({
                        text: 'Logged in successfully!',
                        icon: 'success',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location = '/professor/dashboard';
                    });
                } else if(data.success === 'student') {
                    swalInit.close();
                    swalInit.fire({
                        text: 'Logged in successfully!',
                        icon: 'success',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location = '/student/dashboard';
                    });
                }
            },
            error: function(error){
                swalInit.close();
                swalInit.fire({
                    title: 'Error',
                    text: 'There is error occurred. Please contact the administrator.',
                    icon: 'error',
                    toast: true,
                    position: 'top-end',
                    timer: 3000
                });
                console.log("Error: ", error);
            }
        });

    });
    </script>

</body>

</html>