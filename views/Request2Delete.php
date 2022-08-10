<?php

namespace PHPMaker2022\inventory;

// Page object
$Request2Delete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { request2: currentTable } });
var currentForm, currentPageID;
var frequest2delete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    frequest2delete = new ew.Form("frequest2delete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = frequest2delete;
    loadjs.done("frequest2delete");
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
<form name="frequest2delete" id="frequest2delete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request2">
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
<?php if ($Page->User_ID->Visible) { // User_ID ?>
        <th class="<?= $Page->User_ID->headerCellClass() ?>"><span id="elh_request2_User_ID" class="request2_User_ID"><?= $Page->User_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Item_ID->Visible) { // Item_ID ?>
        <th class="<?= $Page->Item_ID->headerCellClass() ?>"><span id="elh_request2_Item_ID" class="request2_Item_ID"><?= $Page->Item_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Quantity->Visible) { // Quantity ?>
        <th class="<?= $Page->Quantity->headerCellClass() ?>"><span id="elh_request2_Quantity" class="request2_Quantity"><?= $Page->Quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Type->Visible) { // Type ?>
        <th class="<?= $Page->Type->headerCellClass() ?>"><span id="elh_request2_Type" class="request2_Type"><?= $Page->Type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Status->Visible) { // Status ?>
        <th class="<?= $Page->Status->headerCellClass() ?>"><span id="elh_request2_Status" class="request2_Status"><?= $Page->Status->caption() ?></span></th>
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
<?php if ($Page->User_ID->Visible) { // User_ID ?>
        <td<?= $Page->User_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request2_User_ID" class="el_request2_User_ID">
<span<?= $Page->User_ID->viewAttributes() ?>>
<?= $Page->User_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Item_ID->Visible) { // Item_ID ?>
        <td<?= $Page->Item_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request2_Item_ID" class="el_request2_Item_ID">
<span<?= $Page->Item_ID->viewAttributes() ?>>
<?= $Page->Item_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Quantity->Visible) { // Quantity ?>
        <td<?= $Page->Quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request2_Quantity" class="el_request2_Quantity">
<span<?= $Page->Quantity->viewAttributes() ?>>
<?= $Page->Quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Type->Visible) { // Type ?>
        <td<?= $Page->Type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request2_Type" class="el_request2_Type">
<span<?= $Page->Type->viewAttributes() ?>>
<?= $Page->Type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Status->Visible) { // Status ?>
        <td<?= $Page->Status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request2_Status" class="el_request2_Status">
<span<?= $Page->Status->viewAttributes() ?>>
<?= $Page->Status->getViewValue() ?></span>
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
