<div class='menuBubble' onclick="getInventory();">
Stock<br>Transfer
</div>
<div class='menuBubble' onclick="getStockTransferReport();">
Stock Transfer<br>Report
</div>
<?php 
if($_SESSION['type'] == 'HO' || $_SESSION['type'] == 'admin' )
{
?>
<div class='menuBubble' onclick="getWarehouseMaster();">
Warehouse<br>Master
</div>
<div class='menuBubble' onclick="getInventoryManagement();">
Inventory<br>Management
</div>
<div class='menuBubble' onclick="getStockInvoiceMaster();">
Edit Stock <br>
Transfer
</div>
<?php }
else  if($_SESSION['type'] != 'HO' &&  $_SESSION['type'] != 'admin' )
{
?>
<div class='menuBubble' onclick="getPartyInventory();">
Inventory<br>Management
</div>
<?php
 }
?>


