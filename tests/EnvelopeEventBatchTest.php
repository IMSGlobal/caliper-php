<?php
use IMSGlobal\Caliper\actions\Action;
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\agent\SoftwareApplication;
use IMSGlobal\Caliper\entities\annotation\BookmarkAnnotation;
use IMSGlobal\Caliper\entities\lis\CourseSection;
use IMSGlobal\Caliper\entities\lis\Membership;
use IMSGlobal\Caliper\entities\lis\Role;
use IMSGlobal\Caliper\entities\lis\Status;
use IMSGlobal\Caliper\entities\reading\Chapter;
use IMSGlobal\Caliper\entities\reading\Document;
use IMSGlobal\Caliper\entities\reading\WebPage;
use IMSGlobal\Caliper\entities\session\Session;
use IMSGlobal\Caliper\events\AnnotationEvent;
use IMSGlobal\Caliper\events\NavigationEvent;
use IMSGlobal\Caliper\events\ViewEvent;
use IMSGlobal\Caliper\Sensor;

require_once 'CaliperTestCase.php';


/**
 * @requires PHP 5.4
 */
class EnvelopeEventBatchTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new \IMSGlobal\Caliper\request\Envelope())
            ->setSendTime(new \DateTime('2016-11-15T11:05:01.000Z'))
            ->setSensorId(new Sensor('https://example.edu/sensors/1'))
            ->setDataVersion('http://purl.imsglobal.org/ctx/caliper/v1p1')
            ->setData([
                (new NavigationEvent())
                    ->setActor(new Person('https://example.edu/users/554433'))
                    ->setAction(new Action(Action::NAVIGATED_TO))
                    ->setObject((new WebPage('https://example.edu/terms/201601/courses/7/sections/1/pages/2'))
                        ->setName('Learning Analytics Specifications')
                        ->setDescription('Overview of Learning Analytics Specifications with particular emphasis on IMS Caliper.')
                        ->setDateCreated(new \DateTime('2016-08-01T09:00:00.000Z')))
                    ->setEventTime(new \DateTime('2016-11-15T10:15:00.000Z'))
                    ->setReferrer(new WebPage('https://example.edu/terms/201601/courses/7/sections/1/pages/1'))
                    ->setEdApp(new SoftwareApplication('https://example.edu'))
                    ->setGroup((new CourseSection('https://example.edu/terms/201601/courses/7/sections/1'))
                        ->setCourseNumber('CPS 435-01')
                        ->setAcademicSession('Fall 2016')
                    )
                    ->setMembership((new Membership('https://example.edu/terms/201601/courses/7/sections/1/rosters/1'))
                        ->setMember(new Person('https://example.edu/users/554433'))
                        ->setOrganization(new CourseSection('https://example.edu/terms/201601/courses/7/sections/1'))
                        ->setRoles([new Role(Role::LEARNER)])
                        ->setStatus(new Status(Status::ACTIVE))
                        ->setDateCreated(new \DateTime('2016-08-01T06:00:00.000Z')))
                    ->setSession((new Session('https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259'))
                        ->setStartedAtTime(new \DateTime('2016-11-15T10:00:00.000Z')))
                    ->setUuid('72f66ce5-d2ec-44cc-bce5-41602e1015dc'),
                (new AnnotationEvent())
                    ->setActor(new Person('https://example.edu/users/554433'))
                    ->setAction(new Action(Action::BOOKMARKED))
                    ->setObject((new Document('https://example.edu/etexts/201.epub'))
                        ->setName('IMS Caliper Implementation Guide')
                        ->setVersion('1.1')
                    )
                    ->setGenerated((new BookmarkAnnotation('https://example.edu/users/554433/etexts/201/bookmarks/1'))
                        ->setAnnotator(new Person('https://example.edu/users/554433'))
                        ->setAnnotated(new Chapter('https://example.edu/etexts/201.epub#epubcfi(/6/4[chap01]!/4[body01]/10[para05]/1:20)'))
                        ->setBookmarkNotes('Caliper profiles model discrete learning activities or supporting activities that enable learning.')
                        ->setDateCreated(new \DateTime('2016-11-15T10:20:00.000Z')))
                    ->setEventTime(new \DateTime('2016-11-15T10:20:00.000Z'))
                    ->setEdApp((new SoftwareApplication('https://example.edu'))
                        ->setName('ePub Reader')
                        ->setVersion('1.2.3')
                    )
                    ->setGroup((new CourseSection('https://example.edu/terms/201601/courses/7/sections/1'))
                        ->setCourseNumber('CPS 435-01')
                        ->setAcademicSession('Fall 2016')
                    )
                    ->setMembership((new Membership('https://example.edu/terms/201601/courses/7/sections/1/rosters/1'))
                        ->setMember(new Person('https://example.edu/users/554433'))
                        ->setOrganization(new CourseSection('https://example.edu/terms/201601/courses/7/sections/1'))
                        ->setRoles([new Role(Role::LEARNER)])
                        ->setStatus(new Status(Status::ACTIVE))
                        ->setDateCreated(new \DateTime('2016-08-01T06:00:00.000Z')))
                    ->setSession((new Session('https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259'))
                        ->setStartedAtTime(new \DateTime('2016-11-15T10:00:00.000Z')))
                    ->setUuid('c0afa013-64df-453f-b0a6-50f3efbe4cc0'),
                (new ViewEvent())
                    ->setActor(new Person('https://example.edu/users/554433'))
                    ->setAction(new Action(Action::VIEWED))
                    ->setObject((new Document('https://example.edu/etexts/201.epub'))
                        ->setName('IMS Caliper Implementation Guide')
                        ->setDateCreated(new \DateTime('2016-08-01T06:00:00.000Z'))
                        ->setDatePublished(new \DateTime('2016-10-01T06:00:00.000Z'))
                        ->setVersion('1.1')
                    )
                    ->setEventTime(new \DateTime('2016-11-15T10:21:00.000Z'))
                    ->setEdApp(new SoftwareApplication('https://example.edu'))
                    ->setGroup((new CourseSection('https://example.edu/terms/201601/courses/7/sections/1'))
                        ->setCourseNumber('CPS 435-01')
                        ->setAcademicSession('Fall 2016')
                    )
                    ->setMembership((new Membership('https://example.edu/terms/201601/courses/7/sections/1/rosters/1'))
                        ->setMember(new Person('https://example.edu/users/554433'))
                        ->setOrganization(new CourseSection('https://example.edu/terms/201601/courses/7/sections/1'))
                        ->setRoles([new Role(Role::LEARNER)])
                        ->setStatus(new Status(Status::ACTIVE))
                        ->setDateCreated(new \DateTime('2016-08-01T06:00:00.000Z')))
                    ->setSession((new Session('https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259'))
                        ->setStartedAtTime(new \DateTime('2016-11-15T10:00:00.000Z')))
                    ->setUuid('94bad4bd-a7b1-4c3e-ade4-2253efe65172'),
            ])
        );
    }
}
