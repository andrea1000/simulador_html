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

$.get("data.xml",function(xml)
{
	$(xml).find("parametrica").each(function()
	{
		$(this).find("registro").each(function()
		{
		   var name = $(this).find('nParCodigo').text();
		   $("#display").append(name+"<br/>");
		});
    });   
});

</script>
<div id="display">
</div>
<?php
include 'footer.php';
?>