<?php
// use RobRichards\WsePhp\WSASoap;
// use RobRichards\WsePhp\WSSESoap;
// use RobRichards\XMLSecLibs\XMLSecurityKey;
require __DIR__ . '/vendor/autoload.php';
require('ExtendSoapClass.php');

set_time_limit(0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
######################################PHP Version 5.4.45
define('PRIVATE_KEY', 'all.pem');
define('CERT_FILE', 'all.pem');
define('WSDL_VALIDATEDEVICE', 'https://webservicesgateway.sprint.com:444/services/mvno/WholesaleQueryDeviceInfoService/v1?wsdl');
define('DOREQUEST_VALIDATEDEVICE', 'https://webservicesgateway.sprint.com:444/services/mvno/WholesaleQueryDeviceInfoService/v1');

use RobRichards\WsePhp\WSASoap;
use RobRichards\WsePhp\WSSESoap;


function SprintApiSoapExecute($xml_file_name,$requests,$ACTION='querySubscription',$wsdl='',$dorequestPath='')
{
  $sc = new mySoap($wsdl);
  $content = $sc->__doRequest_main($requests,$dorequestPath,$ACTION,SOAP_1_1);
  return $content;
}

$header="<soapenv:Header>
     <m:wsMessageHeader xmlns:m=\"http://integration.sprint.com/common/header/WSMessageHeader/v2\">
        <m:trackingMessageHeader>
           <m:applicationId>2015080801</m:applicationId>
           <m:applicationUserId>HTH Communication</m:applicationUserId>
           <!--Optional:-->
           <m:consumerId>87ULL</m:consumerId>
           <m:messageId>kTYpkpvKgddg:MNUPZ,CCbbb9:B8Jtt</m:messageId>
           <!--Optional:-->
           <m:conversationId>20190221R039489529745</m:conversationId>
           <m:timeToLive>60</m:timeToLive>
           <!--Optional:
           <m:replyCompletionCode>?</m:replyCompletionCode>-->
           <m:messageDateTimeStamp>2019-09-09T07:51:52.839-08:00</m:messageDateTimeStamp>
        </m:trackingMessageHeader>
     </m:wsMessageHeader>
  </soapenv:Header>";
$requests = "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:m=\"http://integration.sprint.com/common/header/WSMessageHeader/v2\" xmlns:whol=\"http://integration.sprint.com/interfaces/wholesaleValidateDevice/v3/wholesaleValidateDeviceV3.xsd\">".$header."
     <soapenv:Body>
      <whol:wholesaleValidateDeviceV3>
       <whol:deviceInfo>
        <whol:deviceDetailInfo>
           <whol:esnMeidDec>256691840802381621</whol:esnMeidDec>
        </whol:deviceDetailInfo>
       </whol:deviceInfo>
       <whol:resellerPartnerId>2015080801</whol:resellerPartnerId>
      </whol:wholesaleValidateDeviceV3>
     </soapenv:Body>
  </soapenv:Envelope>";


// echo "Request <hr>";
 
// echo $requests;

$REFERENCENUMBER= 'ValidateDevice_2348u23498723498';
$soapAction = $ACTION='WholesaleValidateDeviceV3';
$responseAction = 'WHOLESALEVALIDATEDEVICEV3RESPONSE';
$WSDL_VALIDATEDEVICEVAL=$wsdl='https://webservicesgateway.sprint.com:444/services/mvno/WholesaleQueryDeviceInfoService/v1?wsdl';
$DOREQUEST_VALIDATEDEVICEVAL=$dorequestPath='https://webservicesgateway.sprint.com:444/services/mvno/WholesaleQueryDeviceInfoService/v1';
//echo "Response <hr>";
echo $SyncXML = SprintApiSoapExecute('',$requests,$soapAction,WSDL_VALIDATEDEVICE,DOREQUEST_VALIDATEDEVICE);