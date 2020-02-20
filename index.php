<?php 
use core\Router;
use core\Links;
spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

Router::route('/', function(){
  session_start();
  require 'view/main.php';
});

Router::route('/link-generate', function(){
  $link = $_POST['link'];
  $links = new Links;

  /**
   * Cutting of protocol for redirecting
   */
  if (strpos($link, 'https://') !== false) {
  	$link = str_replace('https://','',$link);

  } else if (strpos($link, 'http://') !== false){
  	$link = str_replace('http://','',$link);
  }
  $link_args = $links->generate_link($link);
  $links->add_link($link_args['params']);	
  echo json_encode($link_args['user_link']);
});


Router::route('/short/(\w+)', function($link){
  $links = new Links;
  $links->link_redirecting($link);
});

Router::route('/login', function(){
	session_start();
	/**
	 * If user already logged in, then redirect him to admin panel
	 */
	if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){
		header("Location: /admin",true,301);
		die();
	}
	/**
	 * Check if user send login data
	 */
	if (isset($_POST['login'])) {
		$login = $_POST['login'];
		$password = $_POST['password'];
		/**
		 * If login data correct - loggin him as admin and redirect to admin pane
		 */
		if ($login == 'root' && $password == '123') {
			$_SESSION['isAdmin'] = true;
			header("Location: /admin",true,301);
			die();
		}else {
			/**
			 * If login incorrect redirect back with error
			 */
			$_SESSION['isAdmin'] = false;
			$_SESSION['loginError'] = true;
		    require 'view/login.php';

		}
		

	}else {
   		require 'view/login.php';
	}
});

Router::route('/admin', function(){
	session_start();
	if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
		$links = new Links;
		$links_array = $links->links_list();
 		require 'view/admin.php';
	} else {
		header("Location: /login",true,301);
		die();
	}
	
});

Router::route('/link-remove', function(){
	$id = $_POST['id'];
	$links = new Links;
	$links->remove_link($id);
	echo json_encode($id);
});

Router::route('/logout', function(){
	session_start();
	$_SESSION['isAdmin'] = false;
	header("Location: /",true,301);
});

Router::execute($_SERVER['REQUEST_URI']);