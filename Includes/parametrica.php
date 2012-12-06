<?php

class ParametroPadre
{
	const TipoCredito = 1;
	const TipoDeposito = 2;
	const TasaGeneral = 5;
	const Moneda = 6;
	const ITF = 7;
	const AnioBase = 8;
	const Desgravamen = 9;
	const Mes = 10;
	const ModalidadInteres = 73;
}

class TipoProducto
{
	const Corriente = 20;
	const PlazoFijo = 21;
	const CTS = 22;
}

class ModalidadInteres
{
	const Vencimiento = 1;
	const Mensual = 2;
	const Adelantado = 3;
}
class parTarifario
{
	public $_nTarCodigo;
	public $_nTarCodTipo;
	public $_nTarCodProd;
	public $_nTarCodMoneda;
	public $_nTarCodZona;
	public $_nTarRangoInicial;
	public $_nTarRangoFinal;
	public $_nTarTasaMinima;
	public $_nTarTasaMaxima;
	public $_nTarTasaMoratoria;
	public $_nTDCodigo;
	public $_nTDCodTarifario;
	public $_nTDDiaInicial;
	public $_nTDDiaFinal;
	public $_nTDTasa;

	public $nTarCodigo;
	public $nTarCodTipo;
	public $nTarCodProd;
	public $nTarCodMoneda;
	public $nTarCodZona;
	public $nTarRangoInicial;
	public $nTarRangoFinal;
	public $nTarTasaMinima;
	public $nTarTasaMaxima;
	public $nTarTasaMoratoria;
	public $nTDCodigo;
	public $nTDCodTarifario;
	public $nTDDiaInicial;
	public $nTDDiaFinal;
	public $nTDTasa;
}

class parParametrica
{ 
	public $nParCodigo;
	public $cParNombre;
	public $cPardescripcion;
	public $nParCodPadre;
	public $cParValor;
}

class Parametro
{
	function GetValorParametro($nParCodigo)
	{
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
			if($child->nParCodigo==$nParCodigo)
			{
				return $child->cParValor;
				exit;
			}
		}
	}
	
	function GetAgencia($codAgencia)
    {
            $piloto;
			if (file_exists('data.xml'))
			{
				$xml = simplexml_load_file("data.xml");
			}
			else
			{
				exit('Error!..');
			}

            $lista=new parParametrica();
			
			foreach($xml->parametrica->registro as $tabla)
			{
				if($tabla->nParCodPadre==11 or $tabla->nParCodPadre==12)
				{
					
						$lista->nParCodigo=$tabla->nParCodigo;
						$lista->cParNombre=$tabla->cParNombre;
						$lista->cPardescripcion=$tabla->cPardescripcion;
						$lista->nParCodPadre=$tabla->nParCodPadre;
						$lista->cParValor=$tabla->cParValor;	
				}
			}
            return $lista;
	}
	
	function getListTarifario()
    {
		if (file_exists('data.xml'))
		{
			$xml = simplexml_load_file("data.xml");
		}
		else
		{
			exit('Error!..');
		}
		return $xml->tarifario->registro;
    }
	
	function GetTarifarioDia($Tipo,$codProducto,$codAgencia,$codMoneda,$monto,$plazo)
	{
		$codZona = 0;
		$codTipo;

		switch ($Tipo)
		{
			case ParametroPadre::TipoCredito:
			case ParametroPadre::TipoDeposito:
				$codTipo = $Tipo;
				break;
			default:
				throw new Exception("Tipo Incorrecto.");
		}
		$agencia = $this->GetAgencia($codAgencia);

		if ($agencia != null && $agencia->nParCodPadre!="")
		{
			$codZona=$agencia->nParCodPadre;
		}
		
		$aux = $this->getListTarifario();
		$enc = false;
		$firme = new parTarifario();

		foreach ($this->getListTarifario() as $t)
		{
			if ($t->nTarCodTipo == $codTipo and
				$t->nTarCodProd == $codProducto and
				($t->nTarCodZona == 3 or $t->nTarCodZona == $codZona) and
				$t->nTarCodMoneda == $codMoneda and
				$t->nTarRangoInicial <= $monto and
				($t->nTarRangoFinal == 0.00 or $t->nTarRangoFinal >= $monto) and
				$t->nTDDiaInicial<=$plazo and $t->nTDDiaFinal>=$plazo)
			{
				$firme = $t;
				$enc = true;
				break;
			}
		}
		
		if (!$enc)
		{
			return null;
		}

		return $firme;
	}
	
	function GetTarifario($Tipo,$TipocodProducto,$TipocodAgencia,$TipocodMoneda,$Tipomonto)
	{
		/*Int32 codZona = 0;
		Byte codTipo;

		switch (Tipo)
		{
			case ParametroPadre.TipoCredito:
			case ParametroPadre.TipoDeposito:
				codTipo = (Byte)Tipo;
				break;
			default:
				throw new Exception("Tipo Incorrecto.");
		}

		var agencia = GetAgencia().FirstOrDefault(a => a.cParValor == codAgencia.ToString());

		if (agencia != null && !String.IsNullOrEmpty(agencia.nParCodPadre.ToString()))
		{
			Int32.TryParse(GetOne(agencia.nParCodPadre).cParValor,codZona);
		}

		//var tarifario = BD.Tarifario.Include("TarifarioDia")
		//    .FirstOrDefault(t =>
		//        t.nTarCodTipo == codTipo &&
		//        t.nTarCodProd == codProducto &&
		//        (t.nTarCodZona == 3 || t.nTarCodZona == codZona) &&
		//        t.nTarCodMoneda == codMoneda &&
		//        t.nTarRangoInicial <= monto &&
		//        (t.nTarRangoFinal == 0 || t.nTarRangoFinal >= monto)
		//        );
		var aux = getTarifario();
		Boolean enc=false;
		parTarifario firme=new parTarifario();
		foreach(parTarifario t in getTarifario()){
			if(t.nTarCodTipo == codTipo &&
				t.nTarCodProd == codProducto &&
				(t.nTarCodZona == 3 || t.nTarCodZona == codZona) &&
				t.nTarCodMoneda == codMoneda &&
				t.nTarRangoInicial <= monto &&
				(t.nTarRangoFinal == 0 || t.nTarRangoFinal >= monto)){
				firme=t;
				enc=true;
				break;
			}
		}
		if (!enc)
			return null;
			//firme=aux[0];
			//.FirstOrDefault(t =>
			//    t.nTarCodTipo == codTipo &&
			//    t.nTarCodProd == codProducto &&
			//    (t.nTarCodZona == 3 || t.nTarCodZona == codZona) &&
			//    t.nTarCodMoneda == codMoneda &&
			//    t.nTarRangoInicial <= monto &&
			//    (t.nTarRangoFinal == 0 || t.nTarRangoFinal >= monto)
			//    );
		return firme;*/
	}
}

?>