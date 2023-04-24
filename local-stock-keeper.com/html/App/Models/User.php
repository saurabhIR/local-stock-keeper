<?php
namespace App\Models;

use \Core\View;

/**
 * All the fucntion user requires
 */
class User extends \Core\Model{
	/**
	 * protected name variable
	 * @var string
	 */
	protected $name;
	/**
	 * protected email variable
	 * @var string
	 */
	protected $email;
	/**
	 * protected password variable
	 * @var string
	 */
	protected $password;
	
 /**
  * Holds the array of errors
  * @var array
  */
	public $errors = [];

	/**
	 * Assign values to the variables 
	 * @param mixed $data
	 */
	public function __construct($data =[]) {
			foreach ($data as $key => $value) {
					$this->{$key} = $value;
			}
	}

	/**
	 * Save user information in the database.
	 * @return \mysqli_result|bool
	 */
	public function save() {
		// errors function will check if there is any error in the previous code before moving on
		if (empty($this->errors)) {
		// connecting to database and sanitizing post values
		$db = self::getDB();
		$name = mysqli_real_escape_string($db, $this->name);
		$email = mysqli_real_escape_string($db, $this->email);
		$password = mysqli_real_escape_string($db, $this->password);
		// query for inserting details to the users database
		$sql = "INSERT INTO users (name, email, password)
						VALUES ('$name', '$email', '$password')";
		// executing query
		return mysqli_query($db, $sql);
		}
		return false;
	}

	/**
	 * Checks if email exists in the database.
	 * @param mixed $email
	 * @return bool
	 */
	public static function emailExists($email){
		return static::findByEmail($email) != false;   
	}

	/**
	 * Checks if email exists in the database.
	 * @param mixed $email
	 * @return User|null
	 */
	public static function findByEmail($email)
	{
		$db = static::getDB();
		$email = mysqli_real_escape_string($db, $email);
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($result);

		// Convert the row to an object
		$user = null;
		if ($row) {
				$user = new static();
				foreach ($row as $key => $value) {
						$user->$key = $value;
				}
		}
		return $user;
	}

	/**
	 * Authenticate the email and password.
	 * @param mixed $email
	 * @param mixed $password
	 * @return array|bool|null
	 */
	public static function authenticate($email, $password){
		// checking if email already exists
		$db = static::getDB();
		$email = mysqli_real_escape_string($db, $email);
		$password = mysqli_real_escape_string($db, $password);
		$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($result);
		if(isset($row)){
				//session_start();
				$_SESSION['email'] = $email;
		}
		return $row;
	}

	/**
	 * Add new stock details in the database.
	 * @param mixed $data
	 * @return \mysqli_result|bool
	 */
	public function addStock($data =[]) {
		$db = static::getDB();
		$stock_name = mysqli_real_escape_string($db, $_POST['stock_name']);
		$stock_price = mysqli_real_escape_string($db, $_POST['stock_price']);
		$session_email = $_SESSION['email'];
		// Prepare the SQL statement
		$sql = "INSERT INTO stocks (email, stock_name, stock_price)
		VALUES ('$session_email', '$stock_name', '$stock_price')";
		return mysqli_query($db, $sql);
	}

	/**
	 * Show all the stocks from the database.
	 * @return array
	 */
	public function viewStocks(){
		if (empty($this->errors)) {
		$db = self::getDB();
		$sql = "SELECT * FROM stocks";
		$result = mysqli_query($db, $sql);
		$arr=[];
		while ($row = $result->fetch_assoc()){
				$arr[] = $row;
		
		}
		return $arr;
		}
	}

	/**
	 * Deletes the stock detail from the database.
	 * @param mixed $post_id
	 * @return \mysqli_result|bool
	 */
	public function removeStock($post_id) {
		if (empty($this->errors)) {
			$db = self::getDB();
			$sql = "DELETE FROM stocks WHERE stocks_id = '$post_id'";
			return mysqli_query($db, $sql);
		}
	}

	/**
	 * Shows the user specific stocks
	 * @return array
	 */
	public function userStocks() {
		if (empty($this->errors)) {
			$db = self::getDB();
			$session_email = $_SESSION['email'];
			$sql = "SELECT * FROM stocks 	WHERE email = '$session_email' ";
			$result = mysqli_query($db, $sql);
			$arr=[];
			while ($row = $result->fetch_assoc()){
					$arr[] = $row;
			
			}
			return $arr;
			}
	}

	/**
	 * Gets details from the database of a stock.
	 * @param mixed $post_id
	 * @return array|bool|null
	 */
	public function editStock($post_id) {
		if (empty($this->errors)) {
			$db = self::getDB();
			$sql = "SELECT * FROM stocks WHERE stocks_id='$post_id' ";
			$result = mysqli_query($db, $sql);
			$row = $result->fetch_assoc();
			return $row;
			}
	}

	/**
	 * Updates the stock Details
	 * @param mixed $data
	 * @param mixed $post_id
	 * @return \mysqli_result|bool
	 */
	public function updateStock($data =[],$post_id) {
		if (empty($this->errors)) {
			$db = self::getDB();
			$stock_name = mysqli_real_escape_string($db, $_POST['stock_name']);
			$stock_price = mysqli_real_escape_string($db, $_POST['stock_price']);
			$sql = "UPDATE stocks SET stock_name = '$stock_name', stock_price = '$stock_price' WHERE stocks_id = '$post_id'";
			return mysqli_query($db, $sql);
			}
	}

}

?>