<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/Generatable.php';

class Result extends Entity implements Generatable {
    /** @var Assignable */
    private $assignable;
    /** @var Agent */
    private $actor;
    /** @var float */
    private $normalScore;
    /** @var float */
    private $penaltyScore;
    /** @var float */
    private $extraCreditScore;
    /** @var float */
    private $totalScore;
    /** @var float */
    private $curvedTotalScore;
    /** @var float */
    private $curveFactor;
    /** @var string */
    private $comment;
    /** @var Agent */
    private $scoredBy;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(EntityType::RESULT);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'assignable' => $this->getAssignable(),
            'actor' => $this->getActor(),
            'normalScore' => $this->getNormalScore(),
            'penaltyScore' => $this->getPenaltyScore(),
            'extraCreditScore' => $this->getExtraCreditScore(),
            'totalScore' => $this->getTotalScore(),
            'curvedTotalScore' => $this->getCurvedTotalScore(),
            'curveFactor' => $this->getCurveFactor(),
            'comment' => $this->getComment(),
            'scoredBy' => $this->getScoredBy(),
        ]);
    }

    /** @return Assignable assignable */
    public function getAssignable() {
        return $this->assignable;
    }

    /**
     * @param Assignable $assignable
     * @return $this|Result
     */
    public function setAssignable($assignable) {
        $this->assignable = $assignable;
        return $this;
    }

    /** @return Agent actor */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param Agent $actor
     * @return $this|Result
     */
    public function setActor($actor) {
        $this->actor = $actor;
        return $this;
    }

    /** @return float normalScore */
    public function getNormalScore() {
        return $this->normalScore;
    }

    /**
     * @param float $normalScore
     * @return $this|Result
     */
    public function setNormalScore($normalScore) {
        $this->normalScore = $normalScore;
        return $this;
    }

    /** @return float penaltyScore */
    public function getPenaltyScore() {
        return $this->penaltyScore;
    }

    /**
     * @param float $penaltyScore
     * @return $this|Result
     */
    public function setPenaltyScore($penaltyScore) {
        $this->penaltyScore = $penaltyScore;
        return $this;
    }

    /** @return float extraCreditScore */
    public function getExtraCreditScore() {
        return $this->extraCreditScore;
    }

    /**
     * @param float $extraCreditScore
     * @return $this|Result
     */
    public function setExtraCreditScore($extraCreditScore) {
        $this->extraCreditScore = $extraCreditScore;
        return $this;
    }

    /** @return float totalScore */
    public function getTotalScore() {
        return $this->totalScore;
    }

    /**
     * @param float $totalScore
     * @return $this|Result
     */
    public function setTotalScore($totalScore) {
        $this->totalScore = $totalScore;
        return $this;
    }

    /** @return float curvedTotalScore */
    public function getCurvedTotalScore() {
        return $this->curvedTotalScore;
    }

    /**
     * @param float $curvedTotalScore
     * @return $this|Result
     */
    public function setCurvedTotalScore($curvedTotalScore) {
        $this->curvedTotalScore = $curvedTotalScore;
        return $this;
    }

    /** @return float curveFactor */
    public function getCurveFactor() {
        return $this->curveFactor;
    }

    /**
     * @param float $curveFactor
     * @return $this|Result
     */
    public function setCurveFactor($curveFactor) {
        $this->curveFactor = $curveFactor;
        return $this;
    }

    /** @return string comment */
    public function getComment() {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return $this|Result
     */
    public function setComment($comment) {
        $this->comment = $comment;
        return $this;
    }

    /** @return Agent scoredBy */
    public function getScoredBy() {
        return $this->scoredBy;
    }

    /**
     * @param Agent $scoredBy
     * @return $this|Result
     */
    public function setScoredBy($scoredBy) {
        $this->scoredBy = $scoredBy;
        return $this;
    }
}

