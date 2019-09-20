<?php
class Action {
	private $registry;

	private $controllPath;
	private $controllerClass;
    private $controller;
	private $actionMethod;
	private $methodArgs;
	
	public function __construct($registry){
		$this->registry = $registry;
	}
	
	public function make($action) {
        
        $this->controllPath = APPLICATION_DIR . 'controllers/';
        $this->controllerClass = '';
        $this->controller = null;
        $this->actionMethod = '';
        
        // Разбитие запроса на части
        $action = explode('/', $action);

        // Поиск последней директории в контроллдерах
        foreach($action as $key => $act){
            if(is_dir($this->controllPath . $act)){
                $this->controllPath .= $act . '/';
                unset($action[$key]);
            }
            else break;
        }
        $action = array_values($action);
        
        // Поиск .php файла контроллера и подключение файла
        if(file_exists($this->controllPath . $action[0] . '.php'))
        {
            $this->controllPath .= $action[0] . '.php';
            $this->controllerClass = $action[0] . 'Controller';
            unset($action[0]);
            $action = array_values($action);
        }
        elseif(file_exists($this->controllPath . 'index.php')){
            $this->controllPath .= 'index.php';
            $this->controllerClass = 'indexController';
        }
        elseif(file_exists($this->controllPath . $this->registry->config->page_main . 'index.php')){
            $this->controllPath .= $this->registry->config->page_main . 'index.php';
            $this->controllerClass = 'indexController';
        }
        else{
            echo 'Not found controller. Path: ' . $this->controllPath;
            exit();
        }
        require_once($this->controllPath);

        // Проверка и подключение класса контроллера
        if (class_exists($this->controllerClass)) {
            $this->controller = new $this->controllerClass($this->registry);
        }
        else{
            echo 'Not found class controller. Class name: ' . $this->controllerClass . ', in Path:' . $this->controllPath;
            exit();
        }

        // Проверка и запуск метода из класса контроллера
        $this->actionMethod = $action[0];
        if (method_exists ($this->controllerClass, $this->actionMethod)) {
            unset($action[0]);
            $action = array_values($action);
        }
        elseif(method_exists ($this->controllerClass, 'index')){
            $this->actionMethod = 'index';
        }
        else{
            echo 'Not found action method in class controller. Method name: ' . $this->actionMethod . '() or index(), in Class: ' . $this->controllerClass . ', in Path: ' . $this->controllPath;
            exit();
        }
        
        $this->methodArgs = $action;
	}
	
	public function go($commonEnable = false) {
        // Переход
        if(empty($this->methodArgs)) {
            return call_user_func(array($this->controller, $this->actionMethod));
        } else {
            return call_user_func_array(array($this->controller, $this->actionMethod), $this->methodArgs);
        }
	}
}
?>