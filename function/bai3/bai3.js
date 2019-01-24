function assignLength() {
    var arrayLength = document.getElementById("length");

    var dArray = arrayChop(theArray,arrayLength.value);

    for(var t=0;t<arrayLength.value;t++){


        document.getElementById("box" + t).value = dArray[t];
    }

    for(var k=arrayLength.value;k<30;k++){

        document.getElementById("box" + k).value = ""
    }

}

function output() {

    var max = document.getElementById("max");
    var display = document.getElementById("output");

    theArray = [];

    for (var i=0;i<30;i++){

        theArray[i] = Math.floor(Math.random()*max.value+1);

    }
    display.innerText = theArray;

    assignLength()
}

function arrayChop(a,n){
    var newArray =[];

    for (var j=0;j<n;j++){

        newArray[j]= a[j];
    }

    newArray[n-1]='...';

    return newArray
}