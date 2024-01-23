<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sign in </title>
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
      background-image: url('img/image2.png'); /* Replace 'your-background-image.jpg' with the actual path to your image */
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
                        <div class=" align-items-center  justify-content-between mb-3">
                                
                              <h5 class="align-items-center text-dark">Hello !</h5> 
                              <span  class="align-items-center text-dark"> Log in to Get Started</span>
                             </div>
                             <div class="form-floating  mb-3 ">
                                 <input type="email" name="rid" class="form-control rounded bg-white text-dark " id="floatingInput" placeholder="name@example.com" required>
                                 <label for="floatingInput"> Admin Id</label>
                             </div>
                             <div class="form-floating mb-4">
                                 <input type="password" name="password" class="form-control rounded bg-white text-dark" id="floatingPassword" placeholder="Password" required>
                                 <label for="floatingPassword">Password</label>
                             </div>
                             
                             <button type="submit" name="signin" class="btn text-white btn-lg rounded-pill py-3 w-100 mb-4" style="background-image: linear-gradient(144deg,#5b0697, #6f5af2 100%);">Sign In <span><i class="bi bi-arrow-right ms-3"></i></span></button>
                             <?php

    if(isset($_POST['signin'])){
        include "config.php";
        $remail=$_POST['rid'];
        $rpassword=$_POST['password'];

            $sql="SELECT * FROM resolver WHERE r_email='$remail'";
            $result=mysqli_query($conn,$sql);
    
            if(mysqli_num_rows($result)>0){
                
                $count=0;
                while($row=mysqli_fetch_assoc($result)){
                    if($remail==$_POST['rid'] && $rpassword==$row['r_password']){
                        session_start();
                        $_SESSION["r_email"]=$row['r_email'];
                        $_SESSION["r_password"]=$row['r_password'];
                        // header("Location:index.php");    
                        $count++;
                    }
                }
                if($count>0){
                    header("Location:index.php");
                }else{
                   echo  '<div class="alert alert-danger">Invalid Credentials!</div>';
                }
            }else{
                echo '<div class="alert alert-danger">User Doesn\'t Exists!</div>';
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