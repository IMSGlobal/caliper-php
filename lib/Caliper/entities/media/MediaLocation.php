<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/media/MediaObjectType.php';
require_once 'Caliper/entities/Targetable.php';

class MediaLocation extends DigitalResource implements Targetable {
    private $currentTime;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(MediaObjectType::MEDIA_LOCATION);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'currentTime' => $this->getCurrentTime(),
        ]);
    }

    /**
     * @return int Current time in seconds
     */
    public function getCurrentTime() {
        return $this->currentTime;
    }

    /**
     * @param int $currentTimeSeconds
     * @return $this
     */
    public function setCurrentTime($currentTimeSeconds) {
        $this->currentTime = $currentTimeSeconds;
        return $this;
    }
}