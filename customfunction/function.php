<?php

function changeDays($days){
	if($days == 'H'){
		$d = 'Hourly';
	}
	else if($days == 'W'){
		$d = 'Weekly';
	}
	else if($days == 'M'){
		$d = 'Monthly';
	}else{ $d = 'NULL'; }

	return $d;
}

?>