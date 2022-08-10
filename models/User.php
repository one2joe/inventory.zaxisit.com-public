<?php

namespace PHPMaker2022\inventory;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for user
 */
class User extends DbTable
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
    public $User_ID;
    public $User_Level_ID;
    public $Nickname;
    public $Name;
    public $_Username;
    public $_Password;
    public $Phone;
    public $Address;
    public $_Email;
    public $Image;
    public $Enable;
    public $Branch_ID;
    public $Parent_User_ID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'user';
        $this->TableName = 'user';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`user`";
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
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // User_ID
        $this->User_ID = new DbField(
            'user',
            'user',
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
            'NO'
        );
        $this->User_ID->InputTextType = "text";
        $this->User_ID->IsAutoIncrement = true; // Autoincrement field
        $this->User_ID->IsPrimaryKey = true; // Primary key field
        $this->User_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['User_ID'] = &$this->User_ID;

        // User_Level_ID
        $this->User_Level_ID = new DbField(
            'user',
            'user',
            'x_User_Level_ID',
            'User_Level_ID',
            '`User_Level_ID`',
            '`User_Level_ID`',
            3,
            11,
            -1,
            false,
            '`User_Level_ID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->User_Level_ID->InputTextType = "text";
        $this->User_Level_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->User_Level_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->User_Level_ID->Lookup = new Lookup('User_Level_ID', 'user_level2', false, 'User_Level_ID', ["User_Level_Name","","",""], [], [], [], [], [], [], '', '', "`User_Level_Name`");
        $this->User_Level_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['User_Level_ID'] = &$this->User_Level_ID;

        // Nickname
        $this->Nickname = new DbField(
            'user',
            'user',
            'x_Nickname',
            'Nickname',
            '`Nickname`',
            '`Nickname`',
            200,
            255,
            -1,
            false,
            '`Nickname`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Nickname->InputTextType = "text";
        $this->Nickname->Required = true; // Required field
        $this->Fields['Nickname'] = &$this->Nickname;

        // Name
        $this->Name = new DbField(
            'user',
            'user',
            'x_Name',
            'Name',
            '`Name`',
            '`Name`',
            200,
            255,
            -1,
            false,
            '`Name`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Name->InputTextType = "text";
        $this->Name->Required = true; // Required field
        $this->Fields['Name'] = &$this->Name;

        // Username
        $this->_Username = new DbField(
            'user',
            'user',
            'x__Username',
            'Username',
            '`Username`',
            '`Username`',
            200,
            255,
            -1,
            false,
            '`Username`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_Username->InputTextType = "text";
        $this->_Username->Required = true; // Required field
        $this->Fields['Username'] = &$this->_Username;

        // Password
        $this->_Password = new DbField(
            'user',
            'user',
            'x__Password',
            'Password',
            '`Password`',
            '`Password`',
            200,
            255,
            -1,
            false,
            '`Password`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'PASSWORD'
        );
        $this->_Password->InputTextType = "text";
        if (Config("ENCRYPTED_PASSWORD")) {
            $this->_Password->Raw = true;
        }
        $this->_Password->Required = true; // Required field
        $this->Fields['Password'] = &$this->_Password;

        // Phone
        $this->Phone = new DbField(
            'user',
            'user',
            'x_Phone',
            'Phone',
            '`Phone`',
            '`Phone`',
            200,
            255,
            -1,
            false,
            '`Phone`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Phone->InputTextType = "text";
        $this->Fields['Phone'] = &$this->Phone;

        // Address
        $this->Address = new DbField(
            'user',
            'user',
            'x_Address',
            'Address',
            '`Address`',
            '`Address`',
            200,
            255,
            -1,
            false,
            '`Address`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Address->InputTextType = "text";
        $this->Fields['Address'] = &$this->Address;

        // Email
        $this->_Email = new DbField(
            'user',
            'user',
            'x__Email',
            'Email',
            '`Email`',
            '`Email`',
            200,
            255,
            -1,
            false,
            '`Email`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_Email->InputTextType = "text";
        $this->Fields['Email'] = &$this->_Email;

        // Image
        $this->Image = new DbField(
            'user',
            'user',
            'x_Image',
            'Image',
            '`Image`',
            '`Image`',
            200,
            255,
            -1,
            true,
            '`Image`',
            false,
            false,
            false,
            'IMAGE',
            'FILE'
        );
        $this->Image->InputTextType = "text";
        $this->Image->UploadPath = "../img/user/";
        $this->Fields['Image'] = &$this->Image;

        // Enable
        $this->Enable = new DbField(
            'user',
            'user',
            'x_Enable',
            'Enable',
            '`Enable`',
            '`Enable`',
            202,
            1,
            -1,
            false,
            '`Enable`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->Enable->InputTextType = "text";
        $this->Enable->DataType = DATATYPE_BOOLEAN;
        $this->Enable->Lookup = new Lookup('Enable', 'user', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->Enable->OptionCount = 2;
        $this->Fields['Enable'] = &$this->Enable;

        // Branch_ID
        $this->Branch_ID = new DbField(
            'user',
            'user',
            'x_Branch_ID',
            'Branch_ID',
            '`Branch_ID`',
            '`Branch_ID`',
            3,
            11,
            -1,
            false,
            '`Branch_ID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Branch_ID->InputTextType = "text";
        $this->Branch_ID->Sortable = false; // Allow sort
        $this->Branch_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Branch_ID'] = &$this->Branch_ID;

        // Parent_User_ID
        $this->Parent_User_ID = new DbField(
            'user',
            'user',
            'x_Parent_User_ID',
            'Parent_User_ID',
            '`Parent_User_ID`',
            '`Parent_User_ID`',
            3,
            11,
            -1,
            false,
            '`Parent_User_ID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Parent_User_ID->InputTextType = "text";
        $this->Parent_User_ID->Sortable = false; // Allow sort
        $this->Parent_User_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Parent_User_ID'] = &$this->Parent_User_ID;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`user`";
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
        global $Security;
        // Add User ID filter
        if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
            $filter = $this->addUserIDFilter($filter, $id);
        }
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
            if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                $value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
            $this->User_ID->setDbValue($conn->lastInsertId());
            $rs['User_ID'] = $this->User_ID->DbValue;
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
            if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                if ($value == $this->Fields[$name]->OldValue) { // No need to update hashed password if not changed
                    continue;
                }
                $value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
            if (array_key_exists('User_ID', $rs)) {
                AddFilter($where, QuotedName('User_ID', $this->Dbid) . '=' . QuotedValue($rs['User_ID'], $this->User_ID->DataType, $this->Dbid));
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
        $this->User_ID->DbValue = $row['User_ID'];
        $this->User_Level_ID->DbValue = $row['User_Level_ID'];
        $this->Nickname->DbValue = $row['Nickname'];
        $this->Name->DbValue = $row['Name'];
        $this->_Username->DbValue = $row['Username'];
        $this->_Password->DbValue = $row['Password'];
        $this->Phone->DbValue = $row['Phone'];
        $this->Address->DbValue = $row['Address'];
        $this->_Email->DbValue = $row['Email'];
        $this->Image->Upload->DbValue = $row['Image'];
        $this->Enable->DbValue = $row['Enable'];
        $this->Branch_ID->DbValue = $row['Branch_ID'];
        $this->Parent_User_ID->DbValue = $row['Parent_User_ID'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
        $this->Image->OldUploadPath = "../img/user/";
        $oldFiles = EmptyValue($row['Image']) ? [] : [$row['Image']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->Image->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->Image->oldPhysicalUploadPath() . $oldFile);
            }
        }
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`User_ID` = @User_ID@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->User_ID->CurrentValue : $this->User_ID->OldValue;
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
                $this->User_ID->CurrentValue = $keys[0];
            } else {
                $this->User_ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('User_ID', $row) ? $row['User_ID'] : null;
        } else {
            $val = $this->User_ID->OldValue !== null ? $this->User_ID->OldValue : $this->User_ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@User_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("UserList");
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
        if ($pageName == "UserView") {
            return $Language->phrase("View");
        } elseif ($pageName == "UserEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "UserAdd") {
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
                return "UserView";
            case Config("API_ADD_ACTION"):
                return "UserAdd";
            case Config("API_EDIT_ACTION"):
                return "UserEdit";
            case Config("API_DELETE_ACTION"):
                return "UserDelete";
            case Config("API_LIST_ACTION"):
                return "UserList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "UserList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("UserView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("UserView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "UserAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "UserAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("UserEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("UserAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("UserDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"User_ID\":" . JsonEncode($this->User_ID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->User_ID->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->User_ID->CurrentValue);
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
            if (($keyValue = Param("User_ID") ?? Route("User_ID")) !== null) {
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
                $this->User_ID->CurrentValue = $key;
            } else {
                $this->User_ID->OldValue = $key;
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
        $this->User_ID->setDbValue($row['User_ID']);
        $this->User_Level_ID->setDbValue($row['User_Level_ID']);
        $this->Nickname->setDbValue($row['Nickname']);
        $this->Name->setDbValue($row['Name']);
        $this->_Username->setDbValue($row['Username']);
        $this->_Password->setDbValue($row['Password']);
        $this->Phone->setDbValue($row['Phone']);
        $this->Address->setDbValue($row['Address']);
        $this->_Email->setDbValue($row['Email']);
        $this->Image->Upload->DbValue = $row['Image'];
        $this->Enable->setDbValue($row['Enable']);
        $this->Branch_ID->setDbValue($row['Branch_ID']);
        $this->Parent_User_ID->setDbValue($row['Parent_User_ID']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // User_ID
        $this->User_ID->CellCssStyle = "white-space: nowrap;";

        // User_Level_ID
        $this->User_Level_ID->CellCssStyle = "white-space: nowrap;";

        // Nickname
        $this->Nickname->CellCssStyle = "white-space: nowrap;";

        // Name
        $this->Name->CellCssStyle = "white-space: nowrap;";

        // Username
        $this->_Username->CellCssStyle = "white-space: nowrap;";

        // Password
        $this->_Password->CellCssStyle = "white-space: nowrap;";

        // Phone
        $this->Phone->CellCssStyle = "white-space: nowrap;";

        // Address
        $this->Address->CellCssStyle = "white-space: nowrap;";

        // Email
        $this->_Email->CellCssStyle = "white-space: nowrap;";

        // Image
        $this->Image->CellCssStyle = "white-space: nowrap;";

        // Enable
        $this->Enable->CellCssStyle = "text-align: center; white-space: nowrap;";

        // Branch_ID
        $this->Branch_ID->CellCssStyle = "white-space: nowrap;";

        // Parent_User_ID
        $this->Parent_User_ID->CellCssStyle = "white-space: nowrap;";

        // User_ID
        $this->User_ID->ViewValue = $this->User_ID->CurrentValue;
        $this->User_ID->ViewCustomAttributes = "";

        // User_Level_ID
        if ($Security->canAdmin()) { // System admin
            $curVal = strval($this->User_Level_ID->CurrentValue);
            if ($curVal != "") {
                $this->User_Level_ID->ViewValue = $this->User_Level_ID->lookupCacheOption($curVal);
                if ($this->User_Level_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "`User_Level_ID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->User_Level_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->User_Level_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->User_Level_ID->ViewValue = $this->User_Level_ID->displayValue($arwrk);
                    } else {
                        $this->User_Level_ID->ViewValue = $this->User_Level_ID->CurrentValue;
                    }
                }
            } else {
                $this->User_Level_ID->ViewValue = null;
            }
        } else {
            $this->User_Level_ID->ViewValue = $Language->phrase("PasswordMask");
        }
        $this->User_Level_ID->ViewCustomAttributes = "";

        // Nickname
        $this->Nickname->ViewValue = $this->Nickname->CurrentValue;
        $this->Nickname->ViewCustomAttributes = "";

        // Name
        $this->Name->ViewValue = $this->Name->CurrentValue;
        $this->Name->ViewCustomAttributes = "";

        // Username
        $this->_Username->ViewValue = $this->_Username->CurrentValue;
        $this->_Username->ViewCustomAttributes = "";

        // Password
        $this->_Password->ViewValue = $Language->phrase("PasswordMask");
        $this->_Password->ViewCustomAttributes = "";

        // Phone
        $this->Phone->ViewValue = $this->Phone->CurrentValue;
        $this->Phone->ViewCustomAttributes = "";

        // Address
        $this->Address->ViewValue = $this->Address->CurrentValue;
        $this->Address->ViewCustomAttributes = "";

        // Email
        $this->_Email->ViewValue = $this->_Email->CurrentValue;
        $this->_Email->ViewCustomAttributes = "";

        // Image
        $this->Image->UploadPath = "../img/user/";
        if (!EmptyValue($this->Image->Upload->DbValue)) {
            $this->Image->ImageWidth = 150;
            $this->Image->ImageHeight = 0;
            $this->Image->ImageAlt = $this->Image->alt();
            $this->Image->ImageCssClass = "ew-image";
            $this->Image->ViewValue = $this->Image->Upload->DbValue;
        } else {
            $this->Image->ViewValue = "";
        }
        $this->Image->ViewCustomAttributes = "";

        // Enable
        if (ConvertToBool($this->Enable->CurrentValue)) {
            $this->Enable->ViewValue = $this->Enable->tagCaption(1) != "" ? $this->Enable->tagCaption(1) : "1";
        } else {
            $this->Enable->ViewValue = $this->Enable->tagCaption(2) != "" ? $this->Enable->tagCaption(2) : "0";
        }
        $this->Enable->ViewCustomAttributes = "";

        // Branch_ID
        $this->Branch_ID->ViewValue = $this->Branch_ID->CurrentValue;
        $this->Branch_ID->ViewCustomAttributes = "";

        // Parent_User_ID
        $this->Parent_User_ID->ViewValue = $this->Parent_User_ID->CurrentValue;
        $this->Parent_User_ID->ViewValue = FormatNumber($this->Parent_User_ID->ViewValue, $this->Parent_User_ID->formatPattern());
        $this->Parent_User_ID->ViewCustomAttributes = "";

        // User_ID
        $this->User_ID->LinkCustomAttributes = "";
        $this->User_ID->HrefValue = "";
        $this->User_ID->TooltipValue = "";

        // User_Level_ID
        $this->User_Level_ID->LinkCustomAttributes = "";
        $this->User_Level_ID->HrefValue = "";
        $this->User_Level_ID->TooltipValue = "";

        // Nickname
        $this->Nickname->LinkCustomAttributes = "";
        $this->Nickname->HrefValue = "";
        $this->Nickname->TooltipValue = "";

        // Name
        $this->Name->LinkCustomAttributes = "";
        $this->Name->HrefValue = "";
        $this->Name->TooltipValue = "";

        // Username
        $this->_Username->LinkCustomAttributes = "";
        $this->_Username->HrefValue = "";
        $this->_Username->TooltipValue = "";

        // Password
        $this->_Password->LinkCustomAttributes = "";
        $this->_Password->HrefValue = "";
        $this->_Password->TooltipValue = "";

        // Phone
        $this->Phone->LinkCustomAttributes = "";
        $this->Phone->HrefValue = "";
        $this->Phone->TooltipValue = "";

        // Address
        $this->Address->LinkCustomAttributes = "";
        $this->Address->HrefValue = "";
        $this->Address->TooltipValue = "";

        // Email
        $this->_Email->LinkCustomAttributes = "";
        $this->_Email->HrefValue = "";
        $this->_Email->TooltipValue = "";

        // Image
        $this->Image->LinkCustomAttributes = "";
        $this->Image->HrefValue = "";
        $this->Image->ExportHrefValue = $this->Image->UploadPath . $this->Image->Upload->DbValue;
        $this->Image->TooltipValue = "";
        if ($this->Image->UseColorbox) {
            if (EmptyValue($this->Image->TooltipValue)) {
                $this->Image->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
            }
            $this->Image->LinkAttrs["data-rel"] = "user_x_Image";
            $this->Image->LinkAttrs->appendClass("ew-lightbox");
        }

        // Enable
        $this->Enable->LinkCustomAttributes = "";
        $this->Enable->HrefValue = "";
        $this->Enable->TooltipValue = "";

        // Branch_ID
        $this->Branch_ID->LinkCustomAttributes = "";
        $this->Branch_ID->HrefValue = "";
        $this->Branch_ID->TooltipValue = "";

        // Parent_User_ID
        $this->Parent_User_ID->LinkCustomAttributes = "";
        $this->Parent_User_ID->HrefValue = "";
        $this->Parent_User_ID->TooltipValue = "";

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

        // User_ID
        $this->User_ID->setupEditAttributes();
        $this->User_ID->EditCustomAttributes = "";
        $this->User_ID->EditValue = $this->User_ID->CurrentValue;
        $this->User_ID->ViewCustomAttributes = "";

        // User_Level_ID
        $this->User_Level_ID->setupEditAttributes();
        $this->User_Level_ID->EditCustomAttributes = "";
        if (!$Security->canAdmin()) { // System admin
            $this->User_Level_ID->EditValue = $Language->phrase("PasswordMask");
        } else {
            $this->User_Level_ID->PlaceHolder = RemoveHtml($this->User_Level_ID->title());
        }

        // Nickname
        $this->Nickname->setupEditAttributes();
        $this->Nickname->EditCustomAttributes = "";
        if (!$this->Nickname->Raw) {
            $this->Nickname->CurrentValue = HtmlDecode($this->Nickname->CurrentValue);
        }
        $this->Nickname->EditValue = $this->Nickname->CurrentValue;
        $this->Nickname->PlaceHolder = RemoveHtml($this->Nickname->title());

        // Name
        $this->Name->setupEditAttributes();
        $this->Name->EditCustomAttributes = "";
        if (!$this->Name->Raw) {
            $this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
        }
        $this->Name->EditValue = $this->Name->CurrentValue;
        $this->Name->PlaceHolder = RemoveHtml($this->Name->title());

        // Username
        $this->_Username->setupEditAttributes();
        $this->_Username->EditCustomAttributes = "";
        if (!$this->_Username->Raw) {
            $this->_Username->CurrentValue = HtmlDecode($this->_Username->CurrentValue);
        }
        $this->_Username->EditValue = $this->_Username->CurrentValue;
        $this->_Username->PlaceHolder = RemoveHtml($this->_Username->title());

        // Password
        $this->_Password->setupEditAttributes();
        $this->_Password->EditCustomAttributes = "";
        $this->_Password->EditValue = $Language->phrase("PasswordMask"); // Show as masked password
        $this->_Password->PlaceHolder = RemoveHtml($this->_Password->title());

        // Phone
        $this->Phone->setupEditAttributes();
        $this->Phone->EditCustomAttributes = "";
        if (!$this->Phone->Raw) {
            $this->Phone->CurrentValue = HtmlDecode($this->Phone->CurrentValue);
        }
        $this->Phone->EditValue = $this->Phone->CurrentValue;
        $this->Phone->PlaceHolder = RemoveHtml($this->Phone->title());

        // Address
        $this->Address->setupEditAttributes();
        $this->Address->EditCustomAttributes = "";
        if (!$this->Address->Raw) {
            $this->Address->CurrentValue = HtmlDecode($this->Address->CurrentValue);
        }
        $this->Address->EditValue = $this->Address->CurrentValue;
        $this->Address->PlaceHolder = RemoveHtml($this->Address->title());

        // Email
        $this->_Email->setupEditAttributes();
        $this->_Email->EditCustomAttributes = "";
        if (!$this->_Email->Raw) {
            $this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
        }
        $this->_Email->EditValue = $this->_Email->CurrentValue;
        $this->_Email->PlaceHolder = RemoveHtml($this->_Email->title());

        // Image
        $this->Image->setupEditAttributes();
        $this->Image->EditCustomAttributes = "";
        $this->Image->UploadPath = "../img/user/";
        if (!EmptyValue($this->Image->Upload->DbValue)) {
            $this->Image->ImageWidth = 150;
            $this->Image->ImageHeight = 0;
            $this->Image->ImageAlt = $this->Image->alt();
            $this->Image->ImageCssClass = "ew-image";
            $this->Image->EditValue = $this->Image->Upload->DbValue;
        } else {
            $this->Image->EditValue = "";
        }
        if (!EmptyValue($this->Image->CurrentValue)) {
            $this->Image->Upload->FileName = $this->Image->CurrentValue;
        }

        // Enable
        $this->Enable->EditCustomAttributes = "";
        $this->Enable->EditValue = $this->Enable->options(false);
        $this->Enable->PlaceHolder = RemoveHtml($this->Enable->title());

        // Branch_ID
        $this->Branch_ID->setupEditAttributes();
        $this->Branch_ID->EditCustomAttributes = "";
        $this->Branch_ID->EditValue = $this->Branch_ID->CurrentValue;
        $this->Branch_ID->PlaceHolder = RemoveHtml($this->Branch_ID->title());
        if (strval($this->Branch_ID->EditValue) != "" && is_numeric($this->Branch_ID->EditValue)) {
            $this->Branch_ID->EditValue = $this->Branch_ID->EditValue;
        }

        // Parent_User_ID
        $this->Parent_User_ID->setupEditAttributes();
        $this->Parent_User_ID->EditCustomAttributes = "";
        $this->Parent_User_ID->EditValue = $this->Parent_User_ID->CurrentValue;
        $this->Parent_User_ID->PlaceHolder = RemoveHtml($this->Parent_User_ID->title());
        if (strval($this->Parent_User_ID->EditValue) != "" && is_numeric($this->Parent_User_ID->EditValue)) {
            $this->Parent_User_ID->EditValue = FormatNumber($this->Parent_User_ID->EditValue, null);
        }

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
                    $doc->exportCaption($this->User_ID);
                    $doc->exportCaption($this->User_Level_ID);
                    $doc->exportCaption($this->Nickname);
                    $doc->exportCaption($this->Name);
                    $doc->exportCaption($this->_Username);
                    $doc->exportCaption($this->_Password);
                    $doc->exportCaption($this->Phone);
                    $doc->exportCaption($this->Enable);
                } else {
                    $doc->exportCaption($this->User_ID);
                    $doc->exportCaption($this->User_Level_ID);
                    $doc->exportCaption($this->Nickname);
                    $doc->exportCaption($this->Name);
                    $doc->exportCaption($this->_Username);
                    $doc->exportCaption($this->_Password);
                    $doc->exportCaption($this->Phone);
                    $doc->exportCaption($this->Address);
                    $doc->exportCaption($this->_Email);
                    $doc->exportCaption($this->Image);
                    $doc->exportCaption($this->Enable);
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
                        $doc->exportField($this->User_ID);
                        $doc->exportField($this->User_Level_ID);
                        $doc->exportField($this->Nickname);
                        $doc->exportField($this->Name);
                        $doc->exportField($this->_Username);
                        $doc->exportField($this->_Password);
                        $doc->exportField($this->Phone);
                        $doc->exportField($this->Enable);
                    } else {
                        $doc->exportField($this->User_ID);
                        $doc->exportField($this->User_Level_ID);
                        $doc->exportField($this->Nickname);
                        $doc->exportField($this->Name);
                        $doc->exportField($this->_Username);
                        $doc->exportField($this->_Password);
                        $doc->exportField($this->Phone);
                        $doc->exportField($this->Address);
                        $doc->exportField($this->_Email);
                        $doc->exportField($this->Image);
                        $doc->exportField($this->Enable);
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

    // User ID filter
    public function getUserIDFilter($userId)
    {
        global $Security;
        $userIdFilter = '`User_ID` = ' . QuotedValue($userId, DATATYPE_NUMBER, Config("USER_TABLE_DBID"));
        return $userIdFilter;
    }

    // Add User ID filter
    public function addUserIDFilter($filter = "", $id = "")
    {
        global $Security;
        $filterWrk = "";
        if ($id == "")
            $id = (CurrentPageID() == "list") ? $this->CurrentAction : CurrentPageID();
        if (!$this->userIDAllow($id) && !$Security->isAdmin()) {
            $filterWrk = $Security->userIdList();
            if ($filterWrk != "") {
                $filterWrk = '`User_ID` IN (' . $filterWrk . ')';
            }
        }

        // Call User ID Filtering event
        $this->userIdFiltering($filterWrk);
        AddFilter($filter, $filterWrk);
        return $filter;
    }

    // User ID subquery
    public function getUserIDSubquery(&$fld, &$masterfld)
    {
        global $UserTable;
        $wrk = "";
        $sql = "SELECT " . $masterfld->Expression . " FROM `user`";
        $filter = $this->addUserIDFilter("");
        if ($filter != "") {
            $sql .= " WHERE " . $filter;
        }

        // List all values
        $conn = Conn($UserTable->Dbid);
        $config = $conn->getConfiguration();
        $config->setResultCacheImpl($this->Cache);
        if ($rs = $conn->executeCacheQuery($sql, [], [], $this->CacheProfile)->fetchAllNumeric()) {
            foreach ($rs as $row) {
                if ($wrk != "") {
                    $wrk .= ",";
                }
                $wrk .= QuotedValue($row[0], $masterfld->DataType, Config("USER_TABLE_DBID"));
            }
        }
        if ($wrk != "") {
            $wrk = $fld->Expression . " IN (" . $wrk . ")";
        } else { // No User ID value found
            $wrk = "0=1";
        }
        return $wrk;
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'Image') {
            $fldName = "Image";
            $fileNameFld = "Image";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->User_ID->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssociative($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DATATYPE_BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                        $pathinfo = pathinfo($fileName);
                        $ext = strtolower(@$pathinfo["extension"]);
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment" . ($DownloadFileName ? "; filename=\"" . $DownloadFileName . "\"" : ""));
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
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
