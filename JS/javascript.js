function onBirthMonth(birthmonth) {
    //month = document.forms["register"].elements["birthmonth"].value;
    //document.getElementById("output").innerHTML = month;
    if (birthmonth == 2){ //gibt an welcher Monat Februar ist.
        document.getElementById("output").innerHTML = "Birthmonth: " + birthmonth + " hat 28 Tage, birthmonth%2: " + birthmonth%2;
        for (i = 29; i <= 31 ; i++) {
            if (i == 29 && leapyear == true){
            } else {
                eval("document.getElementById('bday" + i + "').disabled = true");
            }
        }
    }
    else if (birthmonth <=6 && birthmonth%2 == 0 || birthmonth >= 9 && birthmonth%2 > 0){ //gibt aus welche Monate 30 Tage hat.
        document.getElementById("output").innerHTML = "Birthmonth: " + birthmonth + " hat 30 Tage, birthmonth%2: " + birthmonth%2;
        document.getElementById("bday31").disabled = true;
    }
    else if (birthmonth%2 > 0 && birthmonth <= 7 || birthmonth%2 == 0 && birthmonth >= 8){ // gibt aus welche Monate 31 Tage hat.
        document.getElementById("output").innerHTML = "Birthmonth: " + birthmonth + " hat 31 Tage, birthmonth%2: " + birthmonth%2;
    }
}
//2016, 2012, 2008, 2004, 2000, 1996, 1992, 1988, 1984, 1980
//gerade 0, 4, 8 ungerade 2, 6
//2018, 