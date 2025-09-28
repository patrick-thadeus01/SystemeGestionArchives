<div class="col-md-4"></div>
<div class="col-md-4">
	<div class="panel panel-default" id="panel-margin">
		<div style="background-color:black;" class="panel-heading">
			<center><h1 style="color:white"  class="panel-title" >Login Student</h1></center>
		</div>
		<div class="panel-body">
			<form method="POST">
				<div class="form-group">
					<label for="username">User Id</label>
					<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="5" name="stud_no" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label for="text">Username</label>
					<input class="form-control" name="username" type="text" required="required" >
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" name="password" type="password" required="required" >
				</div>
				<?php include 'login_query.php'?>
				<div class="form-group">
					<button class="btn btn-block btn-primary"  name="login"> <b>Login </b></button>
				</div>
			</form>
		</div>
	</div>
</div>	