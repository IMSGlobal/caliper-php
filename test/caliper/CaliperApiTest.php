<?php
require_once(dirname(__FILE__) . "/../../lib/CaliperSensor.php");
require_once(dirname(__FILE__) . "/../../lib/Caliper/entities/Entity.php");
require_once(dirname(__FILE__) . "/../../lib/Caliper/events/Event.php");

class CaliperCaliperTest extends PHPUnit_Framework_TestCase {

    function setUp() {
        // $options["host"] = "localhost:8000";
        // Caliper::init("testapiKey", $options);
        Caliper::init("testapiKey");
    }

    /**
     * @group caliper
     */
    function testDescribe() {
        $caliperEntity = new Entity();
        $caliperEntity->setId("course-1234");
        $caliperEntity->setType("course");
        $caliperEntity->setProperties(array(
            "program" => "Engineering",
            "start-date" => time(),
        ));

        $described = Caliper::describe($caliperEntity);
        $this->assertTrue($described);
    }

    /**
     * @group caliper
     */
    function testSend() {
        $caliperEvent = new Event();
        $caliperEvent->setAction("HILIGHT");
        $caliperEvent->setLearningContext(array(
            "courseId" => "course-1234",
            "userId" => "user-1234",
        ));
        $caliperEvent->setActivityContext(array(
            "activityId" => "reading-1234",
            "pageId" => "page-1234",
        ));

        $sent = Caliper::send($caliperEvent);
        $this->assertTrue($sent);
    }
}