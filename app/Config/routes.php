<?php
	Router::parseExtensions('json', 'xml');

	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));

	CakePlugin::routes();
	require CAKE . 'Config' . DS . 'routes.php';
