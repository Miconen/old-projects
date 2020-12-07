function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}
var el = document.createElement("div");
var img = prompt("Give image url");
el.innerHTML = '<center><img src="' + img + '" title="Test Badge"></center>'
var div = document.getElementsByClassName("userbox")[0].lastChild;
insertAfter(div, el);