<?php
class indexController extends Controller {
	public function index() {
        
        $user = $this->user->isLogin();
        if(empty($user)) $this->response->redirect('/login');
        if($user['lvl'] != '0') $this->response->redirect('/login');
        
        $this->load->model('users');
        
        if(isset($this->request->post['sub_save_user'])){
            $this->usersModel->updateItems(array('name' => $this->request->post['name'], 
                                                 'mail' => $this->request->post['mail'], 
                                                 'login' => $this->request->post['login']),
                                           array('id' => $this->request->post['id']));
        }
        if(isset($this->request->post['sub_rem_user'])){
            
            if($user['id'] != $this->request->post['id']){
                $this->usersModel->deleteItems(array('id' => $this->request->post['id']));
            }
            else{
                $this->data['mess'] = 'Користувач не можете видалити самого себе';
            }
        }
        if(isset($this->request->post['sub_save_teacher'])){
            $this->usersModel->updateItems(array('name' => $this->request->post['name'], 
                                                 'mail' => $this->request->post['mail'], 
                                                 'login' => $this->request->post['login'], 
                                                 'lvl' => '1', 
                                                 'password' => $this->request->post['password']), 
                                           array('id' => $this->request->post['id']));
        }
        if(isset($this->request->post['sub_add_user'])){
            
            $users_login = $this->data['users'] = $this->usersModel->getItems(array(), array('login' => $this->request->post['login']));
            if(empty($users_login))
                $this->usersModel->addItem(array('name' => $this->request->post['name'], 
                                                 'mail' => $this->request->post['mail'], 
                                                 'login' => $this->request->post['login'], 
                                                 'lvl' => $this->request->post['lvl'], 
                                                 'date' => date('Y-m-d'), 
                                                 'password' => $this->request->post['password']));
            else{
                $this->data['mess'] = 'Користувач із таким логіном вже існує';
            }
        }
        
        $this->data['users'] = $this->usersModel->getItems(array(), array(), array('lvl' => '3'));
        $this->data['teach_state'] = $this->usersModel->getItems(array(), array('lvl' => '3'));
        
        $this->data['type_lvl'] = $this->config->type_lvl;
        $this->data['user_id'] = $user['id'];
        
        $this->config->is_sub = false;        
        $this->config->title_tag .= 'ADM';
        $this->config->title_name = 'Адміністрування';
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('admin/index', $this->data);
	}
}
?>