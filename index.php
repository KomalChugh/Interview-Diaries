<?php
//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();
	
	//Initialize User class
	$user = new User();

    if(!isset($gpUserProfile['gender'])){
        $gpUserProfile['gender'] = 'N';
    }
    if(!isset($gpUserProfile['locale'])){
        $gpUserProfile['locale'] = 'en';
    }
    if(!isset($gpUserProfile['link'])){
        $gpUserProfile['link'] = '/';
    }
    if(!isset($gpUserProfile['picture'])){
        $gpUserProfile['picture'] = 'https://i.stack.imgur.com/dr5qp.jpg';
    }
	
	//Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );
    $userData = $user->checkUser($gpUserData);
	
	//Storing user data into session
	$_SESSION['userData'] = $userData;
    $_SESSION['login'] = true;
    $_SESSION['admin'] = false;


    require_once("dbConnect.php");
    $sql = "SELECT * FROM users WHERE id=" . $userData['id'];
    $res = mysqli_query($con,$sql);
    if($res){
        $row=mysqli_fetch_array($res);
        if($row["admin"]==1){
            $_SESSION['admin'] = true;
        }
    }
	
	//Render facebook profile data
    if(!empty($userData)){
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width,initial-scale=1,maximum-scale=1" name="viewport">
    <title>Internship Job Experience | IIT Ropar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="client/css/materialize.min.css" media="screen,projection" rel="stylesheet">
    <link href="client/css/style.css" media="screen,projection" rel="stylesheet">
</head>

<body oncopy="return false" oncut="return false">

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
                <li class="active"><a href="index.php" style="color: #b92b27;font-size:150%">Read</a></li>
                <li><a href="write.php" style="color:#999;font-size:150%">Write</a></li>
                <li><a href="mycontent.php" style="color:#999;font-size:150%">My Content</a></li>
                <?php
                    if($_SESSION['admin']){
                        echo '<li><a href="pending.php" style="color:#999;font-size:150%">Pending Posts</a></li>';
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
                <li><a href="index.php" style="color: #b92b27;font-size:150%">Read</a></li>
                <li><a href="write.php" style="color:#999;font-size:150%">Write</a></li>
                <li><a href="mycontent.php" style="color:#999;font-size:150%">My Content</a></li>
                <?php
                    if($_SESSION["admin"]){
                        echo '<li><a href="pending.php" style="color:#999;font-size:150%">Pending Posts</a></li>';
                    }
                ?>
                <li><a href="logout.php" style="color:#999;font-size:150%">Logout</a></li>
                <div class="input-field" style="color:#666;padding-left:25px;padding-right:25px;" align="center">
                <button class="btn waves-effect waves-light" style="background-color:#f1f8fb;color: #2865a1;border: 1px solid #3a66ad;text-align: center;font-weight:500;border-radius:3px;display: inline-block;box-shadow:0 1px 1px 0 rgba(200,200,200,0.2);" id="submit_button1" type="submit" name="action">Filter</button>
                <select name="category1" id="category1">
                    <option value="0" selected>All Categories</option>
                    <option value="1">Internship Interview Experience</option>
                    <option value="2">Internship Experience</option>
                    <!-- <option value="3">Job Interview Experience</option>
                    <option value="4">Job Experience</option> -->
                  </select>
                  <input placeholder="All Years" name="year1" id="year1" type="number" min="2010" max="2050">
                  <select name="department1" id="department1">
                    <option value="0" selected="">All Departments</option>
                    <option value="1">CBME</option>
                    <option value="2">Chemical</option>
                    <option value="3">Chemistry</option>
                    <option value="4">Civil</option>
                    <option value="5">Computer Science</option>
                    <option value="6">Electrical</option>
                    <option value="7">HSS</option>
                    <option value="8">Mathematics</option>
                    <option value="9">Mechanical</option>
                    <option value="9">Physics</option>
                  </select>
                  <select name="status1" id="status1">
                    <option value="0">All Graduate Categories</option>
                    <option value="1">Undergraduate</option>
                    <option value="2">Masters</option>
                    <option value="3">PhD</option>
                  </select>
              </div>
            </ul>
        </div>
    </nav>
</div>
<!-- Nav bar and side nav bar code ends here -->

<div class="row">
    <div class="col l2  center">
        <ul id="slide-out" class="side-nav fixed z-depth-0" style="background-color: #fafafa;">
            <li style="margin-top: 120px;"></li>
            <div class="input-field" style="padding-left: 80px;color:#666;">
                <button class="btn waves-effect waves-light" style="background-color:#f1f8fb;color: #2865a1;border: 1px solid #3a66ad;text-align: center;font-weight:500;border-radius:3px;display: inline-block;box-shadow:0 1px 1px 0 rgba(200,200,200,0.2);" id="submit_button" type="submit" name="action">Filter</button>
                <select name="category" id="category" style="color:#666;">
                    <option value="0" selected>All Categories</option>
                    <option value="1">Internship Interview Experience</option>
                    <option value="2">Internship Experience</option>
                    <!-- <option value="3">Job Interview Experience</option>
                    <option value="4">Job Experience</option> -->
                  </select>
                  <input placeholder="All years" name="year" id="year" type="number" min="2010" max="2050">
                  <select name="department" id="department">
                    <option value="0" selected="">All Departments</option>
                    <option value="1">CBME</option>
                    <option value="2">Chemical</option>
                    <option value="3">Chemistry</option>
                    <option value="4">Civil</option>
                    <option value="5">Computer Science</option>
                    <option value="6">Electrical</option>
                    <option value="7">HSS</option>
                    <option value="8">Mathematics</option>
                    <option value="9">Mechanical</option>
                    <option value="9">Physics</option>
                  </select>
                  <select name="status" id="status">
                    <option value="0">All Graduate Categories</option>
                    <option value="1">Undergraduate</option>
                    <option value="2">Masters</option>
                    <option value="3">PhD</option>
                  </select>
              </div>
    </ul>
    </div>
    <div class="col l1" style="margin-left: 25px;"></div>
    <div class="col l6">
        <div id="posts">
        </div>
    </div>
</div>


<script src="client/js/jquery.min.js"></script>
<script src="client/js/materialize.min.js"></script>
<script src="client/js/index.js"></script>
<script>
	var div = document.getElementById('posts');
	var flag = 0;
	var limit = 5;
	var category = 0;
	var department = 0;
	var year = 0;
	var graduate = 0;
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

        $("#submit_button").click(function(){
            category = document.getElementById("category").value;
            department = document.getElementById("department").value;
            year = document.getElementById("year").value;
            if(year==""){
                year = 0;
            }
            graduate = document.getElementById("status").value;
            console.log(category);
            flag = 0;
            div.innerHTML = "";
            $.ajax({
                type:"POST",
                url: "data.php",
                data:{
                    'offset' : flag,
                    'limit' : limit,
                    'category':category,
                    'department':department,
                    'year':year,
                    'graduate':graduate,
                },
                success:function(data){
                    div.innerHTML += data;
                    flag += limit;
                }
            });

            $(window).scroll(function(){
                if($(window).scrollTop() >= $(document).height() - $(window).height()){
                    $.ajax({
                        type:"POST",
                        url: "data.php",
                        data:{
                            'offset' : flag,
                            'limit' : limit,
                            'category':category,
                            'department':department,
                            'year':year,
                            'graduate':graduate,
                        },
                        success:function(data){
                            // console.log("here");
                            div.innerHTML += data;
                            flag += limit;
                        }
                    });                    
                }
            });
        });

        $("#submit_button1").click(function(){
            $('.button-collapse').sideNav('hide');
            category = document.getElementById("category1").value;
            department = document.getElementById("department1").value;
            year = document.getElementById("year1").value;
            if(year==""){
                year = 0;
            }
            graduate = document.getElementById("status1").value;
            console.log(category);
            flag = 0;
            div.innerHTML = "";
            $.ajax({
                type:"POST",
                url: "data.php",
                data:{
                    'offset' : flag,
                    'limit' : limit,
                    'category':category,
                    'department':department,
                    'year':year,
                    'graduate':graduate,
                },
                success:function(data){
                    div.innerHTML += data;
                    flag += limit;
                }
            });

            $(window).scroll(function(){
                if($(window).scrollTop() >= $(document).height() - $(window).height()){
                    $.ajax({
                        type:"POST",
                        url: "data.php",
                        data:{
                            'offset' : flag,
                            'limit' : limit,
                            'category':category,
                            'department':department,
                            'year':year,
                            'graduate':graduate,
                        },
                        success:function(data){
                            // console.log("here");
                            div.innerHTML += data;
                            flag += limit;
                        }
                    });                    
                }
            });
        });

        $.ajax({
            type:"POST",
            url: "data.php",
            data:{
                'offset' : flag,
                'limit' : limit,
                'category':category,
                'department':department,
                'year':year,
                'graduate':graduate,
            },
            success:function(data){
                div.innerHTML += data;
                flag += limit;
            }
        });

        $(window).scroll(function(){
            // console.log($(window).scrollTop());
            // console.log($(document).height());
            // console.log($(window).height());
            // console.log($(document).height() - $(window).height());
            if($(window).scrollTop() >= $(document).height() - $(window).height() - 200){
                $.ajax({
                    type:"POST",
                    url: "data.php",
                    data:{
                        'offset' : flag,
                        'limit' : limit,
                        'category':category,
                        'department':department,
                        'year':year,
                        'graduate':graduate,
                    },
                    success:function(data){
                        // console.log("here");
                        div.innerHTML += data;
                        flag += limit;
                    }
                });                    
            }
        });
    });
    </script>
</body>
</html>
<?php
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
	$authUrl = $gClient->createAuthUrl();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width,initial-scale=1,maximum-scale=1" name="viewport">
    <title>Internship Job Experience | IIT Ropar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="client/css/materialize.min.css" media="screen,projection" rel="stylesheet">
    <link href="client/css/style.css" media="screen,projection" rel="stylesheet">
</head>

<body>
<div class="container" style="margin-top: 30px;">
    <div class="row">
    <div class="col m2"></div>
    <div class="col s12 m8">
      <div class="card blue-grey darken-1 hoverable">
        <div class="card-content white-text">
          <span class="card-title" align="center" style="font-size: 200%">Blogs for Internship & Job</span>
          <div align="center">
              <div style="max-width:300px;" >
                    <?php
            $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img class="responsive-img" align="right" src="images/glogin1.png" alt=""/></a>';
            echo $output;?>
            </div>
            </div>
            <br><br><br>
          <p class="flow-text">This is an experience sharing portal where any student can share his/her interview experience be it either internship or job. Internship or Job experience can also be shared in a form of blog. Its very similar to Quora. Its kind of crowdsourcing which is practice of obtaining information or input into a task or project by enlisting the services of a large number of people. Experience is something very valuable which if passed on to juniors can be a great asset.</p>
          <br>
          <p class="flow-text">As far as individuals privacy is concerned, extra care has been taken for that. To read/write a post user need @iitrpr.ac.in email id. So only IIT Ropar students can access it. Also this portal will be hosted on "intranet" which means this portal can only be accessed with IIT Ropar's internet connection be it WiFi or WLAN.</p>
        </div>
      </div>
    </div>
    <div class="col m2"></div>
    </div>
</div>
</body>


<?php
}
?>
