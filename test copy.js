const mysql = require('mysql');
var lon = [];
var index = 0;


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

con.connect(function (error) {

  if (!error) {
    console.log("Connected");
    const sql = "select lon from coordinates where username = 'brad'";
    con.query(sql, function (err, result, field) {
      if (!err) {
        // console.log(JSON.parse(result));
        for (let i = 0; i < result.length; i++) {
          try {
            // console.log(result[i]);
            let ob1 = Object.values(JSON.parse(JSON.stringify(result[i])));
            let ob = ob1.toString()
            Number(ob);
            console.log(typeof ob);
            setLon(ob);
            // setLon.push(result[i]);
          } catch (error) {
            console.log(error.message);
          }

        }
      } else {
        console.log("Error while selecting record from campground table. ");
      }
      console.log(`length after execution :: ${lon.length}`);
      console.log('lon[1] = ' + lon[1]);
      // lon.forEach(function (value) {
      //   console.log("lon array");
      //   console.log(value);
      // });
    });
  } else {

    console.log("Error DataBase Not Connected!!! select statement");
  }
});

//DO NOT FORGET TO CLOSE THE CONNECTION