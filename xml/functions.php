<?php  


	//load comment
	function load($post_id)
		{
			$conn=mysqli_connect("localhost:1101","root","","medicare");
			
			$sql="SELECT * FROM `comment` where post_id='$post_id' order by comment_id desc;";
			$result=mysqli_query($conn,$sql);
			$resultCheck=mysqli_num_rows($result);

			if ($resultCheck > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

					$user=$row['user'];
					$date=$row['date'];
					$comment=$row['comment'];

					$comment=preg_replace("#\[sp\]#", " &nbsp;", $comment);
					$comment=preg_replace("#\[nl\]#", " <br/>", $comment);
					$comment=preg_replace('"\b(https?://\S+)"', '<a href="$1">$1</a>', $comment);

					$sql_get_userd="SELECT * FROM medicares where username=?";

					if ($conn->connect_error) {
					die("Failed to connect : ".$conn->connect_error);
					}else{
					$stmt_get_userd=$conn->prepare($sql_get_userd);
					$stmt_get_userd->bind_param("s",$user);
					$stmt_get_userd->execute();
					$stmt_result_gpd=$stmt_get_userd->get_result();

					if ($stmt_result_gpd->num_rows>0) {
						$data_p=$stmt_result_gpd->fetch_assoc();
						$users_profile=$data_p['profile'];
					}else{
						echo "Something wrong";
					}
					}

					$output= "<div class='comment-content'>".
						"<div class='commenter-profile'><img src='$users_profile' ></div>".
						"<span class='comment-display'>".
							"<span class='user'>$user</span>".
							"<span class='content'>$comment</span>".
							"<span class='reactions'>".
								"<span id='l-rs' class='rs'></span><span class='like'></span>".
								"<span id='d-rs' class='rs'></span><span class='dislike'></span>".
								"<span id='r-rs' class='rs'></span><span class='reply'></span>".
							"</span>".
						"</span>".
					"</div>";
					echo $output;
				}
		}else{
			echo "<span style='text-align:center;width:100%; margin-top: 100px;float:left;'><h3 style='font-size:3vh;text-align:center;'>Comment your opinions<br><small style='font-size:2vh;'>Type your comment in text box</small></h3></span>";
		}
	}

	function loadLike($post_id){
		$like='';
		$conn=mysqli_connect("localhost:1101","root","","medicare");
		$sql="SELECT * FROM `post` where post_id=?";
		$countlike=0;
		if ($conn->connect_error) {
			die("Failed to connect : ".$conn->connect_error);
		}else{
			$stmt=$conn->prepare($sql);
			$stmt->bind_param("s",$post_id);
			$stmt->execute();
			$stmt_result=$stmt->get_result();

			if ($stmt_result->num_rows>0) {
				$data=$stmt_result->fetch_assoc();
				$countlike=$data['likes'];
			}else{
				$countlike=0;
			}
		}

		if($countlike>0){
			if ($countlike<2) {
				$like=$countlike;
			}else{
				$like=$countlike;
			}
			
		}else{
			$like='Like';
		}
	return $like;
	}

	function loadComment($post_id){
		$comment='';
		$conn=mysqli_connect("localhost:1101","root","","medicare");
		$sql="SELECT * FROM `post` where post_id=?";
		$countlike=0;
		if ($conn->connect_error) {
			die("Failed to connect : ".$conn->connect_error);
		}else{
			$stmt=$conn->prepare($sql);
			$stmt->bind_param("s",$post_id);
			$stmt->execute();
			$stmt_result=$stmt->get_result();

			if ($stmt_result->num_rows>0) {
				$data=$stmt_result->fetch_assoc();
				$countcomment=$data['comments'];
			}else{
				$countcomment=0;
			}
		}

		if($countcomment>0){
			if ($countcomment<2) {
				$comment=$countcomment;
			}else{
				$comment=$countcomment;
			}
			
		}else{
			$comment='';
		}
	return $comment;
	}
?>