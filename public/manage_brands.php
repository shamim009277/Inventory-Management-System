<?php 
include_once("./database/constants.php");

if(!isset($_SESSION["userid"])) {
	header("location:".DOMAIN."/");
}
?>

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
    <script type="text/javascript" src="./js/manage.js"></script>
</head>
<body>
	<!--Navbar-->
	<?php include_once("./template/header.php") ?>
    <div class="container">
		<div class="row mt-5">
           <div class="col-md-12 mx-auto">
           	<h4>Brand List</h4>
           <table class="table table-hover table-bordered">
			    <thead>
			      <tr>
			        <th>Sl</th>
			        <th>Brand</th>
			        <th>Status</th>
			        <th>Action</th>
			      </tr>
			    </thead>
			    <tbody id="get_brand">
			      <!-- <tr>
			        <td>01</td>
			        <td>Electronics</td>
			        <td>Root</td>
			        <td><a href="#" class="btn btn-success btn-sm">Active</a>
			        </td>
			        <td>
			        	<a href="#" class="btn btn-danger btn-sm">Delete</a>
			        	<a href="#" class="btn btn-info btn-sm">Edit</a>
			        </td>
			      </tr> -->
			      
			      
			    </tbody>
			  </table>
			  </div>
		</div>
	</div>
	
 
       

</body>
</html>

