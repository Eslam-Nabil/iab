<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://xmldev.dotwconnect.com/gatewayV4.dotw',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'<customer> 
    <username>iabholidays</username> 
    <password>0f106d9bc00b3d593476794066fa3631</password> 
    <id>1899005</id> 
    <source>1</source>  
    <product>hotel</product>  
    <request command="searchhotels">  
        <bookingDetails>  
            <fromDate>2023-01-29</fromDate> 
            <toDate>2023-02-01</toDate> 
            <currency>520</currency>  
            <rooms no="2">  
                <room runno="0">  
                    <adultsCode>1</adultsCode>  
                    <children no="0">  
                    </children>  
                    <rateBasis> 1</rateBasis>  
                    <passengerNationality>81</passengerNationality>  
                    <passengerCountryOfResidence>72</passengerCountryOfResidence>  
                </room>  
            </rooms>  
        </bookingDetails>  
        <return>
        <filters xmlns:a="http://xmldev.dotwconnect.com/xsd/atomicCondition" xmlns:c="http://xmldev.dotwconnect.com/xsd/compl
        exCondition">
        <city>364</city> 
        <nearbyCities>false</nearbyCities>
        </filters>
        </return> 
    </request>  
</customer>',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: text/xml',
    'Cookie: PHPSESSID=c2129b9786b4a777c0bce22a7a86a50e'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
