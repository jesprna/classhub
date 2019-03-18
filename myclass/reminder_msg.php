<?php
ob_start();
session_start();
include "../includes/db.php";
include "../includes/functions.php";
$class_id = $_SESSION['current_class'];

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


$member_id ;
$recipient;
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


}


if ($_SESSION['fullname'] == $class_author){
	$members_link ="class_member.php";
	$classinfo_link ="class_info.php";


}else{
	$members_link ="";
	$classinfo_link ="";

}


if (isset($_POST['reply_msg'])){
  
    $message =$_POST['message'];
    $msg_file =$_FILES['file']['name'];
    $msg_file_temp = $_FILES['file']['tmp_name'];
    $from_id =$_SESSION['current_member'];
    $recipient =$_POST['reply_msg'];
    $general_reply = '1';
    $class_id = $_SESSION['current_class'];
    move_uploaded_file($msg_file_temp, "uploaded/$msg_file");
    $query = "insert into class_general (general_message, general_file, to_id, from_id, opened, recipient_delete, sender_delete, time_sent, class_id,general_reply) values ('$message','$msg_file','$recipient','$from_id','0','0','0', NOW(),'$class_id','1')";
         $result = mysqli_query($connection, $query);


        confirmQuery($result);
        header("Location: index.php");                 
}



if (isset($_POST['delete_msg'])){



    $general_id = $_POST['delete_msg'];
    $query ="update class_general set sender_delete='1' where general_code='{$general_id}'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

}

if (isset($_POST['delete_msg1'])){



    $general_id = $_POST['delete_msg1'];
    $query ="update class_general set recipient_delete='1' where general_id='{$general_id}'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

}




if (isset($_POST['all_msg'])){

    $general_id = $_POST['all_msg'];
    $query ="update class_general set opened='1' where class_id = '{$_SESSION['current_class']}' and to_id ='{$_SESSION['current_member']}' ";
    $result =mysqli_query($connection, $query);
    confirmQuery($result);

    header("Location: index.php");


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
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
		


	</div>
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	<?php
$msg_query = "select general_message,to_id,from_id,general_file,general_reply,general_id,time_sent,sender_delete,general_code,opened,general_cat  from class_general where (class_id = '{$_SESSION['current_class']}' and from_id ='{$_SESSION['current_member']}' and sender_delete='0' and general_cat='reminder') or (class_id = '{$_SESSION['current_class']}' and to_id ='{$_SESSION['current_member']}' and recipient_delete='0' and general_cat='reminder' ) group by general_message  order by general_id  desc ";
            $select_msg_query = mysqli_query($connection, $msg_query);
            confirmQuery($select_msg_query);
         	$counter =0;
         	$count= 0;
         $sender_name;
            while($row = mysqli_fetch_array($select_msg_query)){
            	$message = $row['general_message'];
            	$sender = $row['from_id'];
                $general_file= $row['general_file'];
            	$recipients= $row['to_id'];
                $general_id = $row['general_id'];
                $time_sent =$row['time_sent'];
                $sender_delete =$row['sender_delete'];
                $general_code = $row['general_code'];
                $opened = $row['opened'];
                $general_cat =$row['general_cat']; 
            	++$counter;
            	$query ="select member_name,member_id from class_member where member_id='{$sender}'";
            	$result =mysqli_query($connection,$query);

   confirmQuery($result);
   while ($row = mysqli_fetch_array($result)) {
   	$sender_name =$row['member_name'];
    $member_id = $row['member_id'];
    $recipient = $member_id;

    ++$count;
   }
   echo " 

  <form action='index.php' method='post' enctype='multipart/form-data'>
   ";
   $date = date_create($time_sent);
   $time_sent = date_format($date, 'D M j Y g:i a');
   $style='';
  
   if ($opened==0){
        $style = "style='background-color:rgb(30, 138, 23);'";
   }

            	if ($recipients === $_SESSION['current_member']){
            		echo "

                
            	 <div  class='panel panel-default'>
            <div $style  class='panel-heading' role='tab' id='headingOne'>
            <img class='msglogo' src='../images/reminder.png'>
            <div  style='margin-left:70px; margin-top:-40px;'>
              <p  style='line-height: 20%;'>From $sender_name </p>
              <p style='font-size:0.8em;margin-top:-3px;' >$message</p>
              </div>
                <h4 class='panel-title'>
                    <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse$count' aria-expanded='true' aria-controls='collapseOne'>
                        <i style='margin-top:-3px;' class='more-less glyphicon glyphicon-plus'></i>
                        <p style='margin-left:70px;font-size:0.6em;line-height: 20%;'>$time_sent</p>
                    </a>

                </h4>
            </div>
            <div id='collapse$count' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingOne'>
                <div class='panel-body'>
                    <p style='color:#05afe9;'>From $sender_name</p>
                    <p>$message</p>
                    <a href='uploaded/$general_file'>$general_file</a>
                    </br>
                    <p></p>
                    <a data-toggle='collapse' href='#reply$count'><button class='btn btn-primary'>Reply</button></a>
                    <button name='delete_msg1' value='$general_id' class='btn btn-danger'>Delete</button>
                        <div class='collapse indent indentright' id='reply$count'> 
                            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group margin5'>

                            <textarea width='500' rows='8' placeholder='Enter Message (max 1000 characters)'' id='enter-message' name='message'></textarea>
                            <input type='file' name='file'>
                            <input type='hidden' name='thread_code'>
                            </div>
                            <div class='input-group margin5'>

                                <button type='submit' value='$member_id' name='reply_msg' class='btn btn-primary'>Send</button>
                            </div>                                
                        </div>
                    </div>
            </div>
        </div>

      
                ";


            	}else{

echo "
            	 <div class='panel panel-default'>
            <div class='panel-heading' role='tab' id='headingOne'>
              <img class='msglogo' src='../images/reminder.png'>
            <div  style='margin-left:70px; margin-top:-40px; '>
              <p style='line-height: 20%;'>Sent </p>
              <p style='font-size:0.8em; padding:0;' >$message</p>
              </div>
                <h4 class='panel-title'>
                    <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseOne$counter' aria-expanded='true' aria-controls='collapseOne'>
                        <i class='more-less glyphicon glyphicon-plus'></i>
                      <p style='margin-left:70px;font-size:0.7em; line-height: 20%;'>$time_sent</p>
                    </a>

                </h4>
            </div>
            <div id='collapseOne$counter' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingOne'>
                <div class='panel-body'>
                     <button class='btn btn-danger' name='delete_msg' value='$general_code'>Delete</button>
                </div>
            </div>
        </div>
                ";
            }


          echo "
            </form>

          ";  
            }

            $msg_query1 = "select * from class_general where class_id = '{$_SESSION['current_class']}' and to_id ='{$_SESSION['current_member']}'";
            $select_msg_query1 = mysqli_query($connection, $msg_query1);
            confirmQuery($select_msg_query1);
         
            while($row = mysqli_fetch_array($select_msg_query1)){
            	$message = $row['general_message'];
            	
            	++$count;
            	

            	
            	

            	
                
            }
		?>




    
   
       

     
    </div><!-- panel-group -->
    
    




	</div>	






		</div>
	</div>
</div>



	

</body>
<?php include "class_footer.php"; ?>
</html>