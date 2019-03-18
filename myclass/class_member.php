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
	$member_accounttype =$row['member_accounttype'];
	$member_accountid= $row['member_accountid'];

	$query ="select * from class_account where account_id='{$member_accountid}'";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);
	while($row = mysqli_fetch_array($result)){

		$account_photo = $row['account_photo'];
	}

	if ($member_approve == 1){
	echo "

   


             <div style='padding-bottom:4px;' class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                   <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
           
       				 </div>

                <div style='padding-bottom:12px;' class='col-lg-8 col-md-8 col-sm-12 col-xs-12'>

         
                    <button class='btn btn-primary' type='submit'  value='$class_id' name='' style='width:100%; padding-bottom:15px;   text-align: left;' >
    
                            <img class='classlogo' src='../images/$account_photo'/>
                            $member_name
                            <div style='float:right; vertical-align:middle;'>
                                  <p style='font-size:0.8em; text-align:right; padding:0;'>Role : <b> $member_accounttype </b></p>
                       
              
                       
                        </button>
                        </div>
                        </div>




            ";

	}

	

}



?>
</div>
</div>
</div>
</body>
<?php include "class_footer.php"; ?>
</html>
