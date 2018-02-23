<?php 
	class IOhandler{
		private $DBcon;

		public function __construct(){
	 		include('dbconfig.php');
	 		$db = new connect();
        	$this->DBcon = $db->startConn();
		}

		public function doo($input){
			$q = $this->DBcon->prepare($input);
			$q->execute();
		}

		public function countRow($value, $table, $params){
			$sql = "SELECT $value from $table where $value = $params";
			$result = $this->DBcon->query($sql);
			$row_cnt = $result->rowCount();
			return $this->reponse(200, $row_cnt);
		}

		public function get_all($table, $id) {
		    $query = "SELECT * FROM $table WHERE _exportid='$id'";
		    $sql = $this->DBcon->prepare($query);
		    $sql->execute();
		    $data = $sql->fetchAll();
		    return $data;
		  //   foreach ($data as $key => $val) {
			 //    $value = $data[1];
			 //    return $value;
			 // }
		}

		public function get_sent($table, $id) {
		    $query = "SELECT * FROM $table WHERE sender_id='$id'";
		    $sql = $this->DBcon->prepare($query);
		    $sql->execute();
		    $data = $sql->fetchAll();
		    return $data;
		}

		public function get_receive($table, $id) {
		    $query = "SELECT * FROM $table WHERE receiver_id='$id'";
		    $sql = $this->DBcon->prepare($query);
		    $sql->execute();
		    $data = $sql->fetchAll();
		    return $data;
		}


		private function out($value){
			echo json_encode($what);
		}

		public function reponse($code, $message){
			$response['status'] = $code;
			$response['message'] = $message;
			out($response);
		}

		public function getBy_id($params, $id, $table){
			$SQL = "SELECT * from $table where $params = '$id'";
			$q = $this->DBcon->prepare($SQL);
			$q->execute();
			$data = $q->fetch(PDO::FETCH_ASSOC);
			return $data;
		}
		public function insert($table, array $fields, array $values) {
		    $numFields = count($fields);
		    $numValues = count($values);
		    if($numFields === 0 or $numValues === 0)
		        throw new Exception("At least one field and value is required.");
		    if($numFields !== $numValues)
		        throw new Exception("Mismatched number of field and value arguments.");

		    $fields = '`' . implode('`,`', $fields) . '`';
		    $values = "'" . implode("','", $values) . "'";
		    $sql = "INSERT INTO {$table} ($fields) VALUES($values)";
			
			if ($q=$this->DBcon->prepare ( $sql )) {
		       // echo json_encode($sql);
		        if ($q->execute()) {
		            return true;
		        }
		    }
		    return false;
		}
		public function update($table,$values=array(),$where){
            $args=array();
			foreach($values as $field=>$value){
				$args[]=$field.'="'.$value.'"';
			}
			$spilt = implode(',',$args);
			$sql='UPDATE '.$table.' SET '.$spilt.' WHERE '.$where;
   			if($q=$this->DBcon->prepare($sql)){
   				if ($q->execute()) {
   					return true;
   				}
   			}
   			return false;
    	}
		public function deleteData($id, $table){
			$SQL = "DELETE from $table where _id = :id";
			$q = $this->DBcon->prepare($SQL);
			$q->execute(array(':id' => $id));
			return true;
		}
		public function startSession(){
			if (!isset($_SESSION['id'])) {
				session_start();
			}
			if (isset($_SESSION['id'])) {
				$sessid = $_SESSION['id'];
			}	
		}
		public function endSession(){
			if(!isset($_SESSION['id'])){
				session_start();
			}
	    	if(isset($_SESSION['id'])){
	    		session_destroy();  
			}
	    }
	    public function getSessiondata(){
	        if (!isset($_SESSION)) {
	            session_start();
	        }
	        $session = array();
	        if(isset($_SESSION['userid'])){
	            $session["userid"] = $_SESSION['userid'];
	            $session["username"] = $_SESSION['username'];
	            $session["email"] = $_SESSION['email'];
	            $session["phone"] = $_SESSION['phone'];
	            $session["bitaddress"] = $_SESSION['bitaddress'];
	            $session["kilo_box"] = $_SESSION['kilo_box'];
	        }else{
	            $session["userid"] = '';
	            $session["username"] = '';
	            $session["email"] = '';
	            $session["phone"] = '';
	            $session["bitaddress"] = '';
	            $session["kilo_box"] = '';
	        }
	        return $session;
	    }
	    public function sendMail($values = array()){
	    	$values = '`' . implode ( '`,`', $values ) . '`';
		    $mail_status = mail($values);
		    if ($mail_status) { 
		        return true;    
		    }else{
		        return false;
		    }
	    }
	    public function checkTableExist($table){
	    	$sql = "'SHOW TABLES FROM '.$this->dbname.' LIKE '.$table.''";
	    	if($sql){
	        	if(mysql_num_rows($sql)==1){
	                return true;
	            }else{
	                return false;
	            }
	        }
	    }
	    public function validateInput($input){
			$input=preg_replace("#[^0-9a-z]#i","",$input);
	    }
	    
	    public function login($table, $email, $password){
	    	session_start();
	    	$sql = "SELECT * FROM $table WHERE email='$email' ORDER BY _id DESC limit 1";
		    $q = $this->DBcon->prepare($sql);
			$q->execute();
			$data = $q->fetch(PDO::FETCH_ASSOC);
		    $count=$q->rowCount();
		    $getpw = $data['pass_key'];
		    $getdisable = $data['disable'];
		    $ever_stat = $data['ever_status'];
		    $verify = password_verify($password, $getpw);
		    
			if(($count)){
				if($ever_stat === "1"){
				   	if($getdisable === "0"){
				        if ($verify) {
				           $_SESSION['userid'] = $data['_id'];
				           $_SESSION['email'] = $data['email'];
				           $_SESSION['username'] = $data['full_name'];
				           $_SESSION['phone'] = $data['phone'];
				           $_SESSION['bitaddress'] = $data['bitaddress'];
				           $_SESSION['kilo_box'] = $data['kolo_box_id'];
				           // header( "refresh:5;url=paage-login.php" );
				           echo "ok";
				        } else {
				            echo "incorrect password";
				        }
				    } elseif($getdisable === "1")
				    	{ echo "you are currently disabled contact comapny for verification";}
				}else{ echo "please check your mail and activate";}
			}else {
			    echo "email not exist try logging in with your username";
			}
		}

		public function GetClientMac(){
		    $macAddr=false;
		    $arp=`arp -n`;
		    $lines=explode("\n", $arp);

		    foreach($lines as $line){
		        $cols=preg_split('/\s+/', trim($line));

		        if ($cols[0]==$_SERVER['REMOTE_ADDR']){
		            $macAddr=$cols[2];
		        }
		    }
		    return $macAddr;
		}
		public function my_url(){
		    $url = (!empty($_SERVER['HTTPS'])) ?
		               "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] :
		               "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		    echo $url;
		}
		public function count_rows_of_foreign($table, $export, $id){
			$result = $this->DBcon->query("SELECT * FROM $table WHERE $export=$id");
			$num_rows = $result->rowCount();
			return $num_rows;
		}
	}		
?>