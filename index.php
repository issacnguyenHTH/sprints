<?php
// use RobRichards\WsePhp\WSASoap;
// use RobRichards\WsePhp\WSSESoap;
// use RobRichards\XMLSecLibs\XMLSecurityKey;
require __DIR__ . '/vendor/autoload.php';
use RobRichards\WsePhp\WSASoap;
use RobRichards\WsePhp\WSSESoap;

require('extendSoapClass.php');

set_time_limit(0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
######################################PHP Version 5.4.45
define('PRIVATE_KEY', 'all.pem');
define('CERT_FILE', 'all.pem');
define('WSDL_VALIDATEDEVICE', 'https://webservicesgateway.sprint.com:444/services/mvno/WholesaleQueryDeviceInfoService/v1?wsdl');
define('DOREQUEST_VALIDATEDEVICE', 'https://webservicesgateway.sprint.com:444/services/mvno/WholesaleQueryDeviceInfoService/v1');




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
$SyncXML = SprintApiSoapExecute('',$requests,$soapAction,WSDL_VALIDATEDEVICE,DOREQUEST_VALIDATEDEVICE);

$doc = new \DOMDocument();
$doc->loadXML($SyncXML);
$result = [];
        
        if ($doc->getElementsByTagName('Fault')->item(0)):
            if ($doc->getElementsByTagName('faultcode')->item(0)):
                $result['error']['faultcode'] = $doc->getElementsByTagName('faultcode')->item(0)->nodeValue;
            else:
                $result['error']['faultcode'] = null;
            endif;
            if ($doc->getElementsByTagName('faultstring')->item(0)):
                $result['error']['faultstring'] = $doc->getElementsByTagName('faultstring')->item(0)->nodeValue;
            else:
                $result['error']['faultstring'] = null;
            endif;
            if ($doc->getElementsByTagName('providerErrorCode')->item(0)):
                $result['error']['providerErrorCode'] = $doc->getElementsByTagName('providerErrorCode')->item(0)->nodeValue;
            else:
                $result['error']['providerErrorCode'] = null;
            endif;
            if ($doc->getElementsByTagName('providerErrorText')->item(0)):
                $result['error']['providerErrorText'] = $doc->getElementsByTagName('providerErrorText')->item(0)->nodeValue;
            else:
                $result['error']['providerErrorText'] = null;
            endif;
            if ($doc->getElementsByTagName('availabilityTypeCode')->item(0)):
                $result['availabilityTypeCode'] = $doc->getElementsByTagName('availabilityTypeCode')->item(0)->nodeValue;
            else:
                $result['availabilityTypeCode'] = null;
            endif;
            if ($doc->getElementsByTagName('notAvailableReasonCode')->item(0)):
                $result['notAvailableReasonCode'] = $doc->getElementsByTagName('notAvailableReasonCode')->item(0)->nodeValue;
            else:
                $result['notAvailableReasonCode'] = null;
            endif;
            if ($doc->getElementsByTagName('validationMessage')->item(0)):
                $result['validationMessage'] = $doc->getElementsByTagName('validationMessage')->item(0)->nodeValue;
            else:
                $result['validationMessage'] = null;
            endif;
            if ($doc->getElementsByTagName('manufacturerName')->item(0)):
                $result['manufacturerName'] = $doc->getElementsByTagName('manufacturerName')->item(0)->nodeValue;
            else:
                $result['manufacturerName'] = null;
            endif;
            if ($doc->getElementsByTagName('modelName')->item(0)):
                $result['modelName'] = $doc->getElementsByTagName('modelName')->item(0)->nodeValue;
            else:
                $result['modelName'] = null;
            endif;
            if ($doc->getElementsByTagName('freqMode')->item(0)):
                $result['freqMode'] = $doc->getElementsByTagName('freqMode')->item(0)->nodeValue;
            else:
                $result['freqMode'] = null;
            endif;
            if ($doc->getElementsByTagName('equipmentFreqTypeCode')->item(0)):
                $result['equipmentFreqTypeCode'] = $doc->getElementsByTagName('equipmentFreqTypeCode')->item(0)->nodeValue;
            else:
                $result['equipmentFreqTypeCode'] = null;
            endif;
            if ($doc->getElementsByTagName('modelNumber')->item(0)):
                $result['modelNumber'] = $doc->getElementsByTagName('modelNumber')->item(0)->nodeValue;
            else:
                $result['modelNumber'] = null;
            endif;
            if ($doc->getElementsByTagName('esnMeidHex')->item(0)):
                $result['esnMeidHex'] = $doc->getElementsByTagName('esnMeidHex')->item(0)->nodeValue;
            else:
                $result['esnMeidHex'] = null;
            endif;
            if ($doc->getElementsByTagName('deviceType')->item(0)):
                $result['deviceType'] = $doc->getElementsByTagName('deviceType')->item(0)->nodeValue;
            else:
                $result['deviceType'] = null;
            endif;
            if ($doc->getElementsByTagName('activationStatus')->item(0)):
                $result['activationStatus'] = $doc->getElementsByTagName('activationStatus')->item(0)->nodeValue;
            else:
                $result['activationStatus'] = null;
            endif;
            if ($doc->getElementsByTagName('deviceFedMetInd')->item(0)):
                $result['deviceFedMetInd'] = $doc->getElementsByTagName('deviceFedMetInd')->item(0)->nodeValue;
            else:
                $result['deviceFedMetInd'] = null;
            endif;
            if ($doc->getElementsByTagName('pocSwapInd')->item(0)):
                if ($doc->getElementsByTagName('pocSwapInd')->item(0)->nodeValue = 'true'):
                    $result['pocSwapInd'] = 1;
                else:
                    $result['pocSwapInd'] = 0;
                endif;
            else:
                $result['pocSwapInd'] = null;
            endif;
            if ($doc->getElementsByTagName('iccId')->item(0)):
                $result['iccId'] = $doc->getElementsByTagName('iccId')->item(0)->nodeValue;
            else:
                $result['iccId'] = null;
            endif;
            if ($doc->getElementsByTagName('uiccImsi')->item(0)):
                $result['uiccImsi'] = $doc->getElementsByTagName('uiccImsi')->item(0)->nodeValue;
            else:
                $result['uiccImsi'] = null;
            endif;
            if ($doc->getElementsByTagName('uiccSku')->item(0)):
                $result['uiccSku'] = $doc->getElementsByTagName('uiccSku')->item(0)->nodeValue;
            else:
                $result['uiccSku'] = null;
            endif;
            if ($doc->getElementsByTagName('uiccAvailabilityCode')->item(0)):
                $result['uiccAvailabilityCode'] = $doc->getElementsByTagName('uiccAvailabilityCode')->item(0)->nodeValue;
            else:
                $result['uiccAvailabilityCode'] = null;
            endif;
            if ($doc->getElementsByTagName('uiccNotAvailableReasonCode')->item(0)):

                $result['uiccNotAvailableReasonCode'] = $doc->getElementsByTagName('uiccNotAvailableReasonCode')->item(0)->nodeValue;
            else:
                $result['uiccNotAvailableReasonCode'] = null;
            endif;
            if ($doc->getElementsByTagName('uiccCompatibility')->item(0)):
                $result['uiccCompatibility'] = $doc->getElementsByTagName('uiccCompatibility')->item(0)->nodeValue;
            else:
                $result['uiccCompatibility'] = null;
            endif;
            if ($doc->getElementsByTagName('uiccType')->item(0)):
                $result['uiccType'] = $doc->getElementsByTagName('uiccType')->item(0)->nodeValue;
            else:
                $result['uiccType'] = null;
            endif;
            if ($doc->getElementsByTagName('actionCode')->item(0)):
                $result['actionCode'] = $doc->getElementsByTagName('actionCode')->item(0)->nodeValue;
            else:
                $result['actionCode'] = null;
            endif;
        else:
            if ($doc->getElementsByTagName('availabilityTypeCode')->item(0)):
                $result['availabilityTypeCode'] = $doc->getElementsByTagName('availabilityTypeCode')->item(0)->nodeValue;
            else:
                $result['availabilityTypeCode'] = null;
            endif;
            if ($doc->getElementsByTagName('notAvailableReasonCode')->item(0)):
                $result['notAvailableReasonCode'] = $doc->getElementsByTagName('notAvailableReasonCode')->item(0)->nodeValue;
            else:
                $result['notAvailableReasonCode'] = null;
            endif;
            if ($doc->getElementsByTagName('validationMessage')->item(0)):
                $result['validationMessage'] = $doc->getElementsByTagName('validationMessage')->item(0)->nodeValue;
            else:
                $result['validationMessage'] = null;
            endif;
            if ($doc->getElementsByTagName('manufacturerName')->item(0)):
                $result['manufacturerName'] = $doc->getElementsByTagName('manufacturerName')->item(0)->nodeValue;
            else:
                $result['manufacturerName'] = null;
            endif;
            if ($doc->getElementsByTagName('modelName')->item(0)):
                $result['modelName'] = $doc->getElementsByTagName('modelName')->item(0)->nodeValue;
            else:
                $result['modelName'] = null;
            endif;
            if ($doc->getElementsByTagName('freqMode')->item(0)):
                $result['freqMode'] = $doc->getElementsByTagName('freqMode')->item(0)->nodeValue;
            else:
                $result['freqMode'] = null;
            endif;
            if ($doc->getElementsByTagName('equipmentFreqTypeCode')->item(0)):
                $result['equipmentFreqTypeCode'] = $doc->getElementsByTagName('equipmentFreqTypeCode')->item(0)->nodeValue;
            else:
                $result['equipmentFreqTypeCode'] = null;
            endif;
            if ($doc->getElementsByTagName('modelNumber')->item(0)):
                $result['modelNumber'] = $doc->getElementsByTagName('modelNumber')->item(0)->nodeValue;
            else:
                $result['modelNumber'] = null;
            endif;
            if ($doc->getElementsByTagName('esnMeidHex')->item(0)):
                $result['esnMeidHex'] = $doc->getElementsByTagName('esnMeidHex')->item(0)->nodeValue;
            else:
                $result['esnMeidHex'] = null;
            endif;
            if ($doc->getElementsByTagName('deviceType')->item(0)):
                $result['deviceType'] = $doc->getElementsByTagName('deviceType')->item(0)->nodeValue;
            else:
                $result['deviceType'] = null;
            endif;
            if ($doc->getElementsByTagName('activationStatus')->item(0)):
                $result['activationStatus'] = $doc->getElementsByTagName('activationStatus')->item(0)->nodeValue;
            else:
                $result['activationStatus'] = null;
            endif;
            if ($doc->getElementsByTagName('deviceFedMetInd')->item(0)):
                $result['deviceFedMetInd'] = $doc->getElementsByTagName('deviceFedMetInd')->item(0)->nodeValue;
            else:
                $result['deviceFedMetInd'] = null;
            endif;
            if ($doc->getElementsByTagName('pocSwapInd')->item(0)):
                if ($doc->getElementsByTagName('pocSwapInd')->item(0)->nodeValue = 'true'):
                    $result['pocSwapInd'] = 1;
                else:
                    $result['pocSwapInd'] = 0;
                endif;
            else:
                $result['pocSwapInd'] = null;
            endif;
            if ($doc->getElementsByTagName('iccId')->item(0)):
                $result['iccId'] = $doc->getElementsByTagName('iccId')->item(0)->nodeValue;
            else:
                $result['iccId'] = null;
            endif;
            if ($doc->getElementsByTagName('uiccImsi')->item(0)):
                $result['uiccImsi'] = $doc->getElementsByTagName('uiccImsi')->item(0)->nodeValue;
            else:
                $result['uiccImsi'] = null;
            endif;
            if ($doc->getElementsByTagName('uiccSku')->item(0)):
                $result['uiccSku'] = $doc->getElementsByTagName('uiccSku')->item(0)->nodeValue;
            else:
                $result['uiccSku'] = null;
            endif;
            if ($doc->getElementsByTagName('uiccAvailabilityCode')->item(0)):
                $result['uiccAvailabilityCode'] = $doc->getElementsByTagName('uiccAvailabilityCode')->item(0)->nodeValue;
            else:
                $result['uiccAvailabilityCode'] = null;
            endif;
            if ($doc->getElementsByTagName('uiccNotAvailableReasonCode')->item(0)):

                $result['uiccNotAvailableReasonCode'] = $doc->getElementsByTagName('uiccNotAvailableReasonCode')->item(0)->nodeValue;
            else:
                $result['uiccNotAvailableReasonCode'] = null;
            endif;
            if ($doc->getElementsByTagName('uiccCompatibility')->item(0)):
                $result['uiccCompatibility'] = $doc->getElementsByTagName('uiccCompatibility')->item(0)->nodeValue;
            else:
                $result['uiccCompatibility'] = null;
            endif;
            if ($doc->getElementsByTagName('uiccType')->item(0)):
                $result['uiccType'] = $doc->getElementsByTagName('uiccType')->item(0)->nodeValue;
            else:
                $result['uiccType'] = null;
            endif;
            if ($doc->getElementsByTagName('actionCode')->item(0)):
                $result['actionCode'] = $doc->getElementsByTagName('actionCode')->item(0)->nodeValue;
            else:
                $result['actionCode'] = null;
            endif;
        endif;

      echo '<PRE>';
      print_r($result);
      echo '</PRE>';