<?php
class indexController extends Controller {
	public function index($id = false) {
        
        if(!$id){
            return $this->all();
        }
        
        $this->data['is_login'] = true;
        $user = $this->user->isLogin();
        if(empty($user)) $this->data['is_login'] = false;
        
        $this->load->model('lab');
        $this->data['lab'] = $this->labModel->getItems(array(), array('id' => $id))[0];
        
        $this->labModel->query("UPDATE `lab` SET `view` = `view` + 1 WHERE `id` = '" . $id . "'");
        
        $this->config->title_name = $this->data['lab']['title'];
        $this->config->is_sub = true;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('lab/index', $this->data);
	}
    
    public function all() {
        
        $this->load->model('lab');
        $this->data['list'] = $this->labModel->getItems(array(), array(), array(), array('date' => 'ASC'));
        
        foreach($this->data['list'] as $key => $new){
            $this->data['list'][$key]['type'] = 'lab';
            $path = 'application/public/img/lab/' . $new['id'] . '.jpg';
            if(file_exists(DIR . $path))
                $this->data['list'][$key]['img'] = '/' . $path;
            else
                $this->data['list'][$key]['img'] = '/application/public/img/lab.jpg';
            $this->data['list'][$key]['tags'] = explode(',', $new['tags']);
        }
        
        $this->config->title_name = 'Лабораторні роботи ';
        $this->config->is_sub = true;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('main/list', $this->data);
    }
}
?>