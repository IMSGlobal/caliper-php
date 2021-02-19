<?php
require_once realpath(dirname(__FILE__) . '/../CaliperErrorTestCase.php');

use IMSGlobal\Caliper\entities\survey\SurveyInvitation;
use IMSGlobal\Caliper\entities\survey\Survey;

/**
 * @requires PHP 5.6.28
 */
class EntitySurveyInvitation_MalformedRaterWrongEntityTypeTest extends CaliperErrorTestCase {
    function testError() {
        $this->expectException(TypeError::class);
        // skipping error message since it includes file path
        // $this->expectExceptionMessage('');

        (new SurveyInvitation('https://example.edu/surveys/100/invitations/users/112233'))
            ->setSentCount(1)
            ->setDateSent(new \DateTime('2018-11-15T10:05:00.000Z'))
            ->setRater(
                (new Survey('https://example.edu/survey/1'))
            )
            ->setSurvey(
                (new Survey('https://example.edu/survey/1'))
            )
            ->setDateCreated(new \DateTime('2018-08-01T06:00:00.000Z'));
    }
}