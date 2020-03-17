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
    <script type="text/javascript" src="./js/main.js"></script>
</head>
<body>
	<!--Navbar-->
	<?php include_once("./template/header.php") ?>
    <div class="container">
		<div class="row mt-5">
           <div class="col-md-4">
              <div class="card">
				  <img src="./images/user.png" class="card-img-top mx-auto" style="width:60%" alt="...">
				  <div class="card-body">
				    <h5 class="card-title">Profile Info</h5>
				    <?php if(isset($_SESSION["userid"])) {
	                     $name=$_SESSION["name"];
	                     $type=$_SESSION["user_type"];
	                     $last_login=$_SESSION["last_login"];
                     } ?>
				    <p class="card-text"><i class="fa fa-user">&nbsp;</i><?php echo $name; ?></p>
				    <p class="card-text"><i class="fa fa-user">&nbsp;</i> Admin</p>
				    <p class="card-text">Last Login: <?php echo $last_login; ?></p>
				    <a href="#" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
				  </div>
			   </div>
           </div>
           <div class="col-md-8">
              <div class="jumbotron" style="width:100%;height:100%;">
              	<h3>Welcome Admin,</h3>
              	<div class="row">
                   <div class="col-sm-6">
                      <iframe src="http://free.timeanddate.com/clock/i76663tu/n57/szw110/szh110/hoc000/hbw2/hfceee/cf100/hncccc/fdi76/mqc000/mql10/mqw4/mqd98/mhc000/mhl10/mhw4/mhd98/mmc000/mml10/mmw1/mmd98" frameborder="0" width="110" height="110"></iframe>
                   </div>
                   <div class="col-sm-6">
                      <div class="card">
					      <div class="card-body">
					        <h5 class="card-title">New Orders</h5>
					        <p class="card-text">Here you can make invoice and create new orders.</p>
					        <a href="order_new.php" class="btn btn-primary">New Orders</a>
					      </div>
				      </div>
                   </div>
              	</div>
              </div>
           </div>
		</div>
	</div>
	<div class="container">
		<div class="row mt-4 mb-5">
           <div class="col-md-4">
           	 <div class="card">
		      <div class="card-body">
		        <h5 class="card-title">New Categories</h5>
		        <p class="card-text">Here you can manage your categories and you add new categories.</p>
		        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#category">Add</a>
		        <a href="manage_categories.php" class="btn btn-primary">Manage</a>
		      </div>
		     </div>
           </div>
           <div class="col-md-4">
           	 <div class="card">
		      <div class="card-body">
		        <h5 class="card-title">New Brands</h5>
		        <p class="card-text">Here you can manage your brands and you add new brands.</p>
		        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#brand">Add</a>
		        <a href="manage_brands.php" class="btn btn-primary">Manage</a>
		      </div>
		     </div>
           </div>
           <div class="col-md-4">
           	 <div class="card">
		      <div class="card-body">
		        <h5 class="card-title">Products</h5>
		        <p class="card-text">Here you can manage your products and you add new products.</p>
		        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#product">Add</a>
		        <a href="manage_products.php" class="btn btn-primary">Manage</a>
		      </div>
		     </div>
           </div>
		</div>
	</div>
    
 <?php include_once("./template/brand.php"); ?>
 <?php include_once("./template/category.php"); ?>
 <?php include_once("./template/product.php"); ?>


</body>
</html>

