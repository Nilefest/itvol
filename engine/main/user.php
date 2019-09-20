<?php
class User {
	private $registry;
    private $login_tag = '';
    private $password_tag = '';
	private $user = array();

  	public function __construct($registry, $teg) {
		$this->registry = $registry;
        $this->password_tag = $teg . '_password';
        $this->login_tag = $teg . '_login';
        $this->logged();
        if(isset($this->registry->request->get['logout'])) $this->logout();
  	}

    public function login($login, $password){
        $this->registry->session->set($this->login_tag, $login);
        $this->registry->session->set($this->password_tag, $password);
        $this->logged();
    }
    
    public function logged(){
		if ($this->registry->session->get($this->login_tag)) {
			$query = $this->registry->db->query("SELECT * FROM `users` WHERE `login` = '" . $this->registry->session->get($this->login_tag)  ."' AND `password` = '" . $this->registry->session->get($this->password_tag) . "'");
            if(!empty($query)) $this->user = $query[0];
            else $this->logout();
        }
    }
    
  	public function logout() {
		$this->registry->session->delete($this->login_tag);
		$this->registry->session->delete($this->password_tag);
        $this->user = array();
    }
    
  	public function isLogin() {
        if(empty($this->user)) return false;
        return $this->user;
  	}
    
    public function register($data = array()){
        if(empty($data)) return false;
        $columns = '';
        $values = '';
        foreach($data as $key => $vol){
            $columns .= "`" . $key . "`";
            $values .= "'" . $vol . "'";
            unset($data[$key]);
            if(!empty($data)){
                $columns .= ', ';
                $values .= ', ';
            }
        }
        echo $query = $this->registry->db->query("INSERT INTO `users` (`id`, " . $columns . ") VALUES (NULL, " . $values . ")");
    }
}
?>