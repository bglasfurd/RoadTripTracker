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
