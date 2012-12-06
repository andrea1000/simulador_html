<?php		
include "parametrica.php";
class ClassDeposito
{
	public $Monto;
	public $Tasa;
	public $InteresGanado;
	public $ITFCalculado;
	public $ITF;
	public $TotalPagar;
	public $ExisteError;
	public $Mensaje;

	function DepositoPago($pMonto,$pPlazo,$pModalidad,$pCodMoneda,$pTipoProd,$pCodProducto,$pCodAgencia)
	{
		$Parametro=new Parametro();
		$parTarifario=new parTarifario();
		
		$FACTOR=0;
		$_ITF=number_format($Parametro->GetValorParametro(ParametroPadre::ITF),3);
		$diasMensual=$Parametro->GetValorParametro(ParametroPadre::Mes);
		$anioBase=$Parametro->GetValorParametro(ParametroPadre::AnioBase);
		
		$tarifario = $Parametro->GetTarifario(ParametroPadre::TipoDeposito, $pCodProducto, $pCodAgencia, $pCodMoneda, $pMonto);
		if ($tarifario == null)
		{
			echo '<script>alert("No existe ningún tarifario para los valores ingresados.");</script>';
			return false;
		}
		
		$this->Tasa = number_format($tarifario->nTarTasaMinima,2);

		$this->Monto=$pMonto;
		
		if ($pTipoProd != TipoProducto::CTS)
        {
			$this->ITF = number_format($_ITF,3);
		}
		
		switch($pTipoProd)
            {
                case TipoProducto::Corriente:
				
                    $FACTOR = (pow((1 + $this->Tasa / 100.00), ($pPlazo / $anioBase)) - 1);
                    $this->InteresGanado = number_format($FACTOR * $pMonto,2);
                    break;
					
                case TipoProducto::PlazoFijo:

                    $tarDia=$Parametro->GetTarifarioDia(ParametroPadre::TipoDeposito, $pCodProducto, $pCodAgencia, $pCodMoneda, $pMonto,$pPlazo);
                    if($tarDia != "")
					{
                        $this->Tasa = $tarDia->nTDTasa;
					}

                    switch($pModalidad)
                    {
                        case ModalidadInteres::Vencimiento:
                            $FACTOR = (pow((Double)(1 + $this->Tasa / 100.00), ($pPlazo / $anioBase)) - 1);
                            break;
                        case ModalidadInteres::Mensual:
                            $FACTOR = (pow((Double)(1 + $this->Tasa / 100.00), ($diasMensual / $anioBase)) - 1);
                            break;
                        case ModalidadInteres::Adelantado:
                            $FACTOR = (1 - pow((Double)(1 + $this->Tasa / 100.00), (Double)(-1)) * ($diasMensual / $anioBase));
                            break;
                    }
                    $this->InteresGanado = number_format($FACTOR * $pMonto,2);
                    break;
					
                case TipoProducto::CTS:
				
                    $FACTOR = (pow((1 + $this->Tasa / 100.00), ($pPlazo / $anioBase)) - 1);
                    $this->InteresGanado = number_format($FACTOR * $pMonto,2);
                    break;
            }
			
            $this->ITFCalculado=number_format(($this->Monto+$this->InteresGanado)*(number_format($_ITF,3)/100),2);
			$this->TotalPagar=number_format($this->Monto + $this->InteresGanado - $this->ITFCalculado,2);
	}

}
?>