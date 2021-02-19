<?php
require_once realpath(dirname(__FILE__) . '/../CaliperErrorTestCase.php');

use IMSGlobal\Caliper\entities\scale\MultiselectScale;

/**
 * @requires PHP 5.6.28
 */
class EntityMultiselectScale_MalformedItemValuesContainsWrongTypeTest extends CaliperErrorTestCase {
    function testError() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('IMSGlobal\Caliper\entities\scale\MultiselectScale::setItemValues: array of string expected');

        (new MultiselectScale('https://example.edu/scale/3'))
            ->setScalePoints(5)
            ->setItemLabels(['😁', '😀', '😐', '😕', '😞'])
            ->setItemValues(['superhappy', 'happy', 'indifferent', 'unhappy', 'disappointed', 6])
            ->setIsOrderedSelection(false)
            ->setMinSelections(1)
            ->setMaxSelections(5)
            ->setDateCreated(new \DateTime('2018-08-01T06:00:00.000Z'));
    }
}
