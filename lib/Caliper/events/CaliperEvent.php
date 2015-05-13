<?php
require_once 'util/TimestampUtil.php';

class CaliperEvent implements JsonSerializable {
    private $context;
    private $type;
    private $actor;
    private $action;
    private $object;
    private $target;
    private $startedAtTime;
    private $endedAtTime;
    private $edApp;
    private $group;
    private $generated;
    /**
     * @var int Duration in seconds
     */
    private $duration;

    public function __construct() {
    }

    private static function getLocalizedAction($action) {
        $actionStrings = parse_ini_file(CALIPER_LIB_PATH . DIRECTORY_SEPARATOR . 'actions_en_US.ini');

        if (array_key_exists($action, $actionStrings)) {
            $localizedAction = $actionStrings[$action];
        } else {
            $localizedAction = $action;
        }

        return $localizedAction;
    }

    public function jsonSerialize() {
        return [
            '@context' => $this->getContext(),
            '@type' => $this->getType(),
            'actor' => $this->getActor(),
            'action' => $this->getAction(),
            'object' => $this->getObject(),
            'target' => $this->getTarget(),
            'generated' => $this->getGenerated(),
            'startedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getStartedAtTime()),
            'endedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getEndedAtTime()),
            'duration' => $this->getDurationFormatted(),
            'edApp' => $this->getEdApp(),
            'group' => $this->getGroup(),
        ];
    }

    /**
     * @return mixed
     */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param mixed $context
     */
    public function setContext($context) {
        $this->context = $context;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param mixed $actor
     */
    public function setActor($actor) {
        $this->actor = $actor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAction() {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action) {
        $this->action = $action;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObject() {
        return $this->object;
    }

    /**
     * @param mixed $object
     */
    public function setObject($object) {
        $this->object = $object;
        return $this;
    }

    /**
     *
     */
    public function getTarget() {
        return $this->target;
    }

    /**
     * @param mixed $target
     */
    public function setTarget($target) {
        $this->target = $target;
        return $this;
    }

    /**
     * @return the generated
     */
    public function  getGenerated() {
        return $this->generated;
    }

    /**
     * @param generated
     *            the generated to set
     */
    public function  setGenerated($generated) {
        $this->generated = $generated;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartedAtTime() {
        return $this->startedAtTime;
    }

    /**
     * @param mixed $startedAt
     */
    public function setStartedAtTime($startedAtTime) {
        $this->startedAtTime = $startedAtTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndedAtTime() {
        return $this->endedAtTime;
    }

    /**
     * @param mixed $startedAt
     */
    public function setEndedAtTime($endedAtTime) {
        $this->endedAtTime = $endedAtTime;
        return $this;
    }

    /**
     * @return null|string Duration in seconds formatted according to ISO 8601 ("PTnnnnS")
     */
    public function getDurationFormatted() {
        if ($this->getDuration() === null) {
            return null;
        }

        return 'PT' . $this->getDuration() . 'S';
    }

    /**
     * @return int Duration in seconds
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param int $durationSeconds
     * @return $this
     */
    public function setDuration($durationSeconds) {
        $this->duration = $durationSeconds;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEdApp() {
        return $this->edApp;
    }

    /**
     * @param mixed $edApp
     */
    public function setEdApp($edApp) {
        $this->edApp = $edApp;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroup() {
        return $this->group;
    }

    /**
     * @param mixed $lisOrganization
     */
    public function setGroup($group) {
        $this->group = $group;
        return $this;
    }
}

