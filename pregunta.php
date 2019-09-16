
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Seleccione su cargo</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">

</head>
<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">


            <div class="modal fade in" id="myModal" role="dialog" style="display: block; padding-right: 16px;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccione su cargo :</h4>
            </div>
            <div class="modal-body">
                <form name="formulario" method="POST" action="test.php">
                    <select name="tipo">
                        <option value="Coordinador">Coordinador</option>
                        <option value="Empleado">Empleado</option>
                    </select>
                    <br><br>
                    
                    <button type="submit "  class="btn btn-info">Guardar</button>
                </form>
            </div>
        </div>
    </div>
			</div>
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#myModal").modal();
    });
</script>
</html>
