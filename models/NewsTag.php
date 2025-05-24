<?php

class NewsTag {
    public $news_id;
    public $tag_id;

    public function __construct($news_id = null, $tag_id = null) {
        $this->news_id = $news_id;
        $this->tag_id = $tag_id;
    }
}
?>
