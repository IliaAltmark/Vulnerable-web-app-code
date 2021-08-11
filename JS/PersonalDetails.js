function validateForm() {
  var fnameForm = document.forms["myForm2"]["firstName"].value;
  var lnameForm = document.forms["myForm2"]["lastName"].value;
  var emailForm = document.forms["myForm2"]["Email"].value;
  var atpos = emailForm.indexOf("@");
  var dotpos = emailForm.lastIndexOf(".");
  var phoneNumForm = document.forms["myForm2"]["phoneNumber"].value;
  var creditCardNumberForm = document.forms["myForm2"]["CreditCardNumber"].value;

  for (var i=0;i<fnameForm.length;i++)
  {
	  if ((!(fnameForm.charAt(i) >='a' && fnameForm.charAt(i) <='z')) && (!(fnameForm.charAt(i) >='A' && fnameForm.charAt(i) <='Z'))
	  && (fnameForm.charAt(i) !='-')){
  		alert("A first name can only contain characters from 'A-Z','a-z' and '-'");
  		return false;
		}

  }
  for (var j=0;j<lnameForm.length;j++)
  {
	  if ((!(lnameForm.charAt(j) >='a' && lnameForm.charAt(j) <='z')) && (!(lnameForm.charAt(j) >='A' && lnameForm.charAt(j) <='Z'))
	  && (lnameForm.charAt(j) !='-')){
  		alert("A last name can only contain characters from 'A-Z','a-z' and '-'");
  		return false;
		}
  }
  if(!(emailForm.length==0))
  {
  	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=emailForm.length) {
  		alert("Not a valid e-mail address,please follow the 'email@example.com' format");
  		return false;
  	}
  }
  for (var h=0;h<phoneNumForm.length;h++)
  {
	  if (!(phoneNumForm.charAt(h) >='0' && phoneNumForm.charAt(h) <='9'))
	  {
      alert("A phone number can only contain digits");
  		return false;
	  }
  }
  if (phoneNumForm.length <9 || phoneNumForm.length >11)
  {
  	alert("Please enter a phone number that is 9-11 digits long");
  	return false;
  }
  for (var k=0;k<creditCardNumberForm.length;k++)
  {
	  if (!(creditCardNumberForm.charAt(k) >='0' && creditCardNumberForm.charAt(k) <='9'))
	  {
      alert("A credit card number can only contain digits");
  		return false;
    }
  }
  if (creditCardNumberForm.length <8 || creditCardNumberForm.length > 16)
  {
  	alert("Please enter a credit card number that is 8-16 digits long");
  	return false;
  }
}
