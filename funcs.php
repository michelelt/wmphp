<?php

	# Connessione a host e a DB
	function db_connect()	{
		$host	= "52.213.42.517:3306";
		$user	= "root";
		$pass	= "washomatic";
		mysql_connect($host, $user, $pass) or die("Error");	
		mysql_query("USE washomatic");
	}


	# Restituisce un array con gli utenti
	function get_users()	{
		$query = "SELECT * FROM user";
		$result = mysql_query($query);
		$i	= 0;
		while($row = mysql_fetch_array($result))	{
			$arr[$i] = $row;
			$i++;
		}
		return $arr;
	}


	# Restituisce un array che rappresenta un'entità box
	function box($box_id)	{
		$query = 	"SELECT * FROM box, box_type
				WHERE box.box_id = ". $box_id ."
				AND box.box_type = box_type.box_type_id";
		$result = mysql_query($query);
		return mysql_fetch_array($result);
	}


	# Restituisce la percentuale di riempimento di un box rispetto al massimo previsto dal suo tipo	
	function box_filled_perc($box_id)	{
		$box = box($box_id);
		return round(100 * floatval($box['box_current_weight']) / floatval($box['box_type_max_weight']), 2);
	}


	# Restituisce un array che contiene entità controller collegate all'utente specificato
	function get_user_controllers($user_id)	{
		$query =	"SELECT * FROM user, controller, user_has_controller
				WHERE user.user_id = ". $user_id ."
				AND user.user_id = user_has_controller.user_id
				AND user_has_controller.controller_id = controller.controller_id";
		$result = mysql_query($query);
		$i	= 0;
		while($row = mysql_fetch_array($result))	{
			$arr[$i] = $row;
			$i++;
		}
		return $arr;
	}
	
	
	# Restituisce un array che contiene entà box collegate al controller specificato
	function get_controller_boxes($controller_id)	{
		$query = 	"SELECT * FROM controller_has_box
				WHERE controller_id = ". $controller_id;
		$result = mysql_query($query);
		$i	= 0;
		while($row = mysql_fetch_array($result))	{
			$arr[$i] = box($row['box_id']);
			$i++;
		}
		return $arr;
	}
	

	# Restituisce il nome del tipo di vestito specificato
	function get_type_string($type_id)	{
		$query = "SELECT * FROM item_type WHERE item_type_id =". $type_id;
		$result = mysql_query($query);
		return mysql_fetch_array($result)['item_type_name'];
	}
	

	# Restituisce il tipo di vestito associato a un box
	function get_box_types($box_id)	{
		$query = "SELECT * FROM box WHERE box.box_id = ". $box_id;
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if(intval($row['box_item_type']) == 0)
			return "No clothe associated";
		return get_type_string($row['box_item_type']);
	}
	
	
	# Restituisce il nome del colore specificato
	function get_color_string($color_id)	{
		$query = "SELECT * FROM item_color WHERE item_color_id =". $color_id;
		$result = mysql_query($query);
		return mysql_fetch_array($result)['item_color_name'];
	}
	

	# Restituisce il colore associato a un box
	function get_box_colors($box_id)	{
		$query = "SELECT * FROM box WHERE box.box_id = ". $box_id;
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if(intval($row['box_item_color']) == 0)
			return "No color associated";
		return get_color_string($row['box_item_color']);
	}
	
	
	# Restituisce il nome del materiale specificato
	function get_material_string($material_id)	{
		$query = "SELECT * FROM item_material WHERE item_material_id =". $material_id;
		$result = mysql_query($query);
		return mysql_fetch_array($result)['item_material_name'];
	}
	

	# Restituisce il materiale associato a un box
	function get_box_materials($box_id)	{
		$query = "SELECT * FROM box WHERE box.box_id = ". $box_id;
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if(intval($row['box_item_material']) == 0)
			return "No material associated";
		return get_material_string($row['box_item_material']);
	}
	
	
?>
