<?php
//getratebasis
//getpreferencesids
//getlocationids
//getamenitiesids
//getleisureids
//getchainids
//gethotelclassicationids
//getbusinessids
//getallcountries
//getservingcities
//getservingcountries

header('Content-Type: text/xml');
// function defination to convert array to xml
function array_to_xml( $data, $xml_data ) {
    foreach( $data as $key => $value ) {
        if( is_array($value) ) {
            if( is_numeric($key) ){
                $key = 'item'.$key; //dealing with < 0/>..<n/> issues
            }
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
}
$request_body = [
    'username' => 'iabholidays',
    'password' => '0f106d9bc00b3d593476794066fa3631',
    'id' => '1899005',
    'source' => "1",
    'product' => "hotel",
    'request' => [
        'bookingDetails' => [
            'fromDate' => "2022-12-20",
            'toDate' => "2022-12-25",
            'currency' => '520',
            'rooms' => [
                'room' =>[
                'adultsCode' => '5',
                'children' => [
                    'child' => '2'
                    ],
                'rateBasis'=>'1331',
                'passengerNationality' => '1',
                'passengerCountryOfResidence' => '1',
                'roomTypeSelected' => [
                'selectedRateBasis' => '1',
                'allocationDetails' => '1',
            ],
                ],
            ],         
            'productId' => '2',
            'roomModified' => '2'
        ],
    ],
];

    $xml = new SimpleXMLElement('<customer/>');
    array_to_xml($request_body,$xml);
    $xml->request->addAttribute('command', 'getrooms');
    $xml->request->bookingDetails->rooms->addAttribute('no', '1');
    $xml->request->bookingDetails->rooms->room->addAttribute('runno', '2');
    $xml->request->bookingDetails->rooms->room->children->addAttribute('no', '1');
    $xml->request->bookingDetails->rooms->room->children->child->addAttribute('runno', '10');
    $result = $xml->asXML();
     echo $result;
     die;
$headers=[
    'Content-Type: text/xml',
    'connection: close',
];
        $url = "xmldev.dotwconnect.com/gatewayV4.dotw";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $result);
        curl_setopt($curl, CURLOPT_POST	, true);

        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
        die;
        $xmldat=simplexml_load_string($response);
        foreach ($xmldat->request as $child) {
            echo (string)$child->successful;
         }
    
         echo $response;  

     
?>