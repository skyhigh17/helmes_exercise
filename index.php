
<?php include_once 'Controller/controller.php';

    $controller = new controller($_POST);
    $data = $controller->show_sector();
    $ret_data = $controller->show();
    $controller->create();
?>
<link rel="stylesheet" href="style.css">
<form method='post' name='sectors_form' action=''>
	<!-- saved from url=(0094)file:///C:/Users/oliver.stimmer/AppData/Roaming/Skype/My%20Skype%20Received%20Files/index.html -->
	<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252"></head>
	<body>Please enter your name and pick the Sectors you are currently involved in.
	<br>
	<br>
	<small> <?php if(!empty($_SESSION['error_name'])) echo $_SESSION['error_name'];  ?></small>
	<br>
	Name: 
	<input class="<?php if(!empty($_SESSION["error_class_name"])) echo $_SESSION["error_class_name"]; ?>" value="<?php if(!empty($ret_data->name))  echo $ret_data->name?>" type="text" name="name">
	
	<br>
	<br>
	<small> <?php if(!empty($_SESSION["error_selector"])) echo $_SESSION["error_selector"];  ?></small>
	<br>
	Sectors: 
	<select multiple='' class="<?php  if(!empty($_SESSION["error_selector_class"])) echo $_SESSION["error_selector_class"] ?>"  name='selector[]' size='5'>
		<?php echo $data->create_sectors_select(); ?>
	</select>
	<br>
	<br>
	<small> <?php if(!empty($_SESSION["error_agreement"])) echo $_SESSION["error_agree"];  ?></small>
	<br>
	<input class="<?php if(!empty($_SESSION["error_agreement_class"])) echo $_SESSION["error_agreement_class"]; ?>" <?php if(!empty($ret_data->agree)) if($ret_data->agree == true) echo 'checked="checked"'?> type="checkbox" name="agree"> Agree to terms
	<br>
	<br>
	<input type="submit" value="Save" name="submit"></body></html>
</form>

