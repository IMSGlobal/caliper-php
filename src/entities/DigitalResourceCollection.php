<?php
namespace IMSGlobal\Caliper\entities;

class DigitalResourceCollection extends DigitalResource {
    /** @var DigitalResource[]|null */
    private $items;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new EntityType(EntityType::DIGITAL_RESOURCE_COLLECTION));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'items' => $this->getItems(),
        ]);
    }

    /** @return DigitalResource[]|null */
    public function getItems() {
        return $this->items;
    }

    /**
     * @param DigitalResource|DigitalResource[]|null $items
     * @return DigitalResourceCollection
     */
    public function setItems($items) {
        if (!is_null($items)) {
            if (!is_array($items)) $items = [$items];

            foreach ($items as $item) {
                if (!($item instanceof DigitalResource)) {
                    throw new \InvalidArgumentException(
                        __METHOD__ . ': array of ' . DigitalResource::className() . ' expected');
                }
            }
        }

        $this->items = $items;
        return $this;
    }
}