<?php
	class User{
		public $user_id;
		public $user_name;
		public $user_type;
		public $first_name;
		public $last_name;
		public $gender;
		public $mobile;
		public $email;
		public $password;
		public $question_id;
		public $question_answer;
		public $logged_in_status;
		public $description;
		public $image;
		function __construct($user_id = 0, $user_name = '', $user_type = 'user', $first_name = '', $last_name = '', $gender = '', $mobile = '', $email = '', 
							 $password = '', $question_id = 1, $question_answer = '', $logged_in_status = 0, $description = '', $image = ''){
			$this->user_id = $user_id;
			$this->user_name = $user_name;
			// either "user" or "admin"
			$this->user_type = $user_type;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->gender = $gender;
			$this->mobile = $mobile;
			$this->email = $email;
			$this->password = $password;
			$this->question_id = $question_id;
			$this->question_answer = $question_answer;
			$this->logged_in_status = $logged_in_status;
			$this->description = $description;
			$this->image = $image;
		}
		/*
		public function contents() {
			$vals = array_values(get_object_vars($this));
			return $this->user_name . "\t" . $this->first_name . "\t" . $this->last_name . "\t" . $this->color . "\t" . $this->password;
		}
		public function headings() {
			$vals = array_keys(get_object_vars($this));
			return "user_name\tfirst_name\tlast_name\tcolor\tpassword";
		}
		
		public static function setupDefaultUsers() {
			$users = array();
			$users[] = new User('scat', 'Simons', 'Cat', md5('color' . 'blue'), md5('pwd' . 'password'));
			$users[] = new User('gtierbiter', 'George',  'Tirebiter', md5('color' . 'red'), md5('pwd' . 'password2'));
			User::writeUsers($users);
		}
		public static function writeUsers($users) {
			$helper = new DBHelper();
			foreach($users as $user) {
				$helper->insertUser($user);
			}
		}
		
		public static function readUsers() {
			
			return $users;
		}
		public static function loginRequired(){
			global $_SESSION;
			if(isset($_SESSION['username'])){
				$users = User::readUsers();
				foreach ($users as $user){
					if($user->username === $_SESSION['username']){
						header("Location: ./index.php");
						exit();
					}
				}	
			}
			header("Location: ./login.php");
			exit();
		}
		
		public static function getUser($username, $password){
			?><div id="body-wrapper"><?php
			//$users = User::readUsers();
			foreach($users as $user){
				if(trim($user->user_name) == trim($username)){
						echo "<p>[" . $user->user_name . "][" . trim($user->password) . "]</p>";
						echo "<p>[" . $username . "][" . $password . "]</p>";
					if(trim($user->password) == md5('pwd'.trim($password))){
						return $user;
					}
				}
			}
			return null;
		}
		public static function checkColor($username, $color){
			$users = User::readUsers();
			foreach($users as $user){
				if($user->user_name == $username){
					if($user->color == md5('color'.$color)){
						return $user;
					}
				}
			}
			return null;
		}
		*/
	}
	
?>
