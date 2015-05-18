<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/assignable/Assignable.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/DigitalResourceType.php';

class AssignableDigitalResource extends DigitalResource implements Assignable {
    private $dateCreated;
    private $datePublished;
    private $dateToActivate;
    private $dateToShow;
    private $dateToStartOn;
    private $dateToSubmit;
    private $maxAttempts;
    private $maxSubmits;
    private $maxScore;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(DigitalResourceType::ASSIGNABLE_DIGITAL_RESOURCE);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'dateCreated' => $this->getDateCreated(),
            'datePublished' => $this->getDatePublished(),
            'dateToActivate' => $this->getDateToActivate(),
            'dateToShow' => $this->getDateToShow(),
            'dateToStartOn' => $this->getDateToStartOn(),
            'dateToSubmit' => $this->getDateToSubmit(),
            'maxAttempts' => $this->getMaxAttempts(),
            'maxSubmits' => $this->getMaxSubmits(),
            'maxScore' => $this->getMaxScore(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getDateCreated() {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatePublished() {
        return $this->datePublished;
    }

    /**
     * @param mixed $datePublished
     */
    public function setDatePublished($datePublished) {
        $this->datePublished = $datePublished;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateToActivate() {
        return $this->dateToActivate;
    }

    /**
     * @param mixed $dateToActivate
     */
    public function setDateToActivate($dateToActivate) {
        $this->dateToActivate = $dateToActivate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateToShow() {
        return $this->dateToShow;
    }

    /**
     * @param mixed $dateToShow
     */
    public function setDateToShow($dateToShow) {
        $this->dateToShow = $dateToShow;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateToStartOn() {
        return $this->dateToStartOn;
    }

    /**
     * @param mixed $dateToStartOn
     */
    public function setDateToStartOn($dateToStartOn) {
        $this->dateToStartOn = $dateToStartOn;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateToSubmit() {
        return $this->dateToSubmit;
    }

    /**
     * @param mixed $dateToSubmit
     */
    public function setDateToSubmit($dateToSubmit) {
        $this->dateToSubmit = $dateToSubmit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxAttempts() {
        return $this->maxAttempts;
    }

    /**
     * @param mixed $maxAttempts
     */
    public function setMaxAttempts($maxAttempts) {
        $this->maxAttempts = $maxAttempts;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxSubmits() {
        return $this->maxSubmits;
    }

    /**
     * @param mixed $maxSubmits
     */
    public function setMaxSubmits($maxSubmits) {
        $this->maxSubmits = $maxSubmits;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxScore() {
        return $this->maxScore;
    }

    /**
     * @param mixed $maxScore
     */
    public function setMaxScore($maxScore) {
        $this->maxScore = $maxScore;
        return $this;
    }
} 
