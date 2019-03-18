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

  
        }
?>
<?php
$_SESSION['user'] = (isset($_GET['user']) === true) ? (int)$_GET['user'] : $member_id;
// require 'core/classes/Core.php';
// require 'core/classes/Chat.php';
// $chat = new Chat();
// $chat->throwMessage(85, "sample!", $_SESSION['current_class']);
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



					<div class="chat">
						<div id="one" class="messages">
								

						</div>
						<textarea  class="entry" placeholder="Hit Enter to send message Shift + Enter for new line" ></textarea>
						

					</div>


		</div>
	</div>
</div>



	

</body>
<?php include "class_footer.php"; ?>
</html>