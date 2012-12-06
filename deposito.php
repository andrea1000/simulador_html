<?php

include 'header.php';
include 'Includes/function.php';
$ClsDeposito=new ClassDeposito();
if($_POST)
{
	$ClsDeposito->DepositoPago($_POST["txtMonto"],$_POST["txtPlazo"],$_POST["cboModalidadPagoInteres"],$_POST["radCodMoneda"],$_POST["cboProducto"],$_POST["cboSubProducto"],$_POST["cboAgencia"]);
}
?>
<div class="formulario">
    <form id="formDeposito" name="formDeposito" method="post" onsubmit="return validarDeposito()">
    <table class="form">
        <tbody>
            <tr>
                <td class="label">
                    <label>Producto</label>
                </td>
                <td class="input">
                    
                    <select id="cboProducto" name="cboProducto" onchange='getCboSubProducto("#cboSubProducto");'>

					</select>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Sub Producto</label>
                </td>
                <td class="input">
                    <select id="cboSubProducto" name="cboSubProducto">

					</select>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Agencia de Solicitud</label>
                </td>
                <td class="input">
                    <select id="cboAgencia" name="cboAgencia">

					</select>
                </td>
            </tr>
            
            <tr id="trModalidadPagoInteres">
              <td class="label">
                    <label>Modalidad de Pago de Interés</label>
                </td>
                <td class="input">
                    <select id="cboModalidadPagoInteres" name="cboModalidadPagoInteres">

					</select>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Monto</label>
                </td>
                <td class="input">
                    <input name="txtMonto" type="text" class="numerico" id="txtMonto" value="<?php echo $_POST["txtMonto"]; ?>">
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Moneda</label>
                </td>
                <td class="input">
                    
                    <table border="0">
	<tbody><tr>
		<td><label><input name="radCodMoneda" type="radio" value="1" <?php if($_POST["radCodMoneda"]==1 or $_POST["radCodMoneda"]==""){ echo 'checked="checked"'; } ?> >Soles</label></td><td><label><input name="radCodMoneda" type="radio" value="2" <?php if($_POST["radCodMoneda"]==2){ echo 'checked="checked"'; } ?>>Dólares</label></td>
	</tr>
</tbody></table>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Plazo</label>
                </td>
                <td class="input">
                    <input name="txtPlazo" type="text" class="numerico" id="txtPlazo" onkeypress="return isNumberKey(event)" value="<?php echo $_POST["txtPlazo"];?>">
                    &nbsp;días
                </td>
            </tr>
            <tr>
                <td align="right" colspan="2">&nbsp;
                   
                </td>
            </tr>
            <tr>
                <td align="right" colspan="2" style="padding-right: 35px;">
                    <input type="button" value="Imprimir" class="button" onclick="window.print();">
                    <input type="submit" value="Calcular" class="button">
                </td>
            </tr>
            <tr>
                <td colspan="2" class="titulo">
                    <span>PROGRAMA DE DEPOSITOS</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="form">
                        <tbody><tr>
                            <td class="label">
                                <label>Interés Generado</label>
                            </td>
                            <td class="input">
                                <input name="txtInteresGanado" type="text" class="numerico" id="txtInteresGanado" value="<?php echo $ClsDeposito->InteresGanado;?>" readonly="true">
                            </td>
                            <td class="label">
                                <label>Tasa Efectiva Anual</label>
                            </td>
                            <td class="input">
                                <input name="txtTasa" type="text" class="numerico" id="txtTasa" style="width:125px;" value="<?php echo $ClsDeposito->Tasa;?>" readonly="true"> %
                            </td>
                        </tr>
                        <tr>
                            <td class="label">
                                <label>ITF</label>
                            </td>
                            <td class="input">
                                <input type="text" readonly="true" class="numerico" value="<?php echo $ClsDeposito->ITFCalculado;?>">
                            </td>
                            <td class="label">
                                <label>Año Base</label>
                            </td>
                            <td class="input">
                                <input id="txtAnioBase" name="txtAnioBase" type="text" readonly="true" class="numerico" style="width:125px;"> días
                            </td>
                        </tr>
                        <tr>
                            <td class="label">
                                <label>Monto total a pagar</label>
                            </td>
                            <td class="input">
                                <input type="text" readonly="true" class="numerico" value="<?php echo $ClsDeposito->TotalPagar;?>">
                            </td>
                            <td class="label">
                                <label>Impuesto Transacciones Financiera</label>
                            </td>
                            <td class="input">
                                <input id="txtITF" name="txtITF" type="text" readonly="true" class="numerico" style="width:125px;"> %
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
        </tbody>
    </table>
    <input type="hidden" id="pdf" name="pdf" />
    </form>
</div>
<script>
	getCboProductoDep("#cboProducto","<?php echo $_POST["cboProducto"];?>");
	getCboSubProducto("#cboSubProducto","<?php echo $_POST["cboSubProducto"];?>");
	getCboModalidadPagoInteres("#cboModalidadPagoInteres","<?php echo $_POST["cboModalidadPagoInteres"];?>");
	getCboAgencia("#cboAgencia","<?php echo $_POST["cboAgencia"];?>");
	getTxtAnioBase("#txtAnioBase");
	getTxtITF("#txtITF");
	$("#pdf").val($("#formDeposito").html());
</script>
<?php
include 'footer.php';
?>