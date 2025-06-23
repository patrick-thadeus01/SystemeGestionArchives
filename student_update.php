<!DOCTYPE html>
<?php 
	session_start();
	if(!ISSET($_SESSION['student'])){
		header("location: index.php");
	}
	require_once 'admin/conn.php'
?>
<html lang="en">
	<head>
		<title>School File Management System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="admin/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/style.css" />
	</head>
<body>
	<div class="col-md-12">
		<div class="panel panel-warning" style="margin-top:10%;">
			<div class="panel-heading" style="margin-top:10px;"">
				<h1 class="panel-title" style="text-align:center"> <b> Modifier Les Informations De L'étudiant </b></h1>
			</div>
			<?php
				$query = mysqli_query($conn, "SELECT * FROM `student` WHERE `stud_id` = '$_SESSION[student]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
			?>
			<div class="panel-body">
				<form method="POST" action="update_query.php">
					<div class="form-group">
						<label>Numero Etudiant:</label> 
						<input type="text" class="form-control" value="<?php echo $fetch['stud_no']?>" name="stud_no" readonly="readonly"/>
						<input type="hidden" value="<?php echo $fetch['stud_id']?>" name="stud_id"/>
					</div>
					<div class="form-group">
						<label>Nom:</label> 
						<input type="text" class="form-control" value="<?php echo $fetch['firstname']?>" name="firstname" required="required"/>
					</div>
					<div class="form-group">
						<label>Prénom:</label> 
						<input type="text" class="form-control" value="<?php echo $fetch['lastname']?>" name="lastname" required="required"/>
					</div>
					<div class="form-group" name="gender" required="required">
						<label>Genre:</label> 
						<select class="form-control" name="gender">
							<option value=""></option>
							<option value="Male">Homme</option>
							<option value="Female">Femme</option>
						</select>
					</div>
					<div class="form-inline">
						<label>Filières</label>
						<select name="section" class="form-control" required="required">
							<option value=""> Selectionner la filièere</option>
							<option value="INF">INF</option>
							<option value="MATHS">MATHS</option>
							<option value="BOA">BOA</option>
							<option value="BC">BC</option>
							<option value="PHY">PHY</option>
							<option value="ESCOM">ESCOM</option>
							<option value="FSEGA">FSEGA</option>
						</select>
						<label>Année</label>
						<select name="year" class="form-control" required="required">
							<option value="">Selectionner l'annee </option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
					<br />
					<div class="form-group">
						<label>Mot de passe:</label> 
						<input type="password" class="form-control" value="" name="password" required="required"/>
					</div>
					<a class="btn btn-danger" href="student_profile.php">Annuler</a> <button class="btn btn-primary" name="update"><span class="glyphicon glyphicon-edit"></span> Sauvegarder</button>
				</form>
				
			</div>
		</div>
	</div>
	
	<?php include 'script.php'?>
</body>
</html>