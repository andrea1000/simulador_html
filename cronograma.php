<?php
$cabecera = '';
include 'header.php';
?>
<table class="form">
        <tbody>
            <tr>
                <td class="titulo">
                    <span>CRONOGRAMA DE PAGOS</span>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="form">
                        <tbody>
                            <tr>
                                <td class="label">
                                    Prestamo :
                                </td>
                                <td class="input">
                                    <input type="text" ID="lblPrestamo" value="" />
                                </td>
                                <td class="label">
                                    Fecha :
                                </td>
                                <td class="input">
                                    <input type="text" ID="lblFecha" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    Moneda :
                                </td>
                                <td class="input">
                                    <input type="text" ID="lblMoneda" value="" />
                                </td>
                                <td class="label">
                                    Tasa Moratoria (TEA) :
                                </td>
                                <td class="input">
                                    <input type="text" ID="lblTasaMoratoria" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    N° Cuotas :
                                </td>
                                <td class="input">
                                    <input type="text" ID="lblNroCuotas" value="" />
                                </td>
                                <td class="label">
                                    Interés Efectiva Anual:
                                </td>
                                <td class="input">
                                    <input type="text" ID="lblIEF" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    Cuota Mensual :
                                </td>
                                <td class="input">
                                    <input type="text" ID="lblCuotaMensual" value="" />
                                </td>
                                <td class="label">
                                    Tasa Costo Efectivo Anual :
                                </td>
                                <td class="input">
                                    <input type="text" ID="lblTCEA" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    Total a Pagar :
                                </td>
                                <td class="input">
                                    <input type="text" ID="lblTotalPagar" value="" />
                                </td>
                                <td class="label">
                                    Frecuencia de Pago :
                                </td>
                                <td class="input">
                                    <input type="text" ID="lblFrecuenciaPago" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    Desgravamen :
                                </td>
                                <td class="input">
                                    <input type="text" ID="lblDesgravamen" value="" />
                                </td>
                                <td class="label">
                                    ITF :
                                </td>
                                <td class="input">
                                    <input type="text" ID="lblITF" value="" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <div>
                        <table id="cronograma" cellspacing="0" cellpadding="4" border="0" style="color: #333333;
                            width: 100%; border-collapse: collapse;">
                            <tbody>
                                <tr style="color: White; background-color: #0265C0; font-weight: bold;">
                                    <th scope="col">
                                        N°
                                    </th>
                                    <th scope="col">
                                        Fecha
                                    </th>
                                    <th scope="col">
                                        Amortizacion
                                    </th>
                                    <th scope="col">
                                        Interes
                                    </th>
                                    <th scope="col">
                                        Desgravamen
                                    </th>
                                    <th scope="col">
                                        Cuota
                                    </th>
                                    <th scope="col">
                                        Saldo
                                    </th>
                                    <th scope="col">
                                        ITF
                                    </th>
                                    <th scope="col">
                                        Cuota + ITF
                                    </th>
                                </tr>
                                <tr class="fila" style="background-color: #EFF3FB;">
                                    <td>
                                        0
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <label ID="ltrPrestamo"></label>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                        <tr class="fila">
                                            <td>
                                                 
                                            </td>
                                            <td>
                                                 
                                            </td>
                                            <td>
                                                 
                                            </td>
                                            <td>
                                                 
                                            </td>
                                            <td>
                                                 
                                            </td>
                                            <td class="Cuota">
                                                 
                                            </td>
                                            <td>
                                                 
                                            </td>
                                            <td>
                                                 
                                            </td>
                                            <td class="CuotaITF">
                                                 
                                            </td>
                                        </tr>
                                <tr class="fila total">
                                    <td>
                                        TOTAL :
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    <label ID="ltrAmortizacion"></label>
                                    </td>
                                    <td>
                                    <label ID="ltrInteres"></label>
                                    </td>
                                    <td>
                                    <label ID="ltrDesgravamen"></label>
                                    </td>
                                    <td>
                                    <label ID="ltrCuota"></label>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    <label ID="ltrITF"></label>
                                    </td>
                                    <td>
                                    <label ID="ltrCuotaITF"></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="display: inline; padding-right: 5px;">
                        <input type="button" value="Imprimir" class="button" onclick="window.print();" />
                    </div>
                    <div style="display: inline; padding-left: 5px;">
                        <input type="button" value="Volver" css="button" />
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
<?php
include 'footer.php';
?>