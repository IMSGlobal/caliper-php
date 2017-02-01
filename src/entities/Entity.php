<?php
namespace IMSGlobal\Caliper\entities;

use IMSGlobal\Caliper\util\ClassUtil;
use IMSGlobal\Caliper\context\Context;
use IMSGlobal\Caliper\entities;
use IMSGlobal\Caliper\util;

abstract class Entity extends ClassUtil implements \JsonSerializable, entities\schemadotorg\Thing {
    /** @var string */
    protected $id;
    /** @var Context */
    protected $context;
    /** @var Type */
    private $type;
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var string[] */
    private $extensions;
    /** @var \DateTime */
    private $dateCreated;
    /** @var \DateTime */
    private $dateModified;

    function __construct($id) {
        $this->setId($id)
            ->setContext(new Context(Context::CONTEXT));
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'type' => $this->getType(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'extensions' => (object) $this->getExtensions(),
            'dateCreated' => util\TimestampUtil::formatTimeISO8601MillisUTC($this->getDateCreated()),
            'dateModified' => util\TimestampUtil::formatTimeISO8601MillisUTC($this->getDateModified()),
        ];
    }

    /** @return string id */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this|Entity
     */
    public function setId($id) {
        if (!is_string($id)) {
            throw new \InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->id = $id;
        return $this;
    }

    /** @return Context */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param Context $context
     * @return $this|Entity
     */
    public function setContext(Context $context) {
        $this->context = $context;
        return $this;
    }

    /** @return Type type */
    public function getType() {
        return $this->type;
    }

    /**
     * @param Type $type
     * @return $this|Entity
     */
    public function setType(Type $type) {
        $this->type = $type;
        return $this;
    }

    /** @return string name */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this|Entity
     */
    public function setName($name) {
        if (!is_string($name)) {
            throw new \InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->name = $name;
        return $this;
    }

    /** @return string description */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this|Entity
     */
    public function setDescription($description) {
        if (!is_string($description)) {
            throw new \InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->description = $description;
        return $this;
    }

    /** @return string[] extensions */
    public function getExtensions() {
        return $this->extensions;
    }

    /**
     * @param string|string[] $extensions
     * @return $this|Entity
     */
    /**
     * @param \array[]|null $extensions An array of associative arrays
     * @return Entity
     */
    public function setExtensions($extensions) {
        if ($extensions !== null) {
            if (!is_array($extensions)) {
                $extensions = [$extensions];
            } else {
                $extensions = array_values($extensions);
            }

            foreach ($extensions as $anExtension) {
                if (!util\Type::isStringKeyedArray($anExtension)) {
                    throw new \InvalidArgumentException(__METHOD__ . ': array of associative arrays expected');
                }
            }
        }

        $this->extensions = $extensions;
        return $this;
    }

    /** @return \DateTime dateCreated */
    public function getDateCreated() {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     * @return $this|Entity
     */
    public function setDateCreated(\DateTime $dateCreated) {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /** @return \DateTime dateModified */
    public function getDateModified() {
        return $this->dateModified;
    }

    /**
     * @param \DateTime $dateModified
     * @return $this|Entity
     */
    public function setDateModified(\DateTime $dateModified) {
        $this->dateModified = $dateModified;
        return $this;
    }
}

