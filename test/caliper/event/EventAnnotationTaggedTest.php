<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');
require_once 'Caliper/events/AnnotationEvent.php';
require_once 'Caliper/actions/Action.php';

/**
 * @requires PHP 5.4
 */
class EventAnnotationTaggedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new AnnotationEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(new Action(Action::TAGGED))
            ->setObject(TestReadingEntities::makeFrame4())
            ->setGenerated(TestAnnotationEntities::makeTagAnnotation())
            ->setEventTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeReadingApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership()));
    }
}
