<?php
// example

$sms = new Lox24SMS(00000, 'API-TOKEN');
$sms->setSender("Tim Riedl");
$sms->setReciever("01...");
$sms->setText("Hallo Welt");
$sms->setDeliveryAt(0);
$sms->setServiceDirect();
$sms->sendSMS();

/**
* @author Tim Riedl
* @version 0.1 first release
* @license MIT
* @link https://gist.github.com/uvulpos/dce8f2590834584e094883ed6d704885
*/
class Lox24SMS {

  /* variables */
  private $userid;
  private $apikey;
  private $loxurl;
  private $body;
  private $sender;
  private $reciever;
  private $text;
  private $deliverunixtimestamp;
  private $servicecode;

  /* getter setter */
  public function setUserId($userid)      { $this->userid = $userid; }
  public function getUserId()             { return $this->userid; }

  public function setApiKey($apikey)      { $this->apikey = $apikey; }
  public function getApiKey()             { return $this->apikey; }

  public function setLoxUrl($loxurl)      { $this->loxurl = $loxurl; }
  public function getLoxUrl()             { return $this->loxurl; }

  public function setSender($sender)      { $this->sender = $sender; }
  public function getSender()             { return $this->sender; }

  public function setReciever($reciever)  { $this->reciever = $reciever; }
  public function getReciever()           { return $this->reciever; }

  public function setText($text)          { $this->text = $text; }
  public function getText()               { return $this->text; }

  public function setDeliveryAt($unixtp)  { $this->deliverunixtimestamp = $unixtp; }
  public function getDeliveryAt()         { return $this->deliverunixtimestamp; }

  public function setServiceEconomy()     { $this->servicecode = 'economy'; }
  public function setServicePro()         { $this->servicecode = 'pro'; }
  public function setServiceDirect()      { $this->servicecode = 'direct'; }
  public function getServiceCode()        { return $this->servicecode; }

  /* constructor */
  function __construct($userid='', $apikey='', $debug=false, $loxurl='https://api.lox24.eu/sms') {
    $this->userid = $userid;
    $this->apikey = $apikey;
    $this->loxurl = $loxurl;
    $this->body = "no text";
    $this->sender = "";
    $this->reciever = null;
    $this->text = "no content";
    $this->deliverunixtimestamp = 0;
    $this->servicecode = "direct";
  }

  /* build request-body */
  private function createWebRequestBody() {
    try {
      $body = [
          'sender_id' => $this->getSender()
          ,'text' => $this->getText()
          ,'service_code' => $this->getServiceCode()
          ,'phone' => $this->getReciever()
          ,'delivery_at' => $this->getDeliveryAt()
          ,'is_unicode' => null
          ,'callback_data' => '123456'
      ];
      $this->body = json_encode($body);
      return true;
    } catch (Exception $e) { return false; }
  }

  /* web-request */
  public function sendSMS() {
    try {
      if (!$this->createWebRequestBody())
      { throw new Exception("Could not create body"); }
      $curl = curl_init();
      curl_setopt_array($curl, [
          CURLOPT_POST => true,
          CURLOPT_URL => $this->getLoxUrl(),
          CURLOPT_POSTFIELDS => $this->body,
          CURLOPT_HTTPHEADER => [
              "X-LOX24-CLIENT-ID: ".$this->getUserId(),
              "X-LOX24-AUTH-TOKEN: ".$this->getApiKey(),
              'Accept: application/json', // or application/ld+json
              'Content-Type: application/json',
          ],
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 20,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      ]);
      $response = curl_exec($curl);
      $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      $data = json_decode($response, JSON_OBJECT_AS_ARRAY);
      if(201 === $code)
      { return true; }
      else
      { throw new Exception("Error: code = {$code}, data = <pre>" . print_r($data, true)."</pre>"); }
    } catch (\Exception $e) {
      echo "ERROR! -> ${e}";
      return false;
    }
  }
}
