<?php

namespace TextGenerator;

class PDFText extends \FPDF implements TextEditor
{
    private $pdf;

    public function init($documentTitle)
    {
        $this->SetTitle($documentTitle);
        $this->addPage();
    }

    public function addTitle($title)
    {
        $this->SetFont('Arial','B', 24);
        $this->Cell('', 10, $title);
        $this->Ln(10);
    }

    public function addParagraph($text)
    {
        $this->SetFont('Times','', 12);
        $this->MultiCell(0, 4, $text, '', 'J');
        $this->Ln();
    }

    public function renderDoc()
    {
        $this->output();
    }
}