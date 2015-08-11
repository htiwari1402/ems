<div id="criteriaBar" style="display:inline-block;background-color: #3399FF;float:left;width:20%;border-top:1px solid #888888;color:#ffffff;">
Select Criteria
<hr>
<form id="partyWiseForm">
<table style="color:#ffffff;margin-top:2%;">
<tr>
<td>From :</td>
<td> <input type="text"  name="fromDate" id="fromDate"  class="date"></td>
</tr>
<tr>
<td>To :</td>
<td> <input type="text"  name="toDate" id="toDate"  class="date"></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">Select Party Type</td>
</tr>
<tr><td colspan="2">
<select name="type" id="type" onchange="loadAccessControlTypeID();">
<option value='HO'>Head Office</option>
<option value='Branch'>Branch</option>
<option value='CF'>C & F</option>
<option value='admin'>Admin</option>
</select></td>
</tr>
<tr>
<td colspan="2">Select Party Name</td>
</tr>
<tr>
<td colspan="2" id='accessControlTypeID'></td>
</tr>

</table><br/><br/><br/><br/></form>
<input type="button" value="Generate Report" onclick="generatePartWiseReport();">
</div>
<div id='mainReport' style="display:inline-block;background-color: #ffffff;float:left;border-top:1px solid #888888;width:79%">
</div>
<script>
$('#criteriaBar').height($('#main').height());
</script>