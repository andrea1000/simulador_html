var rutaXml="data.xml";

function isNumberKey(evt) {
    var charCode = evt.which || event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function getCboProducto(object)
{
	$.get(rutaXml,function(xml)
	{
		$(xml).find("parametrica").each(function()
		{
			$(this).find("registro").each(function()
			{
			   var nParCodigo = $(this).find('nParCodigo').text();
			   var cParNombre = $(this).find('cParNombre').text();
			   if(nParCodigo>=32 && nParCodigo<=42)
			   {
			   	  $(object).append(new Option(cParNombre,nParCodigo));
			   }
			});
		});   
	});
}

function getCboTipoProductoCredito(object)
{
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


function getCboAgencia(object)
{
	$.get(rutaXml,function(xml)
	{
		$(xml).find("parametrica").each(function()
		{
			$(this).find("registro").each(function()
			{
			   var nParCodigo = $(this).find('nParCodigo').text();
			   var cParNombre = $(this).find('cParNombre').text();
			   if(nParCodigo>=57 && nParCodigo<=72)
			   {
			   	  $(object).append(new Option(cParNombre,nParCodigo));
			   }
			});
		});   
	});
}


function getCboTasaGeneral(object)
{
	$.get(rutaXml,function(xml)
	{
		$(xml).find("parametrica").each(function()
		{
			$(this).find("registro").each(function()
			{
			   var nParCodigo = $(this).find('nParCodigo').text();
			   var cParNombre = $(this).find('cParNombre').text();
			   if(nParCodigo>=53 && nParCodigo<=54)
			   {
			   	  $(object).append(new Option(cParNombre,nParCodigo));
			   }
			});
		});   
	});
}