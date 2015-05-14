<?php
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/entities/CaliperDigitalResourceTypes.php';
require_once 'CreativeWork.php';

class WebPage extends CaliperDigitalResource implements CreativeWork {

    public function  __construct($id) {
        parent::__construct($id);
        $this->setType(CaliperDigitalResourceTypes::WEB_PAGE);
    }
}
