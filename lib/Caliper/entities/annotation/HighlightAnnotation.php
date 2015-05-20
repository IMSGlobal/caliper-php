<?php

require_once 'Annotation.php';
require_once 'AnnotationType.php';
require_once 'TextPositionSelector.php';

class HighlightAnnotation extends Annotation implements JsonSerializable {
    private $selection;
    private $selectionText;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(AnnotationType::HIGHLIGHT_ANNOTATION);
        $selection = new TextPositionSelector();
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'selection' => (object) $this->getSelection(),
            'selectionText' => $this->getSelectionText()
        ]);
    }

    /**
     * @return the selection
     */
    public function getSelection() {
        return $this->selection;
    }

    /**
     * @param selection
     *            the selection to set
     */
    public function  setSelection($selection) {
        $this->selection = $selection;
        return $this;
    }

    /**
     * @return the selectionText
     */
    public function  getSelectionText() {
        return $this->selectionText;
    }

    /**
     * @param selectionText
     *            the selectionText to set
     */
    public function setSelectionText($selectionText) {
        $this->selectionText = $selectionText;
        return $this;
    }
}
