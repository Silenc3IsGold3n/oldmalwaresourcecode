<?php
require_once('includes/connect.inc.php');
class Users {

    private $db;

    public function __construct(){

        $this->db = new Connection();
        $this->db = $this->db->dbConnect();

    }
	
	public function addUser($user, $pas){
			$st = $this->db->prepare("SELECT * FROM login WHERE user=? AND password=?");
			$st->bindParam(1, $user);
			$st->bindParam(2, $pas);
			$st->execute();
			
			if($st->rowCount() == 0){
					$query = $this->db->prepare("INSERT INTO  login (`id` ,`user` ,`password` ,`admin`)VALUES (NULL ,  ?,  ?,  '0');");
					$query->bindParam(1, $user);
					$query->bindParam(2, $pas);
					$query->execute();
					if($query)
					{
					
					$mes = "User has been succesfully added to the database!";
					$div = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="modal"></button><h4>Succes!</h4>'.$mes.'</div>';
					return $div;
						
					}
				}
				$mes = "User already exists in the database!";
				$div = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="modal"></button><h4>Warning!</h4>'.$mes.'</div>';
				return $div;
    }
	
	public function changePassword($user, $pas){
			$st = $this->db->prepare("UPDATE login SET password = ? WHERE user = ?");
			$st->bindParam(1, $pas);
			$st->bindParam(2, $user);
			$st->execute();
				if($st)
				{
				$mes = "Your Password has been changed!";
				$div = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="modal"></button><h4>Succes!</h4>'.$mes.'</div>';
				return $div;
				}
    }
	
	public function delUser($id)
	{
		$q = $this->db->prepare("DELETE FROM login WHERE id = ?");
		$q->bindParam(1, $id);		
		$q->execute();
	
	}
	
	public function getUser(){
			$st = $this->db->prepare("SELECT * FROM login WHERE admin = 0");
			$st->execute();
			if($st->rowCount() > 0)
			{
			echo '<table class="table table-hover">
					<form method="POST" action="">
						<thead>
							<tr>
								<th>Username</th>
								<th>Password</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>';
			while($row = $st->fetch(PDO::FETCH_ASSOC))
			{
			
				echo '<tr><td>'.$row['user'].'</td><td>'.$row['password'].'</td><td> <input type="checkbox" name="user_'.$row['id'].'" id="inlineCheckbox3"></td></tr>';
			}
			echo '<tr><td></td><td></td><td><button name="del_user" class="btn">Delete user</button></td></tr>';
			echo '</tbody>
					</form>
					</table>';
			}
			else echo 'No users registered yet.';
    }
	 
}

?>