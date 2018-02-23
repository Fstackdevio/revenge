<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Global coin club</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="bg-accpunt-pages">

        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="account-pages">
                                <div class="account-box">
                                    <div class="account-logo-box">
                                        <h2 class="text-uppercase text-center">
                                            <a href="index-2.html" class="text-success">
                                                <span><img src="assets/images/logo_dark.png" alt="" height="30"></span>
                                            </a>
                                        </h2>
                                        <h5 class="text-uppercase font-bold m-b-5 m-t-50">Register</h5>
                                        <p class="m-b-0">Get access to our admin panel</p>
                                    </div>
                                    <div class="account-content">
                                        <form class="form-horizontal" id="register" method="POST" action="../useclass/registration.php">

                                            <div class="form-group m-b-20">
                                                <div class="col-xs-12">
                                                    <label for="username">Full Name</label>
                                                    <input class="form-control" name="fullname" type="text" id="username" required="" placeholder="Michael Zenaty">
                                                </div>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <div class="col-xs-12">
                                                    <label for="emailaddress">Email address</label>
                                                    <input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="john@deo.com">
                                                </div>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <div class="col-xs-12">
                                                    <label for="password">Password</label>
                                                    <input class="form-control" name="pass" type="password" required="" id="password" placeholder="Enter your password">
                                                </div>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <div class="col-xs-12">
                                                    <label for="password">phone number</label>
                                                    <input class="form-control" name="phone" type="text" required="" id="phone" placeholder="Enter your phone number">
                                                </div>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <div class="col-xs-12">

                                                    <div class="checkbox checkbox-success">
                                                        <input id="remember" type="checkbox" checked="">
                                                        <label for="remember">
                                                            I accept <a href="#">Terms and Conditions</a>
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group text-center m-t-10">
                                                <div class="col-xs-12">
                                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" name="submit" type="submit">Sign Up Free</button>
                                                </div>
                                            </div>

                                        </form>

                                       

                                        <div class="row m-t-50">
                                            <div class="col-sm-12 text-center">
                                                <p class="text-muted">Already have an account?  <a href="page-login.php" class="text-dark m-l-5"><b>Sign In</b></a></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>


                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->



        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
         <script>
            $('#register').submit(function() { // catch the form's submit event
                $.ajax({ // create an AJAX call...
                    data: $(this).serialize(), // get the form data
                    type: $(this).attr('method'), // GET or POST
                    url: $(this).attr('action'), // the file to call
                    success: function(response) { // on success..
                        if (response==="ok") {
                            window.location.href = "page-confirm-account.php";
                        }else{
                            $('#register').html(response); // update the DIV
                            setTimeout(function() {
                                $('#created').fadeOut("slow");
                            }, 20000 );
                        }
                    }
                    });
                return false; // cancel original event to prevent form submitting
            });
        </script>

    </body>
</html>