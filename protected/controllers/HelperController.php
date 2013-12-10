<?php

class HelperController extends Controller
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */

    public function init()
    {
        $this->layout =false;
    }

	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

       // @todo php ....
        $this->layout = false;
		$this->render('index');
	}
    public function actionBla(){
        echo 2;
    }
}