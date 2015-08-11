<?php 
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBubble startBubble' onclick="getTaxMaster();">
<img  src='./image/tax.png' height='50' width='50'><br>
Tax 
</div>
<?php }
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBubble' onclick='getDcMaster();'>
<img  src='./image/stakeholder.png' height='50' width='50'><br>
Stakeholder
</div>
<?php }
?>
<div class='mainMenuBubble' onclick="getSales();">
<img  src='./image/sales.png' height='50' width='50'><br>
Sales
</div>
<?php 
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBubble' onclick="getDistributorMaster();">
<img  src='./image/distributor.png' height='50' width='50'><br>
Distributor
</div>
<?php 
}
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBubble' onclick='getEmployee();'>
<img  src='./image/employee.png' height='50' width='50'><br>
Employees
</div>
<?php 
}
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBubble' onclick="getProductMaster();">
<img  src='./image/product.png' height='50' width='50'><br>
Product
</div>
<?php 
}
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBubble' onclick="getTransportMaster()">
<img  src='./image/transport.png' height='50' width='50'><br>
Transporter
</div>
<?php 
}
?>
<div class='mainMenuBubble' onclick='getInventory();'>
<img  src='./image/inventory.png' height='50' width='50'><br>
Inventory
</div>
<?php 

if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBubble' onclick='getStockPurchase();'>
<img  src='./image/purchase.png' height='50' width='50'><br>
Purchase
</div>
<?php 
}
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='mainMenuBubble' onclick='getReportMaster();'>
<img  src='./image/reports.png' height='50' width='50'><br>
Reports<br>
</div>
<?php
 }
 if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
 {
 	?>
 <div class='mainMenuBubble' onclick='getPriceMaster();'>
 <img  src='./image/price.png' height='50' width='50'><br>
Price<br>
 </div>
 <?php
  }
  if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
  {
  	?>
   <div class='mainMenuBubble' onclick='getAccessControl();'>
   <img  src='./image/access.png' height='50' width='50'><br>
  Access<br>
   </div>
   <?php
    }
    if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
    {
    	?>
       <div class='mainMenuBubble' onclick='getRetailerMaster();'>
       <img  src='./image/retail.png' height='50' width='50'><br>
      Retail<br>
       </div>
       <?php
        }
 ?>