<div style="width:70%;margin-top:3%;">
<?php 
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBlock startBubble' onclick="getTaxMaster();">
<img  src='./image/tax.png' height='85' width='85'><br>
Tax Structure
</div>
<?php }
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBlock' onclick='getDcMaster();'>
<img  src='./image/stakeholder.png' height='85' width='85'><br>
Stakeholder
</div>
<?php }
?>
<div class='mainMenuBlock' onclick="getSales();">
<img  src='./image/sales.png' height='85' width='85'><br>
Sales
</div>
<?php 
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBlock' onclick="getDistributorMaster();">
<img  src='./image/distributor.png' height='85' width='85'><br>
Distributor
</div>
<?php }
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBlock' onclick='getEmployee();'>
<img  src='./image/employee.png' height='85' width='85'><br>
Employees
</div>
<?php }
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBlock' onclick="getProductMaster();">
<img  src='./image/product.png' height='85' width='85'><br>
Product
</div>
<?php }
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBlock' onclick="getTransportMaster()">
<img  src='./image/transport.png' height='85' width='85'><br>
Transporter
</div>
<?php }
?>
<div class='mainMenuBlock' onclick='getInventory();'>
<img  src='./image/inventory.png' height='85' width='85'><br>
Inventory
</div>
<?php 
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBlock' onclick='getStockPurchase();'>
<img  src='./image/purchase.png' height='85' width='85'><br>
Purchase
</div>
<?php }
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBlock' onclick='getReportMaster();'>
<img  src='./image/reports.png' height='85' width='85'><br>
Reports
</div>

<?php }
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
	?>
<div class='mainMenuBlock' onclick='getPriceMaster();'>
<img  src='./image/price.png' height='85' width='85'><br>
Price Master
</div>

<?php }
if($_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBlock' onclick='getAccessControl();'>
<img  src='./image/access.png' height='85' width='85'><br>
Access Control
</div>
<?php }
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin'  )
{
?>
<div class='mainMenuBlock' onclick='getRetailerMaster();'>
<img  src='./image/retail.png' height='85' width='85'><br>
Retail Master
</div>
<?php }?>
</div>