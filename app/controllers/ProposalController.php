<?php

class ProposalController extends BaseController {
    
  public static function list_all(){
    self::check_logged_in();
    $proposals = Proposal::all();
    View::make('proposal/proposal_list.html', array('proposals' => $proposals));
    }
    
  public static function find($id){
    self::check_logged_in();
    $proposal = Proposal::find($id);
    View::make('proposal/proposal_show.html', array('proposal' => $proposal));
    }
    
  public static function create(){
    self::check_logged_in();
    View::make('proposal/proposal_add.html');
    }
    
  public static function edit($id){
    self::check_logged_in();
    $proposal = Proposal::find($id);
    View::make('proposal/proposal_edit.html', array('proposal' => $proposal));
    }    
  public static function store(){
    $params = $_POST;
    $attributes = array(
      'nimi' => $params['nimi'],
      'juomalaji' => $params['juomalaji'],
      'ohje' => $params['ohje']
    );
    
      $proposal = new Proposal($attributes);
      $errors = $proposal->errors();

  if(count($errors) == 0){
    $proposal->save();

    Redirect::to('/proposal/' . $proposal->id, array('message' => 'Ehdotus on lisätty arkistoon!'));
    }else{
    View::make('proposal/proposal_add.html', array('errors' => $errors, 'attributes' => $attributes));
    }
   }
    


  public static function update($id){
    $params = $_POST;
    $attributes = array(
      'nimi' => $params['nimi'],
      'juomalaji' => $params['juomalaji'],
      'ohje' => $params['ohje']
    );
    $proposal = new Proposal($attributes);
    $errors = $proposal->errors();

    if(count($errors) > 0){
      View::make('proposal/proposal_edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
      $proposal->edit($id);

      Redirect::to('/proposal/' . $id, array('message' => 'Ehdotusta on muokattu!'));
    }
  }

  public static function destroy($id){
    $proposal = Proposal::destroy($id);
    Redirect::to('/', array('message' => 'Ehdotus on poistettu!'));
  }
    
}