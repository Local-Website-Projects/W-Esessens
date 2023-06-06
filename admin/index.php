<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
if (isset($_SESSION['userid'])) {
    header("Location: Product");
}?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Login | Wayshk Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
                                        <h1 class="text-white">Wayshk Admin</h1>
									</div>
                                    <h4 class="text-center mb-4 text-white">Sign in your account</h4>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Email</strong></label>
                                            <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="text-center mt-4 pt-2">
                                            <button type="submit" name="sub_log" class="btn bg-white text-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <?php
    if (isset($_POST['sub_log'])) {
        $email = $db_handle->checkValue($_POST['email']);
        $password = $db_handle->checkValue($_POST['password']);

        $login = $db_handle->numRows("SELECT * FROM admin_login WHERE email='$email' and password='$password'");

        $login_data = $db_handle->runQuery("SELECT * FROM admin_login WHERE email='$email' and password='$password'");

        if($login==1){
            $_SESSION['userid']=$login_data[0]["id"];
            $_SESSION['name']=$login_data[0]["name"];

            ?>
            <script>
                window.location.href = "Product";
            </script>
        <?php
        }else{
        ?>
            <script>
                alert('email address and password wrong!');
            </script>
            <?php
        }
    }
    ?>
</body>
</html>
