<?php
class Load {
	private $registry;

	public function __construct($registry) {
		$this->registry = $registry;
	}
	
	public function view($name, $vars = array()){
		$file = APPLICATION_DIR . 'views/' . $name . '.php';
		if(is_readable($file)){
			extract($vars);
			
	  		ob_start();
	  		include($file);
	  		$content = ob_get_contents();
	  		ob_end_clean();
			
	  		return $content;
		}
		exit('Error: View file ' . $name . ' not found! Path: ' . APPLICATION_DIR . 'views/' . $name . '.php');
	}
	
	public function model($name = false){        
        $modelClass = $name . 'Model';
        $modelPath = APPLICATION_DIR . 'models/' . $name . '.php';

        if($name){
            if(is_readable($modelPath)){
                require_once($modelPath);
                if(class_exists($modelClass)){
                    $this->registry->$modelClass = new $modelClass($this->registry, $name);
                    return true;
                }
            }
        }
        require_once(ENGINE_DIR . 'main/model.php');
        $this->registry->$modelClass = new Model($this->registry, $name);
        return false;
	}
	
	public function library($name){
		$libClass = $name . 'Library';
		$libPath = ENGINE_DIR . 'libs/' . $name . '.php';
		
		if(is_readable($libPath)){
			require_once($libPath);
			return true;
		}
		exit('Error: Library file ' . $name . ' not found! Path: ' . APPLICATION_DIR . 'libs/' . $name . '.php');
	}
}
?>