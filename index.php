<?php
mb_internal_encoding("UTF-8");

define('DIR', dirname(__FILE__) . '/');
define('ENGINE_DIR', dirname(__FILE__) . '/engine/');
define('APPLICATION_DIR', dirname(__FILE__) . '/application/');

require_once(ENGINE_DIR . 'main/controller.php');
require_once(ENGINE_DIR . 'main/model.php');

require_once(ENGINE_DIR . 'main/registry.php');
require_once(ENGINE_DIR . 'main/config.php');
require_once(ENGINE_DIR . 'main/request.php');
require_once(ENGINE_DIR . 'main/session.php');
require_once(ENGINE_DIR . 'main/response.php');
require_once(ENGINE_DIR . 'main/db.php');
require_once(ENGINE_DIR . 'main/load.php');
require_once(ENGINE_DIR . 'main/action.php');
require_once(ENGINE_DIR . 'main/user.php');

$registry = new Registry();

$config = new Config();
$registry->config = $config;

$registry->config->get_url = $_SERVER['QUERY_STRING'];

$request = new Request();
$registry->request = $request;

$session = new Session();
$registry->session = $session;

$response = new Response();
$registry->response = $response;

$db = new DB($config->db_type, $config->db_hostname, $config->db_port, $config->db_username, $config->db_password, $config->db_database);
$registry->db = $db;

$load = new Load($registry);
$registry->load = $load;

$action = new Action($registry);
$registry->action = $action;

$user = new User($registry, $config->session_tag);
$registry->user = $user;

if(isset($request->get['logout'])) $user->logout();

if(isset($request->get['action'])) $action->make($request->get['action']);
else $action->make($config->page_main);

$response->output($action->go());
?>