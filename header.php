<!DOCTYPE html>
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width,initial-scale=1,maximum-scale=1" name="viewport">
    <title>Internship Job Experience | Write | IIT Ropar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="client/css/materialize.min.css" media="screen,projection" rel="stylesheet">
    <link href="client/css/style.css" media="screen,projection" rel="stylesheet">
</head>

<body>

<!-- Nav bar and side nav bar code goes here -->
<!--
<ul id="dropdown1" class="dropdown-content">
    <li>
        <a href="logout.php" style="color: #2b6dad;font-size:120%;">Logout</a>
    </li>
</ul>
-->
<div class="navbar-fixed">
    <nav style="max-height:53px;line-height: 50px;background-color: white;border-top:2px solid #b92b27;z-index:800;border-bottom:1px solid #ddd;box-shadow: 0 3px 2px -2px rgba(200,200,200,0.2);font-size: 14px;box-sizing:border-box;">
        <div class="container nav-wrapper">
            <a href="index.php" class="brand-logo" style="color: #b92b27">IIT Ropar</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse" style="color: #b92b27;"><i class="material-icons">menu</i></a>
            <ul class="hide-on-med-and-down" style="padding-left: 150px;">
                <li><a href="index.php" style="color:#999;font-size:150%">Read</a></li>
                
                <li class="<?php if($currentPage =='write'){echo 'active';}?>"><a href="write.php" style="color:<?php if($currentPage =='write'){echo '#b92b27';}else{echo '#999';}?>;font-size:150%">Write</a></li>

                <li class="<?php if($currentPage =='content'){echo 'active';}?>"><a href="mycontent.php" style="color:<?php if($currentPage =='content'){echo '#b92b27';}else{echo '#999';}?>;font-size:150%">My Content</a></li>
                <?php
                    if($_SESSION['admin']){
                        if($currentPage =='pending'){
                            echo '<li class="active"><a href="pending.php" style="color:#b92b27;font-size:150%">Pending Posts</a></li>';
                        }
                        else{
                            echo '<li><a href="pending.php" style="color:#999;font-size:150%">Pending Posts</a></li>';
                        }
                    }
                ?>
                <li><a href="logout.php" style="color: #999;font-size:150%;">Logout</a></li>
                <!--
                <li><a style="color: #999;font-size:150%;" class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo $userData['first_name'];?></a></li>
                -->
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <a href="javascript:void(0)" style="text-align: right;"><i class="large material-icons black-text">close</i></a>
                <li><div class="user-view" align="center" style="margin-top: 0px;padding-top: 0px;">
                  <a href="#!user"><img class="circle" src=<?php echo '"'.$userData["picture"].'"'?>></a>
                  <a href="#!name"><span class="black-text name" style="font-size:150%;"><?php echo $userData['first_name']. ' ' . $userData['last_name']; ?></span></a>
                  <a href="#!email"><span class="black-text email" style="font-size:130%;"><?php echo $userData['email'];?></span></a>
                </div></li>
                <li><a href="index.php" style="color:#999;font-size:150%">Read</a></li>
                <li><a href="write.php" style="color:#b92b27;font-size:150%">Write</a></li>
                <li><a href="mycontent.php" style="color:#999;font-size:150%">My Content</a></li>
                <?php
                    if($_SESSION["admin"]){
                        echo '<li><a href="pending.php" style="color:#999;font-size:150%">Pending Posts</a></li>';
                    }
                ?>
                <li><a href="logout.php" style="color:#999;font-size:150%">Logout</a></li>
            </ul>
        </div>
    </nav>
</div>