
<head>
        <meta http-equiv="expires" content="0">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Alumni Tracer">
        <meta name="author" content="Cortez, Esporna, Mangune, Tena">
        <title>Class Messenger - Home</title>
    
          <link href="css/bootstrap.min.css" rel="stylesheet">
               <link href="css/style.css" rel="stylesheet">
        <link href="css/classsidebar.css" type="text/css" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <!--[if lt IE9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
        <!-- Navbar -->
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav1">
                        <span class="sr-only">Show and hide Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand sidenav-menu menu-bar" href="#">
                        <p style="color: #ddd;"><img class="navbarlogo" src="../images/class3.png"/><strong> Class Hub</strong></p>
                    </a>
                    
                </div>
                <div class="collapse navbar-collapse" id="nav1">
                    <ul class="nav navbar-nav">
                        <li><a href="../home">Home</a></li>

                        <?php if ($_SESSION['fullname'] == $class_author){ ?>


                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file icon-white"></i>Compose <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="general_message.php">
                                    <img style="height: 30px;" src="../images/msg.png"> General
                                </a></li>

                                <li><a href="reminder_message.php">
                                    <img style="height: 30px;" src="../images/reminder.png"> Reminder
                                </a></li>

                                <li><a href="homework_message.php">
                                    <img style="height: 30px;" src="../images/homework.png"> Homework
                                </a></li>


                            </ul>


                        </li> 

                        <li><a href="<?php echo $classinfo_link; ?>" >Class Info</a></li>
                        <li><a href="<?php echo $members_link; ?>" >Members</a></li>
                        <?php  }else{  ?>       
                        <li><a href="general_message.php" >Compose</a></li>

                        <?php } ?>

                    
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
   