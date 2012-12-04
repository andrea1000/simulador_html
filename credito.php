<?php

$cabecera = '<script src="Script/Script.js" type="text/javascript"></script>';
include 'header.php';
?>
<table class="form">
    <tbody>
        <tr>
            <td class="label">
                <label id="ddlProducto">Tipo Producto de Crédito</label>
            </td>
            <td class="input">
                <div>
                    <select id="ddlProducto">

                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td class="label">
                <label id="ddlSubProducto">Producto</label>
            </td>
            <td class="input">
                <div>
                    <select id="ddlSubProducto">

                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td class="label">
                <label>Agencia de Solicitud" AssociatedControlID="ddlAgencia" />
            </td>
            <td class="input">
                <div>
                    <select id="ddlAgencia">

                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td class="label">
                <label>Monto" AssociatedControlID="txtMonto" />
            </td>
            <td class="input">
                <input type="text" id="txtMonto" class="numerico"/>
            </td>
        </tr>
        <tr>
            <td class="label">
                <label>Moneda" AssociatedControlID="rbtnMoneda" />
            </td>
            <td class="input">
                <div>
                    <select id="rbtnMoneda">

                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td class="label">
                <label>Nro de Cuotas" AssociatedControlID="txtNroCuotas" />
            </td>
            <td class="input">
                <input type="text" id="txtNroCuotas" class="numerico"/>
            </td>
        </tr>
        <tr>
            <td class="label">
                <label>Tasa General" AssociatedControlID="ddlTasa" />
            </td>
            <td class="input">
                <input type="text" id="ddlTasa" class="numerico"/>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <input type="submit" class="button"/>
            </td>
        </tr>
    </tbody>
</table>
<?php
//hola
include 'footer.php';
?>