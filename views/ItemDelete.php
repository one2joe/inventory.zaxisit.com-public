<?php

namespace PHPMaker2022\inventory;

// Page object
$ItemDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { item: currentTable } });
var currentForm, currentPageID;
var fitemdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fitemdelete = new ew.Form("fitemdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fitemdelete;
    loadjs.done("fitemdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fitemdelete" id="fitemdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="item">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->Image->Visible) { // Image ?>
        <th class="<?= $Page->Image->headerCellClass() ?>"><span id="elh_item_Image" class="item_Image"><?= $Page->Image->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Code->Visible) { // Code ?>
        <th class="<?= $Page->Code->headerCellClass() ?>"><span id="elh_item_Code" class="item_Code"><?= $Page->Code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Name->Visible) { // Name ?>
        <th class="<?= $Page->Name->headerCellClass() ?>"><span id="elh_item_Name" class="item_Name"><?= $Page->Name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Price->Visible) { // Price ?>
        <th class="<?= $Page->Price->headerCellClass() ?>"><span id="elh_item_Price" class="item_Price"><?= $Page->Price->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Quantity->Visible) { // Quantity ?>
        <th class="<?= $Page->Quantity->headerCellClass() ?>"><span id="elh_item_Quantity" class="item_Quantity"><?= $Page->Quantity->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->Image->Visible) { // Image ?>
        <td<?= $Page->Image->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_item_Image" class="el_item_Image">
<span>
<?= GetFileViewTag($Page->Image, $Page->Image->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->Code->Visible) { // Code ?>
        <td<?= $Page->Code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_item_Code" class="el_item_Code">
<span<?= $Page->Code->viewAttributes() ?>>
<?= $Page->Code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Name->Visible) { // Name ?>
        <td<?= $Page->Name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_item_Name" class="el_item_Name">
<span<?= $Page->Name->viewAttributes() ?>>
<?= $Page->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Price->Visible) { // Price ?>
        <td<?= $Page->Price->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_item_Price" class="el_item_Price">
<span<?= $Page->Price->viewAttributes() ?>>
<?= $Page->Price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Quantity->Visible) { // Quantity ?>
        <td<?= $Page->Quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_item_Quantity" class="el_item_Quantity">
<span<?= $Page->Quantity->viewAttributes() ?>>
<?= $Page->Quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
