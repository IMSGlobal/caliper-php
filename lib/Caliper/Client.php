<?php
require_once __DIR__ . '/Consumer.php';
require_once __DIR__ . '/QueueConsumer.php';
require_once 'Caliper/request/Envelope.php';
require_once __DIR__ . '/Consumer/Socket.php';
require_once __DIR__ . '/events/CaliperEvent.php';
require_once __DIR__ . '/entities/CaliperEntity.php';

class Caliper_Client {

    private $consumer;

    /**
     * Create a new client object
     *
     * @param string $apiKey
     * @param array $options array of consumer options [optional]
     * @param string Consumer constructor to use, socket by default.
     */
    public function __construct($apiKey, $options = array()) {

        $consumers = array(
            "socket" => "Caliper_Consumer_Socket"
        );

        # Use our socket consumer by default, add other consumers as needed above
        $consumer_type = isset($options["consumer"]) ? $options["consumer"] :
            "socket";
        $Consumer = $consumers[$consumer_type];

        $this->consumer = new $Consumer($apiKey, $options);
    }

    public function __destruct() {
        $this->consumer->__destruct();
    }

    /**
     * Send learning events
     * @param  CaliperEvent $caliperEvent A Caliper event object
     * @return boolean success
     */
    public function send($caliperEvent) {
        return $this->consumer->send($caliperEvent);
    }

    /**
     * Describe an entity
     * @param  CaliperEntity $caliperEntity The Caliper Entity we are describing
     * @return boolean whether the describe call succeeded
     */
    public function describe($caliperEntity) {
       return $this->consumer->describe($caliperEntity);
    }
}
