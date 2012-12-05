<?php		

	function CronogramaPagos($p$monto,$pNroCuotas,$p$codMoneda,$p$codProducto,$p$codAgencia,$pCodTasa)
{
            oParametro = new Parametro();
            ExisteError = false;
            Decimal _ITF, _Desgravamen, TEM, interes = 0M, amortizacion = 0M, saldoAnterior;
            Int16 anioBase;
            SByte diasMensual;

            var tarifario = oParametro.GetTarifario(ParametroPadre.$TipoCredito, $p$codProducto, $p$codAgencia, $p$codMoneda, $p$monto);
            if (tarifario == null)
            {
                ExisteError = true;
                Mensaje = "No existe ningún tarifario para los valores ingresados.";
                return;
            }
            TasaMoratoria = tarifario.nTarTasaMoratoria;

            switch ($pCodTasa)
            {
                case 1: IEA = tarifario.nTarTasaMinima; break;
                case 2: IEA = tarifario.nTarTasaMaxima; break;
                default:
                    ExisteError = true;
                    Mensaje = "No existe tasa seleccionada.";
                    return;
            }

            Decimal.TryParse(oParametro.GetValorParametro(ParametroPadre.ITF), out _ITF);
            Decimal.TryParse(oParametro.GetValorParametro(ParametroPadre.Desgravamen), out _Desgravamen);
            Int16.TryParse(oParametro.GetValorParametro(ParametroPadre.AnioBase), out anioBase);
            SByte.TryParse(oParametro.GetValorParametro(ParametroPadre.Mes), out diasMensual);
            Moneda = oParametro.GetOne(ParametroPadre.Moneda, $p$codMoneda.ToString()).cParNombre;
            ITF = _ITF;
            Desgravamen = _Desgravamen;
            Prestamo = saldoAnterior = $p$monto;
            NroCuotas = $pNroCuotas;
            FrecuenciaPago = "Mensual";

            // Tasa Efectivo Mensual:
            TEM = (Decimal)((Math.Pow((1 + IEA / 100.00M), (1 / 12.00D)) - 1) * 100);
            TEM = Math.Round(TEM, 2, MidpointRounding.AwayFromZero);

            // Tasa Costo Efectivo Anual
            TCEA = (Decimal)((Math.Pow((1 + TEM / 100.00M), 12.00D) - 1) * 100);
            TCEA = Math.Round(TCEA, 2, MidpointRounding.AwayFromZero);

            // Cuota del Crédito
            CuotaMensual = Prestamo * ((Decimal)((TEM / 100.00 * (Decimal)Math.Pow((1 + TEM / 100.00M), NroCuotas))) / (Decimal)(Math.Pow((1 + TEM / 100.00), NroCuotas) - 1));
            CuotaMensual = Math.Round(CuotaMensual, 2, MidpointRounding.AwayFromZero);

            var lCronograma = new List<TarifarioE>();

            for (int i = 0; i < NroCuotas; i++)
            {
                // Interes
                interes = (Decimal)(Math.Pow((1 + IEA / 100.00M), (diasMensual / anioBase)) - 1) * saldoAnterior;
                interes = Math.Round(interes, 2, MidpointRounding.AwayFromZero);

                // Amoritzacion
                amortizacion = CuotaMensual - interes;

                // Verificar que el último saldo sea cero
                if (i == (NroCuotas - 1) && (saldoAnterior - amortizacion) != 0)
                {
                    amortizacion += (saldoAnterior - amortizacion);
                }

                lCronograma.Add(new TarifarioE
                {
                    _ITF = ITF,
                    Nro = i,
                    Fecha = DateTime.Now.AddDays(diasMensual * (i + 1)),
                    Amortizacion = amortizacion,
                    Interes = interes,
                    SaldoAnterior = saldoAnterior
                });

                saldoAnterior = saldoAnterior - amortizacion;
            }

            Tarifario = lCronograma;
            
        }

?>