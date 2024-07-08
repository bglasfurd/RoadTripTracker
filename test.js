// const mysql = require('mysql');

// var temp = "12.345";

// console.log(typeof parseFloat(temp))

// // First you need to create a connection to the database
//   const con = mysql.createConnection({
//   host: 'localhost',
//   user: 'root',
//   password: '',
//   database: 'biking'
// });

// con.connect((err) => {
//   if(err){
//     console.log('Error connecting to Db');
//     return;
//   }
//   console.log('Connection established');

// });

// con.query("INSERT INTO coordinates (address, lon, lat, username) VALUES ('testing31',"+temp+ ", '13.123', 'brad')",function(err,result){
//   if(err) throw err;


// });



// con.end((err) => {
//   // The connection is terminated gracefully
//   // Ensures all remaining queries are executed
//   // Then sends a quit packet to the MySQL server.
// });


const mysql = require('mysql');
var lon = [];
var index = 0;
var lat = [];
var index1 = 0;
var indexf = 0;



// First you need to create a connection to the database
  const con = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'biking'
});

function setLon(value) {
  lon[index++]=value;
}

function setLat(value) {
  lat[index1++]=value;
}

con.connect(function (error) {

  if (!error) {
    console.log("Connected");

//GETTING LONGITUDE FROM DB
    let sql = "select lon from coordinates where username = 'brad'";
    con.query(sql, function (err, result, field) {
      if (!err) {
        // console.log(JSON.parse(result));
        for (let i = 0; i < result.length; i++) {
          try {
            // console.log(result[i]);
            let ob1 = Object.values(JSON.parse(JSON.stringify(result[i])));
            let ob = ob1.toString()
            setLon(ob);
          } catch (error) {
            console.log(error.message);
          }

        }
      } else {
        console.log("Error while selecting record from coordinates table. ");
      }});
  // GETTING LATITUDE COORDINATES FROM DB

      sql = "select lat from coordinates where username = 'brad'";
      con.query(sql, function (err, result, field) {
        if (!err) {
          // console.log(JSON.parse(result));
          for (let i = 0; i < result.length; i++) {
            try {
              // console.log(result[i]);
              let ob1 = Object.values(JSON.parse(JSON.stringify(result[i])));
              let ob = ob1.toString()
              setLat(ob);
            } catch (error) {
              console.log(error.message);
            }

          }
        } else {
          console.log("Error while selecting record from coordinates table. ");
        }


      for(let i=0; i<lon.length; i++){
        console.log(lon[i] + "\t" +lat[i]);
      }
      
    });
  }})
