<?php
class indexController extends Controller {
	public function index() {
        
        $this->config->is_sub = true;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('main/index', $this->data);
	}
    
    public function login() {
        
        if(isset($this->request->get['logout'])) $this->response->redirect('/');
        
        if(isset($this->request->post['sub_login'])){
            $this->user->login($this->request->post['login'], $this->request->post['password']);
        }
        $user = $this->user->isLogin();
        if(!empty($user)) $this->response->redirect($this->config->type_user[$user['lvl']]);
        elseif(isset($this->request->post['sub_login'])) $this->data['mess'] = 'Невірний логін або пароль';
        
        $this->config->title_name = 'Увійти';
        $this->config->is_sub = true;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('main/login', $this->data);
	}
    
	public function register() {
        
        if(isset($this->request->post['sub_register'])){
            $lvl = ($this->request->post['lvl'] == '1' ? '3' : '2');
            
            $this->load->model('users');
            $users_login = $this->data['users'] = $this->usersModel->getItems(array(), array('login' => $this->request->post['login']));
            if(empty($users_login)){
                $this->user->register(array('name' => $this->request->post['name'], 
                                        'mail' => $this->request->post['mail'], 
                                        'login' => $this->request->post['login'], 
                                        'password' => $this->request->post['password'], 
                                        'lvl' => $lvl, 
                                        'date' => date('Y-m-d')));
            }
            else{
                $this->data['mess'] = 'Користувач із таким логіном вже існує';
            }
            
            
            
        }
        $this->user->login($this->request->post['login'], $this->request->post['password']);
        $this->config->user = $this->user->isLogin();
        
        $this->config->title_name = 'Зареэструватися';
        $this->config->is_sub = true;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('main/register', $this->data);
	}
    
	public function search($tag = '') {
        
        $this->load->model('lecture');
        $this->load->model('lab');
        $this->load->model('test');
        
        $query_lecture = "SELECT *, `type` = 'lecture' FROM `lecture` WHERE `tags` LIKE '%" . $tag . "%'";
        $query_lab = "SELECT *, `type` = 'test' FROM `test` WHERE `tags` LIKE '%" . $tag . "%'";
        $query_test = "SELECT *, `type` = 'lab' FROM `lab` WHERE `tags` LIKE '%" . $tag . "%'";
        
        $this->data['lecture'] = $this->lectureModel->query($query_lecture);
        $this->data['lab'] = $this->labModel->query($query_lab);
        $this->data['test'] = $this->testModel->query($query_test);
        
        $news_updates = array_merge($this->data['lecture'], $this->data['lab'], $this->data['test']);
        usort($news_updates, function($a, $b) {
            return $b['date'] <=> $a['date'];
        });
        
        foreach($news_updates as $key => $new){
            $path = 'application/public/img/' . $new['type'] . '/' . $new['id'] . '.jpg';
            if(file_exists(DIR . $path))
                $news_updates[$key]['img'] = '/' . $path;
            else
                $news_updates[$key]['img'] = '/application/public/img/' . $new['type'] . '.jpg';
            $news_updates[$key]['tags'] = explode(',', $new['tags']);
        }
        
        $this->data['list'] = $news_updates;
        
        $this->data['tag'] = $tag;
        $this->data['list_type'] = 'Результати пошуку';
        $this->config->is_sub = true;
        $this->config->title_name = 'Пошук: ' . $tag;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('main/list', $this->data);
	}
}
?>