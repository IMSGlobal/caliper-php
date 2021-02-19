<?php
require_once realpath(dirname(__FILE__) . '/../CaliperErrorTestCase.php');

use IMSGlobal\Caliper\entities\annotation\TextPositionSelector;

/**
 * @requires PHP 5.6.28
 */
class EntityTextPositionSelector_MalformedStartNotAStringTest extends CaliperErrorTestCase {
    function testError() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('IMSGlobal\Caliper\entities\annotation\TextPositionSelector::setStart: integer expected');

        (new TextPositionSelector())
            ->setStart('2300')
            ->setEnd(2370);
    }
}