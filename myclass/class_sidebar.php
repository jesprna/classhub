<?php
$all_unread_msg;
$reminder_unread_msg;
$homework_unread_msg;
$general_unread_msg;
$pending_member =  "select * from class_general where  class_id = '{$_SESSION['current_class']}' and to_id ='{$_SESSION['current_member']}' and recipient_delete='0' and opened= '0' group by general_message  order by general_id  desc ";
$result_pending = mysqli_query($connection, $pending_member);
$all_unread_msg =mysqli_num_rows($result_pending);


$pending_member1 =  "select * from class_general where  class_id = '{$_SESSION['current_class']}' and to_id ='{$_SESSION['current_member']}' and recipient_delete='0' and opened= '0' and general_cat='reminder' group by general_message  order by general_id  desc ";
$result_pending1 = mysqli_query($connection, $pending_member1);
$reminder_unread_msg =mysqli_num_rows($result_pending1);

$pending_member2 =  "select * from class_general where  class_id = '{$_SESSION['current_class']}' and to_id ='{$_SESSION['current_member']}' and recipient_delete='0' and opened= '0' and general_cat='general' group by general_message  order by general_id  desc ";
$result_pending2 = mysqli_query($connection, $pending_member2);
$general_unread_msg =mysqli_num_rows($result_pending2);



$pending_member3 =  "select * from class_general where  class_id = '{$_SESSION['current_class']}' and to_id ='{$_SESSION['current_member']}' and recipient_delete='0' and opened= '0' and general_cat='homework' group by general_message  order by general_id  desc ";
$result_pending3 = mysqli_query($connection, $pending_member3);
$homework_unread_msg =mysqli_num_rows($result_pending3);

if (isset($_POST['all_msg'])){

    $general_id = $_POST['all_msg'];
    $query ="update class_general set opened='1' where class_id = '{$_SESSION['current_class']}' and to_id ='{$_SESSION['current_member']}' ";
    $result =mysqli_query($connection, $query);
    confirmQuery($result);

    header("Location: index.php");


}


if (isset($_POST['general_msg'])){

    header("Location: general_msg.php");


}

if (isset($_POST['reminder_msg'])){

    header("Location: reminder_msg.php");


}
if (isset($_POST['homework_msg'])){

    header("Location: homework_msg.php");


}
if (isset($_POST['group_msg'])){

    header("Location: group_chat.php");


}

?>


 <div class="sidebar">
 <form action="index.php" method="post">
            <ul class="sidebar-nav">
  
                <li>
                    <a data-toggle="collapse" href="#account">
                        <p><img style="height: 100px;" class="userlogo" src="../images/<?php echo $class_photo;?>"/>Welcome to  <strong><?php echo $class_name; ?></strong></p>                    
                    </a>
                    <div class="collapse indent" id="account">
                        <a href="#"><span class=""></span>Class Code: <?php echo $class_code; ?></a>
                          <?php if ($_SESSION['fullname'] == $class_author){ ?>
                        <a href="class_info.php"><span class=""></span>  Settings</a>
                        <?php } ?>
                    </div> 
                </li>



               
                        <button class="btn btn-primary" type="submit"  value="" name="all_msg" style="width:100%; padding-bottom:7px; margin-bottom: 5px;text-align: left;">
                            <img style="height: 30px;" src='../images/msg.png'/>
                            All Messages
                            <div style='float:right; vertical-align:middle;'>
                                <p style='font-size:0.8em; text-align:right; padding:0;'>Unread : <b>  <?php echo  $all_unread_msg; ?> </b></p>
                            </div>
                        </button>
               


                
                        <button class="btn btn-primary" type="submit"  value="" name="general_msg" style="width:100%; padding-bottom:7px;margin-bottom: 5px;text-align: left;">
                            <img style="height: 30px;" src='../images/msg.png'/>
                            General
                            <div style='float:right; vertical-align:middle;'>
                                <p style='font-size:0.8em; text-align:right; padding:0;'>Unread : <b>  <?php echo  $general_unread_msg; ?> </b></p>
                            </div>
                        </button>
                  



                  
                        <button class="btn btn-primary" type="submit"  value="" name="reminder_msg" style="width:100%; padding-bottom:7px;margin-bottom: 5px;text-align: left;">
                            <img style="height: 30px;" src='../images/reminder.png'/>
                            Reminder
                            <div style='float:right; vertical-align:middle;'>
                                <p style='font-size:0.8em; text-align:right; padding:0;'>Unread : <b>  <?php echo  $reminder_unread_msg; ?> </b></p>
                            </div>
                        </button>
                   

                
                        <button class="btn btn-primary" type="submit"  value="" name="homework_msg" style="width:100%; padding-bottom:7px;margin-bottom: 5px;text-align: left;">
                            <img style="height: 30px;" src='../images/homework.png'/>
                            Homework
                            <div style='float:right; vertical-align:middle;'>
                                <p style='font-size:0.8em; text-align:right; padding:0;'>Unread : <b>  <?php echo  $homework_unread_msg; ?> </b></p>
                            </div>
                        </button>


                         <button class="btn btn-primary" type="submit"  value="" name="group_msg" style="width:100%; padding-bottom:7px; margin-bottom: 5px;text-align: left;">
                            <img style="height: 30px;" src='../images/msg.png'/>
                            Group Chat
                            
                        </button>


                         <button class="btn btn-primary" type="submit"  value="" name="grade_msg" style="width:100%; padding-bottom:7px;margin-bottom: 5px;text-align: left;">
                            <img style="height: 30px;" src='../images/grade.png'/>
                            Grades
                            
                        </button>
                    
                
                
            </ul>
            </form>
        </div>