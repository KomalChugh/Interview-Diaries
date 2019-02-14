<?php
    session_start();
    if(!$_SESSION['login']){
       header("location:index.php");
       die;
    }
    $userData = $_SESSION['userData'];
    $msg = "Error fetching content";
    $a = 0;
    if(isset($_GET['id'])){
        $post_id = $_GET['id'];
        if(is_numeric($post_id)==true){
            $sql = "SELECT * FROM posts WHERE id = $post_id";
            require_once('dbConnect.php');
            $result = mysqli_query($con,$sql);
            if($row=mysqli_fetch_array($result)){
                $a = 1;
                $title = $row['title'];
                $user_name = $row['user_name'];
                $place = $row['place'];
                $content = $row['content'];
                if($row["accepted"]==0){
                    $a = 0;
                }
            }
        }
    }
?>
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
<ul id="dropdown1" class="dropdown-content">
    <li>
        <a href="logout.php" style="color: #2b6dad;font-size:120%;">Logout</a>
    </li>
</ul>
<div class="navbar-fixed">
    <nav style="max-height:53px;line-height: 50px;background-color: white;border-top:2px solid #b92b27;z-index:800;border-bottom:1px solid #ddd;box-shadow: 0 3px 2px -2px rgba(200,200,200,0.2);font-size: 14px;box-sizing:border-box;">
        <div class="container nav-wrapper">
            <a href="index.php" class="brand-logo" style="color: #b92b27">IIT Ropar</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse" style="color: #b92b27;"><i class="material-icons">menu</i></a>
            <ul class="hide-on-med-and-down" style="padding-left: 150px;">
                <li class="active"><a href="index.php" style="color: #b92b27;font-size:150%">Read</a></li>
                <li><a href="write.php" style="color:#999;font-size:150%">Write</a></li>
                <li><a href="mycontent.php" style="color:#999;font-size:150%">My Content</a></li>
                <?php
                    if($_SESSION["admin"]){
                        echo '<li><a href="pending.php" style="color:#999;font-size:150%">Pending Posts</a></li>';
                    }
                ?>
                <li><a style="color: #999;font-size:150%;" class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo $userData['first_name'];?></a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <a href="javascript:void(0)" style="text-align: right;"><i class="large material-icons black-text">close</i></a>
                <li><div class="user-view" align="center" style="margin-top: 0px;padding-top: 0px;">
                  <a href="#!user"><img class="circle" src=<?php echo '"'.$userData["picture"].'"'?>></a>
                  <a href="#!name"><span class="black-text name" style="font-size:150%;"><?php echo $userData['first_name']. ' ' . $userData['last_name']; ?></span></a>
                  <a href="#!email"><span class="black-text email" style="font-size:130%;"><?php echo $userData['email'];?></span></a>
                </div></li>
                <li><a href="index.php" style="color: #b92b27;font-size:150%">Read</a></li>
                <li><a href="write.php" style="color:#999;font-size:150%">Write</a></li>
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
<!-- Nav bar and side nav bar code ends here -->


<div class="row">
    <div class="col l3 m2"></div>
    <div class="col l6 m8 s12">
        <div class="card hoverable">
            <div class="card-content">
                <?php
                    if($a==1){
                        echo '<a target="_blank" href="post.php?id=' . $row["id"] . '"><strong><span class="card-title black-text">' . '<h5>' . $title .'</h5>' . '</span></strong></a>';
            echo '<span class="card-title">' . $user_name . ' @' . $place . '</span>';
                        echo $content;
                        if($row['id']==$userData['id']){
                            // echo ""
                        }
                    }
                    else{
                        echo '<strong><span class="card-title">' . $msg .'</span></strong>';
                    }
                ?>

                
            </div>
        </div>
    </div>
    <div class="col l3 m2"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="client/js/materialize.min.js"></script>
<script src="client/js/index.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="client/js/materialize.min.js"></script>
<script src="client/js/index.js"></script>
<script>
        $(document).ready(function(){
            $('.button-collapse').sideNav({
                closeOnClick: true
                });
                $('.dropdown-button').dropdown({
                    inDuration: 300,
                    outDuration: 225,
                    hover: true, // Activate on hover
                    belowOrigin: true, // Displays dropdown below the button
                    alignment: 'right' // Displays dropdown with edge aligned to the left of button
                });
                $('select').material_select();
                $('.button-collapse').sideNav({
                    menuWidth: 300, // Default is 240
                    edge: 'left', // Choose the horizontal origin
                    closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
                  }
                );
        });
    </script>
</body>
</html>