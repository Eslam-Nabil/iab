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
function searchhotels(){
header('Content-Type: text/xml');
// function defination to convert array to xml

$request_body = [
    'username' => 'iabholidays',
    'password' => '0f106d9bc00b3d593476794066fa3631',
    'id' => '1899005',
    'source' => "1",
    'product' => "hotel",
    'request' => [
        'bookingDetails' => [
            'fromDate' => "2023-01-29",
            'toDate' => "2023-02-29",
            'currency' => '520',
            'rooms' => [
                'room' =>[
                'adultsCode' => '4',
                'children' => [
                   
                    ],
                'rateBasis'=>'1331',
                'passengerNationality' => '81',
                'passengerCountryOfResidence' => '81',    
                ],
            ],         
        ],
        'return'=>[
           'filters'=>[
               'city'=>'364',
           ],
           'resultsPerPage'=>4, 
        ],
    ],
];

    $xml = new SimpleXMLElement('<customer/>');
    array_to_xml($request_body,$xml);
    $xml->request->addAttribute('command', 'searchhotels');
    $xml->request->bookingDetails->rooms->addAttribute('no', '2');
    $xml->request->bookingDetails->rooms->room->addAttribute('runno', '0');
    $xml->request->bookingDetails->rooms->room->children->addAttribute('no', '0');
    $xml->request->return->filters->addAttribute("xmlns:xmlns:a", 'http://xmldev.dotwconnect.com/xsd/atomicCondition');
    $xml->request->return->filters->addAttribute("xmlns:xmlns:c", 'http://xmldev.dotwconnect.com/xsd/complexCondition');
//    $xml->request->bookingDetails->rooms->room->children->child->addAttribute('runno', '');
    $result = $xml->asXML();
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
        return $response;
        die;
}
?>