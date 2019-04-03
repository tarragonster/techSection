var user =[
    {
        name:'Mai Anh',
        gender:'Nu',
        facebook:'facebook.com/maianh',
        phone:'09123754332',
        image:'trung_quoc.jpg',
    },

    {
        name:'Hoang Anh',
        gender:'Nu',
        facebook:'facebook.com/hoanganh',
        phone:'09893728374',
        image:'img/hoang_anh.jpg',
    }
];

$(function () {
    renderContent();
});


function renderContent() {
    var htmlContent ='';

    for(var i = 0; i< user.length; i++){
        htmlContent += '<tr>';

        htmlContent += '<td>'+user[i].name+'<td>';
        htmlContent += '<td>'+user[i].gender+'<td>';
        htmlContent += '<td>'+user[i].facebook+'<td>';
        htmlContent += '<td>'+user[i].phone+'<td>';
        htmlContent += '<td>'+user[i].image+'<td>';

        htmlContent += '<tr>';
    }

    $('#myTable tBody').html(htmlContent);

}


var click = 0;

function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
    dir = "asc";

    while (switching) {

        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {

            shouldSwitch = false;

            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {

                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {

                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {

            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;

            switchcount ++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

$('#name').on("click",function () {
    click++;
    $('#icon2').attr('src',"img/sort-arrows-couple-pointing-up-and-down.png");
    $('#icon3').attr('src',"img/sort-arrows-couple-pointing-up-and-down.png");
    $('#icon4').attr('src',"img/sort-arrows-couple-pointing-up-and-down.png");
    if(click%2 !==0){
        $('#icon1').attr('src',"img/down.png")
    }else{
        $('#icon1').attr('src',"img/up.png")
    }
});

$('#gender').on("click",function () {
    click++;
    $('#icon1').attr('src',"img/sort-arrows-couple-pointing-up-and-down.png");
    $('#icon3').attr('src',"img/sort-arrows-couple-pointing-up-and-down.png");
    $('#icon4').attr('src',"img/sort-arrows-couple-pointing-up-and-down.png");
    if(click%2 !==0){
        $('#icon2').attr('src',"img/down.png")
    }else{
        $('#icon2').attr('src',"img/up.png")
    }
});

$('#fb').on("click",function () {
    click++;
    $('#icon2').attr('src',"img/sort-arrows-couple-pointing-up-and-down.png");
    $('#icon1').attr('src',"img/sort-arrows-couple-pointing-up-and-down.png");
    $('#icon4').attr('src',"img/sort-arrows-couple-pointing-up-and-down.png");
    if(click%2 !==0){
        $('#icon3').attr('src',"img/down.png")
    }else{
        $('#icon3').attr('src',"img/up.png")
    }
});

$('#phone').on("click",function () {
    click++;
    $('#icon2').attr('src',"img/sort-arrows-couple-pointing-up-and-down.png");
    $('#icon3').attr('src',"img/sort-arrows-couple-pointing-up-and-down.png");
    $('#icon1').attr('src',"img/sort-arrows-couple-pointing-up-and-down.png");
    if(click%2 !==0){
        $('#icon4').attr('src',"img/down.png")
    }else{
        $('#icon4').attr('src',"img/up.png")
    }
})