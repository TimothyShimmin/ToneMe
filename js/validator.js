var regexAlphaNumeric = "";

function verifyAlphaNumeric(inputEl){
	var regex = /[^a-zA-Z0-9]/g;
	inputEl.value = inputEl.value.replace(regex, "");
}