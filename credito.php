<?php
$cabecera = '<script src="Script/Script.js" type="text/javascript"></script>';
include 'header.php';
?>
<div class="formulario"> 
	<form method="post">         
    <table class="form">
        <tbody>
            <tr>
                <td class="label">
                    <label>Tipo Producto de Crédito</label>
                </td>
                <td class="input">
                    <select id="cboTipoProductoCredito" name="cboTipoProductoCredito" onchange='getCboProductoCre("#cboProducto");'>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Producto</label>
                </td>
                <td class="input">
                    <select id="cboProducto" name="cboProducto">

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
            <tr>
                <td class="label">
                    <label>Monto</label>
                </td>
                <td class="input">
                    <input id="txtMonto" name="txtMonto" type="text" class="numerico" onkeypress="return isNumberKey(event)" value="<?php echo $_POST["txtMonto"];?>">
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
                    <label>Nro de Cuotas</label>
                </td>
                <td class="input">
                    <input id="txtNroCuotas" name="txtNroCuotas" type="text" class="numerico" onkeypress="return isNumberKey(event)" value="<?php echo $_POST["txtNroCuotas"];?>">
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Tasa General</label>
                </td>
                <td class="input">
                    <select id="cboTasaGeneral" name="cboTasaGeneral" style="width: 156px;">
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="submit" value="Calcular" class="button">
                </td>
            </tr>
        </tbody>
    </table>
	</form>
</div>
<script>
	getCboTipoProductoCredito("#cboTipoProductoCredito","<?php echo $_POST["cboTipoProductoCredito"];?>");
	getCboProductoCre("#cboProducto","<?php echo $_POST["cboProducto"];?>");
	getCboAgencia("#cboAgencia","<?php echo $_POST["cboAgencia"];?>");
	getCboTasaGeneral("#cboTasaGeneral","<?php echo $_POST["cboTasaGeneral"];?>");
</script>
<?php
include 'footer.php';
?>