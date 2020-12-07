// Defaults
var clickValue = 1;
var passiveValue = 0;
let currencyValue = parseInt(document.getElementById('currencyValue').innerHTML);

// Passive Income Handling
// Clock
function passiveTimer() {
	currencyValue = Number(currencyValue) + Number(passiveValue);
	document.getElementById('currencyValue').innerHTML = currencyValue;
	setTimeout(passiveTimer, 1000);
};

// Click Handling
// Increment money onclick
function incrementClick() {
	currencyValue = Number(currencyValue) + Number(clickValue);
	document.getElementById('currencyValue').innerHTML = currencyValue;
};

// Upgrade Handling
// Increment upgrade onclick
function buyUpgrade(button_id, type) {
	// If active upgrade, buyable only once
	if (type == 'active') {
		var innerUpgrade = document.getElementById("upgrade-active-" + button_id).innerHTML;
		var innerCost = document.getElementById("cost-active-" + button_id).innerHTML;
		var innerAmount = document.getElementById("amount-active-" + button_id).innerHTML;
		var innerProfit = document.getElementById("profit-active-" + button_id).innerHTML;

		if (currencyValue >= innerCost) {
			innerAmount++;
			var innerAmount = document.getElementById("amount-active-" + button_id).innerHTML = innerAmount;
			currencyValue = Number(currencyValue) - Number(innerCost);
			document.getElementById('currencyValue').innerHTML = currencyValue;
			clickValue = Number(clickValue) * Number(innerProfit);
			console.log(innerAmount);
		} else {
			console.log('Not enough currency :( Active');
		}
	}
	// If passive upgrade, buyable multiple times
	else if (type == 'passive') {
		var innerUpgrade = document.getElementById("upgrade-passive-" + button_id).innerHTML;
		var innerCost = document.getElementById("cost-passive-" + button_id).innerHTML;
		var innerAmount = document.getElementById("amount-passive-" + button_id).innerHTML;
		var innerProfit = document.getElementById("profit-passive-" + button_id).innerHTML;

		if (currencyValue >= innerCost) {
			innerAmount++;
			document.getElementById("amount-passive-" + button_id).innerHTML = innerAmount;
			currencyValue = Number(currencyValue) - Number(innerCost);
			document.getElementById('currencyValue').innerHTML = currencyValue;
			passiveValue = Number(passiveValue) + Number(innerProfit);
			console.log(innerAmount);
		} else {
			console.log('Not enough currency :( Passive');
		}
	};
};

function updateUpgrades() {
	for (var i = 1; i < 11; i++) {
		var updateAmount = document.getElementById('amount-active-' + i).innerHTML
		var updateProfit = document.getElementById('profit-active-' + i).innerHTML
		if (updateAmount == 0) {
			// Do nothing
		} else {
			for (var e = 0; e < updateAmount; e++) {
				clickValue = Number(clickValue) * Number(updateProfit);
				console.log(updateAmount, updateProfit);
			}
		}
	}
	for (var i = 1; i < 11; i++) {
		var updateAmount = document.getElementById('amount-passive-' + i).innerHTML
		var updateProfit = document.getElementById('profit-passive-' + i).innerHTML
		console.log(updateAmount, updateProfit);
		if (updateAmount == 0) {
			// Do nothing
		} else {
			for (var e = 0; e < updateAmount; e++) {
				passiveValue = Number(passiveValue) + Number(updateProfit);
				console.log(updateAmount, updateProfit);
			}
		}
	}
}

function saveData() {
	var runTime = 0;
	var arr = {
		currency: [],
		active: [],
		passive: []
	}
	var amountActive = "amount-active-"
	var amountPassive = "amount-passive-"
	// Generate passive & active upgrades
	for (var i = 0; i < 10; i++) {
		var iamount = i + 1;
		var documentInfo = document.getElementById(amountActive + iamount);
		activeKey = "active-" + i;
		arr.active.push({
			[activeKey]: documentInfo.innerHTML
		});
	};
	for (var i = 0; i < 10; i++) {
		var iamount = i + 1;
		var documentInfo = document.getElementById(amountPassive + iamount);
		passiveKey = "passive-" + i;
		arr.passive.push({
			[passiveKey]: documentInfo.innerHTML
		});
	};

	arr.currency.push({
		["currency"]: currencyValue
	});

	sendToServer(arr);
	console.log(JSON.stringify(arr));
};

function sendToServer(data) {
	$.ajax({
		url: "../cat-clicker/bin/dbSave.php",
		type: "POST",
		data: {
			arr: data
		},
		success: function(data) {
			window.alert("Data saved!");
			console.log("Data saved!");
		}
	});
};

function loadData() {
	getFromServer();
}

function getFromServer() {
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: "currency",
		success: function(data) {
			currencyValue = Number(data);
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 13
		},
		success: function(data) {
			var domId = "amount-active-1"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 14
		},
		success: function(data) {
			var domId = "amount-active-2"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 15
		},
		success: function(data) {
			var domId = "amount-active-3"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 16
		},
		success: function(data) {
			var domId = "amount-active-4"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 17
		},
		success: function(data) {
			var domId = "amount-active-5"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 18
		},
		success: function(data) {
			var domId = "amount-active-6"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 19
		},
		success: function(data) {
			var domId = "amount-active-7"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 20
		},
		success: function(data) {
			var domId = "amount-active-8"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 21
		},
		success: function(data) {
			var domId = "amount-active-9"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 22
		},
		success: function(data) {
			var domId = "amount-active-10"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 13
		},
		success: function(data) {
			var domId = "amount-active-1"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 14
		},
		success: function(data) {
			var domId = "amount-active-2"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 15
		},
		success: function(data) {
			var domId = "amount-active-3"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 16
		},
		success: function(data) {
			var domId = "amount-active-4"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 17
		},
		success: function(data) {
			var domId = "amount-active-5"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 18
		},
		success: function(data) {
			var domId = "amount-active-6"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 19
		},
		success: function(data) {
			var domId = "amount-active-7"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 20
		},
		success: function(data) {
			var domId = "amount-active-8"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "active",
			"i": 21
		},
		success: function(data) {
			var domId = "amount-active-9"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "passive",
			"i": 2
		},
		success: function(data) {
			var domId = "amount-passive-1"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "passive",
			"i": 3
		},
		success: function(data) {
			var domId = "amount-passive-2"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "passive",
			"i": 5
		},
		success: function(data) {
			var domId = "amount-passive-3"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "passive",
			"i": 6
		},
		success: function(data) {
			var domId = "amount-passive-4"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "passive",
			"i": 7
		},
		success: function(data) {
			var domId = "amount-passive-5"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "passive",
			"i": 8
		},
		success: function(data) {
			var domId = "amount-passive-6"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "passive",
			"i": 9
		},
		success: function(data) {
			var domId = "amount-passive-7"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "passive",
			"i": 10
		},
		success: function(data) {
			var domId = "amount-passive-8"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "passive",
			"i": 11
		},
		success: function(data) {
			var domId = "amount-passive-9"
			document.getElementById(domId).innerHTML = data;
		}
	});
	$.ajax({
		url: "../cat-clicker/bin/dbLoad.php",
		type: "POST",
		data: {
			"type": "passive",
			"i": 12
		},
		success: function(data) {
			var domId = "amount-passive-10"
			document.getElementById(domId).innerHTML = data;
			updateUpgrades()
		}
	});
};