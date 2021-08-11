function validateForm() {
	var date = document.forms["myForm1"]["Date"].value;
	var year = parseInt(date.substring(0,4));
	var month = parseInt(date.substring(5,7));
	var day = parseInt(date.substring(8,10));

	if ((year<2020) || (year==2020 && month<2) || (year==2020 && month==2 && day<20)) {
		alert("The grand opening is only after 20-02-2020!");
		return false;
	}
	if (year>2020) {
		alert("We can't register your order, please choose year 2020!");
		return false;
	}

	var time = document.forms["myForm1"]["Time"].value;
	var hour = parseInt(time.substring(0,2));
	var minutes = parseInt(time.substring(3,5));

	if ((hour<8) || (hour==8 && minutes<30)) {
		alert("That's too early! Please choose a time between 8:30 - 19:45!");
		return false;
	}
	if ((hour>20) || (hour==20 && minutes>0)) {
		alert("That's too late! Please choose a time between 8:30 - 19:45!");
		return false;
	}
	if (hour==19 && minutes>45) {
		alert("Sorry but that's not enough time to drink coffee and pet Haim! Please choose a time between 8:30 - 19:45!");
		return false;
	}
}
