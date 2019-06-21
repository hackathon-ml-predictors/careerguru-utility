<?php
$unique_ids = array();
// open the csv file for reading
$fd = fopen('roo_data.csv', 'r');

// read the rows of the csv file, every row returned as an array
$i =0;
while ($row = fgetcsv($fd)) {
    // change the 3 to the column you want
    // using the keys of arrays to make final values unique since php
    // arrays cant contain duplicate keys
    if($i >0){
   		 $unique_ids[$row[17]] = true;	
    }
    $i++;
}

var_dump(array_keys($unique_ids));

 ?>