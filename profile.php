<!DOCTYPE html>
<html>
<head>
	<title>FETCH COMMENTS</title>
	<style type="text/css">
		body{
			padding: 40px 100px;
			font-family: "verdana";
			font-size: 14px;
		}
		table{
			width: 100%;
			text-align: center;
			margin-top: 15px;
		}
		table thead tr{
			background:#cccccc91;
		}
		form{
			text-align: center;
		}
	</style>
</head>
<body>
<form action="" method="POST">
	<input type="number" name="id">
	<button type="submit" name="submit">RUN</button>
</form>

</body>
</html>


<?php
if(isset($_POST['submit'])){
	$ch = curl_init();
	$post = $_POST['id'];
	curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v3.1/PASTE_YOUR_NUMERIC_PROFILE_ID".$post."/comments?limit=10000&access_token=PASTE_YOUR_ACCESS_TOKEN_HERE");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$results = curl_exec($ch);
	$results = json_decode($results);
	if(isset($results->data)){
		$results = $results->data;
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
		echo "<table>";
		echo "<thead><tr><th>Date time</th><th>Name</th><th>Comment</th><th>..</th></tr></thead><tbody>";
			foreach($results as $result){
				echo '<tr><td>'.$result->created_time.'</td><td>'.$result->from->name.'</td><td>'.$result->message.'</td><td><a href="https://www.facebook.com/'.$result->id.'">Visit Comment</a></td></tr>';
			}
		echo "<tbody></table>";
	}else{
		echo "Something went wrong try again !";
	}
	
}
?>
