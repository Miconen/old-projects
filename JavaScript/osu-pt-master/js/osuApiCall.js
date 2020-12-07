function osuApiCall(apiUrl, callback) {
	var xhttp = new XMLHttpRequest();
	xhttp.timeout = 2000;
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			callback(this.responseText);
		};
	};
	xhttp.ontimeout = function() {
		console.log('Timeout');
	}
	xhttp.open("GET", apiUrl, true);
	xhttp.send();
}