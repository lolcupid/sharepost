<?php
  class Pages extends Controller {
    public function __construct(){

    }
    
    public function index(){
      $data = [
        'title' => 'Welcome To SharePost'
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'Apply to share posts with friends'
      ];
      
      $this->view('pages/about', $data);
    }
  }