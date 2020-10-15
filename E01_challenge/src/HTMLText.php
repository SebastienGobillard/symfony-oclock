<?php

namespace TextGenerator;

class HTMLText implements TextEditor
{
    private $pageTitle;
    private $html;

    public function init($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    public function addTitle($title)
    {
        $this->html .= "<h2>$title</h2>";
    }

    public function addParagraph($text)
    {
        $this->html .= "<p>$text</p>";
    }

    public function renderDoc()
    {
        $finalHtml = "<!DOCTYPE html>
                <html>
                    <head>
                        <title>$this->pageTitle</title>
                    </head>
                <body>
                    <h1>$this->pageTitle</h1>
                    $this->html
                </body>
               </html>";

        echo $finalHtml;
    }
}