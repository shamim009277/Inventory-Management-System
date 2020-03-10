 <?php 

include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");

//For Registration

if (isset($_POST["name"]) AND isset($_POST["email"])) {

	$user = new User();
	$result = $user->createUserAccount($_POST["name"],$_POST["email"],$_POST["password1"],$_POST["usertype"]);
	echo $result;
	exit();
}

//For Login

if (isset($_POST["log_email"]) AND isset($_POST["log_password"])) {
    $user = new User();
    $result = $user->userLogin($_POST["log_email"],$_POST["log_password"]);
    echo $result;
    exit();
} 

//To get Category

if (isset($_POST["getCategory"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("categories");
	foreach ($rows as $row) {
		echo "<option value='".$row["cid"]."'>".$row["category_name"]."</option>";
	}
	exit();
}

//To get Category

if (isset($_POST["getBrand"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("brands");
	foreach ($rows as $row) {
		echo "<option value='".$row["bid"]."'>".$row["brand_name"]."</option>";
	}
	exit();
}

//For Add Category

if (isset($_POST["category_name"]) AND isset($_POST["parent_cat"])) {
	$category = new DBOperation();
	$result=$category->addCategory($_POST["parent_cat"],$_POST["category_name"]);
	echo $result;
	exit();
}

//For Add New Brand

if (isset($_POST["brand_name"])) {
	$brand = new DBOperation();
	$result=$brand->addBrand($_POST["brand_name"]);
	echo $result;
	exit();
}

//For Add New Products
if (isset($_POST["product_name"]) AND isset($_POST["date"]) AND isset($_POST["select_cat"]) AND isset($_POST["select_bar"]) AND isset($_POST["product_price"]) AND isset($_POST["product_stock"])) {
	$product = new DBOperation();
	$result=$product->addProduct($_POST["select_cat"],$_POST["select_bar"],$_POST["product_name"],$_POST["product_price"],$_POST["product_stock"],$_POST["date"]);
	echo $result;
	exit();
}

//Manage Category
if (isset($_POST["manageCategory"])) {
	$obj = new Manage();
	$result = $obj->manageRecordsWithPagination("categories",$_POST["pageno"]);
	$rows = $result["rows"];
	$pagination = $result["pagination"];
	if (count($rows) > 0) {
		$n=(($_POST["pageno"]*3)-3);
		foreach ($rows as $row) {
		  ?>
		    <tr>
		        <td><?php echo  ++$n;?></td>
		        <td><?php echo  $row["category"];?></td>
		        <td><?php echo  $row["parent"];?></td>
		        <td><a href="#" class="btn btn-success btn-sm">Active</a>
		        </td>
		        <td>
		        	<a href="#" did = "<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>
		        	<a href="#" eid = "<?php echo $row['cid']; ?>" class="btn btn-info btn-sm edt_cat">Edit</a>
		        </td>
		      </tr>

		  <?php
		}
		?>
		<tr><td colspan="5"><?php echo  $pagination;  ?></td></tr>

		<?php
         exit();
	}
}


//Delete Category
  if (isset($_POST["deleteCategory"])) {
  	 $obj = new Manage();
  	 $result = $obj->deleteRecord("categories","cid",$_POST["id"]);
  	 echo $result;
  	 exit();
  }



 ?>