<?php

require_once 'Annotation.php';
require_once 'TextPositionSelector.php';
/**
 * 
 *
 */
class HighlightAnnotation extends Annotation {

	private $selection;
	private $selectionText;

	public function __construct($id) {
		parent::__construct($id);
		$this->setType("http://purl.imsglobal.org/caliper/v1/HighlightAnnotation");
		$selection = new TextPositionSelector();
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
	}

}
