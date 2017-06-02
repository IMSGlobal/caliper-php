<?php
namespace IMSGlobal\Caliper\events;

class ThreadEvent extends Event {
    public function __construct($id = null) {
        parent::__construct($id);
        $this->setType(new EventType(EventType::THREAD));
    }
}
