<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function email_sender($to,$subject,$msg){
    $ci = get_instance();
    $ci->load->library('email');

    $ci->email->from('benjamin.joel@vividinfotech.com', 'Salvage');
    $ci->email->to($to);
    $ci->email->subject($subject);
    $ci->email->message($msg);

    if($ci->email->send()){
        return "send";
    } else{
        return $ci->email->print_debugger();
    }
}

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function encode_url($string, $key="", $url_safe=TRUE)
{
    if($key==null || $key=="")
    {
//        $key="tyz_mydefaulturlencryption";

        $key="Bi693wT3";
    }
    $CI =& get_instance();
    $ret = $CI->encrypt->encode($string, $key);

    if ($url_safe)
    {
        $ret = strtr(
            $ret,
            array(
                '+' => '.',
                '=' => '-',
                '/' => '~'
            )
        );
    }

    return $ret;
}

function decode_url($string, $key="")
{
    if($key==null || $key=="")
    {
        $key="Bi693wT3";
    }
    $CI =& get_instance();
    $string = strtr(
        $string,
        array(
            '.' => '+',
            '-' => '=',
            '~' => '/'
        )
    );

    return $CI->encrypt->decode($string, $key);
}


function safe_b64encode($string) {

    $data = base64_encode($string);
    $data = str_replace(array('+','/','='),array('-','_',''),$data);
    return $data;
}

function safe_b64decode($string) {
    $data = str_replace(array('-','_'),array('+','/'),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}

function encode($value){
    $CI =& get_instance();
    $skey = $CI->config->item('encryption_key');
    if(!$value){return false;}
    $text = $value;
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
    return trim(safe_b64encode($crypttext));
}

function decode($value){
    $CI =& get_instance();
    $skey = $CI->config->item('encryption_key');
    if(!$value){return false;}
    $crypttext = safe_b64decode($value);
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey, $crypttext, MCRYPT_MODE_ECB, $iv);
    return trim($decrypttext);
}
function send_sms($mobile,$message)
{
   require('sms/Unifonic/Autoload.php');
   require('sms/Unifonic/API/Client.php');
   //use \Unifonic\API\Client;
   $client = new Client();
		//Kindly note that the newly added sender ID nust me approved by our system if you have any issue please contact our support team
		try {
		$response = $client->Messages->Send($mobile,$message,'GGI'); // send regular massage
		//$response = $client->Account->GetBalance();
		//$response = $client->Account->getSenderIDStatus('Arabic');
		//$response = $client->Account->getSenderIDs();
		//$response = $client->Account->GetAppDefaultSenderID();
		//$response = $client->Messages->Send('recipient','messageBody','senderName');
		//$response = $client->Messages->SendBulkMessages('96650*******,9665*******','Hello','UNIFONIC');
		//$response = $client->Messages->GetMessageIDStatus('9459*******');
		//$response = $client->Messages->GetMessagesReport();
		//$response = $client->Messages->GetMessagesDetails();
		//$response = $client->Messages->GetScheduled();
		//print_r($response);
		 
		} catch (Exception $e) {
		  echo $e->getCode();
		}
}
?>