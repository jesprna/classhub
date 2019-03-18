<?php
ob_start();
session_start();


include "../includes/functions.php";
include "../includes/db.php";


$account_query = "select * from class_account where account_id = '{$_SESSION['account_id']}'";
$select_account_query = mysqli_query($connection, $account_query);

confirmQuery($select_account_query);

while($row = mysqli_fetch_array($select_account_query)){
	$account_fullname = $row['account_fullname'];
	$account_username = $row['account_username'];
	$account_password = $row['account_password'];
	$account_birthdate = $row['account_birthdate'];
	$account_photo = $row['account_photo'];
	$account_email = $row['account_email'];

}

?>


<!DOCTYPE html>


<html>
<head>
	<title></title>
</head>

<?php include "home_header.php"; ?>
<body>

<?php include "home_sidebar.php"; ?>

<div class="content" >
        <div class="container-fluid">
            <div class="row">

 

 <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12  center-block">

  <form  action="index.php" method="post">
    
                        
                       

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input value="<?php echo $account_fullname; ?>" required="" type="text" name="fullname" class="form-control" placeholder="Full Name"/>
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
                                <input value="<?php echo $account_username; ?>" type="text" name="username" class="form-control" placeholder="Username" required="" />
                                      
                                       
                            </div>
                            <?php 
                            echo isset($error['username']) ? $error['username'] : ''
                            ?>  
                            <p></p>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input value="<?php echo $account_email; ?>" type="email" name="email" class="form-control" placeholder="somebody@example.com" required="" />
                            </div>
                              <?php 
                            echo isset($error['email']) ? $error['email'] : ''
                            ?>
                         <p></p>
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                               <input value="<?php echo $account_birthdate; ?>" type="date" name="birthdate" class="form-control" required="">
                            </div>
                        <?php 
                            echo isset($error['birthdate']) ? $error['birthdate'] : ''
                            ?>
                            <p></p>
                         <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                <input value="<?php echo $account_password; ?>" type="password" name="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <?php 
                            echo isset($error['password']) ? $error['password'] : ''
                            ?>
                            <p></p>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                <input value="<?php echo $account_password; ?>" type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required="" />
                                <span class="input-group-btn">
                                    
                                    <button type="submit" name="sign_up" class="btn btn-primary"><strong>Submit</strong></button> <button  class="btn btn-danger"><strong>Cancel</strong></button>
                                </span>
                            </div>
                            <?php 
                            echo isset($error['password']) ? $error['fullname'] : ''
                            ?>
                        </form>     


</div>
 

 
                                     </div>
                                     </div>
                                     </div>


</body>


<?php include"home_footer.php"; ?>
</html>