<?php
namespace App\Controllers;

use \Core\View;
use App\Models\User;


/**
 * Controller for Feed.
 */
class Feed extends \Core\Controller
{

	/**
	 * Summary of newAction
	 * Displays the new stock form.
	 * And the stocks user have posted.
	 * @return void
	 */
	public function newAction(){
			if (isset($_SESSION['email'])){
	  		$user = new User();
				$row = $user->userStocks();
				View::render('Feed/new.php', [
					'row' => $row
				]);
			}
			else {
				header('Location: /Login/new');
			}
	}


	/**
	 * Summary of createAction
	 * Adds a new stock.
	 * Redirects to /Feed/view if the stock was successfully added,
	 * otherwise re-renders the new stock form.
	 * @return void
	 */
	public function createAction(){
	  $user = new User();
	  if  ($user->addStock($_POST)) {
	    header('Location: /Feed/view');
	  }
	  else {
	      View::render('/Feed/new.php',[
	          'user' => $user
	      ]);
	  }
	}

	/**
	 * Summary of viewAction
	 * Displays all stocks.
	 * @return void
	 * Renders the stock table.
	 */
	public function viewAction(){
	    $user = new User();
	    $row = $user->viewStocks();
	    if ($row) {
	        View::render('/Feed/viewpost.php',[
	            'row' => $row
	        ]); 
	    }
	    else {
	        View::render('/Feed/new.php',[
	            'user' => $user
	        ]);
	    }
	}

	/**
	 * Summary of removeAction
	 * Removes a stock.
	 * @return void
	 * Redirects to /Feed/view if the stock was successfully removed.
	 */
	public function removeAction() {
		$post_id= $_GET['id'];
		$user = new User();
	  $row = $user->removeStock($post_id);
		if ($row){
			header('Location: /Feed/view');
		}
	}
  
  }
  ?>