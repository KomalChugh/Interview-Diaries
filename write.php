<?php
    session_start();
    if(!$_SESSION['login']){
       header("location:index.php");
       die;
    }
    $userData = $_SESSION['userData'];

    $currentPage ='write';
    include_once 'header.php';
?>
<!-- Nav bar and side nav bar code ends here -->


<div class="row">
    <div class="col l3 m2"></div>
    <div class="col l6 m8 s12" align="center">
            
        <div class="card hoverable" style="border-radius:4px;box-shadow:1px 1px 0 #f7f7f7;border:1px solid #efefef;padding-left:8px;padding-right:8px;">
            <div class="card-content">
                <span class="card-title">Fill me to add a new Post</span>
                <div class="input-field">
                    <input id="title_text" type="text" data-length="50">
                    <label for="title_text" data-error="wrong" data-success="right">Title for your post</label>
                </div>
                <div class="input-field">
                    <input id="place" type="text">
                    <label for="place" data-error="wrong" data-success="right">Relevant Company/University Name</label>
                    <select name="category" id="category" style="color:#666;">
                        <option value="0" disabled selected>Select Category</option>
                        <option value="1">Internship Interview Experience</option>
                        <option value="2">Internship Experience</option>
                        <!-- <option value="3">Job Interview Experience</option>
                        <option value="4">Job Experience</option> -->
                    </select>
                    <input placeholder="Experience Year" name="year" id="year" type="number" min="2010" max="2050">
                    <select name="department" id="department">
                        <option value="0" disabled selected>Select Department</option>
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
                        <option value="0 " disabled selected>Select Graduate Category</option>
                        <option value="1">Undergraduate</option>
                        <option value="2">Masters</option>
                        <option value="3">PhD</option>
                    </select>
                </div>

                <div class="input-field">
                <textarea id="content" class="materialize-textarea" data-length="50000"></textarea>
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
                <button class="btn" style="background-color:#f1f8fb;color: #2865a1;border: 1px solid #3a66ad;text-align: center;font-weight:500;border-radius:3px;display: inline-block;box-shadow:0 1px 1px 0 rgba(200,200,200,0.2);" id="submit_button" type="submit" name="action">Post</button>
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
                    // console.log("title_text" + title_text);
                    msg.innerHTML = "Please enter title first";
                }
                else if(title_text.length>50){
                    msg.innerHTML = "Total charachters in title must be less than 50";   
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
                else if(content.length>=50000){
                    msg.innerHTML = "Total charachters in main content must be less than 50,000";
                }
                else{
                    $("#preload").show();
                    document.getElementById("submit_button").disabled = true;
                    msg.innerHTML = "";  
                    $.ajax({
                        type:"POST",
                        url: "addPost.php",
                        data:{
                            'title_text':title_text,
                            'category':category,
                            'department':department,
                            'year':year,
                            'graduate':graduate,
                            'content':content,
                            'place' : place
                        },
                        success:function(result){
                            console.log("here");
                            result = $.parseJSON(result);
                            if(result["status"]=="OK"){
                                msg.innerHTML = "Post successfully sent for review";
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

            
            
        });
    </script>
</body>
</html>