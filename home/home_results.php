
<?php
ob_start();
session_start();
include "../includes/db.php";
include "../includes/functions.php";

if (!isset($_SESSION['username'])){
    header("Location: ../index.php");
}

if (!isset($_SESSION['home_results'])){
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


 ?>
<?php



if (isset($_POST['select_class'])){

	$select_classname = $_POST['select_classname'];

		select_class($select_classname);


}




if (isset($_POST['add_class_button'])){

    $class_name = trim($_POST['class_name']);
    $class_visible= trim($_POST['class_visible']);
    $class_accountid= trim($_SESSION['account_id']);
    $member_accounttype = 'Teacher';
    $member_approve = '1';
    $member_name = trim($_SESSION['fullname']);

    $error = [
       
       'ab'=>'',
   ];


    if ($class_name ==''){
        $error['ab'] = 'Classname cannot be empty';
    }
    
foreach($error as $key => $value){
        if(empty($value)){
            
            add_class($class_name,$class_visible,$class_accountid,$member_name);
            add_member($class_accountid, $member_accounttype, $member_approve ,$member_name, $class_name);

            
        }
        
    }

}

?>

<!DOCTYPE html>


<html lang="en">


<?php include "home_header.php"; ?>

<body>
        

<?php include "home_sidebar.php"; ?>

    <div class="content" >
        <div class="container-fluid">
            <div class="row">
    
<!-- Jayson, show this if there is no class to choose

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="jumbotron text-center" style="height: 100%; width: 100%">
<h1>No registered class</h1>
</div>
</div>

-->

<!-- Jayson itong laman ng class ng "row" ang papalitan mo lang ng content para sa chatbox. pag usapan nlng sa monday kung papaano. bale salo lahat nitong home. mag papalit lang laman ng content. getching? -->
<?php 

if (isset($_POST['search_name'])){
    $search_class_name = trim($_POST['search_class_name']);
    search_class_name($search_class_name);


}

if (isset($_POST['search_teacher'])){
    $search_class_teacher = $_POST['search_class_teacher'];
    search_class_teacher($search_class_teacher);


}
if(isset($_POST['search_code'])){
    $search_class_code  = trim($_POST['search_class_code']);
    search_class_code($search_class_code);



}


?>






</div>                
</div>
</div>


</body>
<?php include "home_footer.php"; ?>
</html>