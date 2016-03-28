<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');
require_once 'Caliper/events/SessionEvent.php';
require_once 'Caliper/actions/Action.php';

/**
 * @requires PHP 5.4
 */
class EventSessionTimeoutTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new SessionEvent())
            ->setActor(TestAgentEntities::makeReadingApplication())
            ->setAction(new Action(Action::TIMED_OUT))
            ->setObject(TestSessionEntities::makeSession()
                ->setEndedAtTime(TestTimes::endedTime())
                ->setDuration(TestTimes::durationSeconds()))
            ->setEdApp(TestAgentEntities::makeReadingApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setEventTime(TestTimes::startedTime()));
    }
}
