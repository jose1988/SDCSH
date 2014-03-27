<!DOCTYPE html>
<html>
	<head>
	<script type="text/javascript">
	//EVENTOS EN javascript

	function hacer_click()
	{
		alert("Me haz dado un click");
	}

	function hacer_hover()
	{
		alert("Estas sobre mi!");
	}

	function salir_del_hover()
	{
		alert("Adios!");
	}

	function cargar_pagina()
	{alert("Ya se ha cargado el sitio web");}
	</script>
	</head>

	<body onload="cargar_pagina()">
		<form>
			<input type="button" value="dame click!"  onmouseout="salir_del_hover()" onmouseover="hacer_hover()" onclick="hacer_click()"/>
		</form>
	</body>

</html>