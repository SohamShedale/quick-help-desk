
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Create</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- css style -->
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">


    <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      overflow: hidden;
      background-image: url('img/image1.png'); /* Replace 'your-background-image.jpg' with the actual path to your image */
      background-size: cover;
      background-position: center;
    }

    .overlay {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
    }
    .rounded1{
        border-radius: 40px;
    }
    </style>
</head>

<body>
    <div class="overlay"></div>

    <div class="container-fluid position-relative d-flex p-0">

       
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-8">
                    <div class="bg-white rounded1 p-4 p-sm-5 ">
                    <div class="row">
                        <div class="col-5"><div>
                            <img src="img/logo.png" alt="" style="margin-top:80px;">
                            </div>
                        </div>
                        <div class="col-7">
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="d-flex align-items-center  justify-content-center mb-3">
                              <h5 class="d-flex align-items-center text-dark">Create New Account</h5>
                             </div>
                             <div class="form-floating  mb-3 ">
                                 <input type="number" name="r_id" class="form-control rounded bg-white text-dark " id="floatingInput" placeholder="" required>
                                 <label for="floatingInput"> Executive Id</label>
                             </div>
                             <div class="form-floating mb-4">
                                 <input type="password" name="password" class="form-control rounded bg-white text-dark" id="floatingPassword" placeholder="" required>
                                 <label for="floatingPassword">Password</label>
                             </div>
                             <div class="form-floating   mb-4">
                                 <input type="password" name="confPass" class="form-control rounded bg-white text-dark" id="floatingPassword" placeholder="" required>
                                 <label for="floatingPassword"> Confirm Password</label>
                             </div>
                             <button type="submit" name="signup" class="btn text-white btn-lg rounded-pill py-3 w-100 mb-4" style="background-image: linear-gradient(144deg,#5b0697, #6f5af2 100%);">Create Account <span><i class="bi bi-arrow-right ms-3"></i></span></button>
                             <?php

                                    if(isset($_POST['signup'])){
                                        include "config.php";
                                        $rid=$_POST['r_id'];
                                        $rpassword1=$_POST['password'];
                                        $rpassword2=$_POST['confPass'];

                                        if($rpassword1!=$rpassword2){
                                            echo '<div class="alert alert-danger">Passwords Don\'t Match!</div>';
                                        }else{
                                            $sql="SELECT executive_id FROM executive WHERE executive_id='$rid'";
                                            $result=mysqli_query($conn,$sql);

                                            if(mysqli_num_rows($result)>0){
                                                echo '<div class="alert alert-danger">User Already Exists!</div>';
                                            }else{
                                                $sql="INSERT INTO executive VALUES('$rid','$rpassword1')";
                                                $result=mysqli_query($conn,$sql);
                                                if($result){
                                                    header("Location:executive_signin.php");
                                                }
                                            }
                                        }

                                    }

                                ?>

                            </form>
                    </div>
                    </div>
                   </div>
                        
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="assets/jquery-3.4.1.min.js"></script>
    <script src="assets/bootstrap.bundle.min.js"></script>
    <script src="assets/kit.js"></script>

    
</body>

</html>