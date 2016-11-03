<?php	
		if(!$mycon = @mysql_connect("novusmediacomvn.ipagemysql.com","novusevents","n0vusevents!")) die('Database Error: '.mysql_error());
		elseif(!@mysql_select_db("novusevents",$mycon)) die ('Database Error: '.mysql_error());
?>

