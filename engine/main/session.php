<?php
class Session {
	private $data = array();
	
	public function __construct() {
        session_start();
        $this->data = array_merge($this->data, $_SESSION);
	}
	
	public function set($key, $val){
		$this->data[$key] = $val;
        $_SESSION[$key] = $val;
	}
    
	public function get($key){
		if(isset($this->data[$key])){
			return $this->data[$key];
		}
		return false;
	}
    
    public function delete($key){
		if(isset($this->data[$key])){
			unset($this->data[$key]);
			unset($_SESSION[$key]);
            return true;
		}
		return false;
    }
}
?>