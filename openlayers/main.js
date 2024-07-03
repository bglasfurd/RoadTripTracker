// window.onload = init;

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
    var sql = "select lon from coordinates where username = 'brad'";
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
        console.log("Error while selecting record from campground table. ");
      }

      // lon.forEach(function (value) {
      //   console.log("lon array");
      //   console.log(value);
      // });
    });


// GETTING LATITUDE FROM DB
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
        console.log("Error while selecting record from campground table. ");
      }

      // lon.forEach(function (value) {
      //   console.log("lon array");
      //   console.log(value);
      // });
    });


  } else {

    console.log("Error DataBase Not Connected!!! select statement");
  }

  var indexf = 0;

  lon.forEach(function(value){
  console.log(lon[indexf]+"  "+lat[indexf]);
})
});





// function init() {
//   map = new OpenLayers.Map("js-map");
//   var mapnik         = new OpenLayers.Layer.OSM();
//   var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
//   var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
//   var position       = new OpenLayers.LonLat(77.5946,12.9716).transform(fromProjection, toProjection);
//   var zoom           = 6; 

//   map.addLayer(mapnik);
//   map.setCenter(position, zoom ); 

//   var markers = new OpenLayers.Layer.Markers( "Markers" );
//   map.addLayer(markers);

//   // lon.forEach(function (value) {
//       //   console.log("lon array");
//       //   console.log(value);
//       // });
  
  
//   lon.forEach(function(value){
//     var lonLat = new OpenLayers.LonLat(lon[indexf],lat[indexf]).transform(fromProjection, toProjection); 


//     var size = new OpenLayers.Size(20,30);
//     var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
//     var icon = new OpenLayers.Icon('pinpoint.png', size, offset);
//     var marker = new OpenLayers.Marker(lonLat,icon);
//     markers.addMarker(marker);
//   });

//   marker.events.register("click", marker, function(e){
//     popup = new OpenLayers.Popup.FramedCloud("",
//                             marker.lonlat,
//                             new OpenLayers.Size(200, 200),
//                             "here lies your information",
//                             null, true);

//     map.addPopup(popup);
//   }); 

// }
