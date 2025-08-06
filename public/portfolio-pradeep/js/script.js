function validate() {

    const name = document.getElementById('name');

const number = document.getElementById('number');

const submitButton = document.getElementById('submit');

let isValid = true;

if(name =="" ) {
   alert("Please fill your name.");
    isValid = false;
}

else if(name.value.length < 3) {
    alert("Name must be at least 3 characters long.");
    isValid = false;
}

if(number==""){
 alert("Please fill your number.");
    isValid = false;
}

else if(number.value.length < 10) {
    alert("Number must be at least 10 digits long.");
    isValid = false;
}

if(isValid)
{
    if(submit){
    alert("Thank you for submitting your details.");
}
}
    
}

document.getElementById('submit').addEventListener('click', validate);



