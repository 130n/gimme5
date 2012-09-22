function setHidden(fieldName, fromValue,divName)
{
	document.getElementById(fieldName).value= document.getElementById(fromValue).value;
	document.getElementById(divName).innerHTML= document.getElementById(fromValue).value;
}
// sätter tillbaka värdet, parametrarna är omvänd ordning för att underlätta copypaste
function getHidden(toField, fromField)
{
	var x = document.getElementById(fieldValue).innerHTML;
	document.getElementById(fieldName).innerHTML= document.getElementById(fieldValue).innerHTML;
	return x;
}