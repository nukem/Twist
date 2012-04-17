<?php
class DBConnection{
	function getConnection(){
	  //change to your database server/user name/password
		mysql_connect('n7-mysql5-3.ilisys.com.au','hallslb','eCbmRyJ8') or
         die("Could not connect: " . mysql_error());
    //change to your database name
		mysql_select_db('hallslb_db') or 
		     die("Could not select database: " . mysql_error());
	}
}
?>
