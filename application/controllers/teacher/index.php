<?php
class indexController extends Controller {
	public function index() {
        
        $user = $this->user->isLogin();
        if(empty($user)) $this->response->redirect('/login');
        if($user['lvl'] != '1') $this->response->redirect('/login');
        
        $this->response->redirect('/teacher/lecture');
	}
    
	public function lab() {
        
        $user = $this->user->isLogin();
        if(empty($user)) $this->response->redirect('/login');
        if($user['lvl'] != '1') $this->response->redirect('/login');
        
        $this->load->model('lab');
        
        if(isset($this->request->post['sub_add_lab'])){
            $this->labModel->addItem(array('title' => str_replace("'", '`', $this->request->post['title']), 
                                           'name' => str_replace("'", '`', $this->request->post['name']), 
                                           'target' => str_replace("'", '`', $this->request->post['target']), 
                                           'description' => str_replace("'", '`', $this->request->post['description']), 
                                           'tags' => str_replace("'", '`', $this->request->post['tags']), 
                                           'date' => date('Y-m-d'), 
                                           'teacher_id' => $user['id']));
            
            $id = $this->labModel->getMax('id');
            if(isset($this->request->files['doc']['name']))
                move_uploaded_file($this->request->files['doc']['tmp_name'], APPLICATION_DIR . 'public/files/doc/' . $id . '.doc');
        }
        if(isset($this->request->get['rem_lab'])){
            $this->labModel->deleteItems(array('id' => $this->request->get['rem_lab']));
            if(file_exists(APPLICATION_DIR . 'public/files/doc/' . $this->request->get['rem_lab'] . '.doc'))
                unlink(APPLICATION_DIR . 'public/files/doc/' . $this->request->get['rem_lab'] . '.doc');
        }
        
        $this->data['labs'] = $this->labModel->getItems();
        
        $this->config->is_sub = false;
        $this->config->title_tag .= 'ADM';
        $this->config->title_name = 'Лабораторні роботи';
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('/teacher/lab', $this->data);
	}
    
	public function lecture() {
        
        $user = $this->user->isLogin();
        if(empty($user)) $this->response->redirect('/login');
        if($user['lvl'] != '1') $this->response->redirect('/login');
        
        $this->load->model('lecture');
        
        if(isset($this->request->post['sub_add_lecture'])){
            $this->lectureModel->addItem(array('title' => str_replace("'", '`', $this->request->post['title']), 
                                               'description' => str_replace("'", '`', $this->request->post['description']), 
                                               'tags' => str_replace("'", '`', $this->request->post['tags']), 
                                               'date' => date('Y-m-d'), 
                                               'teacher_id' => $user['id']));
            
            $id = $this->lectureModel->getMax('id');
            if(isset($this->request->files['img']['name']))
                move_uploaded_file($this->request->files['img']['tmp_name'], APPLICATION_DIR . 'public/img/lecture/' . $id . '.jpg');
            if(isset($this->request->files['pdf']['name']))
                move_uploaded_file($this->request->files['pdf']['tmp_name'], APPLICATION_DIR . 'public/files/pdf/' . $id . '.pdf');
        }
        if(isset($this->request->get['rem_lecture'])){
            $this->lectureModel->deleteItems(array('id' => $this->request->get['rem_lecture']));
            if(file_exists(APPLICATION_DIR . 'public/img/lecture/' . $this->request->get['rem_lecture'] . '.jpg'))
                unlink(APPLICATION_DIR . 'public/img/lecture/' . $this->request->get['rem_lecture'] . '.jpg');
            if(file_exists(APPLICATION_DIR . 'public/files/pdf/' . $this->request->get['rem_lecture'] . '.pdf'))
                unlink(APPLICATION_DIR . 'public/files/pdf/' . $this->request->get['rem_lecture'] . '.pdf');
        }
        
        $this->data['lectures'] = $this->lectureModel->getItems();
        
        $this->config->is_sub = false;
        $this->config->title_tag .= 'ADM';
        $this->config->title_name = 'Лекції';
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('/teacher/lecture', $this->data);
	}
    
	public function test() {
        
        $user = $this->user->isLogin();
        if(empty($user)) $this->response->redirect('/login');
        if($user['lvl'] != '1') $this->response->redirect('/login');
        
        $this->load->model('test');
        
        if(isset($this->request->post['sub_add_test'])){
            $this->testModel->addItem(array('title' => str_replace("'", '`', $this->request->post['title']), 
                                            'name' => str_replace("'", '`', $this->request->post['name']), 
                                            'description' => str_replace("'", '`', $this->request->post['description']), 
                                            'tags' => str_replace("'", '`', $this->request->post['tags']), 
                                            'date' => date('Y-m-d'), 
                                            'teacher_id' => $user['id']));
            
            $id = $this->testModel->getMax('id');
            if(isset($this->request->files['excel']['name']))
                move_uploaded_file($this->request->files['excel']['tmp_name'], APPLICATION_DIR . 'public/files/excel/' . $id . '.xlsx');
            
            $this->createTest($id);
        }
        if(isset($this->request->get['rem_test'])){
            $this->testModel->deleteItems(array('id' => $this->request->get['rem_test']));
        }
        
        $this->data['tests'] = $this->testModel->getItems();
        
        $this->config->is_sub = false;
        $this->config->title_tag .= 'ADM';
        $this->config->title_name = 'Тести';
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('/teacher/test', $this->data);
	}
    
	public function no() {
        
        $user = $this->user->isLogin();
        if(empty($user)) $this->response->redirect('/login');
        if($user['lvl'] != '3') $this->response->redirect('/login');
        
        $this->config->is_sub = false;
        $this->config->title_tag .= 'ADM';
        $this->config->title_name = 'Новий викладач';
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('/teacher/no', $this->data);
	}
    
    private function createTest($id = false){
        if(!id) return false;
        
        $this->load->model('test_question');
        $this->load->model('test_answer');
        
        $this->load->library('excel');
        $excel = new excelLibrary();
        
        $list = $excel->readFileToArray(APPLICATION_DIR . 'public/files/excel/' . $id . '.xlsx');
        unset($list[0]);
        
        $ans_true = array();
        $ans_false = array();
        foreach($list as $row){
            if($row[2] != '') $ans_true[] = $row[2];
            if($row[3] != '') $ans_true[] = $row[3];
            if($row[4] != '') $ans_true[] = $row[4];
            if($row[5] != '') $ans_true[] = $row[5];
            if($row[6] != '') $ans_false[] = $row[6];
            if($row[7] != '') $ans_false[] = $row[7];
            if($row[8] != '') $ans_false[] = $row[8];
            if($row[9] != '') $ans_false[] = $row[9];
            
            $type = (count($ans_true) == 1 ? 'radio' : 'checkbox');
            $this->test_questionModel->addItem(array('test_id' => $id, 
                                                     'question' => str_replace("'", '`', $row[1]), 
                                                     'type' => str_replace("'", '`', $type)));
            
            $quest_id = $this->test_questionModel->getMax('id');
            foreach($ans_true as $ans)
                $this->test_answerModel->addItem(array('quest_id' => $quest_id, 
                                                       'value' => str_replace("'", '`', $ans), 
                                                       'is_true' => '1'));
            foreach($ans_false as $ans)
                $this->test_answerModel->addItem(array('quest_id' => $quest_id, 
                                                       'value' => str_replace("'", '`', $ans), 
                                                       'is_true' => '0'));
            
            $ans_true = array();
            $ans_false = array();
        }
        
        return true;
    }
}
?>