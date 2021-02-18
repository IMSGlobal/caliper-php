<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\entities\media\AudioObject;


/**
 * @requires PHP 7.3
 */
class EntityAudioObjectTest extends CaliperTestCase {
    function setUp() : void {
        parent::setUp();


        $this->setTestObject(
            (new AudioObject('https://example.edu/audio/765'))
                ->setName(
                    'Audio Recording: IMS Caliper Sensor API Q&A.'
                )
                ->setMediaType(
                    'audio/ogg'
                )
                ->setDatePublished(
                    new \DateTime('2016-12-01T06:00:00.000Z'))
                ->setDuration(
                    'PT55M13S'
                )
        );
    }
}
