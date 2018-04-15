function onBirthMonth(birthmonth) {
    if (birthmonth == 2){ //gibt an welcher Monat Februar ist.
        document.getElementById("output").innerHTML = "Birthmonth: " + birthmonth + " hat 28 Tage, birthmonth%2: " + birthmonth%2;
        for (;;){
            if(birthday <= 9){
                
            }
        }
    }
    else if (birthmonth <=6 && birthmonth%2 == 0 || birthmonth >= 9 && birthmonth%2 > 0){ //gibt aus welche Monate 30 Tage hat.
        document.getElementById("output").innerHTML = "Birthmonth: " + birthmonth + " hat 30 Tage, birthmonth%2: " + birthmonth%2;
    }
    else if (birthmonth%2 > 0 && birthmonth <= 7 || birthmonth%2 == 0 && birthmonth >= 8){ // gibt aus welche Monate 31 Tage hat.
        document.getElementById("output").innerHTML = "Birthmonth: " + birthmonth + " hat 31 Tage, birthmonth%2: " + birthmonth%2;
    }
}