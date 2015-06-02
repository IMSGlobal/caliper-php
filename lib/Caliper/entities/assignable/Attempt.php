<?php
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/Generatable.php';
require_once 'util/TimestampUtil.php';

class Attempt extends Entity implements Generatable {
    /** @var DigitalResource */
    private $assignable;
    /** @var Agent */
    private $actor;
    /** @var int */
    private $count;
    /** @var DateTime */
    private $startedAtTime;
    /** @var DateTime */
    private $endedAtTime;
    /** @var string */
    private $duration;

    public function  __construct($id) {
        $this->setId($id);
        $this->setType(new EntityType(EntityType::ATTEMPT));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'assignable' => (!is_null($this->getAssignable()))
                ? $this->getAssignable()->getId()
                : null,
            'actor' => (!is_null($this->getActor()))
                ? $this->getActor()->getId()
                : null,
            'count' => $this->getCount(),
            'startedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getStartedAtTime()),
            'endedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getEndedAtTime()),
            'duration' => $this->getDurationFormatted(),
        ]);
    }

    /** @return DigitalResource assignable */
    public function getAssignable() {
        return $this->assignable;
    }

    /**
     * @param DigitalResource $assignable
     * @return $this|Attempt
     */
    public function setAssignable(DigitalResource $assignable) {
        $this->assignable = $assignable;
        return $this;
    }

    /** @return Agent actor */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param Agent $actor
     * @return $this|Attempt
     */
    public function setActor(Agent $actor) {
        $this->actor = $actor;
        return $this;
    }

    /** @return int count */
    public function getCount() {
        return $this->count;
    }

    /**
     * @param int $count
     * @return $this|Attempt
     */
    public function setCount($count) {
        $this->count = $count;
        return $this;
    }

    /** @return DateTime startedAtTime */
    public function getStartedAtTime() {
        return $this->startedAtTime;
    }

    /**
     * @param DateTime $startedAtTime
     * @return $this|Attempt
     */
    public function setStartedAtTime(DateTime $startedAtTime) {
        $this->startedAtTime = $startedAtTime;
        return $this;
    }

    /** @return DateTime endedAtTime */
    public function getEndedAtTime() {
        return $this->endedAtTime;
    }

    /**
     * @param DateTime $endedAtTime
     * @return $this|Attempt
     */
    public function setEndedAtTime(DateTime $endedAtTime) {
        $this->endedAtTime = $endedAtTime;
        return $this;
    }

    /** @return null|string Duration in seconds formatted according to ISO 8601 ("PTnnnnS") */
    public function getDurationFormatted() {
        if ($this->getDuration() === null) {
            return null;
        }

        return 'PT' . $this->getDuration() . 'S';
    }

    /** @return string duration */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param string $duration
     * @return $this|Attempt
     */
    public function setDuration($duration) {
        $this->duration = $duration;
        return $this;
    }
}
