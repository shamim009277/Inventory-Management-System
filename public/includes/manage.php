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

}

//$obj = new Manage();
//echo "<pre>";
//print_r($obj->manageRecordsWithPagination("categories",1));
// echo $obj->deleteRecord("brands",2);


 ?>