
var SERVER_PORT 	= 3306;

var connection = require('mysql');

var MYSQL_DEFAULT_HOST 	= '127.0.0.1';	// define address of mysql server
var MYSQL_DEFAULT_PASS	= '1234';			// define password for mysql server
var MYSQL_DEFAULT_DB 	= 'ToneMe';		// define default mysql database name
var MYSQL_DEFAULT_USER	= 'root';		// define username for mysql server


   connection = connection.createConnection({
    	host     : MYSQL_DEFAULT_HOST,
    	user     : MYSQL_DEFAULT_USER,
    	password : MYSQL_DEFAULT_PASS,
    	database : MYSQL_DEFAULT_DB
  	});


    connection.connect(function(err) {
      if(err) {
        return console.log(err);
      }
      // do anything here after successfully connecting to the server
  console.log('Connected to the mysql server');

    });


  function loginLogic(userName, pass) {
     if (userName.indexOf("'") == -1 && pass.indexOf("'") == -1) {
      var queryString = 'SELECT * FROM Users WHERE password = ' +  + '';
      var retVal = connection.query(queryString, function(error, rows, columns) {
          console.log(rows);
      });
      return retVal;
    }
    else {
      return null;
    }
  }

loginLogic("Bob", "1234");

