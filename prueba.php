<?php
	if (file_exists('data.xml'))
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
	}
?>