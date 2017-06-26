var mainForm = document.getElementById("weekform");
	var filter = document.getElementById("filter");
	var dag = document.getElementById("dag");
	var week = document.getElementById("week");
	var jaar = document.getElementById("jaar");
	filter.addEventListener("keyup", function(e) { filterName(e); });
	dag.addEventListener("change", function(e) { filterName(e); });
	week.addEventListener("change", function(e) { filterName(e); });
	jaar.addEventListener("change", function(e) { filterName(e); });

var aanwezigheidsLijst;
initAanwezigheidsLijst();

function initAanwezigheidsLijst() {
	filter.focus();
	aanwezigheidsLijst = document.getElementById("aanwezigheid");
	if (aanwezigheidsLijst != null) {
		var forms = aanwezigheidsLijst.querySelectorAll("form");
		console.log(forms);
		[].forEach.call(forms, function(form) {
			initCheckboxListeners(form);
		});
	}
}

function initCheckboxListeners(form) {
	var elements = form.elements;
	[].forEach.call(elements, function(element) {
		if (element.type == "checkbox") {
			element.addEventListener("change", function(e) { checkboxHandler(e); });
		}
	})
}

function filterName(e) {
	e.preventDefault();

	var formData = new FormData(mainForm);
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

        	if(document.getElementById('aanwezigheid') != null) {
			    mainForm.parentNode.removeChild(document.getElementById('aanwezigheid'));
			    mainForm.parentNode.appendChild(xmlhttp.responseXML.getElementById('aanwezigheid'));
		    } else {
		        mainForm.parentNode.appendChild(xmlhttp.responseXML.getElementById('aanwezigheid'));
	        }
	        initAanwezigheidsLijst();
        }
    }
    xmlhttp.responseType = 'document';
    xmlhttp.open("POST", mainForm.action, true);
    history.pushState(null, null, mainForm.action);
    xmlhttp.send(formData);
}

function checkboxHandler(e) {
	e.preventDefault();

	var form = e.target.form;
	console.log(form);

	var formData = new FormData(form);
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

        	var newForm = xmlhttp.responseXML.getElementById(form.getAttribute("id"));
        	console.log(newForm);
        	var parentNode = form.parentNode;
        	var nextSibling = form.nextSibling;
        	parentNode.removeChild(form);
        	if (nextSibling == null) {
        		parentNode.appendChild(newForm);
        	} else {
        		parentNode.insertBefore(newForm, nextSibling);
        	}
        	initAanwezigheidsLijst();
        }
    }
    xmlhttp.responseType = 'document';
    xmlhttp.open("POST", mainForm.action, true);
    history.pushState(null, null, mainForm.action);
    xmlhttp.send(formData);
}