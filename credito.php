<?php
$cabecera = '<script src="Script/Script.js" type="text/javascript"></script>';
include 'header.php';
?>
<div class="formulario">          
    <table class="form">
        <tbody>
            <tr>
                <td class="label">
                    <label>Tipo Producto de Crédito</label>
                </td>
                <td class="input">
                    <select>

                    </select>
                </td>
            </tr>
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
                    <label>Agencia de Solicitud</label>
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
                    <input type="text" class="numerico" onkeypress="return isNumberKey(event)">
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Moneda</label>
                </td>
                <td class="input">
                    <table border="0">
                        <tbody><tr>
                                <td><input type="radio" value="1" checked="checked"><label>Soles</label></td><td><input type="radio" value="2"><label>Dólares</label></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Nro de Cuotas</label>
                </td>
                <td class="input">
                    <input type="text" class="numerico" onkeypress="return isNumberKey(event)">
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label>Tasa General</label>
                </td>
                <td class="input">
                    <select style="width: 156px;">
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

</div>

<?php
include 'footer.php';
?>