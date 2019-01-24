function sorting(arr){

    for(var i=0;i<arr.length;i++){
        for(var j=i;j<arr.length;j++){
            t = a[i];
            arr[i] = min2(arr[i],arr[j]);

            if(arr[i]===arr[j]){
                arr[j] = t
            }
        }
    }
    return arr
}

function min2(a,b){
    if (a<b){
        return a
    }
    return b
}

function max2(a,b){

    if (a>b){
        return a
    }
    return b
}

function checkStringNum(string){

    var isString = string.split("");

    for (var i=0; i< isString.length;i++){

        if (isString[i] < 10){
            isString[i] = parseInt(isString[i]);
        }
        return typeof (isString[i])
    }
}

function arrToString(arr){

    var genString ="";

    for(var i = 0; i< arr.length; i++){
        genString = genString + arr[i]
    }
    return genString;
}

function cutString(currentString, number){

    var arString = currentString.split("");
    var newString = "";

    for(var i = 0; i< number;i++){

        newString = newString + arString[i]
    }

    return newString
}

function countElString(string) {

    var count = 0;
    var arString = string.split("");

    for(var i=0;i<arString.length;i++){

        count = count+1;
    }
    return count;
}

function doPrint(string,number){

    for (var i=0; i<number;i++){
        document.write(string)
    }

}
