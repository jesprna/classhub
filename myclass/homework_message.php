<?php
ob_start();
session_start();
include "../includes/db.php";
include "../includes/functions.php";
$member_id ;
$member_query = "select * from class_member where member_accountid = '{$_SESSION['account_id']}' and member_classid='{$_SESSION['current_class']}'";
$select_member_query = mysqli_query($connection, $member_query);

confirmQuery($select_member_query);
while($row = mysqli_fetch_array($select_member_query)){
            $member_classid = $row['member_classid'];  
            $member_approve = $row['member_approve']; 
            $member_id = $row['member_id'];   
            $_SESSION['current_member'] = $member_id;  

  
        }
?>
<?php

if (!isset($_SESSION['current_class'])){
    header("Location: ../home");
}

$class_id;
$class_name ;
$class_visible ;
$class_account_id ;
$class_description ;
$class_code ;
$class_author ;
$class_approval ;
$members_link;
$classinfo_link;
$class_id =$_SESSION['current_class'];
$class_query = "select * from class_main where class_id = '{$class_id}'";
$select_class_query = mysqli_query($connection, $class_query);

confirmQuery($select_class_query);

while($row = mysqli_fetch_array($select_class_query)){
	$class_id = $row['class_id'];
	$class_name = $row['class_name'];
	$class_visible = $row['class_visible'];
	$class_account_id = $row['class_accountid'];
	$class_description = $row['class_description'];
	$class_code = $row['class_code'];
	$class_author = $row['class_author'];
	$class_approval =$row['class_approval'];
	$class_photo = $row['class_photo'];


}


if ($_SESSION['fullname'] == $class_author){
	$members_link ="class_member.php";
	$classinfo_link ="class_info.php";


}else{
	$members_link ="";
	$classinfo_link ="";

}


if (isset($_POST['general_msg'])){


	$message =$_POST['message'];
	$msg_file =$_FILES['file']['name'];
	$msg_file_temp = $_FILES['file']['tmp_name'];
	$recipients =$_POST['recipients'];
	$from_id =$_SESSION['current_member'];
	$class_id = $_SESSION['current_class'];
	$general_code = generateRandomString();



	if (empty($recipients)){
		echo "No recipients";
	}else{
		move_uploaded_file($msg_file_temp, "uploaded/$msg_file");

foreach ($recipients as $value) {
		$query = "insert into class_general (general_message, general_file, to_id, from_id, opened, recipient_delete, sender_delete, time_sent, class_id, general_code,general_cat) values ('$message','$msg_file','$value','$from_id','0','0','0', NOW(),'$class_id','$general_code','homework')";
		 $result = mysqli_query($connection, $query);


        confirmQuery($result);
        header("Location: homework_msg.php");

                    
	# code...
}

	}

	


}

?>





<!DOCTYPE html>



<html>

<head>
	<title></title>
</head>
<?php include "class_header.php"; ?>
<body>
<?php include "class_sidebar.php"; ?>




<div class="content" >
	<div class="container-fluid">
		<div class="row">
			<form id="message_form" method="post" enctype="multipart/form-data">


			<?php

$pending_approval;
$pending_member = "select * from class_member where member_classid = '{$class_id}' and member_approve =0";
$result_pending = mysqli_query($connection, $pending_member);
$pending_approval =mysqli_num_rows($result_pending);


$member_query = "select * from class_member where member_classid = '{$class_id}' order by member_accounttype desc";
$select_member_query = mysqli_query($connection, $member_query);

confirmQuery($select_member_query);

if (mysqli_num_rows($select_member_query)>1){

	?>
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">


	

						<textarea rows="12" placeholder="Enter Message (max 1000 characters)" id="enter-message" name="message"></textarea>
						<p></p>
						<input  type="file" name="file">
						<p></p>
						<button class="btn btn-primary"  type="submit" name="general_msg">Send</button>


</div>

<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
<input class="pull-right" type="checkbox" id="select-all" />
<p></p>
<p></p>
<p>All Members</p>
<?php	

while($row = mysqli_fetch_array($select_member_query)){
	$member_name =$row['member_name'];
	$member_approve =$row['member_approve'];
	$member_classid =$row['member_classid'];
	$meber_accounttype =$row['member_accounttype'];
	$member_accountid= $row['member_accounttype'];
	$member_id =$row['member_id'];

	if ($member_approve == 1){


		if ($member_id !== $_SESSION['current_member']){
			echo "
			<div class='control-group'>
				<label class='control-label ''> $member_name</label>
				<div class='controls pull-right'>
					<label class='radio-inline'><input required type='checkbox' value='$member_id' name='recipients[]'></label>
				</div>
			</div>
			";
		}
	}



}
}else{
	echo "You dont have recipients";


}
	

?>

</div>

</form>

						</div>

		</div>
	</div>
</div>



	

</body>


<?php include "class_footer.php"; ?>
</html>