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
	public $ruta_xml="data.xml";
	function GetValorParametro($nParCodigo)
	{
		if (file_exists($this->ruta_xml))
		{
			$xml = simplexml_load_file($this->ruta_xml);
		}
		else
		{
			echo '<script>alert("No existe ningún tarifario para los valores ingresados.");</script>';
			return false;
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
				$xml = simplexml_load_file($this->ruta_xml);
			}
			else
			{
				echo '<script>alert("No existe ningún tarifario para los valores ingresados.");</script>';
				return false;
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
						break;	
				}
			}
            return $lista;
	}
	
	function GetOne($Codigo)
    {
			$piloto;
			if (file_exists('data.xml'))
			{
				$xml = simplexml_load_file($this->ruta_xml);
			}
			else
			{
				exit("No se pudo cargar los datos.");
			}

            $lista=new parParametrica();
			
            $param = new parParametrica();
            $encontrado = false;
            foreach($xml->parametrica->registro as $tabla)
			{
                $piloto = $tabla->nParCodigo;
                if ($piloto != "" and $piloto == $Codigo)
                {
					$param->nParCodigo=$tabla->nParCodigo;
					$param->cParNombre=$tabla->cParNombre;
					$param->cPardescripcion=$tabla->cPardescripcion;
					$param->nParCodPadre=$tabla->nParCodPadre;
					$param->cParValor=$tabla->cParValor;
                    $encontrado = true;
                }
            }
            if ($encontrado)
                return $param;
            else
                return null;
            //return BD.Parametrica.FirstOrDefault(p => p.nParCodigo == Codigo);
    }
	
	function getListTarifario()
    {
		if (file_exists('data.xml'))
		{
			$xml = simplexml_load_file($this->ruta_xml);
		}
		else
		{
			echo '<script>alert("No se pudo cargar los datos.");</script>';
			return false;
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
				echo '<script>alert("Tipo Incorrecto.");</script>';
				return false;
		}
		$agencia = $this->GetAgencia($codAgencia);

		if ($agencia != null && $agencia->nParCodPadre!="")
		{
			$new_agencia=$this->GetOne($agencia->nParCodPadre);
			echo $codZona=$new_agencia->cParValor;
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
				($t->nTarRangoFinal == 0 or $t->nTarRangoFinal >= $monto) and
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
	
	function GetTarifario($Tipo, $codProducto, $codAgencia, $codMoneda, $monto)
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
					echo '<script>alert("Tipo Incorrecto.");</script>';
					return false;
			}

            $agencia = $this->GetAgencia($codAgencia);

			if ($agencia != null && $agencia->nParCodPadre!="")
			{
				$new_agencia=$this->GetOne($agencia->nParCodPadre);
				$codZona=$new_agencia->cParValor;
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
					($t->nTarRangoFinal == 0 or $t->nTarRangoFinal >= $monto))
				{
					$firme = $t;
					$enc = true;
					break;
				}
			}

            if ($enc!=true)
			{
                return null;
			}
			
            return $firme;
        }
}

?>