<?php
//Функция перебирает существующие комнаты в зависимости от входящих параметров
//Поиск начинается с комнат с найменьшим колличеством людей
function choice ($people, $projector, $board){
	$Cherokee =(object) array('people' => '4', 'projector' => 'No', 'board' => 'No');
	$Navajo =(object) array('people' => '6', 'projector' => 'No', 'board' => 'Yes');
	$Aztec =(object) array('people' => '8', 'projector' => 'Yes', 'board' => 'Yes');

	if( $people <= 4 ){
		if($projector === $Cherokee->projector && $board === $Cherokee->board){
			return "Комната Cherokee";
		}else if ($projector === $Navajo->projector && $board ===  $Navajo->board) {
			return "Комната Navajo";
		}else if ($projector === $Aztec->projector && $board ===  $Aztec->board){
			return "Комната Aztec";
		}else{
			return "Нет подходящих комнат";
		}
	}else if( $people > 4 && $people <= 6 ){
		if($projector === $Navajo->projector && $board ===  $Navajo->board){
			return "Комната Navajo";
		}else if ($projector === $Aztec->projector && $board ===  $Aztec->board) {
			return "Комната Aztec";
		}
		else{
			return "Нет подходящих комнат";
		}
		
	}else if( $people > 6 &&  $people <=8 ) {
		if ($projector === $Aztec->projector && $board ===  $Aztec->board) {
			return "Комната Aztec";
		}
		else{
			return "Нет подходящих комнат";
		}
	}else{
		return "Нет подходящих комнат";
	}
}

 ?>
