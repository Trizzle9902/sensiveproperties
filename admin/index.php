<?php 
/*echo sha1("password");*/
include('connect.php');
   if (isset($_POST['submit'])) {

        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        $error = '';

        $check_admin = mysqli_query($dbconnect,"SELECT email FROM `admin` WHERE `email` = '$email' AND `password`='$password'");
         if (mysqli_num_rows($check_admin) == 1) {
           header('location:dashboard.php');
         }else{
            global $error;
            $error .= "invalid username or password";  
         }     
   }
?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                    
                                        <form action="index.php" method="post">
                                        <?php 
                                            if (!empty($error)){ ?>
                                            <div class="alert alert-danger alert-dismissible col-md-12">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <strong>Error!</strong> <?php  echo $error  ?>
                                            </div>
                                        <?php } ?>
                                            <div class="form-group" ><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" id="inputEmailAddress" type="email" name="email" placeholder="Enter email address" /></div>
                                            <div class="form-group" ><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                                               
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox"><input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" /><label class="custom-control-label" for="rememberPasswordCheck">Remember password</label></div>
                                            </div>
                                            <button class="btn btn-primary" type="submit" name="submit">Login</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
