<?php
namespace App\Controllers;

use \Core\View;
use App\Models\User;

/**
 * Provides functionality to edit Stocks.
 */
class Edit extends \Core\Controller
{
  /**
   * Summary of newAction
   * Displays the form to edit the stock.
   * @return void
   */
  public function newAction(){
    $post_id = $_GET['id'];
    $user = new User();
    //editStock function will show saved details in the form.
    $row = $user->editStock($post_id);
    if ($row) {
      View::render('Edit/new.php',[
          'row' => $row
      ]); 
    }
  }
  /**
   * Saves the updated stock details to the database.
   * @return void
   */
  public function createAction(){
    $user = new User();
    $post_id = $_GET['id'];
    if ($user->updateStock($_POST,$post_id)) {
        header('Location: /Feed/new');
    }
    else {
        View::render('/Feed/new.php',[
            'user' => $user
        ]);
    }
  }

}
?>