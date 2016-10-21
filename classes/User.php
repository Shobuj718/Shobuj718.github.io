<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
	//Admin class
	class User{
		public $db;
		public $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();

		}
		public function userRegistration($name,$username,$password,$email){
			$name     = $this->fm->validation($name);
			$username = $this->fm->validation($username);
			$password = $this->fm->validation($password);
			$email    = $this->fm->validation($email);


			$name     = mysqli_real_escape_string($this->db->link, $name);
			$username = mysqli_real_escape_string($this->db->link,$username);
			$password = mysqli_real_escape_string($this->db->link, md5($password));
			$email    = mysqli_real_escape_string($this->db->link,($email));

			if($name == "" || $username == "" || $password == "" || $email == ""){
				echo "<span class='error'>Field must not be empty !</span>";
				exit();
			}
			else if(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
				echo "<span class='error'>Invalid email address !</span>";
				exit();
			}
			else{
				$chkquery = "SELECT * FROM tbl_user WHERE email = '$email'";
				$chkresult = $this->db->select($chkquery);
				if($chkresult != false){
					echo "<span class='error'>Email address already exist !</span>";
					exit();
				}
				else{
					$query = "INSERT INTO tbl_user(name,username,password,email) VALUES('$name','$username','$password','$email')";
					$inserted_row = $this->db->insert($query);
					if($inserted_row){
						echo "<span class='success'>Registration Successfully...</span>";
						exit();
					}
					else{
						echo "<span class='error'>Error.. Not Registered !</span>";
						exit();
					}
				}
			}


		}

		public function userLogin($email,$password){
			$email    = $this->fm->validation($email);
			$password = $this->fm->validation($password);

			$email    = mysqli_real_escape_string($this->db->link, $email);
			$password = mysqli_real_escape_string($this->db->link, $password);

			if($email == "" || $password == ""){
				echo "empty";
				exit();
			}
			else{
				$query = "SELECT * FROM tbl_user WHERE email='$email' AND password='$password'";
				$result = $this->db->select($query);
				if($result != false){
					$value = $result->fetch_assoc();
					if($value['status'] == '1'){
						echo "disable";
						exit();
					}
					else{
						Session::init();
						Session::set("login", true);
						Session::set("userid", $value['userid']);
						Session::set("username", $value['username']);
						Session::set("name", $value['name']);
						
					}
					
				}
				else{
					echo "error";
					exit();
				}
			}

		}

		public function getAllUser(){
			$query = "SELECT * FROM tbl_user ORDER BY userid ";
			$result = $this->db->select($query);
			return $result; 
		}
		public function disableUser($userid){
			$query = "UPDATE tbl_user
						SET 
						status = '1'  
						WHERE userid = $userid";
			$updated_raw = $this->db->update($query);
			if($updated_raw){
				$msg = "<span class = 'success'>User Disabled !</span>";
				return $msg;
			}
			else{
				$msg = "<span class = 'error'>User Not Disabled !</span>";
				return $msg;
			}
		}

		public function enableUser($userid){
			$query = "UPDATE tbl_user
						SET 
						status = '0'  
						WHERE userid = $userid";
			$updated_raw = $this->db->update($query);
			if($updated_raw){
				$msg = "<span class = 'success'>User Enabled !</span>";
				return $msg;
			}
			else{
				$msg = "<span class = 'error'>User Not Enabled !</span>";
				return $msg;
			}
		}
		public function deleteUser($userid){
			$query = "DELETE  FROM tbl_user WHERE userid = '$userid'";
			$deldata = $this->db->delete($query);
			if($deldata){
				$msg = "<span class = 'success'>User Deleted !</span>";
				return $msg;
			}
			else{
				$msg = "<span class = 'error'>Error... User Not Deleted !</span>";
				return $msg;
		}
	}
}

?>