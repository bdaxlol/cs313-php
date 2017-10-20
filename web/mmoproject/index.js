function setSession(q, r) {
	console.log("setSession was called. Parameters are " + q + " & " + r);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("sessionResult").innerHTML = this.responseText;
			document.getElementById("charSelBtn").style.visibility = "visible";
		}
	};
	xmlhttp.open("GET", "setSession.php?q=" + q + "&r=" + r, true);
	xmlhttp.send();
}