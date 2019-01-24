

function clickForAnswer() {

    var input1 = document.getElementById("box1");
    var input2 = document.getElementById("box2");
    var input3 = document.getElementById("box3");
    var display = document.getElementById("theAnswer");

    var answer = 3*input1.value+2*input2.value-input3.value;

    display.innerText = squared(answer)
}