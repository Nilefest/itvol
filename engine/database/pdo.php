<?php
final class pdoDriver {
	private $pdo = null;
    
	public function __construct($hostname, $port, $username, $password, $database) {
        try{
            $dsn = "mysql:host={$hostname};port={$port};dbname={$database};charset=utf8";
            
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->pdo->query("SET NAMES 'utf8'");
            $this->pdo->query("SET CHARACTER SET utf8");
            $this->pdo->query("SET CHARACTER_SET_CONNECTION=utf8");
            $this->pdo->query("SET SQL_MODE = ''");/**/
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
  	}
		
  	public function query($sql) {
        try{
            $rezult = $this->pdo->query($sql);
            $rezult->setFetchMode(PDO::FETCH_ASSOC);
            $rezultList = array();
        } catch(Exception $e) { echo "ERROR: ".$sql; }
        $i = 0;
        try{
            while($row = $rezult->fetch()){
                $rezultList[$i++] = $row;
            }
            return $rezultList;
        } catch(Exception $e) {}/**/
  	}
	
	public function __destruct() {
		$this->pdo = null;
	}
}
?>
