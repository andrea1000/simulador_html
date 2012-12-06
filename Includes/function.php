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
		$_ITF=$Parametro->GetValorParametro(ParametroPadre::ITF);
		$diasMensual=$Parametro->GetValorParametro(ParametroPadre::Mes);
		$anioBase=$Parametro->GetValorParametro(ParametroPadre::AnioBase);
		
		//$tarifario = $Parametro->GetTarifario(ParametroPadre::TipoDeposito, $pCodProducto, $pCodAgencia, $pCodMoneda, $pMonto);
		if ($tarifario == null)
		{
			/*ExisteError = true;
			Mensaje = "No existe ningún tarifario para los valores ingresados.";
			return;*/
		}
		
		//$this->Tasa = $parTarifario->nTarTasaMinima;
		$this->Tasa=2;		
		$this->Monto=$pMonto;
		
		if ($pTipoProd != TipoProducto::CTS)
        {
			$this->ITF = $_ITF;
		}
		
		switch($pTipoProd)
            {
                case TipoProducto::Corriente:
				
                    $FACTOR = (pow((1 + $this->Tasa / 100.00), ($pPlazo / $anioBase)) - 1);
                    $this->InteresGanado = $FACTOR * $pMonto;
                    break;
					
                case TipoProducto::PlazoFijo:

                    $tarDia=$Parametro->GetTarifarioDia(ParametroPadre::TipoDeposito, $pCodProducto, $pCodAgencia, $pCodMoneda, $pMonto,$pPlazo);
                    if($tarDia != "")
					{
                        echo $this->Tasa = $tarDia->nTDTasa;
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
                    $this->InteresGanado = $FACTOR * $pMonto;
                    break;
					
                case TipoProducto::CTS:
				
                    $FACTOR = (pow((1 + $this->Tasa / 100.00), ($pPlazo / $anioBase)) - 1);
                    $this->InteresGanado = $FACTOR * $pMonto;
                    break;
            }

            $this->ITFCalculado=($this->Monto + $this->InteresGanado) * ($_ITF / 100.00);
			$this->TotalPagar=$this->Monto + $this->InteresGanado - $this->ITFCalculado;
	}

}
?>