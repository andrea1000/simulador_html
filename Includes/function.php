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
		$anioBase=$Parametro->GetValorParametro(ParametroPadre::AnioBase);
		$_ITF=$Parametro->GetValorParametro(ParametroPadre::ITF);
		$diasMensual=$Parametro->GetValorParametro(ParametroPadre::Mes);
		
		
		$this->Tasa = $parTarifario->nTarTasaMinima;

		$this->Monto=$pMonto;
		if ($pTipoProd != TipoProducto::CTS)
        {
			$this->ITF = $_ITF;
		}
		
		switch ($pTipoProd)
            {
                case TipoProducto::Corriente:

                    $FACTOR = (Math.Pow((1 + $this->Tasa / 100.00), ($pPlazo / $anioBase)) - 1);
                    $this->InteresGanado = $FACTOR * $pMonto;
                    break;
                case TipoProducto::PlazoFijo:

                    $tarDia=$Parametro->GetTarifarioDia(ParametroPadre::TipoDeposito, $pCodProducto, $pCodAgencia, $pCodMoneda, $pMonto,$pPlazo);
                    if ($tarDia != null)
                        $this->Tasa = 0;

                    switch ($pModalidad)
                    {
                        case ModalidadInteres::Vencimiento:
                            $FACTOR = (Math.Pow((Double)(1 + $this->Tasa / 100.00), ($pPlazo / $anioBase)) - 1);
                            break;
                        case ModalidadInteres::Mensual:
                            $FACTOR = (Math.Pow((Double)(1 + $this->Tasa / 100.00), ($diasMensual / $anioBase)) - 1);
                            break;
                        case ModalidadInteres::Adelantado:
                            $FACTOR = (1 - Math.Pow((Double)(1 + $this->Tasa / 100.00), (Double)(-1)) * ($diasMensual / $anioBase));
                            break;
                    }
                    $this->InteresGanado = $FACTOR * $pMonto;
                    break;
                case TipoProducto::CTS:
                    $FACTOR = (Math.Pow((1 + $this->Tasa / 100.00), ($pPlazo / $anioBase)) - 1);
                    $this->InteresGanado = $FACTOR * $pMonto;
                    break;
            }

            $this->ITFCalculado = ($this->Monto + $this->InteresGanado) * ($_ITF / 100.00);
			$this->TotalPagar=$this->Monto + $this->InteresGanado - $this->ITFCalculado;
	}

}
?>