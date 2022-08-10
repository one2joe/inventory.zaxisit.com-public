<?php

namespace PHPMaker2022\inventory;

/**
 * Class for export to PDF
 */
class ExportPdf extends ExportBase
{
    // Export
    public function export()
    {
        header("HTTP/1.0 500 Export PDF extension disabled");
        die();
    }
}
