<?php

namespace TextGenerator;

interface TextEditor
{
    public function init($documentTitle);

    /**
     * <h2> in HTML
     */
    public function addTitle($title);

    /**
     * <p> in HTML
     */
    public function addParagraph($text);
    public function renderDoc();
}