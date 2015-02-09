<?php
if (!defined('CALIPER_LIB_PATH')) {
    throw new Exception('Please require CaliperSensor first.');
}

class CaliperEntity implements JsonSerializable {

    protected $id;
    public $type;
    public $name;
    private $description;
    private $properties;
    private $dateCreated;
    private $dateModified;

    function __construct() {
    }

    /**
     * It is preferred to call NutritionalFacts::createBuilder
     * to calling this constructor directly.
     */
//    function __construct(CaliperEntityBuilder $b) {
//        $this->type = $b->getType();
//        $this->name = $b->getName();
//        $this->id = $b->getId();
//        $this->dateModified = $b->getDateModified();
//        $this->properties = $b->getProperties();
//    }
//
//    static function builder($s) {
//        return new CaliperEntityBuilder();
//    }

    /**
     ** @see JsonSerializable::jsonSerialize()
     *to implement jsonLD
     */
    public function jsonSerialize() {
        return [
            '@id' => $this->getId(),
            '@type' => $this->getType(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'properties' => (object) $this->getProperties(),
            'dateCreated' => $this->getDateCreated(),
            'dateModified' => $this->getDateModified(),
        ];
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setDescription($value) {
        $this->description = $value;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     * @param mixed $properties
     */
    public function setProperties($properties) {
        $this->properties = $properties;
    }
    
    /**
     * @return int
     */
    public function getDateCreated() {
        return $this->dateCreated;
    }

    /**
     * @param int $dateCreated
     */
    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return int
     */
    public function getDateModified() {
        return $this->dateModified;
    }

    /**
     * @param int $dateModified
     */
    public function setDateModified($dateModified) {
        $this->dateModified = $dateModified;
    }
} 