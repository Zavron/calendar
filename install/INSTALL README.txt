===== INSTALLATION =====
1.) Copy all files except this folder and its content in a directory on your webserver.
2.) Create a Database for the calendar and import install.sql into it
3.) Configure the calendar:
	a) Go to ./php/mysql.php and insert the connection data to your database
		$db_host - Connection to your database host. Most likely 'localhost'
		$db_user - A database user with access rights for the created database.
			It is recommended to create a new user with Read and Write permissions
		$db_pss - The Password for your database user
		$db_name - Name of the database
	b) Go to ./php/config.php and customize your installation.
		mode_dev - If you enable dev mode a border is shown around all map areas (Default disabled)
		mode_admin - If you enable admin mode, any user you register can access and modify data (Default enabled)
4.) Create a user
	a) Insert a new entry into table 'user'. Password must be Sha1
	b) Check permissions: 0 - No Access, 1 - Read Access, 2 - Read & Write Access

You're done! Have fun using your calendar.
For feedback, errors and improvements, contact: zavron.gm@gmail.com