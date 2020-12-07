var formi = document.getElementById('formi');
var workerSearchResult = document.getElementById('searchResult');
var workerName = document.getElementById('workerName');
var workerPhone = document.getElementById('workerPhone');
var workerEmail = document.getElementById('workerEmail');
var workerPosition = document.getElementById('workerPosition');


formi.addEventListener('submit', function(event) {
  event.preventDefault();
  var workerData = formi.querySelector('.worker-search').value;
  if (workerData) {
    var xhttp = new XMLHttpRequest();
    xhttp.onload = function(event) {
      if (this.readyState == 4 && this.status == 200) {
        var workerResponse = JSON.parse(xhttp.responseText);
        console.log(workerResponse);
        workerName.innerHTML = workerResponse[0].title.rendered;
        workerPhone.innerHTML = workerResponse[0].contact[0].phone;
        workerEmail.innerHTML = workerResponse[0].contact[0].email;
        workerPosition.innerHTML = workerResponse[0].contact[0].position;
      }
    };
    xhttp.open("GET", "http://localhost/wp-dev/wp-json/wp/v2/employee?search=" + encodeURIComponent(workerData), true);
    xhttp.send();
  }
});
