<?php
set_time_limit(0);
require __DIR__ . '\vendor\autoload.php';

use RobRichards\WsePhp\WSASoap;
use RobRichards\WsePhp\WSSESoap;
use RobRichards\XMLSecLibs\XMLSecurityKey;

define('PRIVATE_KEY', 'all.pem');
define('CERT_FILE', 'all.pem');
define('WSDL_VALIDATEDEVICE', 'https://webservicesgateway.sprint.com:444/services/mvno/WholesaleQueryDeviceInfoService/v1?wsdl');
define('DOREQUEST_VALIDATEDEVICE', 'https://webservicesgateway.sprint.com:444/services/mvno/WholesaleQueryDeviceInfoService/v1');

class MySoap extends SoapClient
{
    function __doRequest($request, $location, $saction, $version)
    {
        $dom = new DOMDocument();
        $dom->loadXML($request);
        echo 'test';
        $objWSA = new WSASoap($dom);
        $objWSA->addAction($saction);
        $objWSA->addTo($location);
        $objWSA->addMessageID();
        $objWSA->addReplyTo();

        $dom = $objWSA->getDoc();



        $objWSSE = new WSSESoap($dom);
        /* Sign all headers to include signing the WS-Addressing headers */
        $objWSSE->signAllHeaders = true;

        $objWSSE->addTimestamp();

        /* create new XMLSec Key using RSA SHA-1 and type is private key */
        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' => 'private'));

        /* load the private key from file - last arg is bool if key in file (true) or is string (FALSE) */
        $objKey->loadKey(PRIVATE_KEY, true);

        /* Sign the message - also signs appropraite WS-Security items */
        $objWSSE->signSoapDoc($objKey);

        /* Add certificate (BinarySecurityToken) to the message and attach pointer to Signature */
        $token = $objWSSE->addBinaryToken(file_get_contents(CERT_FILE));
        $objWSSE->attachTokentoSig($token);

        $request = $objWSSE->saveXML();
        return parent::__doRequest($request, $location, $saction, $version);
    }
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
				   <whol:esnMeidDec>270113180109643752</whol:esnMeidDec>
				</whol:deviceDetailInfo>
			 </whol:deviceInfo>
			 <whol:resellerPartnerId>2015080801</whol:resellerPartnerId>
		  </whol:wholesaleValidateDeviceV3>
	   </soapenv:Body>
	</soapenv:Envelope>";

//$wsdl = '<wsdl location>';
$soapAction = 'WholesaleValidateDeviceV3';
$REFERENCENUMBER= 'ValidateDevice_2348u23498723498';
$responseAction = 'WHOLESALEVALIDATEDEVICEV3RESPONSE';
$WSDL_VALIDATEDEVICEVAL=$wsdl='https://webservicesgateway.sprint.com:444/services/mvno/WholesaleQueryDeviceInfoService/v1?wsdl';
$DOREQUEST_VALIDATEDEVICEVAL=$dorequestPath='https://webservicesgateway.sprint.com:444/services/mvno/WholesaleQueryDeviceInfoService/v1';

echo '<p>requests:</p>';
echo $requests;
echo '<p>dorequestPath:</p>';
echo $dorequestPath;
echo '<p>soapAction:</p>';
echo $soapAction;
echo '<br>-------------------------<br>';

$sc = new MySoap($wsdl);

var_dump($sc); die();
$content = $sc->__doRequest($requests,$dorequestPath,$soapAction,SOAP_1_1);

var_dump($content);
