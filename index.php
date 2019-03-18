<?php

ob_start();
session_start();

$_SESSION['username'] = null;

?>
<?php 
include "includes/functions.php";
include "includes/db.php";
?>

<?php
if (isset($_POST['login_button'])){

    class_login($_POST['login_username'], $_POST['login_password']);
    
}

if (isset($_POST['sign_up'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $birthdate = trim($_POST['birthdate']);
    $confirm_password = trim($_POST['confirm_password']);
    $fullname = trim($_POST['fullname']);
    
   $error = [
       
       'username'=>'',
       'password'=>'',
       'email'=>'',
       'birthdate'=>'',
       'fullname' => ''
       
   ];

   if ($fullname==''){
        $error['fullname']= 'Your name cannot be empty';

   }
    if ($birthdate==''){
        $error['birthdate'] = 'Birthdate cannot be empty';
    }
    if ($username==''){
        $error['username'] = 'Username cannot be empty';
    }
    if (username_exists($username)){
        $error['username'] = 'Username exist, Please choose another one';
    }
    if ($email==''){
        $error['email'] = 'email cannot be empty';
    }
    if (email_exists($email)){
        $error['email'] = 'Email exist, <a href="index.php">Please Login </a> ';
    }
    if ($password==''){
        $error['password'] = "Password cannot be empty";
    }
    if ($password !== $confirm_password){

        $error['password'] = "Password do not match";
    }
    if ($fullname ==''){
            $error['fullname'] = "Your name is required";
    }
    
    foreach($error as $key => $value){
        if(empty($value)){
            
             class_signup($username,$password,$email,$birthdate,$confirm_password,$fullname);
            
        }
        
    }



   
}
?>


<!DOCTYOE html>
<html lang="en">
    <head>
        <meta http-equiv="expires" content="0">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Alumni Tracer">
        <meta name="author" content="Cortez, Esporna, Mangune, Tena">
        <title>Class Messenger - Sign in</title>
        

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/stylesindex.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <!--[if lt IE9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container-fluid fit-height bghomefull">        
            <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vertical alignleft">
                    <div class="jumbotron bgnone textwhite" id="title">
                        <img src="images/class4.png" class="logolarge img-responsive">
                        <p>The innovative way of messenger to connect with your class online.</p>
                        <button class="btn btn-info">More info</button>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vertical alignleft">
                    <div class="container floatingblock bgwhite">
                        <form action="index.php" method="post">
                        
                            <h4>Welcome back,<grey> Login now!</grey></h4>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input required="" type="text" name="login_username" class="form-control" placeholder="Username" required  />
                            </div>
                            <p></p>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                <input required="" type="password" name="login_password" class="form-control" placeholder="Password" />
                                <span class="input-group-btn">
                                    <button type="submit" name="login_button" class="btn btn-primary">Login</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="container floatingblock bgwhite">
                        <form  id="sign_up" action="index.php" method="post">
    
                        
                       
                            <h4>New here? <grey>Sign up now!</grey></h4>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input type="text" name="fullname" class="form-control" placeholder="Full Name"/>
<!--                                       <p><?php 
//echo isset($error['username']) ? $error['username'] : ''// 
?>  </p>       -->
                                       
                            </div>
                            <?php 
                            echo isset($error['fullname']) ? $error['fullname'] : ''
                            ?>
<p></p>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input type="text" name="username" class="form-control" placeholder="Username"  />
                                      
                                       
                            </div>
                            <?php 
                            echo isset($error['username']) ? $error['username'] : ''
                            ?>  
                            <p></p>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="text" name="email" class="form-control" placeholder="somebody@example.com"  />
                            </div>
                              <?php 
                            echo isset($error['email']) ? $error['email'] : ''
                            ?>
                         <p></p>
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                               <input type="date" name="birthdate" class="form-control" >
                            </div>
                        <?php 
                            echo isset($error['birthdate']) ? $error['birthdate'] : ''
                            ?>
                            <p></p>
                         <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                <input type="password" name="password" class="form-control" placeholder="Password"  />
                            </div>
                            <?php 
                            echo isset($error['password']) ? $error['password'] : ''
                            ?>
                            <p></p>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password"  />
                                <span class="input-group-btn">
                                    
                                    <button type="submit" name="sign_up" class="btn btn-warning"><strong>Sign up</strong></button>
                                </span>
                            </div>
                            <?php 
                            echo isset($error['password']) ? $error['fullname'] : ''
                            ?>
                        </form>     
                            
                    </div>                      
                </div>
                <div class="vertical fitcenter "></div>
                <footer class="container-fluid">
                    <h2></h2>
                </footer>
            </div>
        </div>
       
        <script src="js/jquery.js"></script> 
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/validation.js"></script>
        <script src="js/bootstrap.min.js"></script>
         <script src="js/moment.min.js"></script> 
<script src="js/combodate.js"></script> 
    </body>
</html>