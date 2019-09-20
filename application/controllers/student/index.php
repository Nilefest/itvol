<?php
class indexController extends Controller {
	public function index() {
        
        $user = $this->user->isLogin();
        if(empty($user)) $this->response->redirect('/login');
        if($user['lvl'] != '2') $this->response->redirect('/login');
        
        $this->load->model('student_statist');
        $this->load->model('test');
        
        if(isset($this->request->get['rem_stat'])){
            $this->student_statistModel->deleteItems(array('id' => $this->request->get['rem_stat']));
        }
        
        $this->data['statistic'] = $this->student_statistModel->getItems(array(), array('st_id' => $user['id']), array(), array('date' => 'DESC'));
        $this->data['tests'] = $this->testModel->colToKey($this->testModel->getItems());
        
        $this->config->is_sub = false;
        $this->config->title_tag .= 'ADM';
        $this->config->title_name = 'Студент';
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('student/index', $this->data);
	}
}
?>