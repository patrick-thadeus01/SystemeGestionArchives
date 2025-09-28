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
		<title>Archive Management System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="admin/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/style.css" />
	</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
		<div class="container-fluid">
			<label class="navbar-brand">LABO ACADEMY</label>
		</div>
	</nav>
	<div class="col-md-8">
		<div style="margin-top:100px; margin-bottom:15px; text-align:center; background-color:lightblue; padding:10px; "> <h3> <b>  File List </b></h3></div>
		<div class="panel panel-default">
			<div class="panel-body alert-success" >
				
				<table id="table" class="table table-bordered">
					<thead>
						<tr>
							<th>File name</th>
							<th>File type</th>
							<th>Date Uploaded</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query = mysqli_query($conn, "SELECT * FROM `student` WHERE `stud_id` = '$_SESSION[student]'") or die(mysqli_error());
							$fetch = mysqli_fetch_array($query);
							$stud_no = $fetch['stud_no'];
							$query1 = mysqli_query($conn, "SELECT * FROM `storage` WHERE `stud_no` = '$stud_no'") or die(mysqli_error());
							while($fetch1 = mysqli_fetch_array($query1)){
						?>
						<tr class="del_file<?php echo $fetch1['store_id']?>">
							<td><?php echo substr($fetch1['filename'], 0 ,30)?></td>
							<td><?php echo $fetch1['file_type']?></td>
							<td><?php echo $fetch1['date_uploaded']?></td>
							<td><a href="download.php?store_id=<?php echo $fetch1['store_id']?>" class="btn btn-success"><span class="glyphicon glyphicon-download"></span> Download</a> | <button class="btn btn-danger btn_remove" type="button" id="<?php echo $fetch1['store_id']?>"><span class="glyphicon glyphicon-trash"></span> Delete</button></td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-primary" style="margin-top:20%;">
			<div class="panel-heading">
				<h1 class="panel-title">Student Infos</h1>
			</div>
			<div class="panel-body">
				<h4>Student no: <label class="pull-right"><?php echo $fetch['stud_no']?></label></h4>
				<hr style="border-top:1px dotted #ccc;"/>
				<h4>Name: <label class="pull-right"><?php echo $fetch['firstname']." ".$fetch['lastname']?></label></h4>
				<hr style="border-top:1px dotted #ccc;"/>
				<h4>Gender: <label class="pull-right"><?php echo $fetch['gender']?></label></h4>
				<hr style="border-top:1px dotted #ccc;"/>
				<h4>Year & Section: <label class="pull-right"><?php echo $fetch['yr&sec']?></label></h4>
				<hr style="border-top:1px dotted #ccc;"/>
				<h3>File</h3>
				<form method="POST" enctype="multipart/form-data" action="save_file.php">
					<input type="file" name="file" size="4" style="background-color:#fff;" required="required" />
					<br />
					<input type="hidden" name="stud_no" value="<?php echo $fetch['stud_no']?>"/>
					<button class="btn btn-success btn-sm" name="save"><span class="glyphicon glyphicon-plus"></span> Add File</button>
				</form>
				<br style="clear:both;"/>
				<div class="dropdown pull-right">
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="glyphicon glyphicon-cog">&nbsp;</span><span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="student_update.php" data-toggle="modal" data-target="#modal_update">Update Account</a></li>
						<li><a href="#" data-toggle="modal" data-target="#modal_confirm">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
		
	</div>
	<div id = "footer">
		<label class = "footer-title">&copy; Copyright School File Management System <?php echo date("Y", strtotime("+8 HOURS"))?></label>
	</div>
	<div class="modal fade" id="modal_confirm" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">System</h3>
				</div>
				<div class="modal-body">
					<center><h4 class="text-danger">Are you sure you want to logout?</h4></center>
				</div>
				<div class="modal-footer">
					<a type="button" class="btn btn-success" data-dismiss="modal">Cancel</a>
					<a href="logout.php" class="btn btn-danger">Logout</a>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal_remove" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Archive Management System </h3>
				</div>
				<div class="modal-body">
					<center><h4 class="text-danger">Are you sure you want to remove this file?</h4></center>
				</div>
				<div class="modal-footer">
					<a type="button" class="btn btn-success" data-dismiss="modal">No</a>
					<button type="button" class="btn btn-danger" id="btn_yes">Yes</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal_update" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Update Student</h3>
				</div>
				<div class="modal-body">
				<?php
				$query = mysqli_query($conn, "SELECT * FROM `student` WHERE `stud_id` = '$_SESSION[student]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
			?>
			<div class="panel-body">
				<form method="POST" action="update_query.php">
					<div class="form-group">
						<label>Student no:</label> 
						<input type="text" class="form-control" value="<?php echo $fetch['stud_no']?>" name="stud_no" readonly="readonly"/>
						<input type="hidden" value="<?php echo $fetch['stud_id']?>" name="stud_id"/>
					</div>
					<div class="form-group">
						<label>Firstname:</label> 
						<input type="text" class="form-control" value="<?php echo $fetch['firstname']?>" name="firstname" required="required"/>
					</div>
					<div class="form-group">
						<label>Lastname:</label> 
						<input type="text" class="form-control" value="<?php echo $fetch['lastname']?>" name="lastname" required="required"/>
					</div>
					<div class="form-group" name="gender" required="required">
						<label>Gender:</label> 
						<select class="form-control" name="gender">
							<option value=""></option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					<div class="form-inline">
					<label>Section</label>
						<select name="section" class="form-control" required="required">
							<option value=""> Select Field</option>
							<option value="INF">INF</option>
							<option value="MATHS">MATHS</option>
							<option value="PHY">PHY</option>
							<option value="BOA">BOA</option>
							<option value="BC">BC</option>
							<option value="FSEGA">FSEGA</option>
						</select>

						<label>Year</label>
						<select name="year" class="form-control" required="required">
							<option value="">Select Level </option>
							<option value="1">L1</option>
							<option value="2">L2</option>
							<option value="3">L3</option>
							<option value="4">M1</option>
							<option value="5">M2</option>
							<option value="5">D1</option>
							<option value="5">D2</option>
							<option value="5">D3</option>
						</select>
						
					</div>
					<br />
					<div class="form-group">
						<label>Password:</label> 
						<input type="password" class="form-control" value="" name="password" required="required"/>
					</div>
				</form>
				
			</div>
				</div>
				<div class="modal-footer">
				<a type="button" class="btn btn-success" data-dismiss="modal">Cancel</a>
				<button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-edit"></span>Save</button>
				</div>
			</div>
		</div>
	</div>
<?php include 'script.php'?>
<script type="text/javascript">
$(document).ready(function(){
	$('.btn_remove').on('click', function(){
		var store_id = $(this).attr('id');
		$("#modal_remove").modal('show');
		$('#btn_yes').attr('name', store_id);
	});
	
	$('#btn_yes').on('click', function(){
		var id = $(this).attr('name');
		$.ajax({
			type: "POST",
			url: "remove_file.php",
			data:{
				store_id: id
			},
			success: function(data){
				$("#modal_remove").modal('hide');
				$(".del_file" + id).empty();
				$(".del_file" + id).html("<td colspan='4'><center class='text-danger'>Deleting...</center></td>");
				setTimeout(function(){
					$(".del_file" + id).fadeOut('slow');
				}, 1000);
				
			}
		});
	});
});
</script>	
</body>
</html>