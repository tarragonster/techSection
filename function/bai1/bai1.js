

    function display() {
        var theInput = document.getElementById("numberInput");

        var theResult = squared(theInput.value);

        if(theInput.value == null){
            document.getElementById("alerting").innerText = ""
        }

        if (isNaN(theInput.value)) {
            document.getElementById("result").innerHTML ="";
            document.getElementById("alerting").innerText = "Number Please!";

        }else if (theInput.value > 100){

            theInput.value = 100;

            document.getElementById("result").innerHTML = "";
            document.getElementById("alerting").innerText = "must be less than 100";
        }else{

            document.getElementById("result").innerHTML = theResult;
            document.getElementById("alerting").innerText = "";
        }
    }


    function squared(a){

    var b;

    b = a*a;

    return b;

}




