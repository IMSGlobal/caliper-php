<?php
class Caliper_Consumer_Socket extends Caliper_QueueConsumer {

  protected $type = "Socket";
  private $socket_failed;

  /**
   * Creates a new socket consumer for dispatching async requests immediately
   * @param string $apiKey
   * @param array  $options
   *     number   "timeout" - the timeout for connecting
   *     function "error_handler" - function called back on errors.
   *     boolean  "debug" - whether to use debug output, wait for response.
   */
  public function __construct($apiKey, $options = array()) {

    if (!isset($options["timeout"]))
      $options["timeout"] = 0.5;

    if (!isset($options["host"]))
      $options["host"] = "localhost";
    
    if (!isset($options["describeURI"]))
      $options["describeURI"] = "/v1/describe";

    if (!isset($options["measureURI"]))
      $options["measureURI"] = "/v1/measure";

    parent::__construct($apiKey, $options);
  }

  public function flushSingleDescribe($item) {
    $socket = $this->createSocket();

    if (!$socket)
      return;    

    $payload = new EventStoreEnvelope($item);

    $payload = json_encode($payload);

    $body = $this->createDescribeBody($this->options["host"], $payload);

    print ("Sending DESCRIBE: ".$body);

    return $this->makeRequest($socket, $body);
  }

  public function flushSingleSend($item) {
    $socket = $this->createSocket();

    if (!$socket)
      return;    
  
    $payload = new EventStoreEnvelope($item);     
   
    $payload = json_encode($payload,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);   
    
    $body = $this->createSendBody($this->options["host"], $payload);

    //print ("Sending: ".$body);

    return $this->makeRequest($socket, $body);
  }

  private function createSocket() {

    if ($this->socket_failed)
      return false;

    $protocol = $this->ssl() ? "ssl" : "tcp";
    $host = $this->options["host"];
    if ($this->options["port"]) {
        $port = $this->options["port"];
    } else {
        $port = $this->ssl() ? 443 : 80;
    }
    $timeout = $this->options["timeout"];

    try {
      # Open our socket to the API Server.
      $socket = pfsockopen($protocol . "://" . $host, $port, $errno,
                           $errstr, $timeout);

      # If we couldn't open the socket, handle the error.
      if ($errno != 0) {
        $this->handleError($errno, $errstr);
        $this->socket_failed = true;
        return false;
      }

      echo '<pre>[DEBUG] Connected to event store : '.$protocol . "://" . $host.':'.$port.'</pre>';

      return $socket;

    } catch (Exception $e) {
      $this->handleError($e->getCode(), $e->getMessage());
      $this->socket_failed = true;
      return false;
    }
  }

  /**
   * Attempt to write request to the socket.
   * Wait for response only if debug mode is enabled.
   *
   * @param  stream  $socket the handle for the socket
   * @param  string  $req    request body
   * @return boolean $success
   */
  private function makeRequest($socket, $req, $retry = true) {

    $bytes_written = 0;
    $bytes_total = strlen($req);
    $closed = false;

    echo '<pre>[DEBUG] Making request : '.$req.'</pre>';

    # Write the request
    while (!$closed && $bytes_written < $bytes_total) {
      try {
        $written = fwrite($socket, substr($req, $bytes_written));
      } catch (Exception $e) {
        $this->handleError($e->getCode(), $e->getMessage());
        $closed = true;
      }
      if (!isset($written) || !$written) {
        $closed = true;
        echo '<pre>[DEBUG] Socket was in closed state... retrying : '.$retry.'</pre>';
      } else {
        $bytes_written += $written;
        echo '<pre>[DEBUG] Bytes written: '.$written.'</pre>';
      }
    }

    # If the socket has been closed, attempt to retry a single time.
    if ($closed) {
      fclose($socket);

      if ($retry) {
        $socket = $this->createSocket();
        if ($socket) return $this->makeRequest($socket, $req, false);
      }
      return false;
    }


    $success = true;

    if ($this->debug()) {
    // if (true) {
      $res = $this->parseResponse(fread($socket, 2048));
      echo '<pre>[DEBUG] Response: '.$res.'</pre>';
      if ($res["status"] != "200") {
        $this->handleError($res["status"], $res["message"]);
        $success = false;
      }
    }

    // while (!feof($socket)) { 
    //   echo '<pre>[DEBUG] Response: '.fgets($socket, 128).'</pre>';
    // } 

    // while (!feof($socket)) {

    //   if($lineBreak == 0)
    //   while(trim(fgets($socket, 2014)) != "") {
    //     $lineBreak = 1;
    //     continue;
    //   }
  
    //   $line = fgets($socket, 1024);
    //   $response .= "$line";
    // } 
    // echo '<pre>[DEBUG] Response: '.$response.'</pre>';

    fclose($socket);

    return $success;
  }

  /**
   * Create the body to send as the post request.
   * @param  string $host
   * @param  string $content
   * @return string body
   */
  private function createDescribeBody($host, $content) {

    $req = "";
    $req.= "POST " . $this->options["describeURI"] . " HTTP/1.1\r\n";
    $req.= "Host: " . $host . "\r\n";
    $req.= "Content-Type: application/json\r\n";
    $req.= "Accept: application/json\r\n";
    $req.= "Content-length: " . strlen($content) . "\r\n";
    // $req.= "Connection: Close\r\n\r\n";
    $req.= "\r\n";
    $req.= $content;

    return $req;
  }

  /**
   * Create the body to send as the post request.
   * @param  string $host
   * @param  string $content
   * @return string body
   */
  private function createSendBody($host, $content) {

    $req = "";
    $req.= "POST " . $this->options["measureURI"] . " HTTP/1.1\r\n";
    $req.= "Host: " . $host . "\r\n";
    $req.= "Content-Type: application/json\r\n";
    $req.= "Accept: application/json\r\n";
    $req.= "Content-length: " . strlen($content) . "\r\n";
    // $req.= "Connection: Close\r\n\r\n";
    $req.= "\r\n";
    $req.= $content;

    return $req;
  }


  /**
   * Parse our response from the server, check header and body.
   * @param  string $res
   * @return array
   *     string $status  HTTP code, e.g. "200"
   *     string $message JSON response from the api
   */
  private function parseResponse($res) {

    $contents = explode("\n", $res);

    # Response comes back as HTTP/1.1 200 OK
    # Final line contains HTTP response.
    $status = explode(" ", $contents[0], 3);
    $result = $contents[count($contents) - 1];

    return array(
      "status"  => isset($status[1]) ? $status[1] : null,
      "message" => $result
    );
  }
}
