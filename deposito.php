<?php
$cabecera = '
    <script src="Script/Script.js" type="text/javascript"></script>
    <script type="text/javascript">
        var Formulario = {
            GetControl: function (id) {
                return document.getElementById(id);
            },
            LimpiarControl: function () {
                /*limpia los controles*/
            }
        };
    </script>
';
include 'header.php';
?>
<div class="formulario">
     
    <table class="form">
        <tbody>
            <tr>
                <td class="label">
                    <label>Producto</label>
                </td>
                <td class="input">
                    
                    <select>

					</select>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Sub Producto</label>
                </td>
                <td class="input">
                    <select>

					</select>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Agencia de Solicitud :</label>
                </td>
                <td class="input">
                    <select>

					</select>
                </td>
            </tr>
            
            <tr>
                <td class="label">
                    <label>Monto</label>
                </td>
                <td class="input">
                    <input type="text" class="numerico" >
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Moneda</label>
                </td>
                <td class="input">
                    
                    <table border="0">
	<tbody><tr>
		<td><label><input name="moneda" type="radio" value="1" checked="checked">Soles</label></td><td><label><input name="moneda" type="radio" value="2">Dólares</label></td>
	</tr>
</tbody></table>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Plazo</label>
                </td>
                <td class="input">
                    <input type="text" class="numerico" onkeypress="return isNumberKey(event)">
                    &nbsp;días
                </td>
            </tr>
            <tr>
                <td align="right" colspan="2">
                   &nbsp;
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
                                <input type="text" readonly="true">
                            </td>
                            <td class="label">
                                <label>Tasa Efectiva Anual</label>
                            </td>
                            <td class="input">
                                <input type="text" readonly="true">
                            </td>
                        </tr>
                        <tr>
                            <td class="label">
                                <label>ITF</label>
                            </td>
                            <td class="input">
                                <input type="text" readonly="true">
                            </td>
                            <td class="label">
                                <label>Año Base</label>
                            </td>
                            <td class="input">
                                <input type="text" value="" readonly="true">
                            </td>
                        </tr>
                        <tr>
                            <td class="label">
                                <label>Monto total a pagar</label>
                            </td>
                            <td class="input">
                                <input type="text" readonly="true">
                            </td>
                            <td class="label">
                                <label>Impuesto Transacciones Financiera</label>
                            </td>
                            <td class="input">
                                <input type="text" value="" readonly="true">
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
        </tbody>
    </table>
            </div>
<?php
include 'footer.php';
?>