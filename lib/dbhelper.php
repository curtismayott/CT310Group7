<?php
	//require_once "../user.php";

	class DBHelper{
		public $dbh;
		function __construct(){
			
		}
		public function init(){
			$dbh = new PDO('sqlite:../assets/users/socialnetwork.db');
			$sql = "CREATE TABLE IF NOT EXISTS Users (user_id INTEGER PRIMARY KEY ASC, user_name TEXT, 
					user_type TEXT, first_name TEXT, last_name TEXT, password TEXT, question_id INTEGER, 
					question_answer TEXT, logged_in_status INTEGER);";
			$dbh->exec($sql);
			$dbh->exec("INSERT INTO Users (user_name, user_type, first_name, last_name, password, question_id, question_answer, logged_in_status) 
						   VALUES ('scat', 'user','Simons', 'Cat', 'test123', '1', 'red', 0);");
			$dbh->exec("INSERT INTO Users (user_name, user_type, first_name, last_name, password, question_id, question_answer, logged_in_status)
						   VALUES ('admin', 'admin', 'Admin', 'istrator', 'password', '1', 'light', 0);");
			
			$sql = "CREATE TABLE IF NOT EXISTS Questions (question_id INTEGER PRIMARY KEY ASC, question_text TEXT);";
			$dbh->exec($sql);
			$dbh->exec("INSERT INTO Questions (question_text) VALUES ('What is your favorite color?');");
			$dbh->exec("INSERT INTO Questions (question_text) VALUES ('What is your favorite place?');");
			$dbh->exec("INSERT INTO Questions (question_text) VALUES ('What is your favorite food?');");
			$dbh->exec("INSERT INTO Questions (question_text) VALUES ('What is your favorite foot?');");
			
			// 
			$sql = "CREATE TABLE IF NOT EXISTS Friends (friend_id INTEGER PRIMARY KEY ASC, user_id INTEGER, friend_user_id INTEGER,
					status INTEGER)";
			$dbh->exec($sql);
			// insert friends list for testing
			
			
			$dbh = null;
		}
	
		public function getNumberUsers(){
			$sql = "SELECT * FROM Users";
			$count = 0;
			foreach($dbh->query($sql) as $row){
				$count++;
			}
			return $count;
		}
		public function getNumberQuestions(){
			$sql = "SELECT * FROM Questions";
			$count = 0;
			foreach($dbh->query($sql) as $row){
				$count++;
			}
			return $count;
		}
		public function insertUser($user){
			$sql = "INSERT INTO Users (user_name, first_name, last_name, password, question_id, question_answer) 
					VALUES ('" . $user->user_name . "', '" . $user->first_name
					 . "', '" . $user->last_name . "', '" . $user->password
					 . "', " . $user->question_id . ", '" . $user->question_answer . "');";
			try{
				$dbh2 = new PDO('sqlite:./info/sophia.db');
				$dbh2->exec($sql);
				$dbh2 = null;
			}catch(PDOException $e){
				?><p>EXCEPTION: <?php $e->getMessage(); ?></p><?php
			}
		}
		public function insertQuestion($question_text){
			$sql = "INSERT INTO Questions (question_text) VALUES ('" . $question_text . "');";
			try{
				$dbh2 = new PDO('sqlite:../assets/users/socialnetwork.db');
				$dbh2->exec($sql);
				$dbh2 = null;
			}catch(PDOException $e){
				?><p>EXCEPTION: <?php $e->getMessage(); ?></p><?php
			}
		}
		public function updateQuestion($question_id, $question_text){
			$sql = "UPDATE Questions SET question_text = " . $question_text . " WHERE question_id = " . $question_id . ";";
			$stm = $this->prepare($sql);
			return $stm->execute();
		}
		public function getUserByID($user_id){
			$sql = "SELECT * FROM Users WHERE user_id = " . $user_id . ";";
			$result = $this->query($sql);
			if($result === FALSE){
				echo "<p>Error reading user</p>";
				return NULL;
			}else{
				$user = new User();
				$user->user_name = $result['user_name'];
				$user->first_name = $result['first_name'];
				$user->last_name = $result['last_name'];
				$user->password = $result['password'];
				$user->question_id = $result['question_id'];
				$user->question_answer = $result['question_answer'];
				return $user;
			}
		}
		public function getUserByUsername($user_name){
			$dbh = new PDO('sqlite:../assets/users/socialnetwork.db');
			$sql = "SELECT * FROM Users WHERE user_name = '" . $user_name . "';";
			foreach($dbh->query($sql) as $result){
				$user = new User();
				$user->user_name = $result['user_name'];
				$user->first_name = $result['first_name'];
				$user->last_name = $result['last_name'];
				$user->password = $result['password'];
				$user->question_id = $result['question_id'];
				$user->question_answer = $result['question_answer'];
				$dbh = null;
				return $user;
			}
			$dbh = null;
			return $user;
		}
		public function getUserByUsernameAndPassword($user_name, $password){
			$dbh = new PDO('sqlite:../assets/users/socialnetwork.db');
			$sql = "SELECT * FROM Users WHERE user_name = '" . $user_name . "' AND password = '" . $password . "';";
			foreach($dbh->query($sql) as $result){
				$user = new User();
				$user->user_name = $result['user_name'];
				$user->first_name = $result['first_name'];
				$user->last_name = $result['last_name'];
				$user->password = $result['password'];
				$user->question_id = $result['question_id'];
				$user->question_answer = $result['question_answer'];
				$dbh = null;
				return $user;
			}
			$dbh = null;
			return $user;
		}
		public function getAllUsers(){
			$sql = "SELECT user_id FROM Users";
			$userIDs = $this->query($sql);
			$users = array();
			for($i = 0; $i < count($userIDs); $i++){
				$users[] = getUserById($userIDs[$i]);
			}
		}
		public function verifyUserByQuestion($user_name, $answer_text){
			$dbh = new PDO('sqlite:../assets/users/socialnetwork.db');
			$sql = "SELECT * FROM Users WHERE user_name = '". $user_name . 
				   "' AND question_answer = '" . $answer_text . "';";
			foreach($dbh->query($sql) as $row){
				return true;
			}
			return false;
		}
		public function getQuestionByID($question_id){
			$dbh = new PDO('sqlite:../assets/users/socialnetwork.db');
			$sql = "SELECT * FROM Questions WHERE question_id = " . $question_id;
			$result = '';
			foreach($dbh->query($sql) as $row){
				$result = $row['question_text'];
				$dbh = null;
				return $result;
			}
			$dbh = null;
			return $result;
		}
		public function getQuestionArray(){
			$dbh = new PDO('sqlite:../assets/users/socialnetwork.db');
			$sql = "SELECT * FROM Questions";
			$questions = array();
			foreach($dbh->query($sql) as $row){
				$questions[] = $row['question_text'];
			}
			$dbh = null;
			return $questions;
		}
		public function updateUserQuestion($user_name, $question_id, $answer){
			$dbh = new PDO('sqlite:../assets/users/socialnetwork.db');
			$sql = "UPDATE Users SET question_id = " . $question_id . ", question_answer = '" . $answer . "' WHERE user_name = '" . $user_name . "';";
			$dbh->exec($sql);
		 	$dbh = null;
		}
	}
?>