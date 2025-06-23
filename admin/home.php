<!DOCTYPE html>
<?php 
	require 'validator.php';
	require_once 'conn.php'
?>
<html lang = "en">
	<head>
		<title>File Management System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	</head>
	<style>
		.flex-container {
			display: flex;
			flex-wrap: nowrap;
			padding-left: 100px;
			text-align: center;
			line-height: 50px;
			font-size: 20px;
			width: 10px;
		}
	
	</style>
<body>
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
		<div class="container-fluid">
			<label class="navbar-brand">Système De Gestion Des Archives</label>
			<?php 
				$query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '$_SESSION[user]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);

				$query = mysqli_query($conn, "SELECT * FROM user");
				$users = mysqli_num_rows($query);

				$query1 = mysqli_query($conn, "SELECT * FROM student");
				$students = mysqli_num_rows($query1);
			?>
			<ul class = "nav navbar-right">	
				<li class = "dropdown">
					<a class = "user dropdown-toggle" data-toggle = "dropdown" href = "#">
						<span class = "glyphicon glyphicon-user"></span>
						<?php 
							echo $fetch['firstname']." ".$fetch['lastname'];
						?>
						<b class = "caret"></b>
					</a>
				<ul class = "dropdown-menu">
					<li>
						<a href = "logout.php"><i class = "glyphicon glyphicon-log-out"></i> Deconnexion</a>
					</li>
				</ul>
				</li>
			</ul>
		</div>
	</nav>
	<?php include 'sidebar.php'?>
	<div id = "content">
		<br /><br /><br />
		<div class="alert alert-info"><h3>Tableaux De Bord</h3></div> 
		<div>
        <div class="flex-container" style="width:50%;Text-align:center;float:left;">
			<div class="card" style="width: 28rem;">
				<div class="card-header">
					<li class="list-group-item">Utilisateurs</li>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">Total Users : <?php echo $users ?> </li>
					<li class="list-group-item"> <a href="user.php" class="btn btn-primary">Gestionaire des Utilisateurs</a> </li>
				</ul>
			</div>
		</div>
        <div class="flex-container" style="Text-align:center;Width:50%;float:right">
		  	<div class="card" style="width: 28rem;">
				<div class="card-header">
					<li class="list-group-item">Etudiants</li>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">Total Etudiants :  <?php echo $students ?> </li>
					<li class="list-group-item"> <a href="student.php" class="btn btn-primary">Gestionaire Des Etudiants</a> </li>
				</ul>
			</div>
		</div>
	</div>
		

	</div>
</div>
	<div id = "footer">
		<label class = "footer-title">&copy; Droits d'auteur du Système de gestion des archives <?php echo date("Y", strtotime("+8 HOURS"))?></label>
	</div>
<?php include 'script.php'?>	
</body>
</html>