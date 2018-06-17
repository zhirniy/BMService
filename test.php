<?php
//Задание №1
function comb_word($word){
	$combination=[];
	$index = 0; 
	$word = explode(" ", $word);
	//Если меньше двух слов - выводим сообщение об ошибке
	if(count($word) < 2 ){
		echo "Few words for a combination";
	}
	//Если 2 - просто выводим их
	else if(count($word) == 2){

		echo $word[0]." ".$word[1];
	}
	else{
	//Если больше 2-х собираем все возможные комбинации слов
		for($i=0; $i < count($word)-1; $i++){
			if($i + 1 < count($word) -1) {
				$combination[$index] = $word[$i]." ".$word[$i+1];
				$index +=1;
			}
			$combination[$index]=$word[$i];
			for($j=$i+1; $j<count($word); $j++){
             $combination[$index].=" ".$word[$j];
			}
			$index +=1; 
		}
        $limit = count($word);
		for($i=0; $i < $limit-1;){
			$combination[$index]=$word[$i];
			for($j=$i+1; $j < $limit; $j++){
			   	$combination[$index].=" ".$word[$j];
			}
			$index +=1; 
			$limit-=1;
		}
	//Оставляем только уникальные значения и отображаем их
		$combination = array_unique($combination);
		var_dump($combination);

	}
}

comb_word("A lead generating website");

//Задание №2
//По регулярному выражению ищем числа и выводим их
function only_number($word){
    preg_match_all("/[0-9]{1,}/", $word, $result);
    var_dump($result);
	
}
only_number("This server has 386 GB RAM and 5000 GB storage");
 ?>