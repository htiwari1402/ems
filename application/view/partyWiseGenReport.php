<style>
#debtorDetail 
{
border : 1px solid #EEEEEE;
}
</style>
<table id="debtorDetail" style="font-size:14px;margin-top:2%;width:90%;margin-left:1%;" cellspacing="0" border=1 >
<tr style="background-color:#FAFFBD;">
<td>Party Name</td>
<td>Contact Person</td>
<td>Contact Number</td>
<td>Associated Officer</td>
<td>Address</td>
<td>Party Contact Number</td>
<td>Fax</td>
<td>Email</td>
</tr>
<tr>
<td><?php echo $debtorDetails['partyName']; ?></td>
<td><?php echo $debtorDetails['contactPerson']; ?></td>
<td><?php echo $debtorDetails['contactNumber']; ?></td>
<td><?php echo $debtorDetails['associatedOfficer']; ?></td>
<td><?php echo $debtorDetails['address']; ?></td>
<td><?php echo $debtorDetails['partyContactNumber']; ?></td>
<td><?php echo $debtorDetails['fax']; ?></td>
<td><?php echo $debtorDetails['email']; ?></td>
</tr>
</table>