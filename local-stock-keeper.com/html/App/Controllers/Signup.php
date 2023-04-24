<?php
namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Summary of Signup
 */
class Signup extends \Core\Controller
{

    /**
     * Renders signup form
     * @return void
     */
    public function newAction(){
        View::render('Signup/new.php');
    }
    
    /**
     * Save user details in the database.
     * @return void
     */
    public function createAction(){
        $user = new User($_POST);
        if($user->save()) {
            header('Location: /Signup/success');
        }
        else{
            View::render('Signup/new.php',[
                'user' => $user
            ]);
        }
    }

    /**
     * Give links on sucessfully signup
     * @return void
     */
    public function successAction(){
        View::render('Signup/success.php');
    }

}
?>