<?php
include './array_to_xml.php';
include './getratebasis.php';
include './searchhotels.php';
$result = searchhotels();
// echo $result;

$xml = new SimpleXMLElement($result);
$hotels_xml = $xml->children();
$hotels_json = json_encode($hotels_xml);
$hotels = json_decode($hotels_json, TRUE);
print_r($hotels['hotels']['hotel']);
// die;
$hotels_content = '';
// header('Content-Type: application/json');
foreach ($hotels['hotels']['hotel'] as $hotel) {
            $hotels_content .= 'hotel_id=' . $hotel['@attributes']['hotelid'].'               ';
            if(array_key_exists(0,$hotel['rooms']['room']['roomType'])){
                foreach ($hotel['rooms']['room']['roomType'] as $roomtype) {
                    $hotels_content .= '<br>type_id= ' . $roomtype['@attributes']['roomtypecode']
                        .'<br>type_name= ' . $roomtype['name']
                        .'<br>price= ' .  $roomtype['rateBases']['rateBasis']['total']  . '<br>          ';
                 }
            }else{
                $hotels_content .= '<br>type_id= ' . $hotel['rooms']['room']['roomType']['@attributes']['roomtypecode']
                .'<br>type_name= ' . $hotel['rooms']['room']['roomType']['name']
                .'<br>price= ' .  $hotel['rooms']['room']['roomType']['rateBases']['rateBasis']['total']  . '<br>          ';
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
