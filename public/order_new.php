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
    <script type="text/javascript" src="./js/order.js"></script>
</head>
<body>
	<!--Navbar-->
	<?php include_once("./template/header.php") ?>
    <div class="container">
       <div class="row mt-3">
           <div class="col-md-10 mx-auto">
           	  <div class="card mb-5" style="box-shadow:0 0 20px 0 lightgray;">
				  <div class="card-header">
				     <h4>New Orders</h4>
				  </div>
				  <div class="card-body">
				     <form id="order_form" onsubmit="return false">
                         <div class="form-group row">
                             <label class="col-sm-3 col-form-label" align="right">Order Date</label>
                             <div class="col-sm-6">
                             	<input type="text" name="order_date" id="order_date" readonly class="form-control form-control-sm" value="<?php echo date("Y-d-m"); ?>">
                             </div>
                         </div>
                         <div class="form-group row">
                             <label class="col-sm-3 col-form-label" align="right">Customer Name</label>
                             <div class="col-sm-6">
                             	<input type="text" name="cust_name" id="cust_name" class="form-control form-control-sm" Placeholder="Please Enter Customer Name" required>
                             </div>
                         </div>
                         <div class="card mb-5" style="box-shadow:0 0 10px 0 lightgray;">
                         	<div class="card-body">
                         		<h5>Make Order List</h5>
                         		<table class="table table-hover table-bordered">
								    <thev ad>
								      <tr>
								        <th>Sl</th>
								        <th style="text-align:center;">Item Name</th>
								        <th style="text-align:center;">Total Quantity</th>
								        <th style="text-align:center;">Quantity</th>
								        <th style="text-align:center;">Price</th>
								        <th style="text-align:center;">Total</th>
								      </tr>
								    </thead>
								    <tbody id="invoice-item">
								       <!-- <tr>
									        <td>01</td>
									        <td>
		                                        <select name="pid[]" class="form-control form-control-sm" required>
		                                           <option>Matching Product Name</option>
		                                        </select>
									        </td>
									        <td>
									        	<input typr="text" name="tqty[]" class="form-control from-control-sm" readonly>
									        </td>
									        <td>
									        	<input typr="text" name="qty[]" class="form-control from-control-sm" required>
									        </td>
									        <td>
									        	<input typr="text" name="price[]" class="form-control from-control-sm" readonly>
									        </td>
									        <td>
									        	TK.570
									        </td>
								        </tr>    -->    
								    </tbody>
								 </table>
								   <center >
                                        <button id="add" style="width:130px;" class="btn btn-success ">Add</button>
                                        <button id="remove" style="width:130px;" class="btn btn-danger ">Remove</button>
								   </center>
                         	</div>  <!--Card Body End-->
                         </div> <!--Order List Card  End-->

                         <div class="form-group row">
                             <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                             <div class="col-sm-6">
                             	<input type="text" name="sub_total" id="sub_total" class="form-control form-control-sm" readonly>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="gst" class="col-sm-3 col-form-label" align="right">GST (18%)</label>
                             <div class="col-sm-6">
                             	<input type="text" name="gst" id="gst" class="form-control form-control-sm" readonly>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="discount" class="col-sm-3 col-form-label" align="right">Discount</label>
                             <div class="col-sm-6">
                             	<input type="text" name="discount" id="discount" class="form-control form-control-sm" required>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                             <div class="col-sm-6">
                             	<input type="text" name="net_total" id="net_total" class="form-control form-control-sm" readonly>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                             <div class="col-sm-6">
                             	<input type="text" name="paid" id="paid" class="form-control form-control-sm" required>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
                             <div class="col-sm-6">
                             	<input type="text" name="due" id="due" class="form-control form-control-sm" readonly>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="payment_type" class="col-sm-3 col-form-label" align="right">Payment Method</label>
                             <div class="col-sm-6">
                             	<select name="payment_type" id="payment_type" class="form-control form-control-sm" reduired>

                                    <option>Cash</option>
                                    <option>Card</option>
                                    <option>Draft</option>
                                    <option>Cheque</option>

                             	</select>
                             </div>
                         </div>
                         <center>
                               <input type="submit" id="order-button" style="width:120px;" class="btn btn-info" value="Order">
                               <input type="submit" id="print_invoice" style="width:120px;" class="btn btn-success d-none" value="Print Invoice">
                         </center>

				     </form>
				  </div>
			  </div>
           </div>
       </div>
    </div>
	

</body>
</html>

