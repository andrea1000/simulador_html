var rutaXml="data.xml";

function isNumberKey(evt) {
    var charCode = evt.which || event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function imprimir()
{
	if(!($("#txtMonto").val()>=1 && $("#txtMonto").val()<=5000000))
	{
		alert("El rango del monto debe ser de 1 a 5000000");
		$("txtMonto").focus();
		return false;
	}
	
	if(!($("#txtPlazo").val()>=1 && $("#txtPlazo").val()<=3600))
	{
		alert("El rango del plazo debe ser de 1 a 3600");
		$("txtMonto").focus();
		return false;
	}
	return true;
}

function validarDeposito()
{
	if(!($("#txtMonto").val()>=1 && $("#txtMonto").val()<=5000000))
	{
		alert("El rango del monto debe ser de 1 a 5000000");
		$("txtMonto").focus();
		return false;
	}
	
	if(!($("#txtPlazo").val()>=1 && $("#txtPlazo").val()<=3600))
	{
		alert("El rango del plazo debe ser de 1 a 3600");
		$("txtMonto").focus();
		return false;
	}
	return true;
}

function validarCredito()
{
	if(!($("#txtMonto").val()>=1 && $("#txtMonto").val()<=5000000))
	{
		alert("El rango del monto debe ser de 1 a 5000000");
		$("txtMonto").focus();
		return false;
	}
	
	if(!($("#txtNroCuotas").val()>=1 && $("#txtNroCuotas").val()<=180))
	{
		alert("El rango del Nro de Cuotas debe ser de 1 a 180");
		$("txtMonto").focus();
		return false;
	}
	return true;
}

function getCboTipoProductoCredito(object,selitem)
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
		if(selitem!="")
		{
			$(object+" option[value="+selitem+"]").attr("selected",true);
		}
	});
}

function getCboProductoCre(object,selitem)
{
	var values=Array();
	values[14]=[32,42];
	values[15]=[43,44];
	values[16]=[45,45];
	values[17]=[46,48];
	values[18]=[49,49];
	values[19]=[50,51];
	
	$.get(rutaXml,function(xml)
	{
		$(object).find("option").remove();
		$(xml).find("parametrica").each(function()
		{
			$(this).find("registro").each(function()
			{
			   var nParCodigo = $(this).find('nParCodigo').text();
			   var cParNombre = $(this).find('cParNombre').text();
			   var cParValor = $(this).find('cParValor').text();
			   if(nParCodigo>=values[$("#cboTipoProductoCredito").val()][0] && nParCodigo<=values[$("#cboTipoProductoCredito").val()][1])
			   {
			   	  $(object).append(new Option(cParNombre,cParValor));
			   }
			});
		});
		if(selitem!="")
		{
			$(object+" option[value="+selitem+"]").attr("selected",true);
		}
	});
}

function getCboAgencia(object,selitem)
{
	$.get(rutaXml,function(xml)
	{
		$(xml).find("parametrica").each(function()
		{
			$(this).find("registro").each(function()
			{
			   var nParCodigo = $(this).find('nParCodigo').text();
			   var cParNombre = $(this).find('cParNombre').text();
			   var cParValor = $(this).find('cParValor').text();
			   if(nParCodigo>=57 && nParCodigo<=72)
			   {
			   	  $(object).append(new Option(cParNombre,cParValor));
			   }
			});
		});
		if(selitem!="")
		{
			$(object+" option[value="+selitem+"]").attr("selected",true);
		}
	});
}

function getCboTasaGeneral(object,selitem)
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
		if(selitem!="")
		{
			$(object+" option[value="+selitem+"]").attr("selected",true);
		}
	});
}

function getCboProductoDep(object,selitem)
{
	$.get(rutaXml,function(xml)
	{

		$(xml).find("parametrica").each(function()
		{
			$(this).find("registro").each(function()
			{
			   var nParCodigo = $(this).find('nParCodigo').text();
			   var cParNombre = $(this).find('cParNombre').text();
			   if(nParCodigo>=20 && nParCodigo<=22)
			   {
			   	  $(object).append(new Option(cParNombre,nParCodigo));
			   }
			});
		});
		if(selitem!="")
		{
			$(object+" option[value="+selitem+"]").attr("selected",true);
		}
	});
}

function getCboSubProducto(object,selitem)
{
	var values=Array();
	values[20]=[23,24];
	values[21]=[25,30,32,32];
	values[22]=[31,31];
	
	$.get(rutaXml,function(xml)
	{
		if($("#cboProducto").val()==21)
		{
			$("#trModalidadPagoInteres").show();
		}
		else
		{
			$("#trModalidadPagoInteres").hide();
		}
		$(object).find("option").remove();
		$(xml).find("parametrica").each(function()
		{
			$(this).find("registro").each(function()
			{
			   var nParCodigo = $(this).find('nParCodigo').text();
			   var cParNombre = $(this).find('cParNombre').text();
			   var cParValor = $(this).find('cParValor').text();
			   
			   if(values[$("#cboProducto").val()][2]>0)
			   {
					if((nParCodigo>=values[$("#cboProducto").val()][0] && nParCodigo<=values[$("#cboProducto").val()][1]) ||(nParCodigo>=values[$("#cboProducto").val()][2] && nParCodigo<=values[$("#cboProducto").val()][3]))
					{
						$(object).append(new Option(cParNombre,cParValor));
					}
			   }
			   else
			   {
				   if(nParCodigo>=values[$("#cboProducto").val()][0] && nParCodigo<=values[$("#cboProducto").val()][1])
				   {
							$(object).append(new Option(cParNombre,cParValor));
					   
				   }
			   }
			});
		});
		if(selitem!="")
		{
			$(object+" option[value="+selitem+"]").attr("selected",true);
		}
	});
}

function getCboModalidadPagoInteres(object,selitem)
{
	$.get(rutaXml,function(xml)
	{
		$(xml).find("parametrica").each(function()
		{
			$(this).find("registro").each(function()
			{
			   var nParCodigo = $(this).find('nParCodigo').text();
			   var cParNombre = $(this).find('cParNombre').text();
			   if(nParCodigo>=74 && nParCodigo<=76)
			   {
			   	  $(object).append(new Option(cParNombre,nParCodigo));
			   }
			});
		});
		if(selitem!="")
		{
			$(object+" option[value="+selitem+"]").attr("selected",true);
		}
	});
}

function getTxtAnioBase(object)
{
	$.get(rutaXml,function(xml)
	{
		$(xml).find("parametrica").each(function()
		{
			$(this).find("registro").each(function()
			{
			   var nParCodigo = $(this).find('nParCodigo').text();
			   var cParValor = $(this).find('cParValor').text();
			   if(nParCodigo==8)
			   {
			   	  $(object).val(cParValor);
			   }
			});
		});
	});
}

function getTxtITF(object)
{
	$.get(rutaXml,function(xml)
	{
		$(xml).find("parametrica").each(function()
		{
			$(this).find("registro").each(function()
			{
			   var nParCodigo = $(this).find('nParCodigo').text();
			   var cParValor = $(this).find('cParValor').text();
			   if(nParCodigo==7)
			   {
			   	  $(object).val(cParValor);
			   }
			});
		});
	});
}