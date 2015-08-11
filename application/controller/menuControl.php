<?php
include '../model/dao.php';
$action = $_REQUEST['a'];
$action();
function mainMenu()
{
	include "../view/menus/mainMenu.php";
}
function generalLedgerMenu()
{
	include "../view/menus/generalLedgerMenu.php";
}
function dcMenu()
{
	include "../view/menus/dcMenu.php";
}
function salesMenu()
{
	include "../view/menus/salesMenu.php";
}
function employee()
{
	include "../view/menus/employeeMenu.php";
}
function productMenu()
{
	include "../view/menus/productMenu.php";
}
function transportMenu()
{
	include "../view/menus/transportMenu.php";
}
function inventoryMenu()
{
	include "../view/menus/inventoryMenu.php";
}
function stockPurchaseMenu()
{
	include "../view/menus/stockPurchaseMenu.php";
}
function reportMasterMenu()
{
	include "../view/menus/reportMasterMenu.php";
}
function pricemasterMenu()
{
	include "../view/menus/pricemasterMenu.php";
}
function retailmasterMenu()
{
	include "../view/menus/retailMenu.php";
}
function accessControl()
{
	include "../view/menus/accessMenu.php";
}
?>