<?php

namespace PHPMaker2022\inventory;

// Page object
$UserEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { user: currentTable } });
var currentForm, currentPageID;
var fuseredit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fuseredit = new ew.Form("fuseredit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fuseredit;

    // Add fields
    var fields = currentTable.fields;
    fuseredit.addFields([
        ["User_Level_ID", [fields.User_Level_ID.visible && fields.User_Level_ID.required ? ew.Validators.required(fields.User_Level_ID.caption) : null], fields.User_Level_ID.isInvalid],
        ["Name", [fields.Name.visible && fields.Name.required ? ew.Validators.required(fields.Name.caption) : null], fields.Name.isInvalid],
        ["_Username", [fields._Username.visible && fields._Username.required ? ew.Validators.required(fields._Username.caption) : null], fields._Username.isInvalid],
        ["_Password", [fields._Password.visible && fields._Password.required ? ew.Validators.required(fields._Password.caption) : null], fields._Password.isInvalid],
        ["Enable", [fields.Enable.visible && fields.Enable.required ? ew.Validators.required(fields.Enable.caption) : null], fields.Enable.isInvalid]
    ]);

    // Form_CustomValidate
    fuseredit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fuseredit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fuseredit.lists.User_Level_ID = <?= $Page->User_Level_ID->toClientList($Page) ?>;
    fuseredit.lists.Enable = <?= $Page->Enable->toClientList($Page) ?>;
    loadjs.done("fuseredit");
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
<form name="fuseredit" id="fuseredit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->User_Level_ID->Visible) { // User_Level_ID ?>
    <div id="r_User_Level_ID"<?= $Page->User_Level_ID->rowAttributes() ?>>
        <label id="elh_user_User_Level_ID" for="x_User_Level_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->User_Level_ID->caption() ?><?= $Page->User_Level_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->User_Level_ID->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_user_User_Level_ID">
<span class="form-control-plaintext"><?= $Page->User_Level_ID->getDisplayValue($Page->User_Level_ID->EditValue) ?></span>
</span>
<?php } else { ?>
<span id="el_user_User_Level_ID">
    <select
        id="x_User_Level_ID"
        name="x_User_Level_ID"
        class="form-select ew-select<?= $Page->User_Level_ID->isInvalidClass() ?>"
        data-select2-id="fuseredit_x_User_Level_ID"
        data-table="user"
        data-field="x_User_Level_ID"
        data-value-separator="<?= $Page->User_Level_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->User_Level_ID->getPlaceHolder()) ?>"
        <?= $Page->User_Level_ID->editAttributes() ?>>
        <?= $Page->User_Level_ID->selectOptionListHtml("x_User_Level_ID") ?>
    </select>
    <?= $Page->User_Level_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->User_Level_ID->getErrorMessage() ?></div>
<?= $Page->User_Level_ID->Lookup->getParamTag($Page, "p_x_User_Level_ID") ?>
<script>
loadjs.ready("fuseredit", function() {
    var options = { name: "x_User_Level_ID", selectId: "fuseredit_x_User_Level_ID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fuseredit.lists.User_Level_ID.lookupOptions.length) {
        options.data = { id: "x_User_Level_ID", form: "fuseredit" };
    } else {
        options.ajax = { id: "x_User_Level_ID", form: "fuseredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.user.fields.User_Level_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Name->Visible) { // Name ?>
    <div id="r_Name"<?= $Page->Name->rowAttributes() ?>>
        <label id="elh_user_Name" for="x_Name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Name->caption() ?><?= $Page->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Name->cellAttributes() ?>>
<span id="el_user_Name">
<input type="<?= $Page->Name->getInputTextType() ?>" name="x_Name" id="x_Name" data-table="user" data-field="x_Name" value="<?= $Page->Name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Name->getPlaceHolder()) ?>"<?= $Page->Name->editAttributes() ?> aria-describedby="x_Name_help">
<?= $Page->Name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_Username->Visible) { // Username ?>
    <div id="r__Username"<?= $Page->_Username->rowAttributes() ?>>
        <label id="elh_user__Username" for="x__Username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_Username->caption() ?><?= $Page->_Username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_Username->cellAttributes() ?>>
<span id="el_user__Username">
<input type="<?= $Page->_Username->getInputTextType() ?>" name="x__Username" id="x__Username" data-table="user" data-field="x__Username" value="<?= $Page->_Username->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_Username->getPlaceHolder()) ?>"<?= $Page->_Username->editAttributes() ?> aria-describedby="x__Username_help">
<?= $Page->_Username->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_Username->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_Password->Visible) { // Password ?>
    <div id="r__Password"<?= $Page->_Password->rowAttributes() ?>>
        <label id="elh_user__Password" for="x__Password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_Password->caption() ?><?= $Page->_Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_Password->cellAttributes() ?>>
<span id="el_user__Password">
<div class="input-group">
    <input type="password" name="x__Password" id="x__Password" autocomplete="new-password" data-field="x__Password" value="<?= $Page->_Password->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_Password->getPlaceHolder()) ?>"<?= $Page->_Password->editAttributes() ?> aria-describedby="x__Password_help">
    <button type="button" class="btn btn-default ew-toggle-password rounded-end" data-ew-action="password"><i class="fas fa-eye"></i></button>
</div>
<?= $Page->_Password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_Password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Enable->Visible) { // Enable ?>
    <div id="r_Enable"<?= $Page->Enable->rowAttributes() ?>>
        <label id="elh_user_Enable" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Enable->caption() ?><?= $Page->Enable->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Enable->cellAttributes() ?>>
<span id="el_user_Enable">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->Enable->isInvalidClass() ?>" data-table="user" data-field="x_Enable" name="x_Enable[]" id="x_Enable_948858" value="1"<?= ConvertToBool($Page->Enable->CurrentValue) ? " checked" : "" ?><?= $Page->Enable->editAttributes() ?> aria-describedby="x_Enable_help">
    <div class="invalid-feedback"><?= $Page->Enable->getErrorMessage() ?></div>
</div>
<?= $Page->Enable->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="user" data-field="x_User_ID" data-hidden="1" name="x_User_ID" id="x_User_ID" value="<?= HtmlEncode($Page->User_ID->CurrentValue) ?>">
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
    ew.addEventHandlers("user");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
