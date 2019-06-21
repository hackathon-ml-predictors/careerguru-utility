<?php 
$file = fopen('roo_data.csv', 'r');
while (($questionArray = fgetcsv($file)) !== FALSE) {
  break;
}

$indexArray = array(1,5,10,17,39);

$temp = array();
$i =1;
$result = array();
$j = '-1';
foreach ($questionArray as $question) {
	$loadder = array();

	if(in_array($i, $indexArray)){
		$loadder['id'] = 0;
		$temp['title'] = 'Hi there';
		$loadder['tooltip'] = 'tip';
		$loadder['type'] = 'loader';
		$loadder['image'] = 'http://192.168.1.158/hackathon/csvdata/image/hi.gif';
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