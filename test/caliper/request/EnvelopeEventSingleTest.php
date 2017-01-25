<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');

/**
 * @requires PHP 5.4
 */
class EnvelopeEventSingleTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject(TestRequests::makeEnvelope()
            ->setData((new IMSGlobal\Caliper\events\NavigationEvent())
                ->setActor(TestAgentEntities::makePerson())
                ->setMembership(TestLisEntities::makeMembership())
                ->setObject(TestReadingEntities::makeEPubVolume())
                //->setNavigatedFrom(TestReadingEntities::makeWebPage())
                ->setEdApp(TestAgentEntities::makeReadingApplication())
                ->setTarget(TestReadingEntities::makeFrame1())
                ->setGroup(TestLisEntities::makeGroup())
                ->setEventTime(TestTimes::startedTime())
                ->setFederatedSession(new IMSGlobal\Caliper\entities\session\Session('https://example.edu/lms/federatedSession/123456789'))));
    }
}