<?php
require_once dirname(__FILE__) . '/../assignable/AssignableDigitalResource.php';
require_once dirname(__FILE__) . '/../assignable/AssignableDigitalResourceType.php';

class Assessment extends AssignableDigitalResource {

    private $assessmentItems;

    public function __construct($id) {
        parent::__construct($id);
        $this->setId($id);
        $this->setType(AssignableDigitalResourceType::ASSESSMENT);
    }

    public function jsonSerialize() {
        return [
            '@id' => $this->getId(),
            '@type' => $this->getType(),
            'name' => $this->getName(),
            'objectType' => $this->getObjectType(),
            'alignedLearningObjective' => $this->getAlignedLearningObjectives(),
            'keyword' => $this->getKeywords(),
            'partOf' => $this->getParentRef(),
            'lastModifiedTime' => $this->getLastModifiedAt(),
            'dateCreated' => $this->getDateCreated(),
            'datePublished' => $this->getDatePublished(),
            'dateToActivate' => $this->getDateToActivate(),
            'dateToShow' => $this->getDateToShow(),
            'dateToStartOn' => $this->getDateToStartOn(),
            'dateToSubmit' => $this->getDateToSubmit(),
            'maxAttempts' => $this->getMaxAttempts(),
            'maxScore' => $this->getMaxScore(),
            'assessmentItems' => $this->getAssessmentItems(),
        ];
    }

    /**
     * @return mixed
     */
    public function getAssessmentItems() {
        return $this->assessmentItems;
    }

    /**
     * @param mixed $assessmentItems
     */
    public function setAssessmentItems($assessmentItems) {
        $this->assessmentItems = $assessmentItems;
        return $this;
    }
}
