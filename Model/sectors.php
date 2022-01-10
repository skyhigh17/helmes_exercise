<?php
session_start();
/**
*1. Correct all of the deficiencies in index.html
*2. "Sectors" selectbox:
*2.1. Add all the entries from the "Sectors" selectbox to database
*2.2. Compose the "Sectors" selectbox using data from database
*3. Perform the following activities after the "Save" button has been pressed: 
*3.1. Validate all input data (all fields are mandatory)
*3.2. Store all input data to the database (Name, Sectors, Agree to terms)
*3.3. Refill the form using stored data 
*3.4. Allow the user to edit his/her own data during the session
**/

/**
* since instruction are unclear and wide:
* name = username
* session system = if name is not in the database, insert name to database and start session
* if name is in database write it in session and update
* if name is in session already, just update
* This is how I understood this exercise
**/



include_once 'config.php';
include_once 'db_connection.php';

class Sectors{

	private array $selected; 

	function __construct($select_arr){
		
		$this->selected = $select_arr;
	}
	
	private function build_selector_dimesions(array $data, $parentId = 0, $counter = 0){
		
		//iterate through database array
		$branch = array();
		foreach ($data as $result){
			
			if ($result['parent_id'] == $parentId){
				//add level to find dimension
				$category = $this->build_selector_dimesions($data, $result['id'], $counter + 1);
				$result['counter'] = $counter;
				if ($category){

					$result['category'][] = $category;
				}
				$branch[] = $result;
			}
		}
		return $branch;
	}


	private function createSelect($tree){ 
		
		//iterate through selector array;
		foreach($tree as $node){

			if(isset($node['counter'])){

				$counter = $node['counter'] - 1;
				$tyhimik = "&nbsp&nbsp&nbsp&nbsp";
				$tyhi = "";
				for($i = 0; $i <= $counter; $i++){

					$tyhi.= $tyhimik;
				}
			}
			
			if(isset($node['category']) || isset($node['id']) || isset($node['name'])){

				$selected = "";
				if(in_array($node['id'], $this->selected)){
					$selected = 'selected="selected"';
				}

				echo "<option $selected value=".$node['id'].">$tyhi".$node['name'];
			}

			if(is_array($node)){

				$this->createSelect($node);
			}

			echo "</option>";
		}

	}


	public function create_sectors_select(){
		
		$db = db(); 
		$query = "SELECT id, parent_id, name FROM form_selector_p order by name";
		$result = $db->prepare($query);
		$result->execute();
		$arr = [];
		foreach ($result as $key => $row){

			$arr[] = $row;
		}

		$data = $this->build_selector_dimesions($arr);
		return $this->createSelect($data);

	}


}


?>

