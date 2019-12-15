<?php
// This script and data application were generated by AppGini 5.81
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/invoice_items.php");
	include("$currDir/invoice_items_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('invoice_items');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "invoice_items";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`invoice_items`.`id`" => "id",
		"IF(    CHAR_LENGTH(`invoices1`.`code`), CONCAT_WS('',   `invoices1`.`code`), '') /* Invoice */" => "invoice",
		"IF(    CHAR_LENGTH(`items1`.`item_description`), CONCAT_WS('',   `items1`.`item_description`), '') /* Item */" => "item",
		"IF(    CHAR_LENGTH(`items1`.`unit_price`), CONCAT_WS('',   `items1`.`unit_price`), '') /* Current price */" => "current_price",
		"`invoice_items`.`catalog_price`" => "catalog_price",
		"FORMAT(`invoice_items`.`unit_price`, 2)" => "unit_price",
		"FORMAT(`invoice_items`.`qty`, 3)" => "qty",
		"`invoice_items`.`price`" => "price",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`invoice_items`.`id`',
		2 => '`invoices1`.`code`',
		3 => '`items1`.`item_description`',
		4 => '`items1`.`unit_price`',
		5 => '`invoice_items`.`catalog_price`',
		6 => '`invoice_items`.`unit_price`',
		7 => '`invoice_items`.`qty`',
		8 => '`invoice_items`.`price`',
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`invoice_items`.`id`" => "id",
		"IF(    CHAR_LENGTH(`invoices1`.`code`), CONCAT_WS('',   `invoices1`.`code`), '') /* Invoice */" => "invoice",
		"IF(    CHAR_LENGTH(`items1`.`item_description`), CONCAT_WS('',   `items1`.`item_description`), '') /* Item */" => "item",
		"IF(    CHAR_LENGTH(`items1`.`unit_price`), CONCAT_WS('',   `items1`.`unit_price`), '') /* Current price */" => "current_price",
		"`invoice_items`.`catalog_price`" => "catalog_price",
		"FORMAT(`invoice_items`.`unit_price`, 2)" => "unit_price",
		"FORMAT(`invoice_items`.`qty`, 3)" => "qty",
		"`invoice_items`.`price`" => "price",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`invoice_items`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`invoices1`.`code`), CONCAT_WS('',   `invoices1`.`code`), '') /* Invoice */" => "Invoice",
		"IF(    CHAR_LENGTH(`items1`.`item_description`), CONCAT_WS('',   `items1`.`item_description`), '') /* Item */" => "Item",
		"IF(    CHAR_LENGTH(`items1`.`unit_price`), CONCAT_WS('',   `items1`.`unit_price`), '') /* Current price */" => "Current price",
		"`invoice_items`.`catalog_price`" => "Catalog price at order date",
		"`invoice_items`.`unit_price`" => "Unit price",
		"`invoice_items`.`qty`" => "Qty",
		"`invoice_items`.`price`" => "Price",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`invoice_items`.`id`" => "id",
		"IF(    CHAR_LENGTH(`invoices1`.`code`), CONCAT_WS('',   `invoices1`.`code`), '') /* Invoice */" => "invoice",
		"IF(    CHAR_LENGTH(`items1`.`item_description`), CONCAT_WS('',   `items1`.`item_description`), '') /* Item */" => "item",
		"IF(    CHAR_LENGTH(`items1`.`unit_price`), CONCAT_WS('',   `items1`.`unit_price`), '') /* Current price */" => "current_price",
		"`invoice_items`.`catalog_price`" => "catalog_price",
		"FORMAT(`invoice_items`.`unit_price`, 2)" => "unit_price",
		"FORMAT(`invoice_items`.`qty`, 3)" => "qty",
		"`invoice_items`.`price`" => "price",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('invoice' => 'Invoice', 'item' => 'Item', );

	$x->QueryFrom = "`invoice_items` LEFT JOIN `invoices` as invoices1 ON `invoices1`.`id`=`invoice_items`.`invoice` LEFT JOIN `items` as items1 ON `items1`.`id`=`invoice_items`.`item` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "invoice_items_view.php";
	$x->RedirectAfterInsert = "invoice_items_view.php?SelectedID=#ID#";
	$x->TableTitle = "Invoice items";
	$x->TableIcon = "resources/table_icons/barcode.png";
	$x->PrimaryKey = "`invoice_items`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth   = array(  350, 80, 60, 80);
	$x->ColCaption = array("Item", "Unit price", "Qty", "Price");
	$x->ColFieldName = array('item', 'unit_price', 'qty', 'price');
	$x->ColNumber  = array(3, 6, 7, 8);

	// template paths below are based on the app main directory
	$x->Template = 'templates/invoice_items_templateTV.html';
	$x->SelectedTemplate = 'templates/invoice_items_templateTVS.html';
	$x->TemplateDV = 'templates/invoice_items_templateDV.html';
	$x->TemplateDVP = 'templates/invoice_items_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';
	$x->HasCalculatedFields = true;

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))) { $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])) { // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `invoice_items`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='invoice_items' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `invoice_items`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='invoice_items' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`invoice_items`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: invoice_items_init
	$render=TRUE;
	if(function_exists('invoice_items_init')) {
		$args=array();
		$render=invoice_items_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// column sums
	if(strpos($x->HTML, '<!-- tv data below -->')) {
		// if printing multi-selection TV, calculate the sum only for the selected records
		if(isset($_REQUEST['Print_x']) && is_array($_REQUEST['record_selector'])) {
			$QueryWhere = '';
			foreach($_REQUEST['record_selector'] as $id) {   // get selected records
				if($id != '') $QueryWhere .= "'" . makeSafe($id) . "',";
			}
			if($QueryWhere != '') {
				$QueryWhere = 'where `invoice_items`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select sum(`invoice_items`.`price`) from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="invoice_items-item"></td>';
			$sumRow .= '<td class="invoice_items-unit_price"></td>';
			$sumRow .= '<td class="invoice_items-qty"></td>';
			$sumRow .= "<td class=\"invoice_items-price text-right\">{$row[0]}</td>";
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: invoice_items_header
	$headerCode='';
	if(function_exists('invoice_items_header')) {
		$args=array();
		$headerCode=invoice_items_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: invoice_items_footer
	$footerCode='';
	if(function_exists('invoice_items_footer')) {
		$args=array();
		$footerCode=invoice_items_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>