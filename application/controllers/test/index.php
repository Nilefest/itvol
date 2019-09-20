<?php
class indexController extends Controller {
	public function index($id = false) {
        
        if(!$id) return $this->all();
        
        $this->data['is_login'] = true;
        $user = $this->user->isLogin();
        if(empty($user)) $this->data['is_login'] = false;
        
        $this->load->model('student_statist');
        $this->load->model('test');
        $this->load->model('test_question');
        $this->load->model('test_answer');
        
        $this->data['test'] = $this->testModel->getItems(array(), array('id' => $id))[0];
        $this->data['test_question'] = $this->test_questionModel->getItems(array(), array('test_id' => $id));
        
        foreach($this->data['test_question'] as $key => $quest){
            $this->data['test_question'][$key]['answers'] = $this->test_answerModel->colToKey($this->test_answerModel->getItems(array(), array('quest_id' => $quest['id'])));
            
            // Перемашать строки
            shuffle($this->data['test_question'][$key]['answers']);
        }
        if(isset($this->request->post['sub_test'])){
            $this->data['testing'] = $this->request->post;
            
            $mark = 0;
            $all_mark = count($this->data['test_question']);
            
            foreach($this->data['test_question'] as $q_key => $quest){
                $this->data['test_question'][$q_key]['is_true_quest'] = '0';
                
                $this->data['test_question'][$q_key]['true_all'] = 0;
                $this->data['test_question'][$q_key]['true_this'] = 0;
                $this->data['test_question'][$q_key]['false_this'] = 0;
                $this->data['test_question'][$q_key]['check_this'] = 0;
                
                foreach($quest['answers'] as $a_key => $ans){
                    // Нанести отметки пользователя на варианті ответов
                    if(isset($this->request->post[$ans['id']]))
                        $this->data['test_question'][$q_key]['answers'][$a_key]['is_check'] = '1';
                    else
                        $this->data['test_question'][$q_key]['answers'][$a_key]['is_check'] = '0';
                    
                    // Количество правильных и НЕ правильных вариантов ответов
                    if($ans['is_true'] == $this->data['test_question'][$q_key]['answers'][$a_key]['is_check']){
                        $this->data['test_question'][$q_key]['true_this']++;
                        $this->data['test_question'][$q_key]['answers'][$a_key]['color'] = 'b2f2a7';
                    }
                    else{
                        $this->data['test_question'][$q_key]['false_this']++;
                        $this->data['test_question'][$q_key]['answers'][$a_key]['color'] = 'ffbcbc';
                    }
                    
                    
                    // Количество отмеченных
                    if($this->data['test_question'][$q_key]['answers'][$a_key]['is_check'] == '1')
                        $this->data['test_question'][$q_key]['check_this']++;
                    
                    // Сколько должно быть правильных
                    $this->data['test_question'][$q_key]['true_all']++;
                }
                
                // Получение статуса 
                // Статус бала для кнопки CHECKBOX можно получить статус ЧАСТИЧНО
                $this->data['test_question'][$q_key]['status'] = 0;
                if($this->data['test_question'][$q_key]['true_all'] == $this->data['test_question'][$q_key]['true_this'])
                    $this->data['test_question'][$q_key]['status'] = 1;
                elseif($this->data['test_question'][$q_key]['type'] == 'checkbox' && $this->data['test_question'][$q_key]['check_this'] > 0){
                    
                    if($this->data['test_question'][$q_key]['true_this'] > 0)
                        $this->data['test_question'][$q_key]['status'] = 2;
                }
                    
                    
                
                
                // Подсчёт балов
                if($this->data['test_question'][$q_key]['status'] == 1)
                    $mark++;
                
            }
            
            
            
            /*foreach($this->data['test_question'] as $q_key => $quest){
                $this->data['test_question'][$q_key]['is_true_quest'] = '1';
                $ask_name = 'ask' . $quest['id'];
                $is_true_ans = [];
                
                $this->data['test_question'][$q_key]['true_all'] = 0;
                $this->data['test_question'][$q_key]['true_this'] = 0;
                $this->data['test_question'][$q_key]['false_this'] = 0;
                
                foreach($quest['answers'] as $a_key => $ans){
                    
                    
                    @$is_sel_val = in_array($ans['id'], $this->data['testing'][$ask_name]);
                    
                    
                    if($ans['is_true'] == '1'){
                        $this->data['test_question'][$q_key]['true_all']++;
                        $this->data['test_question'][$q_key]['true_this']++;
                    }
                    if($ans['is_true'] == '1' && !$is_sel_val){
                        $this->data['test_question'][$q_key]['true_this']--;
                    }
                    if($ans['is_true'] == '0' && $is_sel_val){
                        $this->data['test_question'][$q_key]['false_this']--;
                    }
                    
                    if(($ans['is_true'] == '1' && !$is_sel_val) || ($ans['is_true'] == '0' && $is_sel_val)){
                        $this->data['test_question'][$q_key][answers][$a_key]['color'] = 'ffbcbc';
                        $is_true_ans[] = '0';
                    }
                    else{
                        $this->data['test_question'][$q_key][answers][$a_key]['color'] = 'b2f2a7';
                        $is_true_ans[] = '1';
                    }
                }
                
                if($this->data['test_question'][$q_key]['true_this'] == 0
                  && $this->data['test_question'][$q_key]['false_this'] != 0)
                    $this->data['test_question'][$q_key]['status'] = '0';
                elseif($this->data['test_question'][$q_key]['true_this'] == $this->data['test_question'][$q_key]['true_all']
                      && $this->data['test_question'][$q_key]['false_this'] == 0)
                    $this->data['test_question'][$q_key]['status'] = '1';
                else
                    $this->data['test_question'][$q_key]['status'] = '2';
                
                $this_mark = 1;
                foreach($is_true_ans as $is_true)
                    $this_mark &= $is_true;
                $mark += $this_mark;
            }/**/
            
            
            $this->data['testing_rezult'] = $mark . ' / ' . $all_mark;
            if($user['lvl'] == '2'){
                $this->student_statistModel->addItem(array('st_id' => $user['id'], 
                                                           'test_id' => $id, 
                                                           'mark' => $mark, 
                                                           'mark_all' => $all_mark, 
                                                           'date' => date('Y-m-d')));
            }
            $this->testModel->query("UPDATE `test` SET `testing` = `testing` + 1 WHERE `id` = '" . $id . "'");
        }
        $this->testModel->query("UPDATE `test` SET `view` = `view` + 1 WHERE `id` = '" . $id . "'");
        
        //$this->pre($this->request->post);
        //$this->pre($this->data['test_question']);
        
        //exit();
        $this->data['lvl'] = $this->user->isLogin()['lvl'];
        
        $this->config->title_name = $this->data['test']['title'];
        $this->config->is_sub = true;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('test/index', $this->data);
	}
    
    public function all() {
        
        $this->load->model('test');
        $this->data['list'] = $this->testModel->getItems(array(), array(), array(), array('date' => 'ASC'));
        
        foreach($this->data['list'] as $key => $new){
            $this->data['list'][$key]['type'] = 'test';
            $path = 'application/public/img/test/' . $new['id'] . '.jpg';
            if(file_exists(DIR . $path))
                $this->data['list'][$key]['img'] = '/' . $path;
            else
                $this->data['list'][$key]['img'] = '/application/public/img/test.jpg';
            $this->data['list'][$key]['tags'] = explode(',', $new['tags']);
        }
        
        $this->config->title_name = 'Тести';
        $this->config->is_sub = true;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('main/list', $this->data);
    }
}
?>