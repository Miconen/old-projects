// HTML Element definitions
const elementMapContainer = document.getElementById('elementMapContainer');

const mapArray = [];

function inputHandler() {
	var inputMapId = document.getElementById('formMapId').value;
	var inputApiKey = document.getElementById('formApiKey').value;
	HandleMap(inputMapId, inputApiKey);
}

function HandleMap(inputMapId, inputApiKey) {
	this.inputMapId = inputMapId;
	this.inputApiKey = inputApiKey;

	this.getMap = function() {
		var apiUrl = "https://osu.ppy.sh/api/get_beatmaps?b=" + this.inputMapId + "&k=" + this.inputApiKey;
		// Returns map data in a variable named mapData in JSON format
		// Get map background with an ajax call from the osu website if possible
		// Maybe get more details in the future and display in a popup
		function mycallback(data) {
			this.addMap(data);
		}
		osuApiCall(apiUrl, mycallback);
	}

	this.addMap = function(mapData) {
		var map = JSON.parse(mapData);
		var mapArtist = map[0].artist;
		var mapTitle = map[0].title;
		var mapDifficulty = map[0].version;
		var mapStarsFloat = parseFloat(map[0].difficultyrating);
		var mapStars = mapStarsFloat.toFixed(2);

		mapArray.push([mapArtist, mapTitle, mapDifficulty, mapStars]);

		// Create containers
		var mapContainer = document.createElement("div");
		var mapContainerName = document.createElement("div");
		var mapContainerDesc = document.createElement("div");
		// Add styles
		mapContainer.classList.add("card");
		mapContainerName.classList.add("card-header");
		mapContainerDesc.classList.add("card-body");
		// Create text nodes
		var mapContainerNameContent = document.createTextNode(mapArtist + " - " + mapTitle + " [" + mapDifficulty + "] " + mapStars + " ★");
		var mapContainerDescContent = document.createTextNode("Test");
		// Append containers
		elementMapContainer.appendChild(mapContainer);
		mapContainer.appendChild(mapContainerName).appendChild(mapContainerNameContent);
		mapContainer.appendChild(mapContainerDesc).appendChild(mapContainerDescContent);
	}

	this.getMap()
}