<?php
class indexController extends Controller {
	public function index($id = false) {
        
        if(!$id){
            return $this->all();
        }
        
        $this->data['is_login'] = true;
        $user = $this->user->isLogin();
        if(empty($user)) $this->data['is_login'] = false;
        
        $this->load->model('lecture');
        $this->data['lecture'] = $this->lectureModel->getItems(array(), array('id' => $id))[0];
        
        $this->lectureModel->query("UPDATE `lecture` SET `view` = `view` + 1 WHERE `id` = '" . $id . "'");
        
        //http://www.itvol.nlf.name/application/public/img/lecture/4.jpg
        $path = 'application/public/img/lecture/' . $this->data['lecture']['id'] . '.jpg';
        if(file_exists(DIR . $path))
            $this->data['lecture']['img'] = '/' . $path;
        else
            $this->data['lecture']['img'] = '/application/public/img/lecture.jpg';
        
        $this->config->title_name = $this->data['lecture']['title'];
        $this->config->is_sub = true;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('lecture/index', $this->data);
	}
    
    public function all() {
        
        $this->load->model('lecture');
        $this->data['list'] = $this->lectureModel->getItems(array(), array(), array(), array('date' => 'ASC'));
        
        foreach($this->data['list'] as $key => $new){
            $this->data['list'][$key]['type'] = 'lecture';
            $path = 'application/public/img/lecture/' . $new['id'] . '.jpg';
            if(file_exists(DIR . $path))
                $this->data['list'][$key]['img'] = '/' . $path;
            else
                $this->data['list'][$key]['img'] = '/application/public/img/lecture.jpg';
            $this->data['list'][$key]['tags'] = explode(',', $new['tags']);
        }
        
        $this->config->title_name = 'Лекції';
        $this->config->is_sub = true;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('main/list', $this->data);
    }
}
?>