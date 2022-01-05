<?php

include_once 'Model/action.php';
include_once 'Model/sectors.php';

class controller {
    public $post;

    function __construct($post){
    
        $this->post = $post;
        
    }

    public function create(){
      
        //save controller
        $action = new action;   


        if(isset($this->post['submit'])){
            
            if(!empty($_SESSION['username'])){
                
                $action->update_form($this->post);
                header('location:view.php');

            }else{
                
                $action->insert_form($this->post);
                header('location:view.php');
            }
        }
    }
    
    public function show(){
        //show form data
        $action = new action; 

        if(!empty($_SESSION['username'])){
            $username = $_SESSION['username'];
            $ret_data = $action->form_data($username);
            return $ret_data;
        }


    }

    public function show_sector(){
        //show sector data

        $action = new action; 
        $ret_data = $this->show();
        if(isset($ret_data->selected_select_arr)){
            $selected_select_arr = $ret_data->selected_select_arr;
        }else{
            $selected_select_arr = array();
        }
    
        if(isset($this->post['submit'])){
            $action->validate_form($this->post);
        }
        return $data = new Sectors($selected_select_arr);
   
    }


}

?>