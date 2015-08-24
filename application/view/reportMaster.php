<div id="tabs"  style="width:95%;">
  <ul>
    <li><a href="#tabs-1">Brand Wise</a></li>
    <li><a href="#tabs-2">Product Wise</a></li>
    <li><a href="#tabs-3">State Wise</a></li>
    <li><a href="#tabs-4">City Wise</a></li>
    <li><a href="#tabs-5">Distributor Wise</a></li>
    <li><a href="#tabs-6">Category Wise</a></li>
    <li><a href="#tabs-7">Sub Category Wise</a></li>
  </ul>
  <div id="tabs-1">
<?php include "brandWiseReport.php"; ?>
  </div>
  <div id="tabs-2">
<?php include "productWiseReport.php"; ?>
  </div>
  <div id="tabs-3">
<?php include "stateWiseReport.php"; ?>
  </div>
  <div id="tabs-4">
<?php include "cityWiseReport.php"; ?>
  </div>
    <div id="tabs-5">
<?php include "distWiseReport.php"; ?>
  </div>
    <div id="tabs-6">
<?php include "categoryWiseReport.php"; ?>
  </div>
   <div id="tabs-7">
<?php include "subCategoryWiseReport.php"; ?>
  </div>
</div>

<script>
  $(function() {
    $( "#tabs" ).tabs();//.addClass( "ui-tabs-vertical ui-helper-clearfix" );
    //$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
  });
  </script>
  <style>
  .ui-tabs-vertical { width: 15%; }
  .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 15%;; }
  .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 99%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
  .ui-tabs-vertical .ui-tabs-nav li a { display:block; }
  .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0em; padding-right: .1em; border-right-width: 0px; width: 99%; }
  .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 80%;}
  </style>