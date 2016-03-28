<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');
require_once 'Caliper/events/OutcomeEvent.php';
require_once 'Caliper/actions/Action.php';

/**
 * @requires PHP 5.4
 */
class EventOutcomeGradedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new OutcomeEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(new Action(Action::GRADED))
            ->setObject(TestAssignableEntities::makeAssessmentAttempt()
                ->setAssignable(TestAssessmentEntities::makeAssessment()))
            ->setGenerated(TestAssignableEntities::makeResult())
            ->setEventTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeAssessmentApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership()));
    }
}
