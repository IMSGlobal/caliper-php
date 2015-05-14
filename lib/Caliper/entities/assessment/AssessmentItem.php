<?php
require_once dirname(__FILE__) . '/../assignable/AssignableDigitalResource.php';
require_once dirname(__FILE__) . '/../assignable/AssignableDigitalResourceType.php.php';
require_once dirname(__FILE__) . '/../qti/QTIAssessmentItem.php';


class AssessmentItem extends AssignableDigitalResource implements QTIAssessmentItem, JsonSerializable {

    public function __construct($id) {
        parent::__construct($id);
        $this->setId($id);
        $this->setType(AssignableDigitalResourceType::ASSESSMENT_ITEM);
    }

    public function jsonSerialize() {
        return ['@id' => $this->getId(),
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
            'maxScore' => $this->getMaxScore()];
    }
}
