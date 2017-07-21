<?php
require_once('includes/connect.inc.php');
class User {

    private $db;

    public function __construct(){

        $this->db = new Connection();
        $this->db = $this->db->dbConnect();

    }
	
	public function loginUser($user, $pas){
			$st = $this->db->prepare("SELECT * FROM login WHERE user=? AND password=?");
			$st->bindParam(1, $user);
			$st->bindParam(2, $pas);
			$st->execute();
			
			if($st->rowCount() > 0){
                while($row = $st->fetch(PDO::FETCH_ASSOC))
                {
                $id = $row['id'];
                $user = $row['user'];
                }
				header('location:bots.php');
                return $_SESSION['user'] = $user.($user == 'Admin' ? $_SESSION['admin'] = 'Admin': "");
				}
    }
	 
}

?>