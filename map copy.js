window.onload = init;




function init() {
  map = new OpenLayers.Map("js-map");
  var mapnik         = new OpenLayers.Layer.OSM();
  var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
  var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
  var position       = new OpenLayers.LonLat(77.5946,12.9716).transform(fromProjection, toProjection);
  var zoom           = 6; 

  map.addLayer(mapnik);
  map.setCenter(position, zoom ); 

  var markers = new OpenLayers.Layer.Markers( "Markers" );
  map.addLayer(markers);
  
  const long = [77.5946,109.6690977];
  const lat = [12.9716,-7.4029428]; 
  
  for(let i=0; i<2; i++){
    var lonLat = new OpenLayers.LonLat(long[i],lat[i]).transform(fromProjection, toProjection); 


    var size = new OpenLayers.Size(20,30);
    var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
    var icon = new OpenLayers.Icon('pinpoint.png', size, offset);
    var marker = new OpenLayers.Marker(lonLat,icon);
    markers.addMarker(marker);
  }

  marker.events.register("click", marker, function(e){
    popup = new OpenLayers.Popup.FramedCloud("",
                            marker.lonlat,
                            new OpenLayers.Size(200, 200),
                            "here lies your information",
                            null, true);

    map.addPopup(popup);
  }); 

}
