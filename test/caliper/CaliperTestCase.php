<?php
require_once realpath(dirname(__FILE__) . '/../../lib/Caliper/Sensor.php');
require_once 'Caliper/Options.php';
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAgentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAnnotationEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAssessmentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAssignableEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestLisEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestMediaEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestReadingEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestRequests.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestResponseEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestSessionEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestTimes.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');

class CaliperTestCase extends PHPUnit_Framework_TestCase {
    /** @var string */
    protected $fixtureFilename;
    /** @var object */
    private $testObject;

    function setUp() {
        parent::setUp();
        date_default_timezone_set('UTC');
    }

    function testObjectSerializesToJson() {
        $testOptions = (
        (new Options())
            ->setJsonInclude(JsonInclude::ALWAYS) // For use with old fixtures that contain nulls and empties
        );

        $testRequestor = new HttpRequestor($testOptions);

        $testJson = $testRequestor->serializeData($this->getTestObject());
        $testFixtureFilePath = realpath(CALIPER_LIB_PATH . $this->getFixtureFilename());

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $testJson, get_called_class());

        $this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $testJson);
    }

    /** @return object */
    public function getTestObject() {
        return $this->testObject;
    }

    /**
     * @param object $testObject
     * @return $this
     */
    public function setTestObject($testObject) {
        $this->testObject = $testObject;
        return $this;
    }

    /** @return string */
    public function getFixtureFilename() {
        return $this->fixtureFilename;
    }

    /**
     * @param string $fixtureFilename
     * @return $this
     */
    public function setFixtureFilename($fixtureFilename) {
        $this->fixtureFilename = $fixtureFilename;
        return $this;
    }
}