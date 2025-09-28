<?php
	session_start();
	require 'conn.php';
	//if the user got registered
	if(ISSET($_POST['login'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		//query to check if the username and password exist in the database
		//if it exists, it will return one row
		$query = mysqli_query($conn, "SELECT * FROM `user` WHERE `username` = '$username' && `password` = '$password'") or die(mysqli_error());
		$fetch = mysqli_fetch_array($query);
		$row = $query->num_rows;
		
		//if one row is returned, it means the username and password is correct
		//then the program creates a session and redirect to home.php
		if($row > 0){
			$_SESSION['user'] = $fetch['user_id'];
			$_SESSION['status'] = $fetch['status'];
			header("location:home.php");
		}else{
			echo "<center><label class='text-danger'>Invalid username or password</label></center>";
		}
	}
?>