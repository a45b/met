var gCity; 
window.onload = getLocation;

// refresh result in every hour 
setInterval(function(){
	if(gCity.length != 0){
		searchByCity();
	}
	getLocation();
}, 600000);

// get lat long
function getLocation() {
	if (navigator.geolocation) {    	
	    navigator.geolocation.getCurrentPosition(searchByLatLong);
	}
	document.getElementById("gear").addEventListener("click", searchByCity);	
	document.getElementById("city")
		.addEventListener("keyup", function(event) {
		event.preventDefault();
		if (event.keyCode == 13) {
			searchByCity();
		}
	});
}

// search by latitude longitude
function searchByLatLong(position) {	
	var lat = position.coords.latitude.toFixed(4);
	var lon = position.coords.longitude.toFixed(4);
	//var url = 'http://api.openweathermap.org/data/2.5/find?lat='+lat+'&lon='+lon+'&cnt=1&appid=2a4232ec0f2f82a8f8a10600a21b9481&units=metric';
	var url = 'https://met-iamkdev.rhcloud.com/cord/'+lat+'/'+lon;
	
	getData(url);
}

// search by city name
function searchByCity(){
    var city = document.getElementById('city').value;
	if(city.length == 0){
		city = 'Banglore';
	}
	gCity = city;    	
	//var url = 'http://api.openweathermap.org/data/2.5/find?q='+city+'&cnt=1&appid=2a4232ec0f2f82a8f8a10600a21b9481&units=metric';
	var url = 'https://met-iamkdev.rhcloud.com/find/'+city;
	getData(url);
}

// get json
function json(response) {  
	return response.json()  
}

// fetch data
function getData(url){
	fetch(url, {mode: 'cors'}) 	  
	.then(json)
	.then(function(data) {  
		//console.log('Request successful', data);  	    	    	    
		var icon = 'https://openweathermap.org/img/w/'+data['list'][0]['weather'][0]['icon']+'.png';		
		var temp = Math.round(data['list'][0]['main']['temp'])

		document.getElementById("place_name").innerHTML = data['list'][0]['name'];
		document.getElementById("icon_container").innerHTML = '<img src='+icon+' title='+data['list'][0]['weather'][0]['main']+'>';	    
		document.getElementById("temp").innerHTML = temp+'&deg;';
	})  
	.catch(function(error) {  
		console.log('Request failed', error)  
	});
}