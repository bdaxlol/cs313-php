function setSession(var, val) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("sessionResult").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "setSession.php?q=" + var + "&r=" + val, true);
	xmlhttp.send();
}