<?php
	if(isset($_POST['offset']) && isset($_POST['limit']) && isset($_POST['category']) && isset($_POST['department']) && isset($_POST['year']) && isset($_POST['graduate']) ){
		$limit = $_POST['limit'];
		$offset = $_POST['offset'];
		$category = $_POST["category"];
		$department = $_POST["department"];
		$year = $_POST["year"];
		$graduate = $_POST["graduate"];
		$temp = " WHERE (1=1 ";
		
		if($category>0){
			$temp .= " AND category=$category";
		}
		if($department>0){
			$temp .= " AND department=$department";
		}
		if($year>0){
			$temp .= " AND year=$year";
		}
		if($graduate>0){
			$temp .= " AND graduate=$graduate";
		}

		$temp .= " ) ";
		require_once('dbConnect.php');
		$sql = "SELECT * FROM posts " . $temp . " AND accepted=1 ORDER BY time_added DESC LIMIT {$limit} OFFSET {$offset} ";
		$result = mysqli_query($con,$sql);
		$count = 0;
		while($row=mysqli_fetch_array($result)){
			echo '<div class="card hoverable" style="border-radius:4px;box-shadow:1px 1px 0 #f7f7f7;border:1px solid #efefef;padding-left:8px;padding-right:8px;">';
			$title = $row['title'];
            $user_name = $row['user_name'];
            $place = $row['place'];
            $content = $row['content'];
			echo '<div class="card-content" style="overflow: hidden;position: relative;">';
			echo '<a target="_blank" href="post.php?id=' . $row["id"] . '"><strong><span class="card-title black-text">' . '<h5>' . $title .'</h5>' . '</span></strong></a>';
            echo '<span class="card-title">' . $user_name . ' @' . $place . '</span>';
			$l = min(150,strlen($row["content"])-1);
			echo substr($row["content"],0,$l);
			echo '<div id="post-' . $row["id"] . '" style="display:none;">' . substr($row["content"],$l) . '</div>';
			echo '<a href="javascript:void(0)" style="color:#2b6dad;" onclick="document.getElementById(' .  "'post-" . $row["id"] . "')" . ".style.display='inline';$(this).hide();" . '">...(more)</a>'; 
			echo '</div>';
			echo '</div>';
		}

	}

?>