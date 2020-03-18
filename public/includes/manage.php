<?php 

/**
* 
*/
class Manage
{
	private $con;
	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function manageRecordsWithPagination($table,$pno){

		$a = $this->pagination($this->con,$table,$pno,3);
		if ($table=="categories") {
			 $sql = "SELECT p.category_name as category, c.category_name as parent, p.status, p.cid 
			 FROM categories p LEFT JOIN categories c ON p.parent_cat=c.cid ".$a["limit"];
		}else if($table=="products"){
             $sql = "SELECT P.product_name, c.category_name, b.brand_name, p.product_price, p.product_stock, p.added_date,
                    p.p_status FROM products p, categories c, brands b WHERE p.cid = c.cid AND p.bid = b.bid ".$a["limit"];
		}
		else{
			$sql = "SELECT * FROM ".$table." ".$a["limit"];
		}
		$result = $this->con->query($sql) or die($this->con->error);
		$rows = array();
		if($result->num_rows > 0) {
			while ( $row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}

		return ["rows"=>$rows,"pagination"=>$a["pagination"]];
	}


	private function pagination($con,$table,$pno,$n){

	//$query = $con->query("SELECT COUNT(*) as rows FROM ".$table);
    //$row = mysqli_fetch_assoc($query);	
	//$totalRecords = 100000;
    $query = "SELECT * FROM ".$table;
    $result= mysqli_query($con, $query);
    $numberOfRow=mysqli_num_rows($result);


	$pagenum = $pno;
	$numOfRecordsPerPage = $n;

	$list = ceil($numberOfRow/$numOfRecordsPerPage);

	//echo "Last Page ".$list."<br/>";

     $pagination = "<ul class='pagination'>";

	if ($list != 1) {
		if ($pagenum > 1) {
			$previous = "";
			$previous = $pagenum-1;
			$pagination .="<li class='page-item'><a class='page-link' pn='".$previous."' href='#' style='color:#444;'> Previous </a>";
		}
		for($i=$pagenum-5; $i < $pagenum; $i++) { 
			if ($i > 0) {
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i."  </a>";
			}
					
		}
		   $pagination .="<li class='page-item'><a class='page-link' pn='".$pagenum ."' href='#' style='color:red;'> $pagenum </a>";

		   for ($i=$pagenum+1; $i <=$list ; $i++) { 

		   	  $pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i."  </a>";
		   	  if ($i > $pagenum+10) {
		   	  	 break;
		   	  }
		   }
		   if ($list > $pagenum) {
              $next =  $pagenum+1;
		   	 $pagination .="<li class='page-item'><a class='page-link' pn='".$next."' href='#' style='color:#444;'> Next </a></li></ul>";
		   }
	}

	$limit = "Limit ".($pagenum-1)*$numOfRecordsPerPage.",".$numOfRecordsPerPage;
  
	return ["pagination"=>$pagination,"limit"=>$limit];  

}


   public function deleteRecord($table,$pk,$id){
   	  if ($table == "categories") {
   	  	   $pre_stmt=$this->con->prepare("SELECT ".$id." FROM categories WHERE parent_cat = ?");
   	  	   $pre_stmt->bind_param("i",$id);
   	  	   $pre_stmt->execute(); 
   	  	   $result = $pre_stmt->get_result() or die($this->con->error);
   	  	   if ($result->num_rows > 0) {
   	  	   	    return "DEPENDENT_CATEGORY";
   	  	   }else{
                $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ? ");
                $pre_stmt->bind_param("i",$id);
                $result = $pre_stmt->execute() or die($this->con->error);
                if ($result) {
                	 return "CATEGORY_DELETED";
                }
   	  	   } 
   	  }else{
          $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ? ");
          $pre_stmt->bind_param("i",$id);
          $result = $pre_stmt->execute() or die($this->con->error);
               if ($result) {
               	   return "DELETED";
               }
   	  }
   }


   public function getSingleRecord($table,$pk,$id){
        $pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk." = ? LIMIT 1");
        $pre_stmt->bind_param("i",$id);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        if ($result->num_rows == 1) {
        	  $row = $result->fetch_assoc();
        }
        return $row;
   }


   public function storeCustomerOrder($order_date,$cust_name,$arr_tqty,$arr_qty,$arr_price,$arr_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type){

   	   $pre_stmt = $this->con->prepare("INSERT INTO `orders`(`customer_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) 
   	   	VALUES (?,?,?,?,?,?,?,?,?)");
   	   $pre_stmt->bind_param("ssdddddds",$cust_name,$order_date,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);
   	   $pre_stmt->execute() or die($this->con->error);
   	   $order_on = $pre_stmt->insert_id;
   	    if ($order_on != null) {
   	    	 for ($i=0; $i < count($arr_qty) ; $i++) { 

   	    	 	//Here we are finding remaining quanty after calculation
   	    	 	  $rem_qty = $arr_tqty[$i] - $arr_qty[$i];
   	    	 	  if ($rem_qty < 0) {
   	    	 	  	  return "ORDER_FAILED";
   	    	 	  }else{
   	    	 	    $sql = "UPDATE products SET product_stock = '$rem_qty' WHERE product_name = '".$arr_pro_name[$i]."'";
   	    	 	  	$this->con->query($sql);
   	    	 	  }
  
   	    	 	  $insert_product = $this->con->prepare("INSERT INTO `order_details`(`orderid`, `product_name`, `qty`, `price`) 
   	    	 	  	VALUES (?,?,?,?)");
   	    	 	  $insert_product->bind_param("isdd",$order_on,$arr_pro_name[$i],$arr_qty[$i],$arr_price[$i]);
   	    	 	  $insert_product->execute() or die($this->con->error);
   	    	 }

   	    	 return "ORDER_COMPLETE";
   	    }
   }

}

//$obj = new Manage();
//echo "<pre>";
//print_r($obj->manageRecordsWithPagination("products",1));
//echo $obj->deleteRecord("brands",2);
//print_r($obj->getSingleRecord("brands","bid",4));

 ?>