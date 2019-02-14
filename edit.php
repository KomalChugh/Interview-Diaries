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
                if(($userData['id']==$row['user_id'] || $_SESSION['admin']) && $row['accepted']==0){
                    $a = 1;
                    $title = $row['title'];
                    $title = htmlspecialchars($title);
                    $place = $row['place'];
                    $place = htmlspecialchars($place);
                    $C = array("1"=>"", "2"=>"", "3"=>"", "4"=>"");
                    $category = $row["category"];
                    $C["$category"] = "selected";
                    $D = array("1"=>"", "2"=>"", "3"=>"", "4"=>"","5"=>"","6"=>"", "7"=>"", "8"=>"", "9"=>"","10"=>"");
                    $department = $row["department"];
                    $D["$department"] = "selected";
                    $year = $row['year'];
                    $content = $row['content'];
                    $G = array("1"=>"", "2"=>"", "3"=>"", "4"=>"");
                    $graduate = $row["graduate"];
                    $G["$graduate"] = "selected";
                    $post_id = $row["id"];
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
                <li><a href="index.php" style="color:#999;font-size:150%">Read</a></li>
                <li class="active"><a href="write.php" style="color:#b92b27;font-size:150%">Write</a></li>
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
<!-- Nav bar and side nav bar code ends here -->

<div class="row">
    <div class="col l3 m2"></div>
    <div class="col l6 m8 s12">
        <div class="card hoverable">
            <div class="card-content">
                <?php
                    if($a==1){
                        echo '<span class="card-title">' . 'Edit your post here' . '</span>';
                        ?>
                        <div class="input-field">
                            <input id="title_text" value="<?=$title?>" type="text" data-length="50">
                        </div>
                        <div class="input-field">
                            <input id="place" type="text" value="<?=$place?>">
                            <select name="category" id="category" style="color:#666;">
                                <option value="0" disabled <?=$C["1"]?> >All Categories</option>
                                <option value="1" <?=$C["1"]?> >Internship Interview Experience</option>
                                <option value="2" <?=$C["2"]?> >Internship Experience</option>
                                <!-- <option value="3" <?=$C["3"]?> >Job Interview Experience</option>
                                <option value="4" <?=$C["4"]?> >Job Experience</option> -->
                            </select>
                            <input id="year" type="number" value="<?=$year?>">
                            <select name="department" id="department">
                                <option value="0" disabled>All Departments</option>
                                <option value="1" <?=$D["1"]?> >CBME</option>
                                <option value="2" <?=$D["2"]?> >Chemical</option>
                                <option value="3" <?=$D["3"]?> >Chemistry</option>
                                <option value="4" <?=$D["4"]?> >Civil</option>
                                <option value="5" <?=$D["5"]?> >Computer Science</option>
                                <option value="6" <?=$D["6"]?> >Electrical</option>
                                <option value="7" <?=$D["7"]?> >HSS</option>
                                <option value="8" <?=$D["8"]?> >Mathematics</option>
                                <option value="9" <?=$D["9"]?> >Mechanical</option>
                                <option value="10" <?=$D["10"]?> >Physics</option>
                            </select>
                            <select name="status" id="status">
                                <option value="0" disabled>All Graduate Categories</option>
                                <option value="1" <?=$G["1"]?> >Undergraduate</option>
                                <option value="2" <?=$G["2"]?> >Masters</option>
                                <option value="3" <?=$G["3"]?> >PhD</option>
                            </select>
                        </div>

                        <div class="input-field">
                        <textarea id="content" class="materialize-textarea" data-length="50000"> <?php echo $content;?> </textarea>
                        <label for="content">Main Content</label>
                        </div>
                        <div id="preload" style="margin-bottom: 20px;">
                            <div class="active large preloader-wrapper">
                                <div class="spinner-layer spinner-red-only">
                                    <div class="left circle-clipper">
                                        <div class="circle">
                                        </div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle">
                                        </div>
                                    </div>
                                    <div class="right circle-clipper">
                                        <div class="circle">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="message" class="red-text" style="font-size: 150%;"></div>
                        <button class="btn" style="background-color:#f1f8fb;color: #2865a1;border: 1px solid #3a66ad;text-align: center;font-weight:500;border-radius:3px;display: inline-block;box-shadow:0 1px 1px 0 rgba(200,200,200,0.2);" id="submit_button" type="submit" name="action">Update Post</button>
                        <?php
                            if($_SESSION['admin']==1){
                                echo '&nbsp;<button class="btn" style="background-color:#f1f8fb;color: #2865a1;border: 1px solid #3a66ad;text-align: center;font-weight:500;border-radius:3px;display: inline-block;box-shadow:0 1px 1px 0 rgba(200,200,200,0.2);" id="publish_button" type="submit" name="action">Publish Post</button>';
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
<script src="client/js/jquery.min.js"></script>
<script src="client/js/materialize.min.js"></script>
<script src="client/js/index.js"></script>
<script>
        $(document).ready(function(){
            $("#preload").hide();
            $('select').material_select();
            $('.button-collapse').sideNav({
                  closeOnClick: true
                }
            );
            $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      hover: true, // Activate on hover
      belowOrigin: true, // Displays dropdown below the button
      alignment: 'right' // Displays dropdown with edge aligned to the left of button
    }
  );

            $("#submit_button").click(function(){
                msg = document.getElementById("message");
                category = document.getElementById("category").value;
                department = document.getElementById("department").value;
                year = document.getElementById("year").value;
                graduate = document.getElementById("status").value;
                title_text = document.getElementById("title_text").value;
                content = document.getElementById("content").value;
                place = document.getElementById("place").value;
                console.log("category" + category);
                console.log("department" + department);
                console.log("year" + year);
                console.log("graduate" + graduate);
                console.log("title_text" + title_text);
                console.log("content" + content);
                console.log("place" + place);
                if(title_text==""){
                    console.log("title_text" + title_text);
                    msg.innerHTML = "Please enter title first";
                }
                else if(place==""){
                    console.log("place" + place);
                    msg.innerHTML = "Please add Company/University name first";
                }
                else if(category==0){
                    console.log("category" + category);
                    msg.innerHTML = "Please choose category first";
                }
                else if(year==0){
                    console.log("year" + year);
                    msg.innerHTML = "Please choose a year first";
                }
                else if(department==0){
                    console.log("department" + department);
                    msg.innerHTML = "Please choose a department first";
                }
                else if(graduate==0){
                    console.log("graduate" + graduate);
                    msg.innerHTML = "Pease choose a graduation category first";
                }
                else if(content==""){
                    msg.innerHTML = "Please add content first";
                }
                else{
                    $("#preload").show();
                    document.getElementById("submit_button").disabled = true;
                    msg.innerHTML = "";  
                    $.ajax({
                        type:"POST",
                        url: "updatePost.php",
                        data:{
                            'title_text':title_text,
                            'category':category,
                            'department':department,
                            'year':year,
                            'status':graduate,
                            'content':content,
                            'place' : place,
                            'accepted':0,
                            'post_id': <?php echo $post_id;?>
                        },
                        success:function(result){
                            console.log("here");
                            console.log(<?php echo $post_id;?>);
                            console.log(result);
                            result = $.parseJSON(result);
                            $("#preload").hide();
                            if(result["status"]=="OK"){
                                msg.innerHTML = "Post successfully updated";
                                $("#preload").hide();
                            }
                            else{
                                msg.innerHTML = "Some unexpected error occured, please try again later";
                                document.getElementById("submit_button").disabled = false;
                            }
                        }
                    });
                }
            });

            <?php
            if($_SESSION["admin"]){

                echo '$("#publish_button").click(function(){
                msg = document.getElementById("message");
                category = document.getElementById("category").value;
                department = document.getElementById("department").value;
                year = document.getElementById("year").value;
                graduate = document.getElementById("status").value;
                title_text = document.getElementById("title_text").value;
                content = document.getElementById("content").value;
                place = document.getElementById("place").value;
                console.log("category" + category);
                console.log("department" + department);
                console.log("year" + year);
                console.log("graduate" + graduate);
                console.log("title_text" + title_text);
                console.log("content" + content);
                console.log("place" + place);
                if(title_text==""){
                    console.log("title_text" + title_text);
                    msg.innerHTML = "Please enter title first";
                }
                else if(place==""){
                    console.log("place" + place);
                    msg.innerHTML = "Please add Company/University name first";
                }
                else if(category==0){
                    console.log("category" + category);
                    msg.innerHTML = "Please choose category first";
                }
                else if(year==0){
                    console.log("year" + year);
                    msg.innerHTML = "Please choose a year first";
                }
                else if(department==0){
                    console.log("department" + department);
                    msg.innerHTML = "Please choose a department first";
                }
                else if(graduate==0){
                    console.log("graduate" + graduate);
                    msg.innerHTML = "Pease choose a graduation category first";
                }
                else if(content==""){
                    msg.innerHTML = "Please add content first";
                }
                else{
                    $("#preload").show();
                    document.getElementById("submit_button").disabled = true;
                    document.getElementById("publish_button").disabled = true;
                    msg.innerHTML = "";  
                    $.ajax({
                        type:"POST",
                        url: "updatePost.php",
                        data:{
                            "title_text":title_text,
                            "category":category,
                            "department":department,
                            "year":year,
                            "status":graduate,
                            "content":content,
                            "place" : place,
                            "accepted":1,
                            "post_id": ' . "$post_id" .'
                        },
                        success:function(result){
                            console.log("here");
                            
                            result = $.parseJSON(result);
                            console.log(result);
                            if(result["status"]=="OK"){
                                msg.innerHTML = "Post successfully published";
                                $("#preload").hide();
                            }
                            else{
                                msg.innerHTML = "Some unexpected error occured, please try again later";
                                document.getElementById("submit_button").disabled = false;
                            }
                        }
                    });
                }
            });';
        }
            ?>

            
            
        });
    </script>
</body>
</html>