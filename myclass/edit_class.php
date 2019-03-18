
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


if (isset($_POST['update_class_button'])){

    $class_name = trim($_POST['class_name']);
    $class_visible= trim($_POST['class_visible']);
    $member_approval = trim($_POST['member_approval']);
    $class_description= trim($_POST['class_description']);
    $class_photo =$_FILES['class_photo']['name'];
    $class_photo_temp = $_FILES['class_photo']['tmp_name'];
    move_uploaded_file($class_photo_temp, "../images/$class_photo");

   
    $query ="update class_main set class_name='{$class_name}', class_visible='{$class_visible}',class_description='{$class_description}', class_approval='{$member_approval}', class_photo='{$class_photo}'  where class_id='{$_SESSION['current_class']}'";
    $result =mysqli_query($connection, $query);
    confirmQuery($result);

    header("Location: class_info.php");


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
 <a href="class_info.php"><button type="submit" name="add_class_button" class=" btn btn-primary">Class Info</button></a>
 <form action="edit_class.php" method="post" enctype="multipart/form-data" >
                                <div class="input-group margin5">
                                    
                                    <input type="text" name="class_name" class="form-control" value="<?php echo $class_name; ?>" placeholder="Class Name" />
                                </div>
                                <div class="input-group margin5">
                                    
                                    <input type="text" name="member_name" class="form-control"  value="<?php echo $_SESSION['fullname'] ?>" placeholder="Teacher Name" readonly  />
                                </div>

                                <div class="control-group">
                                	<label class="control-label ">Class Code</label>
                                	<div class="controls pull-right"><?php echo $class_code;  ?></div>
                                </div>

                              

                                <div class="control-group">
                                	<label class="control-label "> Class Visible</label>
                                	<div class="controls pull-right">

               
                                		<label class="radio-inline"> <input  <?php echo $visible_yes; ?>  type="radio" value="1" name="class_visible"  >YES </label>
                                        <label class="radio-inline"><input  <?php echo $visible_no; ?> type="radio"  value="0" name="class_visible" >NO </label>

                                	</div>
                                </div>


                                <div class="control-group">
                                	<label class="control-label ">Require Teacher Approval?</label>
                                	<div class="controls pull-right input-group">

                                		<label class="radio-inline"> <input type="radio" value="1" name="member_approval" <?php echo $approval_yes; ?> >YES </label>
                                        <label class="radio-inline"><input type="radio" value="0" name="member_approval" <?php echo $approval_no; ?> >NO </label>

                                	</div>
                                </div>


                                <div style="padding-bottom: 100px;" class="control-group">
                                    <label class="control-label ">Class Photo</label>
                                   <div class="controls pull-right">
                                   <img style="height: 60px;" src="../images/<?php echo $class_photo;?>">
                                   <input required="" type="file" name="class_photo" ></div>
                                </div>

                                  <div class="control-group">
                        <label class="control-label">Description</label>
                        <div class="controls margin0 pull-right">
                            <textarea maxlength="250" rows="4" placeholder="Max 250 characters"  class="input-xlarge" name="class_description"><?php echo $class_description; ?></textarea>
                        </div>
                        <br>
                    </div>



</div>
 <button type="submit" name="update_class_button" class=" btn btn-primary">Save</button>
 </form>

 
                                     </div>
                                     </div>
                                     </div>
</body>
<?php include "class_footer.php"; ?>
</html>