<?php
$config = array(
    
    // Title
	'title_name'   =>      'Офіційний сайт',
	'title_tag'    =>      'ITvol',
    
    // Meta
	'meta_description' =>  'Сайт для онлайн навчання у галузі ІТ',
	'meta_keywords'    =>  'дистанційне навчання, дипломна робота, ІТ, інформаційні технології',
    
	// Page
	'page_url'     =>      '',
	'page_main'    =>      'main/',
    
    // GET string from URL
	'get_url'      =>      '',
	
	// DB
	'db_type'      =>      'pdo',
	'db_hostname'  =>      'localhost',
	'db_port'      =>      3306,
	'db_username'  =>      'root',
	'db_password'  =>      'root',
	'db_database'  =>      'itvoldb',
    
	// Mail
	'mail_host'    =>      '',
	'mail_port'    =>      '',
	'mail_login'   =>      '',
	'mail_password'=>      '',
	'mail_sender'  =>      '',
    
    // Tag for session and cookie
	'session_tag'  =>      'itvol',
    
	// Custom style, script
	'custom_css'   =>      array(),
	'custom_js'    =>      array(),
    
    // Global vars
    'is_sub'       =>      true,
    'type_lvl'     =>      array('0' => 'Адміністратор', '1' => 'Викладач', '2' => 'Студент', '3' => 'Заява',),
    'type_user'    =>      array('0' => '/admin', '1' => '/teacher', '2' => '/student', '3' => '/teacher/no',),
    'user'         =>      array(),
);
?>