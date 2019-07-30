<?php

namespace IMSGlobal\Caliper\events;

use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\survey\Survey;
use IMSGlobal\Caliper\context\Context;

class SurveyEvent extends Event {
    /** @var Person */
    private $actor;
    /** @var Survey */
    private $object;

    public function __construct($id = null) {
        parent::__construct($id);
        $this->setType(new EventType(EventType::SURVEY));
        $this->setContext(new Context(Context::SURVEY_PROFILE_EXTENSION));
    }

    /** @return Person object */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param Person $object
     * @throws \InvalidArgumentException Person expected
     * @return $this|SurveyEvent
     */
    public function setActor($actor) {
        if (is_null($actor) || is_string($actor) || ($actor instanceof Person)) {
            $this->actor = $actor;
            return $this;
        }

        throw new \InvalidArgumentException(__METHOD__ . ': Person expected');
    }

    /** @return Survey object */
    public function getObject() {
        return $this->object;
    }

    /**
     * @param Survey $object
     * @throws \InvalidArgumentException Survey expected
     * @return $this|SurveyEvent
     */
    public function setObject($object) {
        if (is_null($object) || is_string($object) || ($object instanceof Survey)) {
            $this->object = $object;
            return $this;
        }

        throw new \InvalidArgumentException(__METHOD__ . ': Survey expected');
    }
}
