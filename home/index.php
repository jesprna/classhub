
<?php
ob_start();
 session_start();

 $_SESSION['current_class'] = null;
$_SESSION['join_classname']= null;
include "../includes/db.php";
include "../includes/functions.php";
if (!isset($_SESSION['username'])){
    header("Location: ../index.php");
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

if (isset($_POST['openclass'])){
    $class_id = $_POST['openclass'];  

    $_SESSION['current_class'] = $class_id;
    header("Location: ../myclass");
    }








    if (isset($_POST['radiodelete'])){


        $class_look = trim($_POST['radiodelete']);
        $class_author;

        global $connection;
        $class_query = "select * from class_main where class_id = '{$class_look}' ";
        $select_class_query = mysqli_query($connection, $class_query);
        confirmQuery($select_class_query);
        while($row = mysqli_fetch_array($select_class_query)){
            $class_id = $row['class_id'];
            $class_name= $row['class_name'];
            $class_author = $row['class_author'];



        }
        if ($class_author == $_SESSION['fullname']){
            echo "author";
            $class_delete = trim($_POST['radiodelete']);
            delete_class($class_delete);

        }else{
            echo "not author";
            $class_id =trim($_POST['radiodelete']);
            $class_query = "select * from class_member where member_classid = '{$class_id}' and member_accountid= '{$_SESSION['account_id']}'";
            $select_class_query = mysqli_query($connection, $class_query);
            confirmQuery($select_class_query);
            confirmQuery($select_class_query);
            while($row = mysqli_fetch_array($select_class_query)){
                $leave_member= $row['member_id'];



            }
            delete_member($leave_member);
        }


    }

    if (isset($_POST['add_class_button'])){

        $class_name = trim($_POST['class_name']);
        $class_visible= trim($_POST['class_visible']);
        $class_accountid= trim($_SESSION['account_id']);
        $member_accounttype = 'Teacher';
        $member_approval = trim($_POST['member_approval']);
        $member_name = trim($_SESSION['fullname']);

        $error = [

        'ab'=>'',
        ];


        if ($class_name ==''){
            $error['ab'] = 'Classname cannot be empty';
        }

        foreach($error as $key => $value){
            if(empty($value)){

                add_class($class_name,$class_visible,$class_accountid,$member_name,$member_approval);
                add_member($class_accountid, $member_accounttype, $member_approval ,$member_name, $class_name);


            }

        }

    }




if (isset($_POST['change_photo'])){

    $account_photo =$_FILES['account_photo']['name'];
    $account_photo_temp = $_FILES['account_photo']['tmp_name'];
    move_uploaded_file($account_photo_temp, "../images/$account_photo");

    $query ="update class_account set account_photo='$account_photo'  where account_id='{$_SESSION['account_id']}'";
    $result =mysqli_query($connection, $query);
    confirmQuery($result);




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

<?php 
$account_id = $_SESSION['account_id'];
$member_id;
$member_query = "select * from class_member where member_accountid = '{$account_id}'";
$select_member_query = mysqli_query($connection, $member_query);
$member_approve;
$button_open;
$member_status;
confirmQuery($select_member_query);
if (mysqli_num_rows($select_member_query)>0){
    echo "
    <form action='index.php' method='post'>
        <div style='margin-bottom: 20px;' class=' col-lg-3 col-md-3 col-sm-12 col-xs-12'>
           
        </div>
        ";
        while($row = mysqli_fetch_array($select_member_query)){
            $member_classid = $row['member_classid'];  
            $member_approve = $row['member_approve'];      
            $member_id =$row['member_id'];
            $class_query = "select * from class_main where class_id = '{$member_classid}'";
            $select_class_query = mysqli_query($connection, $class_query);
            confirmQuery($select_class_query);
            confirmQuery($select_class_query);
            while($row = mysqli_fetch_array($select_class_query)){
                $class_id = $row['class_id'];
                $class_name= $row['class_name'];
                $class_author = $row['class_author'];
                $delete_classid = $row['class_id'];
                $class_photo = $row['class_photo'];
                $_SESSION['class_author'] = $class_author;
                 if ($member_approve== '1'){
                           $button_open ='openclass';
                           $member_status='Approved';
                        }else{
                            $button_open ='';
                             $member_status='unapprove';
                        }
                echo "
                   <div style='padding-bottom:7px;' class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                   <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
           
        </div>

                <div style='padding-bottom:25px;' class='col-lg-8 col-md-8 col-sm-12 col-xs-12'>

                  
                    <button class='btn btn-primary' type='submit'  value='$class_id' name='$button_open' style='width:100%; padding-bottom:15px;   text-align: left;' >
    
                            <img class='classlogo' src='../images/$class_photo'/>
                            $class_name
                            <div style='float:right; vertical-align:middle;'>
                                  <p style='font-size:0.8em; text-align:right; padding:0;'>Class Creator : <b> $class_author </b></p>
                        <p style='font-size:0.8em; text-align:right;'>Status : <b> $member_status</b></p>
                        
                       </div>
                        </button>
                        ";?>

                        <?php  if ($class_author == $_SESSION['fullname']){
                            echo "<label style='padding-top:4px; float:right;' class='radio-inline'><button style='background-color:#980202; border-color:#980202;font-size:0.8em; ' class='btn btn-primary' type='submit' value='$class_id' name='radiodelete'>Delete Class</button>            
                        </label>";
                        } else{
                            echo "<label style='padding-top:4px; float:right;'  class='radio-inline'><button style='background-color:#980202; border-color:#980202; font-size:0.8em;' class='btn btn-primary' type='submit' value='$class_id' name='radiodelete'>Leave Class</button>            
                        </label>";
                        }


                        ?>

                        <?php  echo "

                      
                         
                    </div>
                </div>  

                </div>            
                ";
            }
          
    }
      echo "
        </form> 
        ";    
}
else{
    echo "
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class='well'>
            <h4>You don't have yet a  Class. Build or Join on Class now.</h4>
        </div>
    </div>
    ";
}
?>






</div>                
</div>
</div>


</body>
<?php include "home_footer.php"; ?>
</html>