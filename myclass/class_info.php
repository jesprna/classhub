
<?php

ob_start();
session_start();
include "../includes/db.php";
include "../includes/functions.php";
$class_id;
$class_name ;
$visible_yes;
$approval_yes;
$approval_no;
$visible_no;
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

if ($class_description ==null){
	$class_description ="(description not provided)";
}
if ($_SESSION['fullname'] == $class_author){
	$members_link ="class_member.php";
	$classinfo_link ="class_info.php";


}else{
	$members_link ="";
	$classinfo_link ="";
	header("Location: index.php");

}

if ($class_visible== 1){
	$visible_yes ="checked";
	$visible_no ="";

}else{
	$visible_yes ="";
	$visible_no ="checked";
}

if ($class_approval ==1){
	$approval_yes ="checked";
	$approval_no= "";

}else{
$approval_yes ="";
	$approval_no= "checked";
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

 

 <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12  center-block">
<a href="edit_class.php"><button type="submit" name="add_class_button" class=" btn btn-primary">Edit Class</button></a> 
                                <div style="padding-top: 30px;" class="control-group" id="classInfo">
                                    <label style="float:left;" class="control-label" for="classInfo"><img style="height: 60px;" src="../images/<?php echo $class_photo;?>"></label>

                                    <div style="margin-left: 96px;" class="controls">
                                   
                                    <input readonly type="text" name="class_name" class="form-control" value="<?php echo $class_name; ?>" placeholder="Class Name" > <input  type="text" name="member_name" class="form-control"  value="<?php echo $_SESSION['fullname'] ?>" placeholder="Teacher Name" readonly  >
                                    </div>
                                </div>
                            

                                <div class="control-group">
                                	<label class="control-label ">Class Code</label>
                                	<div class="controls pull-right"><?php echo $class_code;  ?></div>
                                </div>

                                <div class="control-group">
                                	<label class="control-label ">Class Description</label>
                                	<div class="controls pull-right"><?php echo $class_description;  ?></div>
                                </div>

                                <div class="control-group">
                                	<label class="control-label "> Class Visible</label>
                                	<div class="controls pull-right">

               
                                		<label class="radio-inline"> <input  <?php echo $visible_yes; ?>  type="radio" value="true" name="class_visible" disabled >YES </label>
                                        <label class="radio-inline"><input  <?php echo $visible_no; ?> type="radio"  value="false" name="class_visible" disabled>NO </label>

                                	</div>
                                </div>


                                <div class="control-group">
                                	<label class="control-label ">Require Teacher Approval?</label>
                                	<div class="controls pull-right input-group">

                                		<label class="radio-inline"> <input type="radio" value="true" name="member_approval" <?php echo $approval_yes; ?> disabled>YES </label>
                                        <label class="radio-inline"><input type="radio" value="false" name="member_approval" <?php echo $approval_no; ?> disabled>NO </label>

                                	</div>
                                </div>

</div>
                                     </div>
                                     </div>
                                     </div>
</body>
<?php include "class_footer.php"; ?>
</html>