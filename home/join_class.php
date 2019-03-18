<?php
ob_start();
session_start();
include "../includes/db.php";
include "../includes/functions.php";
if (!isset($_SESSION['username'])){
    header("Location: ../index.php");
}
if (!isset($_SESSION['join_classname'])){
    header("Location: index.php");
}



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

if (isset($_POST['joinclass_button'])){
$class_name= $_POST['class_name'];
$member_name = $_POST['member_name'];
$member_type = $_POST['member_type'];
$member_approve ='';
$class_id='';
$class_approval;
$account_id = $_SESSION['account_id'];


$error = [
       
       'account_id'=>'',
       
   ];
     


   

$class_query = "select * from class_main where class_name = '{$class_name}'";
    $select_class_query = mysqli_query($connection, $class_query);

    confirmQuery($select_class_query);

    while($row = mysqli_fetch_array($select_class_query)){
         $class_id = $row['class_id'];
         $class_approval = $row['class_approval'];

        
        
    }
    if ($class_approval == 1){
    	$member_approve =0;

    }else{
    	$member_approve =1;
    }
    if (member_exists($account_id, $class_id)){
        $error['account_id'] = 'Already a member';
    }
 foreach($error as $key => $value){
        if(empty($value)){
      if (member_exists($_SESSION['account_id'], $class_id)){
        echo "already a member";
      }else{

     $query = "insert into class_member (member_accountid, member_accounttype,member_approve, member_name, member_classid)";
    $query .= "values ('$account_id', '$member_type','$member_approve','$member_name','$class_id')";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    header("Location: ../myclass"); 
          
      }
                
        }
        
    }
    



}





 ?>
<?php

?>
<!DOCTYPE html>
<html>
<?php include"home_header.php"; ?>
<body>
<?php include"home_sidebar.php"; ?>
 <div class="content" >
        <div class="container-fluid">
            <div class="row">

    <form action="join_class.php" method="post" class="form-horizontal">
      <div class="modal-header">
        <h3>Join to <?php  echo $_SESSION['join_classname'] ?> </h3>
         <?php 
                            echo isset($error['account_id']) ? $error['account_id'] : ''
                            ?>
      </div>
      <div class="modal-body">

      	<div class="form-group">
      		<label for="contact-name" class="col-lg-2 control-label"  >Class Name:</label>
      		<div class="col-lg-10">
      			<input type="text" class="form-control"  value="<?php  echo $_SESSION['join_classname'] ?>" name="class_name" placeholder="Full Name" readonly>
      		</div>
      	</div>
      	<div class="form-group">
      		<label for="contact-name" class="col-lg-2 control-label"  >Full Name</label>
      		<div class="col-lg-10">
      			<input type="text" class="form-control" value="<?php  echo $_SESSION['fullname'] ?>" name="member_name" placeholder="Full Name" readonly>
      		</div>
      	</div>

            <div class="form-group">
            <label for="contact-number" class="col-lg-2 control-label"  >You are a </label>
            <div class="col-lg-10">
             <select  name="member_type">
    <option value="student">Student</option>
    <option value="teacher">Teacher</option>
    </select>
    
            </div>
          </div>


           

        
      </div>
      <div class="modal-footer">
          <button type="submit" name="joinclass_button" class="btn btn-primary" >Join Now</button>        
      </div>


      </form>

</div>
</div>
</div>



</body>
<?php include"home_footer.php"; ?>
</html>