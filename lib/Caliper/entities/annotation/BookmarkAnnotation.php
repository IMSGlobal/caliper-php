<?php
require_once 'Annotation.php';
require_once 'AnnotationType.php';

class BookmarkAnnotation extends Annotation {
    /** @var string */
    private $bookmarkNotes;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(AnnotationType::BOOKMARK_ANNOTATION);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'bookmarkNotes' => $this->getBookmarkNotes(),
        ]);
    }

    /** @return string bookmarkNotes */
    public function  getBookmarkNotes() {
        return $this->bookmarkNotes;
    }

    /**
     * @param string $bookmarkNotes
     * @return $this|BookmarkAnnotation
     */
    public function  setBookmarkNotes($bookmarkNotes) {
        $this->bookmarkNotes = $bookmarkNotes;
        return $this;
    }
}
