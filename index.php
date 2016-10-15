<?php

	include 'funcs.php';
	
	db_connect();
	
	$users = get_users();
	
	echo "<ul>";
	foreach($users as $user)	{
		echo "<li>User: ". $user['user_username'];
		echo "<ul>";
		$controllers = get_user_controllers($user['user_id']);
		foreach($controllers as $controller)	{
			echo "<li> Controller ". $controller['controller_id'];
			echo "<ul>";
			$boxes = get_controller_boxes($controller['controller_id']);
			foreach($boxes as $box)	{
				echo "<li> Box ". $box['box_id'] ." ";
				echo "(". box_filled_perc($box['box_id']) ."%)";
				echo "<ul>";
				echo "<li>Material: ". get_box_materials($box['box_id']) ."</li>";
				echo "<li>Color: ". get_box_colors($box['box_id']) ."</li>";
				echo "<li>Clothe: ". get_box_types($box['box_id']) ."</li>";
				echo "</ul>";
				echo "</li>";
			}
			echo "</ul>";
			echo "</li>";
		}
		echo "</ul>";
		echo "</li>";
	}
	echo "</ul>";

?>
