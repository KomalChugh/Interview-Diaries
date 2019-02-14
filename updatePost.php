<?php
	$message = new stdclass();
	// var_dump($_POST);

	
	if(isset($_POST['title_text']) && isset($_POST['content']) && isset($_POST['category']) && isset($_POST['department']) && isset($_POST['year']) && isset($_POST['status']) && isset($_POST['place']) && $_POST['post_id']){
		
		$title_text = $_POST['title_text'];
		$content = $_POST['content'];
		$category = $_POST["category"];
		$department = $_POST["department"];
		$year = $_POST["year"];
		$graduate = $_POST["status"];
		$place = $_POST["place"];
		$post_id = $_POST["post_id"];
		$accepted = $_POST["accepted"];
		
		require_once('dbConnect.php');
		
		$sql = "UPDATE posts SET content='$content', category=$category, department=$department, year=$year, graduate=$graduate, place='$place', title='$title_text', accepted=$accepted WHERE id=$post_id";
		
		$result = mysqli_query($con,$sql);
		if($result){
			$message->status = "OK";
		}
		else{
			$message->status = $con->error;
		}
	}
	else{
		$message->status = "ERROR1";
	}

	echo json_encode($message);

?>