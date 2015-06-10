<?php
require_once 'Caliper/context/Context.php';
require_once 'Caliper/util/TimestampUtil.php';

class Envelope implements JsonSerializable {
    /** @var string */
    private $sensorId;
    /** @var DateTime */
    private $sendTime;
    /** @var object[] */
    private $data;

    public function __construct() {
        $this->setSendTime(new DateTime());
    }

    public function jsonSerialize() {
        return [
            'sensor' => $this->getSensorId(),
            'sendTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getSendTime()),
            'data' => $this->getData(),
        ];
    }

    /** @return string id */
    public function getSensorId() {
        return $this->sensorId;
    }

    /**
     * @param Sensor $sensor
     * @return $this|Envelope
     */
    public function setSensorId(Sensor $sensor) {
        $this->sensorId = $sensor->getId();
        return $this;
    }

    /** @return DateTime sendTime */
    public function getSendTime() {
        return $this->sendTime;
    }

    /**
     * @param DateTime $sendTime
     * @return $this|Envelope
     */
    public function setSendTime(DateTime $sendTime) {
        $this->sendTime = $sendTime;
        return $this;
    }

    /** @return object[] data */
    public function getData() {
        return $this->data;
    }

    /**
     * @param object|object[] $data
     * @return $this|Envelope
     */
    public function setData($data) {
        if (!is_array($data)) {
            $data = [$data];
        }

        foreach ($data as $aData) {
            if (!is_object($aData)) {
                throw new InvalidArgumentException(__METHOD__ . ': object expected');
            }
        }

        $this->data = $data;
        return $this;
    }
}

