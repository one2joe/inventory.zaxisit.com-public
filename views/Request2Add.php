<?php

namespace PHPMaker2022\inventory;

// Page object
$Request2Add = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { request2: currentTable } });
var currentForm, currentPageID;
var frequest2add;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    frequest2add = new ew.Form("frequest2add", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = frequest2add;

    // Add fields
    var fields = currentTable.fields;
    frequest2add.addFields([
        ["User_ID", [fields.User_ID.visible && fields.User_ID.required ? ew.Validators.required(fields.User_ID.caption) : null], fields.User_ID.isInvalid],
        ["Item_ID", [fields.Item_ID.visible && fields.Item_ID.required ? ew.Validators.required(fields.Item_ID.caption) : null], fields.Item_ID.isInvalid],
        ["Quantity", [fields.Quantity.visible && fields.Quantity.required ? ew.Validators.required(fields.Quantity.caption) : null, ew.Validators.integer], fields.Quantity.isInvalid],
        ["Type", [fields.Type.visible && fields.Type.required ? ew.Validators.required(fields.Type.caption) : null], fields.Type.isInvalid],
        ["Status", [fields.Status.visible && fields.Status.required ? ew.Validators.required(fields.Status.caption) : null], fields.Status.isInvalid],
        ["Created", [fields.Created.visible && fields.Created.required ? ew.Validators.required(fields.Created.caption) : null], fields.Created.isInvalid],
        ["Modified", [fields.Modified.visible && fields.Modified.required ? ew.Validators.required(fields.Modified.caption) : null], fields.Modified.isInvalid]
    ]);

    // Form_CustomValidate
    frequest2add.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frequest2add.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    frequest2add.lists.User_ID = <?= $Page->User_ID->toClientList($Page) ?>;
    frequest2add.lists.Item_ID = <?= $Page->Item_ID->toClientList($Page) ?>;
    frequest2add.lists.Type = <?= $Page->Type->toClientList($Page) ?>;
    frequest2add.lists.Status = <?= $Page->Status->toClientList($Page) ?>;
    loadjs.done("frequest2add");
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
<form name="frequest2add" id="frequest2add" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request2">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->Item_ID->Visible) { // Item_ID ?>
    <div id="r_Item_ID"<?= $Page->Item_ID->rowAttributes() ?>>
        <label id="elh_request2_Item_ID" for="x_Item_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Item_ID->caption() ?><?= $Page->Item_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Item_ID->cellAttributes() ?>>
<span id="el_request2_Item_ID">
    <select
        id="x_Item_ID"
        name="x_Item_ID"
        class="form-select ew-select<?= $Page->Item_ID->isInvalidClass() ?>"
        data-select2-id="frequest2add_x_Item_ID"
        data-table="request2"
        data-field="x_Item_ID"
        data-value-separator="<?= $Page->Item_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Item_ID->getPlaceHolder()) ?>"
        <?= $Page->Item_ID->editAttributes() ?>>
        <?= $Page->Item_ID->selectOptionListHtml("x_Item_ID") ?>
    </select>
    <?= $Page->Item_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Item_ID->getErrorMessage() ?></div>
<?= $Page->Item_ID->Lookup->getParamTag($Page, "p_x_Item_ID") ?>
<script>
loadjs.ready("frequest2add", function() {
    var options = { name: "x_Item_ID", selectId: "frequest2add_x_Item_ID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (frequest2add.lists.Item_ID.lookupOptions.length) {
        options.data = { id: "x_Item_ID", form: "frequest2add" };
    } else {
        options.ajax = { id: "x_Item_ID", form: "frequest2add", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.request2.fields.Item_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Quantity->Visible) { // Quantity ?>
    <div id="r_Quantity"<?= $Page->Quantity->rowAttributes() ?>>
        <label id="elh_request2_Quantity" for="x_Quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Quantity->caption() ?><?= $Page->Quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Quantity->cellAttributes() ?>>
<span id="el_request2_Quantity">
<input type="<?= $Page->Quantity->getInputTextType() ?>" name="x_Quantity" id="x_Quantity" data-table="request2" data-field="x_Quantity" value="<?= $Page->Quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->Quantity->getPlaceHolder()) ?>"<?= $Page->Quantity->editAttributes() ?> aria-describedby="x_Quantity_help">
<?= $Page->Quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Type->Visible) { // Type ?>
    <div id="r_Type"<?= $Page->Type->rowAttributes() ?>>
        <label id="elh_request2_Type" for="x_Type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Type->caption() ?><?= $Page->Type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Type->cellAttributes() ?>>
<span id="el_request2_Type">
    <select
        id="x_Type"
        name="x_Type"
        class="form-select ew-select<?= $Page->Type->isInvalidClass() ?>"
        data-select2-id="frequest2add_x_Type"
        data-table="request2"
        data-field="x_Type"
        data-value-separator="<?= $Page->Type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Type->getPlaceHolder()) ?>"
        <?= $Page->Type->editAttributes() ?>>
        <?= $Page->Type->selectOptionListHtml("x_Type") ?>
    </select>
    <?= $Page->Type->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Type->getErrorMessage() ?></div>
<script>
loadjs.ready("frequest2add", function() {
    var options = { name: "x_Type", selectId: "frequest2add_x_Type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (frequest2add.lists.Type.lookupOptions.length) {
        options.data = { id: "x_Type", form: "frequest2add" };
    } else {
        options.ajax = { id: "x_Type", form: "frequest2add", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.request2.fields.Type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Status->Visible) { // Status ?>
    <div id="r_Status"<?= $Page->Status->rowAttributes() ?>>
        <label id="elh_request2_Status" for="x_Status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Status->caption() ?><?= $Page->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Status->cellAttributes() ?>>
<span id="el_request2_Status">
    <select
        id="x_Status"
        name="x_Status"
        class="form-select ew-select<?= $Page->Status->isInvalidClass() ?>"
        data-select2-id="frequest2add_x_Status"
        data-table="request2"
        data-field="x_Status"
        data-value-separator="<?= $Page->Status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Status->getPlaceHolder()) ?>"
        <?= $Page->Status->editAttributes() ?>>
        <?= $Page->Status->selectOptionListHtml("x_Status") ?>
    </select>
    <?= $Page->Status->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Status->getErrorMessage() ?></div>
<script>
loadjs.ready("frequest2add", function() {
    var options = { name: "x_Status", selectId: "frequest2add_x_Status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (frequest2add.lists.Status.lookupOptions.length) {
        options.data = { id: "x_Status", form: "frequest2add" };
    } else {
        options.ajax = { id: "x_Status", form: "frequest2add", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.request2.fields.Status.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("request2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
