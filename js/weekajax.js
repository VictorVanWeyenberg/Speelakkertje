

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

	function initAanwezigheidsLijst() {
		filter.focus();
		aanwezigheidsLijst = document.getElementById("aanwezigheid");
		if (aanwezigheidsLijst != null) {
			var forms = aanwezigheidsLijst.querySelectorAll("form");
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
		var formRow = form.parentNode;

		var formData = new FormData(form);
		var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {

	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

	        	var newFormRow = xmlhttp.responseXML.getElementById(form.getAttribute("id")).parentNode;
	        	//console.log(newFormRow);
	        	var nextSibling = formRow.nextSibling;
	        	var parentNode = formRow.parentNode;
	        	parentNode.removeChild(formRow);
	        	if (nextSibling == null) {
	        		parentNode.appendChild(newFormRow);
	        	} else {
	        		parentNode.insertBefore(newFormRow, nextSibling);
	        	}
	        	initAanwezigheidsLijst();
	        }
	    }
	    xmlhttp.responseType = 'document';
	    xmlhttp.open("POST", mainForm.action, true);
	    history.pushState(null, null, mainForm.action);
	    xmlhttp.send(formData);
	}

	initAanwezigheidsLijst();
