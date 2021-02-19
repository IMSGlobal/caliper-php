<?php
require_once realpath(dirname(__FILE__) . '/../CaliperErrorTestCase.php');

use IMSGlobal\Caliper\entities\measure\AggregateMeasure;
use IMSGlobal\Caliper\entities\measure\Metric;

/**
 * @requires PHP 5.6.28
 */
class EntityAggregateMeasure_MalformedStartedAtTimeNotValidDateTimeTest extends CaliperErrorTestCase {
    function testError() {
        $this->markTestSkipped('Since errors are not thrown for dates missing time component');
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('');

        (new AggregateMeasure('urn:uuid:c3ba4c01-1f17-46e0-85dd-1e366e6ebb81'))
            ->setMetric(new Metric(Metric::UNITS_COMPLETED))
            ->setName('Units Completed')
            ->setMaxMetricValue(25.0)
            ->setStartedAtTime(new \DateTime('2019-08-15'))
            ->setEndedAtTime(new \DateTime('2019-11-15T10:15:00.000Z'));
    }
}
