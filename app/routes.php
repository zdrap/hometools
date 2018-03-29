<?php

$app->get('/welcome', function ($request, $response) {
	$this->view->render($response, 'home.twig');
});

