
var SERVER_PORT 	= 3306;

var mysql = require('mysql');

var MYSQL_DEFAULT_HOST 	= 'localhost';	// define address of mysql server
var MYSQL_DEFAULT_PASS	= '1234';			// define password for mysql server
var MYSQL_DEFAULT_DB 	= 'mydb';		// define default mysql database name
var MYSQL_DEFAULT_USER	= 'root';		// define username for mysql server


  	var connection = mysql.createConnection({
    	host     : MYSQL_DEFAULT_HOST,
    	user     : MYSQL_DEFAULT_USER,
    	password : MYSQL_DEFAULT_PASS,
    	database : MYSQL_DEFAULT_DB
  	});

    connection.connect(function(err) {
       console.log(err);
    });

    // do anything here after successfully connecting to the server
	console.log('Connected to the mysql server');

	function doSampleQuery() {
		mysqlServer.query("SELECT * FROM `sample_table`");
	}
