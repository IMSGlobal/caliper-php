<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperEntity.php';
require_once 'Caliper/entities/schemadotorg/CreativeWork.php';
require_once 'Caliper/entities/Targetable.php';

/**
 *         Caliper representation of a CreativeWork
 *         (https://schema.org/CreativeWork)
 *
 *         We add on learning specific attributes, including a list of
 *         {@link LearningObjective} learning objectives and a list of
 *         {@link String} keywords
 *
 *         In addition, we add a the following attributes:
 *
 *         name (https://schema.org/name) -the name of the resource,
 *
 *         about (https://schema.org/about) - the subject matter of the resource
 *
 *         language (https://schema.org/Language) - Natural languages such as
 *         Spanish, Tamil, Hindi, English, etc. and programming languages such
 *         as Scheme and Lisp
 *
 */
class CaliperDigitalResource extends CaliperEntity implements CreativeWork, Targetable {

    private $objectTypes = [];
    private $alignedLearningObjectives = [];
    private $keywords = [];
    private $isPartOf;
    private $datePublished;

    public function __construct() {
        parent::__construct();
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'objectType' => $this->getObjectTypes(),
            'alignedLearningObjective' => $this->getAlignedLearningObjectives(),
            'keywords' => $this->getKeywords(),
            'isPartOf' => $this->getIsPartOf(),
            'datePublished' => $this->getDatePublished(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getObjectTypes() {
        return $this->objectTypes;
    }

    /**
     * @param mixed $objectTypes
     */
    public function setObjectTypes($objectTypes) {
        $this->objectType = $objectTypes;
        return $this;
    }

    /**
     * @return object alignedLearningObjectives
     */
    public function  getAlignedLearningObjectives() {
        return $this->alignedLearningObjectives;
    }

    /**
     * @param alignedLearningObjectives object alignedLearningObjectives to set
     */
    public function setAlignedLearningObjectives($alignedLearningObjectives) {
        $this->alignedLearningObjectives = $alignedLearningObjectives;
        return $this;
    }

    /**
     * @return string the keywords
     */
    public function  getKeywords() {
        return $this->keywords;
    }

    /**
     * @param keywords string the keywords to set
     */
    public function setKeywords($keywords) {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return object isPartOf
     */
    public function getIsPartOf() {
        return $this->isPartOf;
    }

    /**
     * @param isPartOf object isPartOf to set
     */
    public function setIsPartOf($isPartOf) {
        $this->isPartOf = $isPartOf;
        return $this;
    }

    /**
     * @return DateTime datePublished
     */
    public function getDatePublished() {
        return $this->datePublished;
    }

    /**
     * @param datePublished DateTime datePublished to set
     */
    public function setDatePublished($datePublished) {
        $this->datePublished = $datePublished;
        return $this;
    }
}

