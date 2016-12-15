<html>
<head>
</head>
<body>
<?php 
	function clearMessage()
	{
		foreach ($_SESSION["messages"] as $key => $value) {
			
			echo $_SESSION["messages"][ $key ];
			$_SESSION["messages"][ $key ] = "";
			unset( $_SESSION["messages"][ $key ] );
		}
	}
	
	clearMessage();
	
	?>
</body>