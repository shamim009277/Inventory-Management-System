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
		        	<a href="#" eid = "<?php echo $row['cid']; ?>" class="btn btn-info btn-sm edt_cat" data-toggle="modal" data-target="#category">Edit</a>
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
  	 $cat = new Manage();
  	 $result = $cat->deleteRecord("categories","cid",$_POST["id"]);
  	 echo $result;
  	 exit();
  }

//Update Category
  if (isset($_POST["updateCategory"])) {
  	$update = new Manage();
  	$result = $update->getSingleRecord("categories","cid",$_POST["id"]);
  	echo json_encode($result);
  	exit();
  }


  //Manage Brand
  if (isset($_POST["manageBrand"])) {
  	 $brand = new Manage();
  	 $result = $brand-> manageRecordsWithPagination("brands",$_POST["pageno"]);
  	 $rows = $result["rows"];
  	 $pagination = $result["pagination"];
  	 if (count($rows) > 0) {
  	 	$n=(($_POST["pageno"]*3)-3);
  	 	foreach ($rows as $row) {
  	 		?>
  	 		  <tr>
                  <td><?php echo ++$n; ?></td>
                  <td><?php echo $row["brand_name"]; ?></td>
                  <td>
                  	   <a href="#" class="btn btn-success btn-sm">Active</a>
                  </td>
                  <td>
                       <a href="#" did="<?php echo $row['bid']; ?>" class="btn btn-danger btn-sm del-bar">Delete</a>
                       <a href="#" eid="<?php echo $row['bid']; ?>" class="btn btn-info btn-sm edt-bar">Edit</a>
                  </td>
  	 		  </tr> 
  	 	<?php	 		
  	 	}
  	 	         
  	 	?>
  	 	  <tr><td colspan="4"><?php echo $pagination; ?></td></tr>

  	 	<?php
  	 	  exit();
  	 }
  }


  //Delete Brand
  if (isset($_POST["deleteBrand"])) {
  	 $brand = new Manage();
  	 $result = $brand->deleteRecord("brands","bid",$_POST["id"]);
  	 echo $result;
  	 exit();
  }




  //Manage product
  if (isset($_POST["manageProduct"])) {
     $product = new Manage();
     $result = $product->manageRecordsWithPagination("products",$_POST["pageno"]);
     $rows = $result["rows"];
     $pagination = $result["pagination"];
     if (count($result) >0 ) {
         $n = (($_POST["pageno"]*3)-3);
        foreach ($rows as $row) {
          ?>
            <tr>
              <td><?php echo ++$n; ?></td>
              <td><?php echo $row["product_name"]; ?></td>
              <td><?php echo $row["category_name"]; ?></td>
              <td><?php echo $row["brand_name"]; ?></td>
              <td><?php echo $row["product_price"]; ?></td>
              <td><?php echo $row["product_stock"]; ?></td>
              <td><?php echo $row["added_date"]; ?></td>
              <td><a href="#" class="btn btn-success btn-sm">Active</a>
              </td>
              <td>
                <a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_prd">Delete</a>
                <a href="#" eid="<?php echo $row['pid']; ?>" class="btn btn-info btn-sm edt_prd">Edit</a>
              </td>
            </tr> 

          <?php 
        }
        ?>
          <tr><td colspan="9"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
     }
  }




//------------------------Order Pprocessing--------------------

  if(isset($_POST["getNewOrderItem"])) {
     $obj = new DBOperation();
     $rows = $obj->getAllRecord("products");
     ?>
     <tr>
        <td class="number">01</td>
        <td>
          <select name="pid[]" class="form-control form-control-sm pid" required>
              <option value="">Select Product</option>
              <?php 
                    foreach ($rows as $row) {
                      ?>
                          <option value="<?php echo $row['pid']; ?>"><?php echo $row['product_name']; ?></option>
                      <?php
                    }
               ?>
             
          </select>
        </td>
        <td>
          <input name="tqty[]" type="text" class="form-control from-control-sm tqty" readonly>
        </td>
        <td>
          <input name="qty[]" type="text" class="form-control from-control-sm qty" required>
        </td>
        <td>
          <input name="price[]" type="text" class="form-control from-control-sm price" readonly>
        </td>
                
          <input name="pro_name[]" type="hidden" class="form-control from-control-sm pro_name">
        <td>
          TK. <span class="amt">0</span>
        </td>
      </tr> 

     <?php
     exit();
  }


  //Get Single Record
  if (isset($_POST["getPriceQuantity"])) {
    $obj = new Manage();
    $result = $obj->getSingleRecord("products","pid",$_POST["id"]);
    echo json_encode($result);
    exit();
  }

  //Please New order
  if (isset($_POST["order_date"]) AND isset($_POST["cust_name"])) {
    
      $order_date = $_POST["order_date"];
      $cust_name  = $_POST["cust_name"];

      //Array data for place order
      $arr_tqty = $_POST["tqty"];
      $arr_qty = $_POST["qty"];
      $arr_price = $_POST["price"];
      $arr_pro_name = $_POST["pro_name"];
      //$_POST["tqty"];


      $sub_total  = $_POST["sub_total"];
      $gst        = $_POST["gst"];
      $discount   = $_POST["discount"];
      $net_total  = $_POST["net_total"];
      $paid       = $_POST["paid"];
      $due        = $_POST["due"];
      $payment_type = $_POST["payment_type"];


      $order = new Manage();
      echo $result = $order->storeCustomerOrder($order_date,$cust_name,$arr_tqty,$arr_qty,$arr_price,$arr_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);
      exit();
      


  }




 ?>