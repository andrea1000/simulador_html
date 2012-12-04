

function isNumberKey(evt) {
    var charCode = evt.which || event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function getCboTipoProductoCredito(object)
{var rutaXml="data.xml";
	$.get(rutaXml,function(xml)
	{
		$(xml).find("parametrica").each(function()
		{
			$(this).find("registro").each(function()
			{
			   var nParCodigo = $(this).find('nParCodigo').text();
			   var cParNombre = $(this).find('cParNombre').text();
			   if(nParCodigo>=14 && nParCodigo<=19)
			   {
			   	  $(object).append(new Option(cParNombre,nParCodigo));
			   }
			});
		});   
	});
}