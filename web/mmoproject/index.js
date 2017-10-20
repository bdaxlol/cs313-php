function setSession(q, r) {
	console.log("setSession was called. Parameters are " + q + " & " + r);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("sessionResult").innerHTML = this.responseText;
			document.getElementById("continueBtn").style.visibility = "visible";
		}
	};
	xmlhttp.open("GET", "setSession.php?q=" + q + "&r=" + r, true);
	xmlhttp.send();
}

function attackEnemy(str, enemyId) {
	console.log("attackEnemy was called. Parameters are " + str + " & " + enemyId);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("attackResult").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "attackEnemy.php?str=" + str + "&enemyId=" + enemyId, true);
	xmlhttp.send();
}

function addLine(str) {
    var table = document.getElementById("scrollTable");
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    cell1.innerHTML = str;
    updateScroll();
}

function updateScroll(){
    var element = document.getElementById("scrollDiv");
    element.scrollTop = element.scrollHeight;
}