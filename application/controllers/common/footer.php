<?php
class footerController extends Controller {
	public function index() {
              
        $this->load->model('lecture');
        $this->data['lecture'] = $this->lectureModel->getItems(array('id', 'title', 'tags', 'date'), array(), array(), array('date' => 'ASC'));
        
        $this->load->model('lab');
        $this->data['lab'] = $this->labModel->getItems(array('id', 'title', 'tags', 'date'), array(), array(), array('date' => 'ASC'));
        
        $this->load->model('test');
        $this->data['test'] = $this->testModel->getItems(array('id', 'title', 'tags', 'date'), array(), array(), array('date' => 'ASC'));
        
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
        
        $this->data['news'] = $news_updates;
        $this->data['tags'] = $tags_all;
        
        $this->data['js'] = $this->config->custom_js;
        
		return $this->load->view('common/footer', $this->data);
	}
}
?>