<?php

namespace Admin;
 
use Auth, BaseController, Input, Redirect, View;

class AuthController extends BaseController {

    /**
     * Armazena a mensagem de status do login
     *
     * @var string
     */
    private $auth_status;

	/**
	* Display the login page
	*
	* @return View
	*/
	public function showLogin()
	{
        //Check authentication
        if (Auth::check()) {
            return Redirect::to(\Config::get('admin.route'));
        }
        
        //Make de view
		return View::make('admin.auth.login');
	}

	/**
	 * Login action
	 *
	 * @return Redirect
	 */
	public function postLogin()
	{
        //Check authentication
        if (Auth::check()) {
            return Redirect::to(\Config::get('admin.route'));
        }
        
        //Get user credentials
		$credentials = array(
			'identifier' => Input::get('email'),
			'password' => Input::get('password')
		);
        
        //Remember login?
        $remember = Input::get('remember_me') === null ? false : true;
     
		try
		{
			if (Auth::attempt($credentials, $remember)){
                
                if (\Request::ajax())
                {
                    return \Response::json(array(
                        'status' => 1, 
                        'text' => 'Login efetuado com sucesso! Redirecionando...',
                        'location' => \Config::get('admin.route')
                    )); 
                }
                
				return Redirect::guest(\Config::get('admin.route'));
			}
		}
		catch (\Toddish\Verify\UserNotFoundException $e)
		{
			$this->auth_status = "Usuário não encontrado!";
		}
        catch (\Toddish\Verify\UserPasswordIncorrectException $e)
        {
            $this->auth_status = "Senha incorreta!";
        }
        catch (\Toddish\Verify\UserUnverifiedException $e)
        {
            $this->auth_status = "O usuário não foi verificado!";
        }
        catch (\Toddish\Verify\UserDisabledException $e)
        {
            $this->auth_status = "Usuário desativado!";
        }
        catch (\Toddish\Verify\UserDeletedException $e)
        {
            $this->auth_status = "O usuário foi deletado";
        }
        
        if (\Request::ajax())
        {
            return \Response::json(array('status' => 0, 'text' => $this->auth_status)); 
        }
			
		return Redirect::route('admin.login')->withErrors(array('login' => $this->auth_status));
	}

	/**
	 * Logout action
	 *
	 * @return Redirect
	 */
	public static function getLogout()
	{
		Auth::logout();

		return Redirect::route('admin.login');
	}
 
}