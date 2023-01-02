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
function getallcountries()
{
    header('Content-Type: text/xml');
    // function defination to convert array to xml
    $request_body = [
        'username' => 'iabholidays',
        'password' => '0f106d9bc00b3d593476794066fa3631',
        'id' => '1899005',
        'source' => "1",
        'product' => "hotel",
        'request' => [],
    ];

    $xml = new SimpleXMLElement('<customer/>');
    array_to_xml($request_body, $xml);
    $xml->request->addAttribute('command', 'getallcountries');
    $result = $xml->asXML();
    $headers = [
        'Content-Type: text/xml',
        'connection: close',
    ];
    $url = "xmldev.dotwconnect.com/gatewayV4.dotw";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $result);
    curl_setopt($curl, CURLOPT_POST, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $xml = new SimpleXMLElement($response);
    $countries_xml = $xml->children();
    $countries_json = json_encode($countries_xml);
    $countries = json_decode($countries_json, TRUE);
    // print_r($countries);
    foreach($countries['countries']['country'] as $country){
        $countries_arr[]=[
            'country_name'=>$country['name'],
            'country_code'=>$country['code']
        ];
    }
    return $countries_arr;
}
getallcountries();
