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

<?php
include 'footer.php';
?>