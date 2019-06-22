<?php 
$file = fopen('roo_data.csv', 'r');
while (($questionArray = fgetcsv($file)) !== FALSE) {
  break;
}

$indexArray[] = array('position'=>1,'title'=>'Hi There !','tooltip'=>'give your input get career','image'=>'http://192.168.1.158/hackathon/csvdata/image/giphy.gif');
$indexArray[] = array('position'=>15,'title'=>"Great, thanks for submitting first set of answers. Now let's move forward for next set.",'tooltip'=>'give your input get career','image'=>'http://192.168.1.158/hackathon/csvdata/image/wave.gif');
$indexArray[] = array('position'=>23,'title'=>'Awesome, you have  Few more steps and you will get your goal','tooltip'=>'give your input get career','image'=>'http://192.168.1.158/hackathon/csvdata/image/basics.gif');
$indexArray[] = array('position'=>32,'title'=>'You are just awesome ','tooltip'=>'give your input get career','image'=>'http://192.168.1.158/hackathon/csvdata/image/basics.gif');
$column = array_column($indexArray, 'position');
//$indexArray = array(1,5,10,17,39);
array_pop($questionArray);
$temp = array();
$i =1;
$result = array();
$j = '-1';
foreach ($questionArray as $question) {
	$loadder = array();

	if(in_array($i, $column)){
		$key = array_search($i, $column);
		$loadder['id'] = 0;
		$loadder['title'] = $indexArray[$key]['title'];
		$loadder['tooltip'] = $indexArray[$key]['tooltip'];
		$loadder['type'] = 'loader';
		$loadder['image'] = $indexArray[$key]['image'];
		$loadder['option_type']  = 'image';
		$loadder['options']  = array();
		$result[] = $loadder;
	}
		$temp['id'] = $i;
		$temp['title'] = ucfirst(trim($question));
		$temp['tooltip'] = 'tip';
		$temp['type'] = 'question';
		$temp['image'] = '';
		$options = options($i-1);
		$temp['option_type']  = $options['type'];
		$temp['options']  = $options['options'];
		$result[] = $temp;	

		$i++;
	
}


function options($question){
	$boolarray = array('yes','no','Management','Technical','salary','job','smart worker','hard worker','stubborn','gentle','work','poor','medium','excellent');
	$fd = fopen('roo_data.csv', 'r');
	$unique_ids = array();
$i =0;
$type = 'checkbox';
while ($row = fgetcsv($fd)) {
    // change the 3 to the column you want
    // using the keys of arrays to make final values unique since php
    // arrays cant contain duplicate keys
    if($i >0){
    	if(is_numeric($row[$question])){
    		$type =  'number';
    		break;
    	}
    	else if(in_array($row[$question], $boolarray)){
    		$type = 'radio';
    	}
   		 $unique_ids[$row[$question]] = true;	
    	}
    	$i++;
    	}
    	
    
    

$response['type'] =$type;
$response['options'] =  array_keys($unique_ids);
return $response;

}

echo json_encode($result);
?>