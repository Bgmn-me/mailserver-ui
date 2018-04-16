function onBirthMonth(birthmonth) {
    if (birthmonth == 2){ //gibt an welcher Monat Februar ist.

        //check if the selected year is a leap-year or not.
        byear = document.forms["register"].elements["birthyear"].value;
        //document.getElementById("output").innerHTML = byear;
        byearsubstr01 = parseInt((byear).toString().substr(3,1));
        if(((byearsubstr01 == 0 || byearsubstr01 == 4 || byearsubstr01 == 8) && parseInt((byear).toString().substr(2,1))%2 == 0) || ((byearsubstr01 == 2 || byearsubstr01 == 6) && parseInt((byear).toString().substr(2,1))%2 != 0)){
            leapyear = true;
        } else {
            leapyear = false;
        }
        
        //disable all days over 28(29 by a leap-year) because it is februar.
        for (i = 29; i <= 31 ; i++) {
            if (i == 29 && leapyear == true){
                document.getElementById("bday29").disabled = false;
            } else {
                eval("document.getElementById('bday" + i + "').disabled = true");
            }
        }
    }
    else if (birthmonth <=6 && birthmonth%2 == 0 || birthmonth >= 9 && birthmonth%2 > 0){ //shows which months didn't have more than 30 days and disable the option in the <select> form element.
        document.getElementById("bday29").disabled = false;
        document.getElementById("bday30").disabled = false;
        document.getElementById("bday31").disabled = true;
    }
    else {// if (birthmonth%2 > 0 && birthmonth <= 7 || birthmonth%2 == 0 && birthmonth >= 8) { //shows which months didn't have more than 31 days and enable the options in the <select> form element.
        document.getElementById("bday29").disabled = false;
        document.getElementById("bday30").disabled = false;
        document.getElementById("bday31").disabled = false;
    }
}

function onBirthDate(birth,birthdate) {
    birth = birth;
    document.getElementById("output").innerHTML = birthdate;

}