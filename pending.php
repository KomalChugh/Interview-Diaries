<?php
    session_start();
    if(!$_SESSION['login']){
       header("location:index.php");
       die;
    }

    $userData = $_SESSION['userData'];

    $msg = "Error fetching content";
    require_once('dbConnect.php');
    $a = 0;
    if($_SESSION["admin"]){
        $sql = "SELECT * FROM posts WHERE accepted=0";
        $result = mysqli_query($con,$sql);
        if($result){
            $a = 1;
        }       
    }
    $currentPage ='pending';
    include_once 'header.php';
?>

<!-- Nav bar and side nav bar code ends here -->
<div class="row">
    <div class="col l3 m2"></div>
    <div class="col l6 m8 s12">
                <?php
                    if($a==1){
                        while($row=mysqli_fetch_array($result)){
                            echo '<div class="card hoverable" style="border-radius:4px;box-shadow:1px 1px 0 #f7f7f7;border:1px solid #efefef;padding-left:8px;padding-right:8px;">';
                            echo '<div class="card-content">';
                            if($row['accepted']==0){
                                echo "<blockquote>Pending Post</blockquote>";
                            }
                            $title = $row['title'];
                            $user_name = $row['user_name'];
                            $place = $row['place'];
                            $content = $row['content'];
                            echo '<a target="_blank" href="post.php?id=' . $row["id"] . '"><strong><span class="card-title black-text">' . '<h5>' . $title .'</h5>' . '</span></strong></a>';
                            echo '<span class="card-title">' . $user_name . ' @' . $place . '</span>';
                            $l = min(150,strlen($row["content"])-1);
            echo substr($row["content"],0,$l);
            echo '<div id="post-' . $row["id"] . '" style="display:none;">' . substr($row["content"],$l) . '</div>';
            echo '<a href="javascript:void(0)" style="color:#2b6dad;" onclick="document.getElementById(' .  "'post-" . $row["id"] . "')" . ".style.display='inline';$(this).hide();" . '">...(read)</a><br>';
                            if($row['accepted']==0){
                                echo '<form action="edit.php"  style="margin:0px;padding:0px;display:inline;"><input type="hidden" name="id" value="'. $row["id"] .'"/><button class="btn" style="background-color:#f1f8fb;color: #2865a1;border: 1px solid #3a66ad;text-align: center;font-weight:500;border-radius:3px;display: inline-block;box-shadow:0 1px 1px 0 rgba(200,200,200,0.2);margin-top:10px;" id="edit_button' . $row["id"] . ' type="submit">Edit</button></form>';
                            }
                            echo '</div></div>';
                        }
                    }
                    else{
                        echo '<strong><span class="card-title">' . $msg .'</span></strong>';
                    }
                ?>
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
