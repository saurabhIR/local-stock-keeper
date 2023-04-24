<?php
namespace App\Controllers;

use \Core\View;
use App\Models\User;

/**
 * Login Controller
 * This controller is responsible for handling user authentication and rendering login form.
 */
class Login extends \Core\Controller
{

    /**
     * Renders the login form.
     * @return void
     */
    public function newAction(){
        View::render('Login/new.php');
    }

    /**
     * Authenticates the user and redirects to Feed/new on successful login.
     * @return void
     */
    public function createAction(){
        $user = User::authenticate($_POST['email'] ,$_POST['password']);
        if ($user) {
            header('Location: /Feed/new');
            exit;
        }
        else {
            View::render('Login/new.php' , [
                'email' => $_POST['email']
            ]);
        }
    }
}
?>