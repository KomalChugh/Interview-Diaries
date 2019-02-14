<?php
	$message = new stdclass();
	if(isset($_POST['title_text']) && isset($_POST['content']) && isset($_POST['category']) && isset($_POST['department']) && isset($_POST['year']) && isset($_POST['graduate']) && isset($_POST['place']) ){
		
		$title_text = $_POST['title_text'];
		$content = $_POST['content'];
		$category = $_POST["category"];
		$department = $_POST["department"];
		$year = $_POST["year"];
		$graduate = $_POST["graduate"];
		$place = $_POST["place"];
		
		require_once('dbConnect.php');
		
		session_start();
		$user_id = $_SESSION['userData']['id'];
		$user_name = $_SESSION['userData']['first_name'] . " " .$_SESSION['userData']['last_name'];
		
		$sql = "INSERT INTO posts(user_id, content, category, department, year, graduate, place, user_name, title) VALUES($user_id, '$content', $category, $department, $year, $graduate, '$place', '$user_name', '$title_text')";
		
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