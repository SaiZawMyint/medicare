<?php

	 function getRd($req)
	{
		if (!isset($_GET['rda'])) {
			$rd=isset($_POST['rd']) ? $_POST['rd'] : '/Medicare';
		}else{
			require $req;;
			$rd=$rd;
		}
		return $rd;
	}

?>