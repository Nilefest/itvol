<?php
class headerController extends Controller {

	public function index() {
        
        $this->load->model('lecture');
        $this->load->model('lab');
        $this->load->model('test');
        
        $query_lecture = "SELECT *, `type` = 'lecture' FROM `lecture`";
        $query_lab = "SELECT *, `type` = 'test' FROM `lab`";
        $query_test = "SELECT *, `type` = 'lab' FROM `test`";
        
        $this->data['lecture'] = $this->lectureModel->query($query_lecture);
        $this->data['lab'] = $this->labModel->query($query_lab);
        $this->data['test'] = $this->testModel->query($query_test);
        
        $tags_all = array();
        $news_updates = array_merge($this->data['lecture'], $this->data['lab'], $this->data['test']);
        
        usort($news_updates, function($a, $b) {
            return $b['date'] <=> $a['date'];
        });
        
        foreach($news_updates as $key => $new){
            $tags_all = array_merge($tags_all, explode(',', $new['tags']));
        }
        
        foreach($tags_all as $key => $tag){
            $tags_all[trim($tag)] = trim($tag);
            unset($tags_all[$key]);
        }
        
        $this->config->user = $this->user->isLogin();
        $this->data['user'] = $this->config->user;
        $this->data['type_user'] = $this->config->type_user;
        
        $this->data['news'] = $news_updates;
        $this->data['tags'] = $tags_all;
        
        $this->data['title'] = $this->config->title_name;
        $this->data['tag'] = $this->config->title_tag;
        
        $this->data['description'] = $this->config->meta_description;
        $this->data['keywords'] = $this->config->meta_keywords;
        
        $this->data['css'] = $this->config->custom_css;
        
        $this->data['is_sub'] = $this->config->is_sub;
		return $this->load->view('common/header', $this->data);
	}
}
?>