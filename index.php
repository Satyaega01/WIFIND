<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>SimpleGIS | Home</title>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content='' name='description' />
    <meta content='' name='author' />
    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/custom.css"/>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class='navbar navbar-default navbar-static-top'>
      <div class='container-fluid'>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class='navbar-brand' href='index.php'>SimpleGIS</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
            <li class='active'><a href="index.php">Home</a></li>
			<li><a id="about" href="#" >About</a></li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
				<?php
				error_reporting(0);
				session_start();
				//echo $_SESSION['mytype'];
				if (strlen($_SESSION['myusername']) != 0 && strlen($_SESSION['myname']) != 0 && strlen($_SESSION['mytype']) != 0)  { ?>
					<li><a href="admin/main.php">Login as <?php echo $_SESSION['myname']; ?></a></li>
					
				<?php } else{ ?> 
			        <li><a href="admin/index.php">Login</a></li>
				<?php }?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class='container-fluid'>
      <div class='row'>
        <!-- start left -->
		
		<div class='col-md-4'>
          <div class='well'>
            <h4>
              Pencarian Lokasi	
            </h4>
			<div class="form-group">
				<label>Cari Berdasarkan</label><small> (<a id='find_me' onclick="showCoordinate()" href='#'>Get Geolocation</a>)</small>
				<select id="pilihcari" name="pilihcari" class="form-control">
					<option value='Tampilkan Semua'>Tampilkan Semua</option>
					<option value='Radius'>Radius</option>
				</select>
			</div>
			<input type="hidden" id="lat" name="lat" size="30" maxlength="30" value="<?php echo $lat; ?>" class="form-control" placeholder="Latitude">
			<input type="hidden" id="long" name="long" size="30" maxlength="30" value="<?php echo $lng; ?>" class="form-control" placeholder="Longitude">
            <div id="divradius" class="form-group">
              <label>
                Radius
                <select id='search_radius'>
                  <option value='500'>1/2 km</option>
                  <option value='1000'>1 km</option>
                  <option value='2000'>2 km</option>
				  <option value='3000'>3 km</option>
				  <option value='4000'>4 km</option>
				  <option value='5000'>5 km</option>
                </select>
              </label>
            </div>
            <br />
            <a class='btn btn-primary' id='search' href='#'>
              <i class='glyphicon glyphicon-search'></i>
              Search
            </a>
			<a class='btn btn-warning' id='directionModal' href='#'>
              <i class='glyphicon glyphicon-random'></i>
              Tampilkan Rute
            </a>
            <a class='btn btn-default' id='reset' onclick="resetMap()" href='#'>
              <i class='glyphicon glyphicon-repeat'></i>
              Reset
            </a>
          </div>
          <div class='alert alert-info' id='result_box'><strong id='result_count'></strong></div>
        </div>
		<!-- ----------------- -->
		
        <div class='col-md-8'>
          <noscript>
            <div class='alert alert-info'>
              <h4>Your JavaScript is disabled</h4>
              <p>Please enable JavaScript to view the map.</p>
            </div>
          </noscript>
          <div id='map_canvas'></div>
          <p class='pull-right'>
            <a href='http://derekeder.com/searchable_map_template/'>Map Template</a> by <a href='http://derekeder.com'>Derek Eder</a>.
		  </p>
        </div>
      </div>
    </div>
	
	<!-- Modal -->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">About</h4>
				</div>
				<div class="modal-body" id="modal-body1">
				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
	<!-- Modal -->
	<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Rute</h4>
				</div>
				<div class="modal-body" id="directions-panel">
				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

    <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyAAgY3Vew0LpTLCBR_Sg98TKXrW_8Yk_4o&libraries=geometry"></script>
    <script type='text/javascript'>
		$(window).resize(function () {
          var h = $(window).height(),
            offsetTop = 105; // Calculate the top offset
        
          $('#map_canvas').css('height', (h - offsetTop));
        }).resize();
		
		var map, infoWindow, marker, myMarker;
		var gmarkers = []; 
		var map = null;
		var circle = null;
		var geocoder = new google.maps.Geocoder(); //geocoding
		var bounds = new google.maps.LatLngBounds();
		var infoWindow = new google.maps.InfoWindow;
		
		var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
		
		var customIcons = {
			hospital: {
				iconku: 'icon/hospital.png'
			},
			hotel: {
				iconku: 'icon/hotel.png'
			},
			university: {
				iconku: 'icon/university.png'
			}
		};
		
        $(function() {				
			//---> mengatasi multiple load Google Maps API
			if(!window.google||!window.google.maps){
				
				var script = document.createElement('script');
				script.type = 'text/javascript';
				script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAAgY3Vew0LpTLCBR_Sg98TKXrW_8Yk_4o&libraries=geometry&callback=initMap';
				document.body.appendChild(script);
			}
			else{
				initMap();
			}

			$("#divradius").hide();
			$("#result_box").hide();
			$("#directionModal").hide();
			
			$("select#pilihcari").change(function(){ 
				if ($("select#pilihcari").val() == "Tampilkan Semua"){ 	
					resetMap();
				}else if ($("select#pilihcari").val() == "Radius"){ 
					$("#divradius").show();
				}
			});
		});
		
		//---> membuat marker dan push to gmarkers (array)
		function createMarker(latlng, name, icon, html) {
			var contentString = html;
			var marker = new google.maps.Marker({
				position: latlng,
				title: name,
				icon: customIcons[icon].iconku,
				animation: google.maps.Animation.DROP
			});
			console.log(icon)
			
			//menempatkan dan menampilkan info window untuk marker
			google.maps.event.addListener(marker, 'click', function() {
				infoWindow.setContent(contentString); 
				infoWindow.open(map,marker);
			});
			
			gmarkers.push(marker);
			//alert(gmarkers.length);
			map.setCenter(marker.position);
			//map.zoom(12);
		}
		
		//---> mendefinisikan fungsi initMap()
		function initMap(){
			map = new google.maps.Map(document.getElementById('map_canvas'), {
			   center: new google.maps.LatLng(-8.676488,115.211177),
			   zoom: 12,
			   mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			
			// Bagian ini digunakan untuk mendapatkan data format JSON yang dibentuk dalam getmarker.php
			// berbasis Ajax
			$.ajax({
				url: "getmarker.php",
				type: "GET",
				dataType: "json",
				//cache: true,
                success: function(result){
					for(i=0; i < result.data.marker.length;i++){
						var point = new google.maps.LatLng(parseFloat(result.data.marker[i].lat),parseFloat(result.data.marker[i].lng));
						
						var content = '<h4>'+result.data.marker[i].name+'</h4>' +
						  '<b>Lokasi:</b>' +
						  '<p>'+result.data.marker[i].address+'</p>'+
						  '<p>Lat: '+result.data.marker[i].lat+'<br/>Lng: '+result.data.marker[i].lng+'</p>'+
						  '<b>Direction:</b>' +
						  '<p><input type="button" value="Rute ke Lokasi ini" id="akhir" />'+
						  '<input type="hidden" value='+result.data.marker[i].lat+' id="latku" />'+
						  '<input type="hidden" value='+result.data.marker[i].lng+' id="longku" /></p>'; 
						
						var type = result.data.marker[i].category;
						//membuat marker
						createMarker(point,result.data.marker[i].name,result.data.marker[i].category,content);
						// console.log(result.data.marker[i].category)
					}
			
					if (gmarkers.length > 0){
						for (var i=0; i<gmarkers.length;i++) {
							bounds.extend(gmarkers[i].getPosition());
							gmarkers[i].setMap(map);
						}	

						//now fit the map to the newly inclusive bounds
						map.fitBounds(bounds);
					}
                }
			});
			
			google.maps.event.addListener(map, 'click', function() {
				infoWindow.close();
			});
			
			//menampilkan traffic layer pada peta
			var trafficLayer = new google.maps.TrafficLayer(); 
            trafficLayer.setMap(map);			
			
			setDefaultMarker();
			
		} //akhir initMap()
			
		jQuery(document).on('click', '#search', function(event){
			if ($("select#pilihcari").val() != "Tampilkan Semua"){
				radiusSearch();
			}else{
				alert("Silahkan pilih metode pencarian..");
				
			}
		});
		
		//---> menset default marker
		function setDefaultMarker(){
			if (myMarker != null){
				myMarker.setMap(null);
			}
			
			//set lat & lng first load marker
			$("#lat").val(-8.676156560668673);
			$("#long").val(115.20589841265871);
			
			//var mylocation = new google.maps.LatLng($("#lat").val(),$("#long").val());
			
			myMarker = new google.maps.Marker({
				position: new google.maps.LatLng(-8.676156560668673,115.20589841265871),
				draggable: true,
				icon: 'icon/position.png',
			}); 
			
			google.maps.event.addListener(myMarker, 'dragend', function(event){
				$("#lat").val(event.latLng.lat());
				$("#long").val(event.latLng.lng());
				var contentD = '<h4>Posisi Saat Ini</h4>' +
				  '<b>Lokasi</b>' +
				  '<p>Lat: '+event.latLng.lat()+'<br/>Lng: '+event.latLng.lng()+'</p>';
				
				infoWindow.setContent(contentD);
				infoWindow.open(map, myMarker);
			});
			
			google.maps.event.addListener(myMarker, 'click', function(event){
				var contentD = '<h4>Posisi Saat Ini</h4>' +
				  '<b>Lokasi</b>' +
				  '<p>Lat: '+event.latLng.lat()+'<br/>Lng: '+event.latLng.lng()+'</p>';
				
				infoWindow.setContent(contentD);
				infoWindow.open(map, myMarker);
			});
			
			myMarker.setMap(map);
		}
		
		//---> fungsi geolocation
		function showCoordinate() {
			// Try HTML5 geolocation.
			infoWindow.close();
			if(navigator.geolocation) {  
				success = function(position) {    
					
					if (myMarker != null){
						myMarker.setMap(null);
					}
					
					var pos = {
					  lat: position.coords.latitude,
					  lng: position.coords.longitude,
					};
					
					myMarker = new google.maps.Marker({
					  position: new google.maps.LatLng(position.coords.latitude,position.coords.longitude),
					  draggable: true,
					  map: map,
					  icon: 'icon/position.png',
					}); 
					
					google.maps.event.addListener(myMarker, 'dragend', function(event){
						$("#lat").val(event.latLng.lat());
						$("#long").val(event.latLng.lng());
						
						var contentG = '<h4>Posisi Saat Ini</h4>' +
							'<b>Lokasi</b>' +
							'<p>Lat: '+event.latLng.lat()+'<br/>Lng: '+event.latLng.lng()+'</p>';
							
						infoWindow.setContent(contentG);
						infoWindow.open(map, myMarker);
					});
					
					$("#lat").val(position.coords.latitude);
					$("#long").val(position.coords.longitude);
					map.setCenter(pos);
				};
				error = function() {
					handleLocationError(true, infoWindow, map.getCenter());
				};    
				navigator.geolocation.getCurrentPosition(success, error);  
			} else {
			  // Browser doesn't support Geolocation
			  handleLocationError(false, infoWindow, map.getCenter());
			}
		}
		  
		function handleLocationError(browserHasGeolocation, infoWindow, pos) {
			infoWindow.setPosition(pos);
			infoWindow.setContent(browserHasGeolocation ?
								  'Error: The Geolocation service failed.' :
								  'Error: Your browser doesn\'t support geolocation.');
			infoWindow.open(map);
		}
		
		//---> me-reset peta
		function resetMap() {
			$("#divradius").hide();
			$("#pilihcari").val('Tampilkan Semua');
			$("#result_box").hide();
			$("#directionModal").hide();

			if (gmarkers.length > 0){
				for (var i=0; i<gmarkers.length;i++) {
					bounds.extend(gmarkers[i].getPosition());
					gmarkers[i].setMap(map);
				}
				//now fit the map to the newly inclusive bounds
				map.fitBounds(bounds);
				if (circle != null){
					circle.setMap(null);
				}
			}
			
			infoWindow.close();
			
			//set map null direction
			if (directionsDisplay){
				directionsDisplay.setMap(null);
			}
			
			setDefaultMarker();
		}
		
		//---> pencarian marker dengan radius
		function radiusSearch() {
			var lat = document.getElementById('lat').value;
			var lang = document.getElementById('long').value;
			var searchLatLang = new google.maps.LatLng(lat,lang)
			
			infoWindow.close();
			
			var radius = parseInt(document.getElementById('search_radius').value);
			geocoder.geocode( { 'location': searchLatLang}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
					var searchCenter = results[0].geometry.location;
					
					if (circle) circle.setMap(null);
					circle = new google.maps.Circle({strokeColor: '#1E90FF',
						strokeOpacity: 0.5,
						strokeWeight: 1,
						center:searchCenter,
						radius: radius,
						fillOpacity: 0.25,
						fillColor: "#1E90FF",
						map: map});
					
					var foundMarkers = 0;
					for (var i=0; i<gmarkers.length;i++) {
					  if (google.maps.geometry.spherical.computeDistanceBetween(gmarkers[i].getPosition(),searchCenter) < radius) {
						bounds.extend(gmarkers[i].getPosition())
						gmarkers[i].setMap(map);
						foundMarkers++;
					  } else {
						gmarkers[i].setMap(null);
					  }
					}
					// menampilkan jumlah marker yang ditemukan
					$("#result_box").fadeOut(function () {
						$("#result_count").html("Jumlah marker lokasi yang ditemukan: "+foundMarkers);
					});
					$("#result_box").fadeIn();
					
					map.fitBounds(circle.getBounds());
				
				} else {
					alert('Geocode was not successful for the following reason: ' + status);
				}
			});
		}
		
		//kalkulasi dan tampilkan rute
		function calculateAndDisplayRoute(tujuan) {
			
			//var start = new google.maps.LatLng(-8.679584, 115.202956);
			//var end = new google.maps.LatLng(-8.796386, 115.176770);
			
			//menambahkan arah ke dalam peta
			directionsDisplay.setMap(map);
			directionsDisplay.setPanel(document.getElementById('directions-panel'));
			
			var asal = new google.maps.LatLng(parseFloat($("#lat").val()),parseFloat($("#long").val()));

			directionsService.route({
			  origin: asal,
			  destination: tujuan,
			  travelMode: 'DRIVING'
			}, function(response, status) {
			  if (status === 'OK') {
				directionsDisplay.setDirections(response);
			  } else {
				window.alert('Directions request failed due to ' + status);
			  }
			});
			$("#directionModal").val();
			$("#directionModal").show();
			$('#myModal3').modal({show:true});
		}
		
		$('#directionModal').on('click',function(){
			$('#myModal3').modal({show:true});
		});
		
		jQuery(document).on('click', '#akhir', function(event){
			var posisi = new google.maps.LatLng(parseFloat($("input#latku").val()),parseFloat($("input#longku").val()));
			//alert(posisi);

			calculateAndDisplayRoute(posisi);
			infoWindow.close();
		});
		
		$('#about').on('click',function(){
			$('#modal-body1').load('getContent.php?id=1',function(){
				$('#myModal1').modal({show:true});
			});
		});

    </script>
  </body>
</html>
