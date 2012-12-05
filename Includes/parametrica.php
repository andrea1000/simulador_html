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
		}
}

?>