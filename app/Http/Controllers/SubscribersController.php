<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubscribersController extends Controller
{
    //The method to show the form to add a new feed
    public function getIndex() {
        //We load a view directly and return it to be served
        return View::make('subscribe_form');
    }
    
    
    //This method is to process the form
public function postSubmit() {

  //we check if it's really an AJAX request
  if(Request::ajax()) {
    
    $validation = Validator::make(Input::all(), array(
      //email field should be required, should be in an email//format, and should be unique
      'email' => 'required|email|unique:subscribers,email'
    )
    );

    if($validation->fails()) {
      return $validation->errors()->first();
    } else {

      $create = Subscribers::create(array(
        'email' => Input::get('email')
      ));

      //If successful, we will be returning the '1' so the form//understands it's successful
      //or if we encountered an unsuccessful creation attempt,return its info
      return $create?'1':'We could not save your address to oursystem, please try again later';
    }

  } else {
    return Redirect::to('subscribers');
  }
}
}
