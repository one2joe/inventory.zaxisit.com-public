<?php

namespace PHPMaker2022\inventory;

// Page object
$UserLevel2List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { user_level2: currentTable } });
var currentForm, currentPageID;
var fuser_level2list;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fuser_level2list = new ew.Form("fuser_level2list", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fuser_level2list;
    fuser_level2list.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Add fields
    var fields = currentTable.fields;
    fuser_level2list.addFields([
        ["User_Level_ID", [fields.User_Level_ID.visible && fields.User_Level_ID.required ? ew.Validators.required(fields.User_Level_ID.caption) : null, ew.Validators.userLevelId, ew.Validators.integer], fields.User_Level_ID.isInvalid],
        ["User_Level_Name", [fields.User_Level_Name.visible && fields.User_Level_Name.required ? ew.Validators.required(fields.User_Level_Name.caption) : null, ew.Validators.userLevelName('User_Level_ID')], fields.User_Level_Name.isInvalid]
    ]);

    // Form_CustomValidate
    fuser_level2list.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fuser_level2list.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fuser_level2list");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> user_level2">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
</div>
<?php } ?>
<form name="fuser_level2list" id="fuser_level2list" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="user_level2">
<div id="gmp_user_level2" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isAdd() || $Page->isCopy() || $Page->isGridEdit()) { ?>
<table id="tbl_user_level2list" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->User_Level_ID->Visible) { // User_Level_ID ?>
        <th data-name="User_Level_ID" class="<?= $Page->User_Level_ID->headerCellClass() ?>" style="width: 1%; white-space: nowrap;"><div id="elh_user_level2_User_Level_ID" class="user_level2_User_Level_ID"><?= $Page->renderFieldHeader($Page->User_Level_ID) ?></div></th>
<?php } ?>
<?php if ($Page->User_Level_Name->Visible) { // User_Level_Name ?>
        <th data-name="User_Level_Name" class="<?= $Page->User_Level_Name->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_user_level2_User_Level_Name" class="user_level2_User_Level_Name"><?= $Page->renderFieldHeader($Page->User_Level_Name) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->isAdd() || $Page->isCopy()) {
    $Page->RowIndex = 0;
    $Page->KeyCount = $Page->RowIndex;
    if ($Page->isAdd()) {
        $Page->loadRowValues();
    }
    if ($Page->EventCancelled) { // Insert failed
        $Page->restoreFormValues(); // Restore form values
    }

    // Set row properties
    $Page->resetAttributes();
    $Page->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_user_level2", "data-rowtype" => ROWTYPE_ADD]);
    // $Page->RowAttrs->appendClass("ew-table-checked");

    // Reset previous form error if any
    $Page->resetFormError();

    // Render row
    $Page->RowType = ROWTYPE_ADD;
    $Page->renderRow();

    // Render list options
    $Page->renderListOptions();
    $Page->StartRowCount = 0;
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->User_Level_ID->Visible) { // User_Level_ID ?>
        <td data-name="User_Level_ID">
<span id="el<?= $Page->RowCount ?>_user_level2_User_Level_ID" class="el_user_level2_User_Level_ID">
<input type="<?= $Page->User_Level_ID->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_User_Level_ID" id="x<?= $Page->RowIndex ?>_User_Level_ID" data-table="user_level2" data-field="x_User_Level_ID" value="<?= $Page->User_Level_ID->EditValue ?>" size="2" placeholder="<?= HtmlEncode($Page->User_Level_ID->getPlaceHolder()) ?>"<?= $Page->User_Level_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->User_Level_ID->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="user_level2" data-field="x_User_Level_ID" data-hidden="1" name="o<?= $Page->RowIndex ?>_User_Level_ID" id="o<?= $Page->RowIndex ?>_User_Level_ID" value="<?= HtmlEncode($Page->User_Level_ID->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->User_Level_Name->Visible) { // User_Level_Name ?>
        <td data-name="User_Level_Name">
<span id="el<?= $Page->RowCount ?>_user_level2_User_Level_Name" class="el_user_level2_User_Level_Name">
<input type="<?= $Page->User_Level_Name->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_User_Level_Name" id="x<?= $Page->RowIndex ?>_User_Level_Name" data-table="user_level2" data-field="x_User_Level_Name" value="<?= $Page->User_Level_Name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->User_Level_Name->getPlaceHolder()) ?>"<?= $Page->User_Level_Name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->User_Level_Name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="user_level2" data-field="x_User_Level_Name" data-hidden="1" name="o<?= $Page->RowIndex ?>_User_Level_Name" id="o<?= $Page->RowIndex ?>_User_Level_Name" value="<?= HtmlEncode($Page->User_Level_Name->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
<script>
loadjs.ready(["fuser_level2list","load"], () => fuser_level2list.updateLists(<?= $Page->RowIndex ?>));
</script>
    </tr>
<?php
}
?>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}

// Restore number of post back records
if ($CurrentForm && ($Page->isConfirm() || $Page->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Page->FormKeyCountName) && ($Page->isGridAdd() || $Page->isGridEdit() || $Page->isConfirm())) {
        $Page->KeyCount = $CurrentForm->getValue($Page->FormKeyCountName);
        $Page->StopRecord = $Page->StartRecord + $Page->KeyCount - 1;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
$Page->EditRowCount = 0;
if ($Page->isEdit()) {
    $Page->RowIndex = 1;
}
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;
        if ($Page->isAdd() || $Page->isGridAdd() || $Page->isGridEdit() || $Page->isConfirm()) {
            $Page->RowIndex++;
            $CurrentForm->Index = $Page->RowIndex;
            if ($CurrentForm->hasValue($Page->FormActionName) && ($Page->isConfirm() || $Page->EventCancelled)) {
                $Page->RowAction = strval($CurrentForm->getValue($Page->FormActionName));
            } elseif ($Page->isGridAdd()) {
                $Page->RowAction = "insert";
            } else {
                $Page->RowAction = "";
            }
        }

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view
        if ($Page->isEdit()) {
            if ($Page->checkInlineEditKey() && $Page->EditRowCount == 0) { // Inline edit
                $Page->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Page->isEdit() && $Page->RowType == ROWTYPE_EDIT && $Page->EventCancelled) { // Update failed
            $CurrentForm->Index = 1;
            $Page->restoreFormValues(); // Restore form values
        }
        if ($Page->RowType == ROWTYPE_EDIT) { // Edit row
            $Page->EditRowCount++;
        }

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_user_level2",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->User_Level_ID->Visible) { // User_Level_ID ?>
        <td data-name="User_Level_ID"<?= $Page->User_Level_ID->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="<?= $Page->User_Level_ID->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_User_Level_ID" id="x<?= $Page->RowIndex ?>_User_Level_ID" data-table="user_level2" data-field="x_User_Level_ID" value="<?= $Page->User_Level_ID->EditValue ?>" size="2" placeholder="<?= HtmlEncode($Page->User_Level_ID->getPlaceHolder()) ?>"<?= $Page->User_Level_ID->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->User_Level_ID->getErrorMessage() ?></div>
<input type="hidden" data-table="user_level2" data-field="x_User_Level_ID" data-hidden="1" name="o<?= $Page->RowIndex ?>_User_Level_ID" id="o<?= $Page->RowIndex ?>_User_Level_ID" value="<?= HtmlEncode($Page->User_Level_ID->OldValue ?? $Page->User_Level_ID->CurrentValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_user_level2_User_Level_ID" class="el_user_level2_User_Level_ID">
<span<?= $Page->User_Level_ID->viewAttributes() ?>>
<?= $Page->User_Level_ID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="user_level2" data-field="x_User_Level_ID" data-hidden="1" name="x<?= $Page->RowIndex ?>_User_Level_ID" id="x<?= $Page->RowIndex ?>_User_Level_ID" value="<?= HtmlEncode($Page->User_Level_ID->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Page->User_Level_Name->Visible) { // User_Level_Name ?>
        <td data-name="User_Level_Name"<?= $Page->User_Level_Name->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_user_level2_User_Level_Name" class="el_user_level2_User_Level_Name">
<input type="<?= $Page->User_Level_Name->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_User_Level_Name" id="x<?= $Page->RowIndex ?>_User_Level_Name" data-table="user_level2" data-field="x_User_Level_Name" value="<?= $Page->User_Level_Name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->User_Level_Name->getPlaceHolder()) ?>"<?= $Page->User_Level_Name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->User_Level_Name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_user_level2_User_Level_Name" class="el_user_level2_User_Level_Name">
<span<?= $Page->User_Level_Name->viewAttributes() ?>>
<?= $Page->User_Level_Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php if ($Page->RowType == ROWTYPE_ADD || $Page->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fuser_level2list","load"], () => fuser_level2list.updateLists(<?= $Page->RowIndex ?>));
</script>
<?php } ?>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Page->isAdd() || $Page->isCopy()) { ?>
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php } ?>
<?php if ($Page->isEdit()) { ?>
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php } ?>
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("user_level2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
