<?php

namespace PHPMaker2022\inventory;

// Page object
$ItemEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { item: currentTable } });
var currentForm, currentPageID;
var fitemedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fitemedit = new ew.Form("fitemedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fitemedit;

    // Add fields
    var fields = currentTable.fields;
    fitemedit.addFields([
        ["Image", [fields.Image.visible && fields.Image.required ? ew.Validators.fileRequired(fields.Image.caption) : null], fields.Image.isInvalid],
        ["Code", [fields.Code.visible && fields.Code.required ? ew.Validators.required(fields.Code.caption) : null], fields.Code.isInvalid],
        ["Name", [fields.Name.visible && fields.Name.required ? ew.Validators.required(fields.Name.caption) : null], fields.Name.isInvalid],
        ["Price", [fields.Price.visible && fields.Price.required ? ew.Validators.required(fields.Price.caption) : null, ew.Validators.float], fields.Price.isInvalid],
        ["Quantity", [fields.Quantity.visible && fields.Quantity.required ? ew.Validators.required(fields.Quantity.caption) : null, ew.Validators.integer], fields.Quantity.isInvalid],
        ["Modified", [fields.Modified.visible && fields.Modified.required ? ew.Validators.required(fields.Modified.caption) : null], fields.Modified.isInvalid]
    ]);

    // Form_CustomValidate
    fitemedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fitemedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fitemedit");
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
<form name="fitemedit" id="fitemedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="item">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->Image->Visible) { // Image ?>
    <div id="r_Image"<?= $Page->Image->rowAttributes() ?>>
        <label id="elh_item_Image" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Image->caption() ?><?= $Page->Image->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Image->cellAttributes() ?>>
<span id="el_item_Image">
<div id="fd_x_Image" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->Image->title() ?>" data-table="item" data-field="x_Image" name="x_Image" id="x_Image" lang="<?= CurrentLanguageID() ?>"<?= $Page->Image->editAttributes() ?> aria-describedby="x_Image_help"<?= ($Page->Image->ReadOnly || $Page->Image->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->Image->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Image->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_Image" id= "fn_x_Image" value="<?= $Page->Image->Upload->FileName ?>">
<input type="hidden" name="fa_x_Image" id= "fa_x_Image" value="<?= (Post("fa_x_Image") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Image" id= "fs_x_Image" value="100">
<input type="hidden" name="fx_x_Image" id= "fx_x_Image" value="<?= $Page->Image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Image" id= "fm_x_Image" value="<?= $Page->Image->UploadMaxFileSize ?>">
<table id="ft_x_Image" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Code->Visible) { // Code ?>
    <div id="r_Code"<?= $Page->Code->rowAttributes() ?>>
        <label id="elh_item_Code" for="x_Code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Code->caption() ?><?= $Page->Code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Code->cellAttributes() ?>>
<span id="el_item_Code">
<input type="<?= $Page->Code->getInputTextType() ?>" name="x_Code" id="x_Code" data-table="item" data-field="x_Code" value="<?= $Page->Code->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->Code->getPlaceHolder()) ?>"<?= $Page->Code->editAttributes() ?> aria-describedby="x_Code_help">
<?= $Page->Code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Name->Visible) { // Name ?>
    <div id="r_Name"<?= $Page->Name->rowAttributes() ?>>
        <label id="elh_item_Name" for="x_Name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Name->caption() ?><?= $Page->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Name->cellAttributes() ?>>
<span id="el_item_Name">
<input type="<?= $Page->Name->getInputTextType() ?>" name="x_Name" id="x_Name" data-table="item" data-field="x_Name" value="<?= $Page->Name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Name->getPlaceHolder()) ?>"<?= $Page->Name->editAttributes() ?> aria-describedby="x_Name_help">
<?= $Page->Name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Price->Visible) { // Price ?>
    <div id="r_Price"<?= $Page->Price->rowAttributes() ?>>
        <label id="elh_item_Price" for="x_Price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Price->caption() ?><?= $Page->Price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Price->cellAttributes() ?>>
<span id="el_item_Price">
<input type="<?= $Page->Price->getInputTextType() ?>" name="x_Price" id="x_Price" data-table="item" data-field="x_Price" value="<?= $Page->Price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->Price->getPlaceHolder()) ?>"<?= $Page->Price->editAttributes() ?> aria-describedby="x_Price_help">
<?= $Page->Price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Quantity->Visible) { // Quantity ?>
    <div id="r_Quantity"<?= $Page->Quantity->rowAttributes() ?>>
        <label id="elh_item_Quantity" for="x_Quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Quantity->caption() ?><?= $Page->Quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Quantity->cellAttributes() ?>>
<span id="el_item_Quantity">
<input type="<?= $Page->Quantity->getInputTextType() ?>" name="x_Quantity" id="x_Quantity" data-table="item" data-field="x_Quantity" value="<?= $Page->Quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->Quantity->getPlaceHolder()) ?>"<?= $Page->Quantity->editAttributes() ?> aria-describedby="x_Quantity_help">
<?= $Page->Quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="item" data-field="x_Item_ID" data-hidden="1" name="x_Item_ID" id="x_Item_ID" value="<?= HtmlEncode($Page->Item_ID->CurrentValue) ?>">
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("item");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
