<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Inventory Management Syatem</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="./js/main.js"></script>
</head>
<body>
	<!--Navbar-->
	<?php include_once("./template/header.php") ?>
    <div class="container">
		<div class="card mt-5 mx-auto" style="width: 30rem;">
		  <div class="card-header">
			    Register
		  </div>
		  <div class="card-body">
		    <form id="register_form" onsubmit="return false" autocomplete="off">
		      <div class="form-group">
			    <label for="name">Full Name</label>
			    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Full Name">
			    <small id="n_error" class="form-text text-muted"></small>
			  </div>
			  <div class="form-group">
			    <label for="email">Email address</label>
			    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address">
			    <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
			  </div>
			  <div class="form-group">
			    <label for="password1">Password</label>
			    <input type="password" class="form-control" name="password1" id="password1" placeholder="Enter Password">
			    <small id="p1_error" class="form-text text-muted"></small>
			  </div>

			  <div class="form-group">
			    <label for="password">Re-enter Password</label>
			    <input type="password" class="form-control" name="password2" id="password2" placeholder="Enter Password">
			    <small id="p2_error" class="form-text text-muted"></small>
			  </div>
			  <div class="form-group">
			    <label for="usertype">User Type</label>
			    <select name="usertype" class="form-control" id="usertype">
                    <option value="">Select User Type</option>
                    <option value="1">Admin</option>
                    <option value="0">Other</option>
			    </select>
			    <small id="t_error" class="form-text text-muted"></small>
			  </div>
			  
			  <button type="submit" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Register</button>
			  <span><a href="index.php">Login</a></span>
			</form>
		  </div>
		  <div class="card-footer">
		  	<a href="#" class="text-danger"> Forget Password ?</a>
		  </div>
		</div>
	</div>
</body>
</html>



