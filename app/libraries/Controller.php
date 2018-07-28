<?php
/*
 *Base Controller
 *Loads Models and Views
 */

  class Controller
  {
      //Load Model
      public function model($model)
      {
          //Require Model file
          require_once('../app/models'.$model.'.php');

          //Instantiate the Model
          return new $model();
      }

      //Load View 

      public function view($view, $data = [])
      {
        //check for view file 
        if (file_exists('../app/views/'.$view.'.php'))
        {
            require_once('../app/views/'.$view.'.php'); 
        }
        else
        {
            //If view doesn't exist
            die('View Does Not Exist');
        } 
      }
  }