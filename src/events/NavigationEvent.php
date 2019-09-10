<?php

namespace IMSGlobal\Caliper\events;

use IMSGlobal\Caliper\actions;
use IMSGlobal\Caliper\entities\DigitalResource;
use IMSGlobal\Caliper\entities\survey\Questionnaire;
use IMSGlobal\Caliper\entities\survey\QuestionnaireItem;
use IMSGlobal\Caliper\context\Context;

class NavigationEvent extends Event {
    /** @var DigitalResource */
    private $object;

    public function __construct($id = null) {
        parent::__construct($id);
        $this->setType(new EventType(EventType::NAVIGATION))
            ->setAction(new actions\Action(actions\Action::NAVIGATED_TO));
    }

    /** @return DigitalResource object */
    public function getObject() {
        return $this->object;
    }

    /**
     * @param DigitalResource $object
     * @throws \InvalidArgumentException DigitalResource expected
     * @return $this|NavigationEvent
     */
    public function setObject($object) {
        if (is_null($object) || ($object instanceof DigitalResource)) {
            $this->object = $object;
            if ($object instanceof Questionnaire || $object instanceof QuestionnaireItem) {
                $this->setContext(new Context(Context::SURVEY_PROFILE_EXTENSION));
            }
            return $this;
        }

        throw new \InvalidArgumentException(__METHOD__ . ': DigitalResource expected');
    }
}
