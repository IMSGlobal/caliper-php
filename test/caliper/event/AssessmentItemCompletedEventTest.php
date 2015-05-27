<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/actions/Action.php';
require_once 'Caliper/events/AssessmentItemEvent.php';
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAgentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAssessmentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAssignableEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestLisEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestResponseEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestTimes.php');

/**
 * @requires PHP 5.4
 */
class AssessmentItemCompletedEventTest extends PHPUnit_Framework_TestCase {
    private $testObject;

    function setUp() {
        $this->testObject = (new AssessmentItemEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(Action::COMPLETED)
            ->setObject(TestAssessmentEntities::makeAssessmentItem())
            ->setGenerated(TestResponseEntities::makeFillinBlankResponse()
                ->setAttempt(TestAssignableEntities::makeItemAttempt())
                ->setStartedAtTime(TestTimes::startedTime())
                ->setValues('2 July 1776'))
            ->setStartedAtTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeAssessmentApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership());
    }

    /**
     * @group passes
     */
    function testObjectSerializesToJson() {
        $testJson = json_encode($this->testObject, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperAssessmentItemCompletedEvent.json');

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $testJson, __CLASS__);

        $this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $testJson);
    }
}
