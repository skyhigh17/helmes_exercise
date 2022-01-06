<?php 

class action{
	
    public array $selected_arr;
    public string $name;
    public bool $agree;

    public function insert_form($post_data){

        $db = db();

        if(!empty($post_data)){

            //when name already exists in database go update database
            //cases not covered = there can be only one name, otherwise it will be over written
            
            $result = $db->prepare("SELECT name FROM user_submit where name = :name order by name");
            $result->execute([
                'name'=>$post_data['name'],
            ]);

            $row = $result->fetch(PDO::FETCH_ASSOC);
            
            if(!empty($row['name'])){

                if(isset($post_data['name'])){
                    
                    $this->update_form($post_data);
                }
            }
            else
            {
                //do inserts 

                $agree = "";

                if(isset($post_data['agree']))
                {
                    $agree = true;
                }
             
                if(is_bool($agree) && is_string($post_data['name']) && isset($post_data['selector'])){
                    
                    $_SESSION['username'] = $post_data['name'];
                    $stmt = $db->prepare("INSERT INTO user_submit (name, agree)  VALUES (:name, :agree)");
                    $stmt->execute([
                        'name' => $post_data['name'],
                        'agree' => $agree,
                    ]);

                    $last_id = $db->lastInsertId();
                    
                    //insert into select

                    foreach ($post_data['selector'] as $row)
                    {
                        
                        $stmt = $db->prepare("INSERT INTO selector_to_user (selector_id,  user_submit_id)  VALUES (:selector_id, :fuser_submit_id)");

                        $stmt->execute([
                        'selector_id' => $row, 
                        'fuser_submit_id'=> $last_id,
                        ]);

                    }
           
                }
            }
        }
        
    }

    public function validate_form($post){

        //validation error
        if(isset($post['name'])){
            if (empty($post['name'])) {

                $_SESSION['error_name'] = ERROR_NAME;
                $_SESSION['error_class_name'] = ERROR_CLASS;
            }else{
                $_SESSION['error_name'] = "";
                $_SESSION['error_class_name'] = "";
            }
        }

        if(!isset($post['selector'])){

            $_SESSION['error_selector'] = ERROR_SELECTOR;
            $_SESSION['error_selector_class'] = ERROR_CLASS;
        }
        
        if(!empty($post['selector'])){
            $_SESSION['error_selector'] = "";
            $_SESSION['error_selector_class'] = "";
        }
        
        if(!isset($post['agree'])){
            $_SESSION['error_agreement'] = ERROR_AGREE;
            $_SESSION['error_agreement_class'] = ERROR_CLASS;
        }

        if(!empty($post['agree'])){
            $_SESSION['error_agreement'] = "";
            $_SESSION['error_agreement_class'] = "";
        }
        
    }


    public function form_data($name){

            $where = "where name = '".$name."' ";

            $db = db();
            $query = "SELECT user_submit.id, name, agree, selector_to_user.selector_id as selector_id 
                FROM user_submit
                LEFT JOIN selector_to_user on user_submit.id = selector_to_user.user_submit_id 
                $where
            order by name";
            $result = $db->prepare($query);
            $result->execute();
            
            foreach($result as $row){
                $this->selected_select_arr[] = $row['selector_id'];
            }
            if(!empty($row['name']) || !empty($row['agree'])){
                $this->name = $row['name'];
                $this->agree = $row['agree'];
            }

        return $this;
    }

    
    public function update_form($post){


        if(!empty($post['name']) && isset($post['selector']) && isset($post['agree'])){

            $db = db();

            if(isset($post['agree']))
            {
                $agree = 1;
            }


            $result = $db->prepare("SELECT user_submit.id FROM user_submit where name = :name order by name");
            $result->execute([
                'name'=>$_SESSION['username'],
            ]);

            $row = $result->fetch();

            $user_insert_id = $row['id']; 

            // delete old selectors and insert new ones with user id for update
            $result = $db->prepare("DELETE FROM selector_to_user where user_submit_id = :id ");
            $result->execute([
                'id'=>$user_insert_id,
            ]);

            foreach ($post['selector'] as $row)
            {
                
                $stmt = $db->prepare("INSERT INTO selector_to_user (selector_id,  user_submit_id)  VALUES (:selector_id, :fuser_submit_id)");
                $stmt->execute([
                'selector_id' => $row,
                'fuser_submit_id'=> $user_insert_id,
                ]);

            }

            $stmt = $db->prepare("UPDATE user_submit set name = :name, agree = :agree where name = :user");
            $stmt->execute([
                'name'=> $post['name'],
                'user'=> $_SESSION['username'],
                'agree'=> $agree,
            ]);
            $_SESSION['username'] = $post['name'];

        }
    }

}

?>