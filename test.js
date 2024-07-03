const mysql = require('mysql');

var temp = "12.345";

console.log(typeof temp)

// First you need to create a connection to the database
  const con = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'biking'
});

con.connect((err) => {
  if(err){
    console.log('Error connecting to Db');
    return;
  }
  console.log('Connection established');

});

con.query("INSERT INTO coordinates (address, lon, lat, username, latlonID) VALUES ('testing31',"+temp+ ", '13.123', 'brad', NULL)",function(err,result){
  if(err) throw err;


});

//BROOO I WANT TO TALK TO YOU... you keep that in mind. rn broo circumstances



con.end((err) => {
  // The connection is terminated gracefully
  // Ensures all remaining queries are executed
  // Then sends a quit packet to the MySQL server.
});
