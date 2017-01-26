<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');

/**
 * @requires PHP 5.4
 */
class EventAnnotationSharedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new IMSGlobal\Caliper\events\AnnotationEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(new IMSGlobal\Caliper\actions\Action(IMSGlobal\Caliper\actions\Action::SHARED))
            ->setObject(TestReadingEntities::makeFrame3())
            ->setGenerated(TestAnnotationEntities::makeSharedAnnotation())
            ->setEventTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeReadingApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership())
            ->setUuid('3bdab9e6-11cd-4a0f-9d09-8e363994176b')
        );
    }
}
