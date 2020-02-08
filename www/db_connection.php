<?php
	
	class MyBD extends SQLite3
	{
		
		function __construct()
		{
			$this->open('database.db');
		}
	}
	
?>