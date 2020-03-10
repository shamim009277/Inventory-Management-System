<?php 

/**
* 
*/
class DBOperation
{
	private $con;

	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con  = $db->connect();
	}

	public function addCategory($parent,$cat){
        $pre_stmt=$this->con->prepare("INSERT INTO `categories`(`parent_cat`, `category_name`, `status`) 
                	VALUES (?,?,?)");
        $status=1;
        $pre_stmt->bind_param("isi",$parent,$cat,$status);
        $result=$pre_stmt->execute() or die($this->con->error);
        if ($result) {
        	return "Category_added";
        }else{
        	return 0;
        }
	}

	public function addBrand($brand){
		$pre_stmt=$this->con->prepare("INSERT INTO `brands`(`brand_name`, `status`) 
			VALUES (?,?)");
		$status=1;
		$pre_stmt->bind_param("si",$brand,$status);
		$result=$pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "BRAND_ADDED";
		}
		return 0;

	}

	public function addProduct($cid,$bid,$Product_name,$price,$stock,$date){
       $pre_stmt = $this->con->prepare("INSERT INTO `products`(`cid`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`) 
       	VALUES (?,?,?,?,?,?,?)");
       $status = 1;
       $pre_stmt->bind_param("iisdisi",$cid,$bid,$Product_name,$price,$stock,$date,$status);
       $result=$pre_stmt->execute() or die($this->con->error);
       if ($result) {
       	  return "PRODUCT_ADDED";
       }
        return 0;
	}



	

	public function getAllRecord($table){
		$pre_stmt=$this->con->prepare("SELECT * FROM ".$table);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
        $rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
		return "No_Data";
	}
}

//$cat = new DBOperation();
/*echo $cat->addCategory(1,"Mobile");*/
/*echo "<pre>";
print_r($cat->getAllRecord("categories")); */
/*echo $cat->addBrand("Samsung");
*/ 
 //echo $cat->addProduct(1,1,"Mobile",543,10,234,1);

 ?>
