 <div class="sidebar">
            <ul class="sidebar-nav">
  
                <li>
                    <a data-toggle="collapse" href="#account">
                        <p><img class="userlogo" src="../images/<?php echo $account_photo; ?>"/>Hi! <strong><?php echo $_SESSION['fullname'] ?></strong></p>                    
                    </a>
                    <div class="collapse indent" id="account">
                        <a data-toggle="collapse" href="#photo"><span class="glyphicon glyphicon-user"></span>  Change Picture</a>
                        <form action="index.php" method="post" enctype="multipart/form-data">
                                    <div class="collapse indent indentright" id="photo"> 
                                        <div style="padding-top: 30px;" class="control-group" id="classInfo">
                                    <label style="float:left;" class="control-label" for="classInfo"><img style="height: 50px;" src="../images/<?php echo $account_photo; ?>"></label>

                                    <div style="margin-left: 70px;" class="controls">
                                   
                                    <input style="padding: 10px;" required  type="file" name="account_photo" ><button style="margin-left: 10px;" type="submit" name="change_photo" class="btn btn-primary">Change</button>
                                    </div>
                                </div>
                                         <div class="input-group margin5">
                                
                                             
                                         </div>                                
                                     </div>
                                </form>   
                        <a href="edit_account.php"><span class="glyphicon glyphicon-wrench"></span>  Settings</a>
                    </div> 
                </li>
                <li>
                    <a data-toggle="collapse" href="#teacher">Teacher</a>
                    <div class="collapse indent in" id="teacher">
                        <a data-toggle="collapse" href="#buildclass">
                            <span class="glyphicon glyphicon-plus-sign"></span>  Build a Class
                        </a>



                      
                            <div class="collapse indent indentright" id="buildclass"> 
                            <form action="index.php" method="post"> 
                                <div class="input-group margin5">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </span>
                                    <input required="" type="text" name="class_name" class="form-control" placeholder="Class Name" />
                                     <?php 
                            echo isset($error['ab']) ? $error['ab'] : ''
                            ?>
                                </div>
                                <div class="input-group margin5">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-user"></span>
                                    </span>
                                    <input type="text" name="member_name" class="form-control"  value="<?php echo $_SESSION['fullname'] ?>" placeholder="Teacher Name" readonly  />
                                </div>
                                 <div class="control-group">
                                    <label class="control-label "> Class Visible</label>
                                    <div class="controls pull-right">

               
                                        <label class="radio-inline"> <input  type="radio" value="true" name="class_visible" checked="checked" >YES </label>
                                        <label class="radio-inline"><input type="radio"  value="false" name="class_visible">NO </label>

                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label ">Require Teacher Approval?</label>
                                    <div class="controls pull-right input-group">

                                        <label class="radio-inline"> <input type="radio" value="true" name="member_approval" checked="checked" >YES </label>
                                        <label class="radio-inline"><input type="radio" value="false" name="member_approval">NO </label>

                                    </div>
                                </div>
                                         <button type="submit" name="add_class_button" class="btn btn-primary">Save</button>

                                     </form>      
                            </div> 
                      


                    </div> 
                </li> 
                <li>
                    <a data-toggle="collapse" href="#student">Student</a>
                    <div class="collapse indent in" id="student">
                          <a data-toggle="collapse" href="#joinclass">
                            <span class="glyphicon glyphicon-ok-sign"></span>  Join a Class
                        </a>
                             <div class="collapse indent indentright" id="joinclass"> 
                            

                                <p>If your Teacher has already built a Class, you can search for it here:</p>
                                <a data-toggle="collapse" href="#classname">
                                    <span class="glyphicon glyphicon-plus-sign"></span>  Class Name
                                </a>

                                 <form action="home_results.php" method="post">
                                    <div class="collapse indent indentright" id="classname"> 
                                        <div class="input-group margin5">
                                
                                             <input required="" type="text" name="search_class_name" class="form-control" placeholder="Class Name" />
                                         </div>
                                         <div class="input-group margin5">
                                
                                             <button type="submit" name="search_name" class="btn btn-primary">Search</button>
                                         </div>                                
                                     </div>
                                </form>   

                                <a data-toggle="collapse" href="#teachername">
                                <span class="glyphicon glyphicon-plus-sign"></span>  Teacher's Name
                                </a>

                                 <form action="home_results.php" method="post">
                                    <div class="collapse indent indentright" id="teachername"> 
                                        <div class="input-group margin5">
                                            
                                             <input required="" type="text" name="search_class_teacher" class="form-control" placeholder="Teacher Name" />
                                         </div>
                                         <div class="input-group margin5">
                                
                                             <button type="submit" name="search_teacher" class="btn btn-primary">Search</button>
                                         </div>
                                 
                                     </div> 
                                </form>

                                <a data-toggle="collapse" href="#classcode">
                                    <span class="glyphicon glyphicon-plus-sign"></span>  Class Code
                                </a>
                                 <form action="home_results.php" method="post">
                                        <div class="collapse indent indentright" id="classcode"> 
                                        <div class="input-group margin5">
                                
                                             <input required="" type="text" name="search_class_code" class="form-control" placeholder="Class Code" />
                                         </div>
                                         <div class="input-group margin5">
                                
                                             <button type="submit" name="search_code" class="btn btn-primary">Search</button>
                                         </div>
                                 
                                     </div> 
                              
                                </form>

                                 
                            </div> 

                    </div> 
                </li>
                
            </ul>
        </div>