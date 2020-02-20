<?php
//include 'OpenLocationCode.php';

$this->title = 'Mapa';
$this->params['breadcrumbs'][] = $this->title;
?>
     
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUw0-Dsf0cT40H6UVfMLTtAFIVP3RmLdE&language=pt&sensor=false"></script>  

  <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <script src="js/openlocationcode.js"></script>
  <script src="js/examples.js"></script>
  <link href='css/examples.css' rel='stylesheet' type='text/css'> 

  
  
  <div class="container" style="height: 600px;">
    <div class="col-md-9" style="height: 600px;">
      <div id="map" style="width: 100%; height: 100%; float:left;"></div> 
      
    </div>
    <div class="col-md-3" style="height: 600px; overflow-y: scroll;">
      <div id="panel" style="width: 100%;height: 100%; float:right;"></div> 
    </div>  
    
       </div>
       <script type="text/javascript"> 

     
//function initialize() {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
              var pos = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude
                };

              //  teste=pos.lat;
               // window.alert(teste);
             //   infoWindow.setPosition(pos);
             //   infoWindow.setContent('Location found.');
             //   map.setCenter(pos);

        
            /*  }, function() {
                handleLocationError(true, infoWindow, map.getCenter());*/

         var directionsService = new google.maps.DirectionsService();
         var directionsDisplay = new google.maps.DirectionsRenderer();
    
          var map = new google.maps.Map(document.getElementById('map'), {
           zoom:7,
           mapTypeId: google.maps.MapTypeId.ROADMAP
         });
        
         directionsDisplay.setMap(map);
         directionsDisplay.setPanel(document.getElementById('panel'));
     //   window.alert(pos.lat);
     //   window.alert(pos.lng);

       //  var originCorrentDate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        //window.alert(position.coords.longitude);

      //  var originCorrentDate = new google.maps.LatLng(codeArea.latitudeLo, codeArea.longitudeLo);

      var notasLocal = "Palmarejo";
      var olc = "SUM";

      var motoboyOLC = "seM";

      var dest;
        if(olc!=null){
          //var code = "<!?php echo $olccodeCliente;?>";
          //var codeArea = OpenLocationCode.decode(code);
          dest = new google.maps.LatLng(14.9163012, -23.5070331);
        }else if(notasLocal!=null){
          dest = notasLocal;
        }

      var orig;
      if(motoboyOLC!=null){
          //var codemot = "<!?php echo $olcMotoboy;?>";
          //var codeAreamot = OpenLocationCode.decode(codemot);
          orig = new google.maps.LatLng(14.9193911, -23.51219);
        }


         var request = {
         //  origin: 'Avenida do Palmarejo, Praia',
           origin: orig, 
           destination:dest,

         //  destination:'Rua Engenheiro António Graça, Praia, Cabo Verde',
           optimizeWaypoints: true,
           travelMode: google.maps.TravelMode.DRIVING
         };
    
         directionsService.route(request, function(response, status) {
           if (status == google.maps.DirectionsStatus.OK) {
             directionsDisplay.setDirections(response);
           }
         });
              });

        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
    // }

       
       </script> 