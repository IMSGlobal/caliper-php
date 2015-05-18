<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/media/MediaObject.php';
require_once 'Caliper/entities/media/MediaObjectType.php';
require_once 'Caliper/entities/schemadotorg/AudioObject.php';

class AudioObject extends MediaObject implements schemadotorg\AudioObject {
    /**
     * @var string
     */
    private $volumeMin;
    /**
     * @var string
     */
    private $volumeMax;
    /**
     * @var string
     */
    private $volumeLevel;
    /**
     * @var boolean
     */
    private $muted;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(MediaObjectType::AUDIO_OBJECT);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'volumeMin' => $this->getVolumeMin(),
            'volumeMax' => $this->getVolumeMax(),
            'volumeLevel' => $this->getVolumeLevel(),
            'muted' => $this->getMuted(),
        ]);
    }

    /**
     * @return string
     */
    public function getVolumeMin() {
        return $this->volumeMin;
    }

    /**
     * @param string $volumeMin
     * @return object
     */
    public function setVolumeMin($volumeMin) {
        $this->volumeMin = $volumeMin;
        return $this;
    }

    /**
     * @return string
     */
    public function getVolumeMax() {
        return $this->volumeMax;
    }

    /**
     * @param string $volumeMax
     * @return object
     */
    public function setVolumeMax($volumeMax) {
        $this->volumeMax = $volumeMax;
        return $this;
    }

    /**
     * @return string
     */
    public function getVolumeLevel() {
        return $this->volumeLevel;
    }

    /**
     * @param string $volumeLevel
     * @return object
     */
    public function setVolumeLevel($volumeLevel) {
        $this->volumeLevel = $volumeLevel;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isMuted() {
        return $this->muted;
    }

    /**
     * @param boolean $muted
     * @return object
     */
    public function setMuted($muted) {
        $this->muted = $muted;
        return $this;
    }


}