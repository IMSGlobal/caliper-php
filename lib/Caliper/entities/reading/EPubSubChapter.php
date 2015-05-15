<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/schemadotorg/CreativeWork.php';

/**
 *         Representation of an EPUB 3 Volume
 *
 *         A major sub-division of a chapter
 *         http://www.idpf.org/epub/vocab/structure/#subchapter
 */
class EPubSubChapter extends DigitalResource implements CreativeWork {
    private $index;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(DigitalResourceType::EPUB_SUB_CHAPTER);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'index' => $this->getIndex(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getIndex() {
        return $this->index;
    }

    /**
     * @param mixed $index
     */
    public function setIndex($index) {
        $this->index = $index;
        return $this;
    }
}