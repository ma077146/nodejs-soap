// Call the script with an argument: 'node index.js --zip=29073', or to test a fail, 'node index.js --zip=FAIL'
  
var soap = require('soap');

const argss = require('yargs').argv;

var url = 'https://graphical.weather.gov/xml/DWMLgen/wsdl/ndfdXML.wsdl#LatLonListZipCodeRequest';

var args = {zipCodeList: argss.zip};

soap.createClient(url, function(err, client) {
  client.LatLonListZipCode(args, function(err, result) {
  console.log(result);
  });
});
  

