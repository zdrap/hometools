<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v; 

class AuthController extends Controller
{
	public function getSignUp($request, $response) 
	{
		return $this->view->render($response, 'auth/signup.twig');
	}

	public function postSignUp($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'email' => v::NoWhitespace()->notEmpty()->email()->emailAvailable(),
			'name' => v::notEmpty()->alpha(),
			'password' => v::NoWhitespace()->notEmpty(),
		]);

		if($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('auth.signup'));
		}

		$user = User::create([
			'email' => $request->getParam('email'),
			'name' => $request->getParam('name'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT, ['cost' => 10]),
		]);

		return $response->withRedirect($this->router->pathFor('home'));
	}
}
