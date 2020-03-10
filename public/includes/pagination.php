<?php 

 $con = mysqli_connect("localhost","root","","test");

function pagination($con,$table,$pno,$n){

	//$query = $con->query("SELECT COUNT(*) as rows FROM".$table);
    //$row = mysqli_fetch_assoc($query);	
	$totalRecords = 100000;
	$pagenum = $pno;
	$numOfRecordsPerPage = $n;

	$list = ceil($totalRecords/$numOfRecordsPerPage);

	echo "Last Page ".$list."<br/>";

     $pagination = "";

	if ($list != 1) {
		if ($pagenum > 1) {
			$previous = "";
			$previous = $pagenum-1;
			$pagination .="<a href='pagination.php?pagenum=".$previous."' style='color:#444;'> Previous </a>";
		}
		for($i=$pagenum-5; $i < $pagenum; $i++) { 
			if ($i > 0) {
				$pagination .= "<a href='pagination.php?pagenum=".$i."'> ".$i."  </a>";
			}
					
		}
		   $pagination .="<a href='pagination.php?pagenum=".$pagenum ."' style='color:red;'> $pagenum </a>";

		   for ($i=$pagenum+1; $i <=$list ; $i++) { 

		   	  $pagination .= "<a href='pagination.php?pagenum=".$i."'> ".$i."  </a>";
		   	  if ($i > $pagenum+10) {
		   	  	 break;
		   	  }
		   }
		   if ($list > $pagenum) {
              $next =  $pagenum+1;
		   	 $pagination .="<a href='pagination.php?pagenum=".$next."' style='color:#444;'> Next </a>";
		   }
	}

	$limit = "Limit ".($pagenum-1)*$numOfRecordsPerPage.",".$numOfRecordsPerPage;
  
	return ["pegination"=>$pagination,"limit"=>$limit];  

}


  if (isset($_GET["pagenum"])) {
  	$page=$_GET["pagenum"];
  	echo "<pre>";
    print_r(pagination($con,"fff",$page,10));
  	;
  }
     

 ?>