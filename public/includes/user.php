<?php 

/**
* 
*/
class User
{
	
   private $con;

	function __construct()  
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
		
	}

	//User is Exist

	public function emailExist($email){
		$pre_stmt = $this->con->prepare("SELECT id FROM user WHERE email = ? ");   
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			return 1;
		}else{
			return 0;
		}
       
	}

	//Create User Account
	//To protect you application from sql attack you can use prepares statement

	public function createUserAccount($name,$email,$password,$usertype){
		if ($this->emailExist($email)) {
			return "EMAIL_ALREADY_EXIST";
		}else{
			$pass = password_hash($password,PASSWORD_BCRYPT,["COST"=>8]);
			$date = date("Y-m-d");
			$note = "";
			$pre_stmt = $this->con->prepare("INSERT INTO `user`(`name`, `email`, `password`, `user_type`, `register_date`, `last_login`, `notes`) 
				VALUES (?,?,?,?,?,?,?)");
			$pre_stmt->bind_param("sssssss",$name,$email,$pass,$usertype,$date,$date,$note);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return $this->con->insert_id;
			}else{
				return "SOMETHING WRONG";
			}
		}

	}

	public function userLogin($email,$password){
		$pre_stmt = $this->con->prepare("SELECT id,name,password,last_login FROM user WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows < 1) {
			return "NOTHING_REGISTER";
		}else{
           $row = $result->fetch_assoc();
           if (password_verify($password,$row["password"])) {
           	   $_SESSION["userid"] = $row["id"];
           	   $_SESSION["name"] = $row["name"];
           	   $_SESSION["user_type"] = $row["user_type"];
           	   $_SESSION["last_login"] = $row["last_login"];

           	   $last_login = date("Y-m-d h:m:s");
           	   $pre_stmt = $this->con->prepare("UPDATE user SET last_login = ? WHERE email = ? ");
           	   $pre_stmt->bind_param("ss",$last_login,$email);
           	   $result = $pre_stmt->execute() or die($this->con->error);
           	   if ($result) {
           	   	   return 1;
           	   }else{
           	   	  return 0;
           	   }
           }else{
           	  return "PASSWORD_NOT_MATCHED";
           }
		}
	}
}

/*$user = new User();
echo $user->createUserAccount("Towhedul Islam","towhid009@gmail.com","towhid009","Admin");

echo $user->userLogin("towhid009@gmail.com","towhid009");
echo $_SESSION["name"];*/

 ?>