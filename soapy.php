<?php 
/**
 * This test is always going to fail.  The only difference is if we add the GET varibable "test" to
 * the request, we will catch the SOAP fault.
 * 
 * To test the SOAP fault, hit "localhost:3000/soapy.php?test=1".
 * 
 * To test without catching the SOAP fault, hit "localhost:3000/soapy.php".  Should get a fatal error.
 */
$soapclient = new soapclient('http://graphical.weather.gov/xml/DWMLgen/wsdl/ndfdXML.wsdl#LatLonListZipCode',
    array('stream_context' => stream_context_create(
        array(
            'http'=> array(
								'user_agent' => 'PHP/SOAP',
                'accept' => 'application/xml')
            )
        )
    )
);

//Use the functions of the client, the params of the function are in 
//the associative array
$params = array('zipCodeList' => '30906');

if (isset($_GET['test'])) {
    try {
        $response = $soapclient->LatLonListZipCode($params);
    }
    catch (SoapFault $e ) {
        //print_r($e);
        echo 'SOAP Fault was caught.... ' . $e->faultcode;
    }
}
else {
    echo 'SOAP fault was not caught..... ' . PHP_EOL;
    $response = $soapclient->LatLonListZipCode($params);
}

PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;
echo 'Now we will finish processing....';

