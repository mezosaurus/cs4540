/*
* Function used to show or hide sections for various content in the TA application form
*/
function showSection(n) {
	var section = document.getElementById('formSection' + n);
	var button = document.getElementById('sectionBtn' + n);
	if (section.style.display == 'none') {
		section.style.display = 'table';
		button.className = 'arrow-down';
	}
	else {
		section.style.display = 'none';
		button.className = 'arrow-up';
	}
}

function onEducationLevelChange(select) {
	// Get value of education level and display the graduate information section if they select a graduate levl of education
	var edLevel = select.value;
	var gradSection = document.getElementById('graduateInfo');
	if (edLevel == 'gradbsms' || edLevel == 'master' || edLevel == 'phd') {
		gradSection.style.display = 'block';
	}
	else {
		gradSection.style.display = 'none';
	}
}

function onEmployedChange(radio) {
	var employmentDiv = document.getElementById('employmentInfo');
	if (radio.value == 0) {
		// hide employment div
		employmentDiv.style.display = 'none';
	}
	else {
		// show employment div
		employmentDiv.style.display = 'block';
	}
}

/*var courseList = [
	{
		"id" : "1000",
		"name" : "Engineering Computing"
	},
	{
		"id" : "1040",
		"name" : "Creating Interactive Web Content"
	},
	{
		"id" : "2000",
		"name" : "Programming in C"
	},
	{
		"id" : "2100",
		"name" : "Discrete Structures"
	},
	{
		"id" : "3100",
		"name" : "Models of Computation"
	},
	{
		"id" : "3500",
		"name" : "Software Practice I"
	},
	{
		"id" : "4150",
		"name" : "Adv Algorithms and Data Structures"
	},
	{
		"id" : "4400",
		"name" : "Computer Systems"
	},
	{
		"id" : "5530",
		"name" : "Database Systems"
	},
	{
		"id" : "5320",
		"name" : "Computer Vision"
	},
	{
		"id" : "6170",
		"name" : "Computational Topology"
	},
	{
		"id" : "6320",
		"name" : "3D Comp Vision"
	}
];
function createFormElements() {
	for (var i = 0; i < courseList.length; i++) {
		var formSection;

		// Get appropriate formsection div
		if (courseList[i].id >= 1000 && courseList[i].id <= 1999) {
			formSection = document.getElementById('formSection1000');
		}
		else if (courseList[i].id >= 2000 && courseList[i].id <= 2999) {
			formSection = document.getElementById('formSection2000');
		}
		else if (courseList[i].id >= 3000 && courseList[i].id <= 3999) {
			formSection = document.getElementById('formSection3000');
		}
		else if (courseList[i].id >= 4000 && courseList[i].id <= 4999) {
			formSection = document.getElementById('formSection4000');
		}
		else if (courseList[i].id >= 5000 && courseList[i].id <= 5999) {
			formSection = document.getElementById('formSection5000');
		}
		else if (courseList[i].id >= 6000 && courseList[i].id <= 6999) {
			formSection = document.getElementById('formSection6000');
		}

		// Create break
		var lineBreak = document.createElement("br");

		// Create label
		var label = document.createElement("label");
		label.htmlFor = 'courseExperience' + courseList[i].id;
		label.className = 'checkbox-label';
		label.innerHTML = 'CS ' + courseList[i].id + ' - ' + courseList[i].name;

		// Create checkbox input
		var input = document.createElement("input");
		input.id = 'courseExperience' + courseList[i].id;
		input.className = 'checkbox';
		input.setAttribute('type', 'checkbox');
		input.setAttribute('name', 'courseExperience' + courseList[i].id);

		formSection.appendChild(label);
		formSection.appendChild(input);
		formSection.appendChild(lineBreak);
	}
	for (var i = 0; i < courseList.length; i++) {
		var formSection;

		// Get appropriate formsection div
		if (courseList[i].id >= 1000 && courseList[i].id <= 1999) {
			formSection = document.getElementById('formSection1001');
		}
		else if (courseList[i].id >= 2000 && courseList[i].id <= 2999) {
			formSection = document.getElementById('formSection2001');
		}
		else if (courseList[i].id >= 3000 && courseList[i].id <= 3999) {
			formSection = document.getElementById('formSection3001');
		}
		else if (courseList[i].id >= 4000 && courseList[i].id <= 4999) {
			formSection = document.getElementById('formSection4001');
		}
		else if (courseList[i].id >= 5000 && courseList[i].id <= 5999) {
			formSection = document.getElementById('formSection5001');
		}
		else if (courseList[i].id >= 6000 && courseList[i].id <= 6999) {
			formSection = document.getElementById('formSection6001');
		}

		// Create p tag
		// Create break
		var lineBreak = document.createElement("br");

		// Create label
		var label = document.createElement("label");
		label.htmlFor = 'courseRequest' + courseList[i].id;
		label.className = 'checkbox-label';
		label.innerHTML = 'CS ' + courseList[i].id + ' - ' + courseList[i].name;

		// Create checkbox input

		var input = document.createElement("input");
		input.id = 'courseRequest' + courseList[i].id;
		input.className = 'checkbox';
		input.setAttribute('type', 'checkbox');
		input.setAttribute('name', 'courseRequest' + courseList[i].id);

		formSection.appendChild(label);
		formSection.appendChild(input);
		formSection.appendChild(lineBreak);
	}
}*/

