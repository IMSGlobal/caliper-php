<?php
require_once 'Caliper/events/Event.php';
require_once 'Caliper/events/EventType.php';
require_once 'Caliper/entities/DigitalResource.php';

class MediaEvent extends Event {
	public function __construct(){
		parent::__construct();
		$this->setType(new EventType(EventType::MEDIA));
	}
}
