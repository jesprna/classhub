<?php

ob_start();
session_start();
include "../includes/db.php";
include "../includes/functions.php";
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


}
if ($_SESSION['fullname'] == $class_author){
	$members_link ="class_member.php";
	$classinfo_link ="class_info.php";


}else{
	$members_link ="";
	$classinfo_link ="";

}


if (isset($_POST['accept_member'])){
	$member_id = $_POST['accept_member'];
	$query ="update class_member set member_approve='1' where member_id='{$member_id}'";
	$result =mysqli_query($connection, $query);
	confirmQuery($result);

}
if (isset($_POST['decline_member'])){
	$member_id = $_POST['decline_member'];
	$query ="delete from class_member  where member_id='{$member_id}'";
	$result =mysqli_query($connection, $query);
	confirmQuery($result);

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


<?php



$member_query = "select * from class_member where member_classid = '{$class_id}'";
$select_member_query = mysqli_query($connection, $member_query);

confirmQuery($select_member_query);
if (mysqli_num_rows($select_member_query)>0){
	echo "
	 <form action='member_approve.php' method='post'>

	 ";
while($row = mysqli_fetch_array($select_member_query)){
	$member_id =$row['member_id'];
	$member_name =$row['member_name'];
	$member_approve =$row['member_approve'];
	$member_classid =$row['member_classid'];
	$member_accounttype =$row['member_accounttype'];
	$member_accountid= $row['member_accounttype'];
	

	if ($member_approve == 0){
	echo "

	<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
		<div class='well'>
			<button type='submit' style = 'width:100%;' value='$member_id'   class='btn btn-primary'>
				<h4>$member_name</h4>
				<p>Role: $member_accounttype</p>
			</button>
			<p></p>
			<label class='radio-inline'>
				<button style='background-color:#1b7303; border-color:#1b7303;' value='$member_id' class='btn btn-primary' type='submit'  name='accept_member'> Accept
				</button>            
			</label>

			<label class='radio-inline'>
				<button style='background-color:#980202; border-color:#980202;' value='$member_id' class='btn btn-primary' type='submit' name='decline_member'> Decline
				</button>            
			</label>



		</div>

	</div>      

          ";

	}	

}
echo "
		</form

";
}else{
echo "
<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
<p>No pending</p>
	
	</div>
	";
}


?>

</div>
</div>
</div>
</body>
<?php include "class_footer.php"; ?>
</html>
