<?php 
function fetch($sql)
{
	$result = mysql_query($sql);
	$return = array();
	while($row = mysql_fetch_array($result))
	{
		$return[] = $row;
	}
	return $return;
	 
}

function optionMaker($inputArray,$key,$data)
{
	$returnString = 'select:select;';
	foreach($inputArray as $k=>$d)
	{
		$returnString .= $d[$key].":".$d[$data].";";
	}
	return substr($returnString,0,strlen($returnString)-1);
}