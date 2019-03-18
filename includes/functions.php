<?php


function member_exists($accountid,$class_id){
 global $connection;
    $query = "select member_accountid from class_member where member_accountid = '$accountid' and member_classid='$class_id'";
    $result = mysqli_query($connection,$query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0 ){
        return true;
    }else{
        return false;
    }
}

function confirmQuery($result){

    global $connection;
    if(!$result){

        die("QUERY FAILED". mysqli_error());
    }
}

function class_login($login_username, $login_password){

    global $connection;
    $login_username = trim($login_username);
    $login_password = trim($login_password);
    $login_username = mysqli_real_escape_string($connection, $login_username);
    $login_password = mysqli_real_escape_string($connection, $login_password);
    $hashFormat = "$2y$10$";
    $salt ="iusesomecrazystrings22";
    $hashF_and_salt = $hashFormat . $salt;
    $login_password = crypt($login_password,$hashF_and_salt);

    $login_query = "select * from class_account where account_username = '{$login_username}'";
    $select_user_query = mysqli_query($connection, $login_query);

    confirmQuery($select_user_query);

    while($row = mysqli_fetch_array($select_user_query)){
        $account_id = $row['account_id'];
        $account_username = $row['account_username'];
        $account_password = $row['account_password'];
        $account_fullname = $row['account_fullname'];

    }

    if ($login_username === $account_username && $login_password === $account_password){
        $_SESSION['username'] = $account_username;
        $_SESSION['fullname'] = $account_fullname;
        $_SESSION['account_id'] = $account_id;
        header("Location: home");   
    }
    else{
        header("Location: index.php");
    }

}

function class_signup($username,$password,$email,$birthdate,$confirm_password,$fullname){
    global $connection;

    if(username_exists($username)){
        echo $message ="user exists";
    }else{

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        $email = mysqli_real_escape_string($connection, $email);
        $birthdate = mysqli_real_escape_string($connection, $birthdate);
        $fullname = mysqli_real_escape_string($connection, $fullname);

        $hashFormat = "$2y$10$";
        $salt = "iusesomecrazystrings22";
        $hashF_and_salt = $hashFormat . $salt;
        $password = crypt($password,$hashF_and_salt);


        $query = "insert into class_account (account_fullname, account_username, account_password,account_email, account_birthdate)";
        $query .= "values ('$fullname', '$username','$password','$email','$birthdate')";

        $result = mysqli_query($connection, $query);


        confirmQuery($result);



        $login_query = "select * from class_account where account_username = '{$login_username}'";
        $select_user_query = mysqli_query($connection, $login_query);

        confirmQuery($select_user_query);

        while($row = mysqli_fetch_array($select_user_query)){
            $account_id = $row['account_id'];
            $account_username = $row['account_username'];
            $account_password = $row['account_password'];
            $account_fullname = $row['account_fullname'];

        }
        $_SESSION['username'] = $username;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['account_id'] =$account_id;

        header("Location: home"); 



    }



}

function username_exists($username){
 global $connection;
    $query = "select account_username from class_account where account_username = '$username'";
    $result = mysqli_query($connection,$query);

    if(mysqli_num_rows($result) > 0 ){
        return true;
    }else{
        return false;
    }
}







function email_exists($email){

    global $connection;
    $query = "select account_email from class_account where account_email = '$email'";
    $result = mysqli_query($connection,$query);

    if(mysqli_num_rows($result) > 0 ){
        return true;
    }else{
        return false;
    }
}


function add_class($class_name,$class_visible,$class_accountid,$member_name,$class_approval){

    global $connection;
    $class_code = generateRandomString();
    $class_code = mysqli_real_escape_string($connection,$class_code);
    $class_name = mysqli_real_escape_string($connection, $class_name);
    $class_visible= mysqli_real_escape_string($connection, $class_visible);
    $class_accountid = mysqli_real_escape_string($connection, $class_accountid);
    $member_name =mysqli_real_escape_string($connection, $member_name);
    $class_approval = mysqli_real_escape_string($connection, $class_approval);

    if ($class_visible == 'true') {
        $class_visible = 1;
    }else if ($class_visible == 'false'){
        $class_visible = 0;
    }

    if ($class_approval == 'true') {
        $class_approval = 1;
    }else if ($class_approval == 'false'){
        $class_approval = 0;
    }

    $query = "insert into class_main ( class_name, class_visible,class_accountid, class_author, class_code, class_approval)";
    $query .= "values ('$class_name', '$class_visible','$class_accountid','$member_name','$class_code','$class_approval')";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

}


function add_member($account_id,$member_accounttype, $member_approval,$member_name, $class_name){
    global $connection;


    $class_query = "select * from class_main where class_name = '{$class_name}'";
    $select_class_query = mysqli_query($connection, $class_query);

    confirmQuery($select_class_query);

    while($row = mysqli_fetch_array($select_class_query)){
        $class_id = $row['class_id'];


    }

    $account_id = mysqli_real_escape_string($connection, $account_id);
    $member_accounttype = mysqli_real_escape_string($connection, $member_accounttype);
    $member_approve= mysqli_real_escape_string($connection, $member_approve);
    $member_name = mysqli_real_escape_string($connection, $member_name);
    $class_id = mysqli_escape_string($connection, $class_id);


    $member_approval = '1';
    $query = "insert into class_member (member_accountid, member_accounttype,member_approve, member_name, member_classid)";
    $query .= "values ('$account_id', '$member_accounttype','$member_approval','$member_name','$class_id')";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    header("Location: ../myclass"); 
}



function search_class_name($search_class_name){
    global $connection;
    $class_query = "select * from class_main where class_name = '{$search_class_name}' AND class_visible = 1";
    $select_class_query = mysqli_query($connection, $class_query);
    confirmQuery($select_class_query);
    if (mysqli_num_rows($select_class_query)>0){
        echo "


        <form action='home_results.php' method='post'>
            <div style='margin-bottom: 20px;' class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <button type='submit' name='select_class' class='btn btn-primary'>Join Class</button>
            </div>
            ";


            confirmQuery($select_class_query);
            while($row = mysqli_fetch_array($select_class_query)){
                $class_id = $row['class_id'];
                $class_name= $row['class_name'];
                $class_author = $row['class_author'];
                $class_photo = $row['class_photo'];
                echo "
                <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                    <div class='well'>
                        <label class='radio-inline'><input type='radio' value='$class_name' name='select_classname'>
                            <h4>
                                <img class='classlogo' src='../images/$class_photo'/>
                                $class_name
                            </h4>
                        </a>
                        <p>Class Creator : $class_author</p>
                    </label>
                </div>
            </div>      
            ";
        }




        echo "
    </form>
    ";
    $_SESSION['home_results'] ="enabled";

}else{
    echo "
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class='well'>
            <h4>Sorry. We can't find any Classes that match to  $search_class_name... try again?</h4>
        </div>
    </div>
    ";
}
}


function search_class_teacher($search_class_teacher){
    global $connection;

    $class_query = "  select * from class_main where class_author = '{$search_class_teacher}' AND class_visible = 1   ";
    $select_class_query = mysqli_query($connection, $class_query);
    if (mysqli_num_rows($select_class_query)>0){
        echo "


        <form action='home_results.php' method='post'>




            <div style='margin-bottom: 20px;' class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <button type='submit' name='select_class' class='btn btn-primary'>Join Class</button>
            </div>




            ";


            confirmQuery($select_class_query);
            while($row = mysqli_fetch_array($select_class_query)){
                $class_id = $row['class_id'];
                $class_name= $row['class_name'];
                $class_author = $row['class_author'];
                $class_photo = $row['class_photo'];
                echo "
                <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                    <div class='well'>
                        <label class='radio-inline'><input type='radio' value='$class_name' name='select_classname'>
                            <h4>
                                <img class='classlogo' src='../images/$class_photo'/>
                                $class_name
                            </h4>
                        </a>
                        <p>Class Creator : $class_author</p>
                    </label>
                </div>
            </div>      
            ";
        }



        echo "
    </form>
    ";
    $_SESSION['home_results'] ="enabled";

}else{
    echo "

    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class='well'>
            <h4>Sorry. We can't find any Classes that match to  $search_class_name... try again?</h4>

        </div>

    </div>

    ";

}



}


function search_class_code($search_class_code){
    global $connection;
    $class_query = "select * from class_main where class_code = '{$search_class_code}' AND class_visible = 1";
    $select_class_query = mysqli_query($connection, $class_query);
    confirmQuery($select_class_query);
    if (mysqli_num_rows($select_class_query)>0){
        echo "


        <form action='home_results.php' method='post'>




            <div style='margin-bottom: 20px;' class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <button type='submit' name='select_class' class='btn btn-primary'>Join Class</button>
            </div>




            ";


             confirmQuery($select_class_query);
            while($row = mysqli_fetch_array($select_class_query)){
                $class_id = $row['class_id'];
                $class_name= $row['class_name'];
                $class_author = $row['class_author'];
                $class_photo = $row['class_photo'];
                echo "
                <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                    <div class='well'>
                        <label class='radio-inline'><input type='radio' value='$class_name' name='select_classname'>
                            <h4>
                                <img class='classlogo' src='../images/$class_photo'/>
                                $class_name
                            </h4>
                        </a>
                        <p>Class Creator : $class_author</p>
                    </label>
                </div>
            </div>      
            ";
        }

        

        echo "
    </form>
    ";
    $_SESSION['home_results'] ="enabled";

}else{
    echo "

    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class='well'>
            <h4>Sorry. We can't find any Classes that match to  $search_class_name... try again?</h4>

        </div>

    </div>

    ";

}

}

function delete_class($class_id){
    global $connection;
    $query = "delete from class_main where class_id ='{$class_id}'";
    $results= mysqli_query($connection,$query);
    confirmQuery($results);

     $query2 = "delete from class_member where member_classid ='{$class_id}'";
    $results2= mysqli_query($connection,$query2);
    confirmQuery($results2);

    $query3 = "delete from class_general where class_id ='{$class_id}'";
    $results3= mysqli_query($connection,$query3);
    confirmQuery($results3);

     $query4 = "delete from class_chat where class_id ='{$class_id}'";
    $results4= mysqli_query($connection,$query4);
    confirmQuery($results4);



}



function delete_member($member_id){
         global $connection;
    $query = "delete from class_member where member_id ='{$member_id}'";
    $results= mysqli_query($connection,$query);
    confirmQuery($results);


     $query2 = "delete from class_general where from_id ='{$member_id}'";
    $results2= mysqli_query($connection,$query2);
    confirmQuery($results2);


     $query3 = "delete from class_chat where member_id ='{$member_id}'";
    $results3= mysqli_query($connection,$query3);
    confirmQuery($results3);


}



function select_class($select_classname){
    $_SESSION['join_classname']= $select_classname;
    header("Location: join_class.php");



}



function generateRandomString($length = 6) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>