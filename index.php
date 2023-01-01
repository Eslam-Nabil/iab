<?php
include './array_to_xml.php';
include './getratebasis.php';
include './searchhotels.php';
$result = searchhotels();
// echo $result;
// die;
$xml = new SimpleXMLElement($result);
$hotels_xml = $xml->children();
$hotels_json = json_encode($hotels_xml);
$hotels = json_decode($hotels_json, TRUE);
// print_r($hotels['hotels']['hotel']);
// die;
$hotels_content = '';
foreach ($hotels['hotels']['hotel'] as $hotel) {
    $hotels_content .= 'hotel id=' . $hotel['@attributes']['hotelid'];
    foreach ($hotel['rooms']['room']['roomType'] as $roomtype) {
        $hotels_content .= '<br>room type id= ' . $roomtype['@attributes']['roomtypecode']
            .'<br>type name= ' . $roomtype['name']
            .'<br>price= ' .  $roomtype['rateBases']['rateBasis']['total']  . '<br>';
        }
    }
echo $hotels_content;
die;

//$xml = simplexml_load_string($result, "SimpleXMLElement", LIBXML_NOCDATA);
//$json = json_encode($xml);
//
//header('contentType: application/json');
//$array = json_decode($json,TRUE);
//print_r($array);
//die;
//$xml=simplexml_load_string($result);
//echo $xml;
//$name=$xml->getNamespaces();
//echo $name;
//echo $xml;
//foreach($xml->children('result')->ratebass as $a => $b) {
//    echo $a,'="',$b,"\"\n";
//}

//$option=$xml->result->ratebasis->option;
//echo option;
