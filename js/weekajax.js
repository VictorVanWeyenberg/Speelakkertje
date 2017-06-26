	var checkboxes = document.getElementById("aanwezigheid").querySelectorAll("input[type=checkbox]");
	[].forEach.call(checkboxes, function(checkbox) {
		//checkbox.onmouseup = function(e) { checkbox.form.submit(); };
		//checkbox.form.onsubmit = function(e) { console.log("jup"); e.preventDefault(); insert(e); };
	});

	var filter = document.getElementById("filter").querySelector("input[type=text]");
	filter.addEventListener("keyup", function(e) { filter.form.submit(); });

function insert(e) {
	e.preventDefault();

	console.log(e.target.form);

	var formData = new FormData(e.target.form);
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

        	if(xmlhttp.responseXML.getElementById('aanwezigheidslijst') != document.getElementById('aanwezigheidslijst')) {
	        	document.querySelector("body").replaceChild(xmlhttp.responseXML.getElementById('aanwezigheidslijst'), document.getElementById('aanwezigheidslijst'));
	        }
        }
    }
    xmlhttp.responseType = 'document';
    xmlhttp.open("POST", e.target.href, true);
    history.pushState(null, null, e.target.href);
    xmlhttp.send(formData);
}

function insert() {
	
}