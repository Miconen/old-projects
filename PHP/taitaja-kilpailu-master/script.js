function showTextForm() {
  var inputForm = document.getElementById("hideableTextForm");
      inputForm.style.display = "block";
      console.log("loudaoda");
}

function hideTextForm() {
  var inputForm = document.getElementById("hideableTextForm");
  if (document.getElementById("hideableTextForm").value !== "") {
    var r = confirm("Sivutetaanko kentän sisältö?");
    if (r == true) {
        inputForm.style.display = "none";
        inputForm.value = "";
    } else {
        document.getElementById("radio-ruokavalio-1").checked = true;
        return false;
    }
  } else if (inputForm.style.display === "block") {
      inputForm.style.display = "none";
  }
}
