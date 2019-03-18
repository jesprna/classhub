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




if (isset($_POST['edit_member'])){
	$member_id =$_POST['edit_member'];

	$query ="delete from class_member where member_id='{$member_id}'";



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

<form action="edit_member.php" method="post">
<?php

$pending_approval;
$pending_member = "select * from class_member where member_classid = '{$class_id}' and member_approve =0";
$result_pending = mysqli_query($connection, $pending_member);
$pending_approval =mysqli_num_rows($result_pending);
echo "
 <div style='margin-bottom: 20px;' class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
<a href='member_approve.php'> <button type='submit' value='$class_id'  class='btn btn-primary'>
 Pending Approval : 
            $pending_approval
                        
                        </button></a>

 
        </div>";


$member_query = "select * from class_member where member_classid = '{$class_id}' order by member_accounttype desc";
$select_member_query = mysqli_query($connection, $member_query);

confirmQuery($select_member_query);

while($row = mysqli_fetch_array($select_member_query)){
	$member_name =$row['member_name'];
	$member_approve =$row['member_approve'];
	$member_classid =$row['member_classid'];
	$meber_accounttype =$row['member_accounttype'];
	$member_accountid= $row['member_accounttype'];

	if ($member_approve == 1){
	echo "

                <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                    <div class='well'>
                         <button type='submit' style = 'width:100%;' name='edit_member' value='$class_id'  class='btn btn-primary'>
                        <h4> $member_name</h4>
                        <p>Role: $meber_accounttype</p>
                        </button>





                </div>

            </div>      



            ";

	}

	

}



?>
</form>
</div>
</div>
</div>
</body>
<?php include "class_footer.php"; ?>
</html>
