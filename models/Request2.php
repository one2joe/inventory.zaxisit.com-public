<?php

namespace PHPMaker2022\inventory;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for request
 */
class Request2 extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-3 col-form-label ew-label";
    public $RightColumnClass = "col-sm-9";
    public $OffsetColumnClass = "col-sm-9 offset-sm-3";
    public $TableLeftColumnClass = "w-col-3";

    // Export
    public $ExportDoc;

    // Fields
    public $Request_ID;
    public $User_ID;
    public $Item_ID;
    public $Quantity;
    public $Type;
    public $Status;
    public $Created;
    public $Modified;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'request2';
        $this->TableName = 'request';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`request`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordVersion = 12; // Word version (PHPWord only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = "A4"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 10;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // Request_ID
        $this->Request_ID = new DbField(
            'request2',
            'request',
            'x_Request_ID',
            'Request_ID',
            '`Request_ID`',
            '`Request_ID`',
            19,
            11,
            -1,
            false,
            '`Request_ID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'NO'
        );
        $this->Request_ID->InputTextType = "text";
        $this->Request_ID->IsAutoIncrement = true; // Autoincrement field
        $this->Request_ID->IsPrimaryKey = true; // Primary key field
        $this->Request_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Request_ID'] = &$this->Request_ID;

        // User_ID
        $this->User_ID = new DbField(
            'request2',
            'request',
            'x_User_ID',
            'User_ID',
            '`User_ID`',
            '`User_ID`',
            3,
            11,
            -1,
            false,
            '`User_ID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->User_ID->InputTextType = "text";
        $this->User_ID->Nullable = false; // NOT NULL field
        $this->User_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->User_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->User_ID->Lookup = new Lookup('User_ID', 'user', false, 'User_ID', ["Name","Username","",""], [], [], [], [], [], [], '', '', "CONCAT(COALESCE(`Name`, ''),'" . ValueSeparator(1, $this->User_ID) . "',COALESCE(`Username`,''))");
        $this->User_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['User_ID'] = &$this->User_ID;

        // Item_ID
        $this->Item_ID = new DbField(
            'request2',
            'request',
            'x_Item_ID',
            'Item_ID',
            '`Item_ID`',
            '`Item_ID`',
            19,
            11,
            -1,
            false,
            '`Item_ID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->Item_ID->InputTextType = "text";
        $this->Item_ID->Nullable = false; // NOT NULL field
        $this->Item_ID->Required = true; // Required field
        $this->Item_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->Item_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->Item_ID->Lookup = new Lookup('Item_ID', 'item', false, 'Item_ID', ["Code","Name","",""], [], [], [], [], [], [], '', '', "CONCAT(COALESCE(`Code`, ''),'" . ValueSeparator(1, $this->Item_ID) . "',COALESCE(`Name`,''))");
        $this->Item_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Item_ID'] = &$this->Item_ID;

        // Quantity
        $this->Quantity = new DbField(
            'request2',
            'request',
            'x_Quantity',
            'Quantity',
            '`Quantity`',
            '`Quantity`',
            19,
            11,
            -1,
            false,
            '`Quantity`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Quantity->InputTextType = "text";
        $this->Quantity->Nullable = false; // NOT NULL field
        $this->Quantity->Required = true; // Required field
        $this->Quantity->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Quantity'] = &$this->Quantity;

        // Type
        $this->Type = new DbField(
            'request2',
            'request',
            'x_Type',
            'Type',
            '`Type`',
            '`Type`',
            202,
            3,
            -1,
            false,
            '`Type`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->Type->InputTextType = "text";
        $this->Type->Nullable = false; // NOT NULL field
        $this->Type->Required = true; // Required field
        $this->Type->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->Type->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->Type->Lookup = new Lookup('Type', 'request2', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->Type->OptionCount = 1;
        $this->Fields['Type'] = &$this->Type;

        // Status
        $this->Status = new DbField(
            'request2',
            'request',
            'x_Status',
            'Status',
            '`Status`',
            '`Status`',
            202,
            8,
            -1,
            false,
            '`Status`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->Status->InputTextType = "text";
        $this->Status->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->Status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->Status->Lookup = new Lookup('Status', 'request2', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->Status->OptionCount = 3;
        $this->Fields['Status'] = &$this->Status;

        // Created
        $this->Created = new DbField(
            'request2',
            'request',
            'x_Created',
            'Created',
            '`Created`',
            CastDateFieldForLike("`Created`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`Created`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Created->InputTextType = "text";
        $this->Created->Nullable = false; // NOT NULL field
        $this->Created->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Created'] = &$this->Created;

        // Modified
        $this->Modified = new DbField(
            'request2',
            'request',
            'x_Modified',
            'Modified',
            '`Modified`',
            CastDateFieldForLike("`Modified`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`Modified`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Modified->InputTextType = "text";
        $this->Modified->Nullable = false; // NOT NULL field
        $this->Modified->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Modified'] = &$this->Modified;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`request`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            case "lookup":
                return (($allow & 256) == 256);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlwrk);
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->Request_ID->setDbValue($conn->lastInsertId());
            $rs['Request_ID'] = $this->Request_ID->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('Request_ID', $rs)) {
                AddFilter($where, QuotedName('Request_ID', $this->Dbid) . '=' . QuotedValue($rs['Request_ID'], $this->Request_ID->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->Request_ID->DbValue = $row['Request_ID'];
        $this->User_ID->DbValue = $row['User_ID'];
        $this->Item_ID->DbValue = $row['Item_ID'];
        $this->Quantity->DbValue = $row['Quantity'];
        $this->Type->DbValue = $row['Type'];
        $this->Status->DbValue = $row['Status'];
        $this->Created->DbValue = $row['Created'];
        $this->Modified->DbValue = $row['Modified'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`Request_ID` = @Request_ID@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->Request_ID->CurrentValue : $this->Request_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->Request_ID->CurrentValue = $keys[0];
            } else {
                $this->Request_ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('Request_ID', $row) ? $row['Request_ID'] : null;
        } else {
            $val = $this->Request_ID->OldValue !== null ? $this->Request_ID->OldValue : $this->Request_ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@Request_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("Request2List");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "Request2View") {
            return $Language->phrase("View");
        } elseif ($pageName == "Request2Edit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "Request2Add") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "Request2View";
            case Config("API_ADD_ACTION"):
                return "Request2Add";
            case Config("API_EDIT_ACTION"):
                return "Request2Edit";
            case Config("API_DELETE_ACTION"):
                return "Request2Delete";
            case Config("API_LIST_ACTION"):
                return "Request2List";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "Request2List";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("Request2View", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("Request2View", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "Request2Add?" . $this->getUrlParm($parm);
        } else {
            $url = "Request2Add";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("Request2Edit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("Request2Add", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("Request2Delete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"Request_ID\":" . JsonEncode($this->Request_ID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->Request_ID->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->Request_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("Request_ID") ?? Route("Request_ID")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->Request_ID->CurrentValue = $key;
            } else {
                $this->Request_ID->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->Request_ID->setDbValue($row['Request_ID']);
        $this->User_ID->setDbValue($row['User_ID']);
        $this->Item_ID->setDbValue($row['Item_ID']);
        $this->Quantity->setDbValue($row['Quantity']);
        $this->Type->setDbValue($row['Type']);
        $this->Status->setDbValue($row['Status']);
        $this->Created->setDbValue($row['Created']);
        $this->Modified->setDbValue($row['Modified']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Request_ID

        // User_ID

        // Item_ID

        // Quantity

        // Type

        // Status

        // Created

        // Modified

        // Request_ID
        $this->Request_ID->ViewValue = $this->Request_ID->CurrentValue;
        $this->Request_ID->ViewCustomAttributes = "";

        // User_ID
        $curVal = strval($this->User_ID->CurrentValue);
        if ($curVal != "") {
            $this->User_ID->ViewValue = $this->User_ID->lookupCacheOption($curVal);
            if ($this->User_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "`User_ID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->User_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->User_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->User_ID->ViewValue = $this->User_ID->displayValue($arwrk);
                } else {
                    $this->User_ID->ViewValue = FormatNumber($this->User_ID->CurrentValue, $this->User_ID->formatPattern());
                }
            }
        } else {
            $this->User_ID->ViewValue = null;
        }
        $this->User_ID->ViewCustomAttributes = "";

        // Item_ID
        $curVal = strval($this->Item_ID->CurrentValue);
        if ($curVal != "") {
            $this->Item_ID->ViewValue = $this->Item_ID->lookupCacheOption($curVal);
            if ($this->Item_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "`Item_ID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->Item_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->Item_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->Item_ID->ViewValue = $this->Item_ID->displayValue($arwrk);
                } else {
                    $this->Item_ID->ViewValue = FormatNumber($this->Item_ID->CurrentValue, $this->Item_ID->formatPattern());
                }
            }
        } else {
            $this->Item_ID->ViewValue = null;
        }
        $this->Item_ID->ViewCustomAttributes = "";

        // Quantity
        $this->Quantity->ViewValue = $this->Quantity->CurrentValue;
        $this->Quantity->ViewValue = FormatNumber($this->Quantity->ViewValue, $this->Quantity->formatPattern());
        $this->Quantity->CellCssStyle .= "text-align: right;";
        $this->Quantity->ViewCustomAttributes = "";

        // Type
        if (strval($this->Type->CurrentValue) != "") {
            $this->Type->ViewValue = $this->Type->optionCaption($this->Type->CurrentValue);
        } else {
            $this->Type->ViewValue = null;
        }
        $this->Type->ViewCustomAttributes = "";

        // Status
        if (strval($this->Status->CurrentValue) != "") {
            $this->Status->ViewValue = $this->Status->optionCaption($this->Status->CurrentValue);
        } else {
            $this->Status->ViewValue = null;
        }
        $this->Status->ViewCustomAttributes = "";

        // Created
        $this->Created->ViewValue = $this->Created->CurrentValue;
        $this->Created->ViewValue = FormatDateTime($this->Created->ViewValue, $this->Created->formatPattern());
        $this->Created->ViewCustomAttributes = "";

        // Modified
        $this->Modified->ViewValue = $this->Modified->CurrentValue;
        $this->Modified->ViewValue = FormatDateTime($this->Modified->ViewValue, $this->Modified->formatPattern());
        $this->Modified->ViewCustomAttributes = "";

        // Request_ID
        $this->Request_ID->LinkCustomAttributes = "";
        $this->Request_ID->HrefValue = "";
        $this->Request_ID->TooltipValue = "";

        // User_ID
        $this->User_ID->LinkCustomAttributes = "";
        $this->User_ID->HrefValue = "";
        $this->User_ID->TooltipValue = "";

        // Item_ID
        $this->Item_ID->LinkCustomAttributes = "";
        $this->Item_ID->HrefValue = "";
        $this->Item_ID->TooltipValue = "";

        // Quantity
        $this->Quantity->LinkCustomAttributes = "";
        $this->Quantity->HrefValue = "";
        $this->Quantity->TooltipValue = "";

        // Type
        $this->Type->LinkCustomAttributes = "";
        $this->Type->HrefValue = "";
        $this->Type->TooltipValue = "";

        // Status
        $this->Status->LinkCustomAttributes = "";
        $this->Status->HrefValue = "";
        $this->Status->TooltipValue = "";

        // Created
        $this->Created->LinkCustomAttributes = "";
        $this->Created->HrefValue = "";
        $this->Created->TooltipValue = "";

        // Modified
        $this->Modified->LinkCustomAttributes = "";
        $this->Modified->HrefValue = "";
        $this->Modified->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Request_ID
        $this->Request_ID->setupEditAttributes();
        $this->Request_ID->EditCustomAttributes = "";
        $this->Request_ID->EditValue = $this->Request_ID->CurrentValue;
        $this->Request_ID->ViewCustomAttributes = "";

        // User_ID

        // Item_ID
        $this->Item_ID->setupEditAttributes();
        $this->Item_ID->EditCustomAttributes = "";
        $this->Item_ID->PlaceHolder = RemoveHtml($this->Item_ID->title());

        // Quantity
        $this->Quantity->setupEditAttributes();
        $this->Quantity->EditCustomAttributes = "";
        $this->Quantity->EditValue = $this->Quantity->CurrentValue;
        $this->Quantity->PlaceHolder = RemoveHtml($this->Quantity->title());
        if (strval($this->Quantity->EditValue) != "" && is_numeric($this->Quantity->EditValue)) {
            $this->Quantity->EditValue = FormatNumber($this->Quantity->EditValue, null);
        }

        // Type
        $this->Type->setupEditAttributes();
        $this->Type->EditCustomAttributes = "";
        $this->Type->EditValue = $this->Type->options(true);
        $this->Type->PlaceHolder = RemoveHtml($this->Type->title());

        // Status
        $this->Status->setupEditAttributes();
        $this->Status->EditCustomAttributes = "";
        $this->Status->EditValue = $this->Status->options(true);
        $this->Status->PlaceHolder = RemoveHtml($this->Status->title());

        // Created

        // Modified

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->Request_ID);
                    $doc->exportCaption($this->User_ID);
                    $doc->exportCaption($this->Item_ID);
                    $doc->exportCaption($this->Quantity);
                    $doc->exportCaption($this->Type);
                    $doc->exportCaption($this->Status);
                    $doc->exportCaption($this->Created);
                    $doc->exportCaption($this->Modified);
                } else {
                    $doc->exportCaption($this->Request_ID);
                    $doc->exportCaption($this->User_ID);
                    $doc->exportCaption($this->Item_ID);
                    $doc->exportCaption($this->Quantity);
                    $doc->exportCaption($this->Type);
                    $doc->exportCaption($this->Status);
                    $doc->exportCaption($this->Created);
                    $doc->exportCaption($this->Modified);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->Request_ID);
                        $doc->exportField($this->User_ID);
                        $doc->exportField($this->Item_ID);
                        $doc->exportField($this->Quantity);
                        $doc->exportField($this->Type);
                        $doc->exportField($this->Status);
                        $doc->exportField($this->Created);
                        $doc->exportField($this->Modified);
                    } else {
                        $doc->exportField($this->Request_ID);
                        $doc->exportField($this->User_ID);
                        $doc->exportField($this->Item_ID);
                        $doc->exportField($this->Quantity);
                        $doc->exportField($this->Type);
                        $doc->exportField($this->Status);
                        $doc->exportField($this->Created);
                        $doc->exportField($this->Modified);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->ExportDoc = &$doc;
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
