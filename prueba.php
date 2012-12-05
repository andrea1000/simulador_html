<?php
	/*if (file_exists('data.xml'))
	{
		$xml = simplexml_load_file("data.xml");
	}
	else
	{
		exit('Error!..');
	}

	foreach($xml->parametrica->registro as $child)
	{
		echo $child->getName() . "->" . $child->nParCodigo . "<br>";
	}*/
?>
<?php
$cabecera = '<script src="Script/Script.js" type="text/javascript"></script>';
include 'header.php';
?>

<script>

/*$.get("data.xml",function(xml)
{
	$(xml).find("parametrica").each(function()
	{
		$(this).find("registro").each(function()
		{
		   var name = $(this).find('nParCodigo').text();
		   $("#display").append(name+"<br/>");
		});
    });   
});*/
$(function()
{
	var values=Array();
	
	values[14]=[32,42];
	values[15]=[43,44];
	values[16]=[32,42];
	values[17]=[32,42];
	values[18]=[32,42];
	values[19]=[32,42];
	
	var irango=values[14][0];
	$("#display").append(irango+"<br/>");
});

</script>
<div id="display">
</div>
<?php
include 'footer.php';
?>