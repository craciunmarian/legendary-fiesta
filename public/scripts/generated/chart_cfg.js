const colors = [
    '#de2316',
    '#0fb3db',
    '#0fdb38',
    '#a30557',
    '#f58d42',
    '#141413',
    '#ebeb07',
    '#19158c',
    '#d400f5',
    '#FFFFFF',
    '#FFFFFF',
];

var query = '/api/query?' + '&from-json=false' + '&start-date=2012-05-01';
var ctx = document.getElementById('chart');
let params = new URLSearchParams(location.search);
var chartType = params.get("manner");

var county1, county2, county3;

if (params.get("county1") != 'ALEGE JUDEŢUL') {
    query = query + '&counties[]=' + params.get("county1").toLowerCase();
    county1 = params.get("county1");
}
if (params.get("county2") != 'ALEGE JUDEŢUL') {
    query = query + '&counties[]=' + params.get("county2").toLowerCase();
    county2 = params.get("county2");
}
if (params.get("county3") != 'ALEGE JUDEŢUL') {
    query = query + '&counties[]=' + params.get("county3").toLowerCase();
    county3 = params.get("county3");
}
if (params.has("women") || params.has("men")) {
    query = query + '&categories[]=sex';
}
if (params.has("age[]")) {
    query = query + '&categories[]=age';
}
if (params.has("education[]")) {
    query = query + '&categories[]=education';
}
if (params.has("compensated") || params.has("unpaid")) {
    query = query + '&categories[]=compensation';
}
if (params.has("urban") || params.has("rural")) {
    query = query + '&categories[]=environment';
}
if (params.has("rate")) {
    query = query + '&categories[]=rate';
}

var i = 0;

var chart = new Chart(ctx, {
    type: 'bar',
    data: {
    },
    options: {
        responsive: true,
        animation: true,
    }
});

function addData(label, dataAdd) {
    chart.data.datasets.push({
        label: label,
        data: dataAdd,
        backgroundColor: colors[i],
        borderColor: colors[i]
    });

    chart.update();
    i++;
}

function addLabel(label) {
    chart.data.labels.push(label);
    chart.update();
}

fetch(query)
    .then(function (u) {
        return u.json();
    })
    .then(function (json) {
        getChart(json);
    });

function getChart(data) {
    console.log(data);

    if (county1) {
        addLabel(county1);
        var dataset1 = data[0];
    }

    if (county2) {
        addLabel(county2);
        var dataset2 = data[1];
    }

    if (county3) {
        addLabel(county3);
        var dataset3 = data[2];
    }

    if (params.has("women")) {
        addData('Femei', [dataset1?.nr_barbati, dataset2?.nr_femei, dataset3?.nr_femei]);
    }
    if (params.has("men")) {
        addData('Barbati', [dataset1?.nr_barbati, dataset2?.nr_barbati, dataset3?.nr_barbati]);
    }
    if (params.has("compensated")) {
        addData('Indemnizați', [dataset1?.nr_indemnizati, dataset2?.nr_indemnizati, dataset3?.nr_indemnizati]);
    }
    if (params.has("unpaid")) {
        addData('Neindemnizați', [dataset1?.nr_neindemnizati, dataset2?.nr_neindemnizati, dataset3?.nr_neindemnizati]);
    }
    if (params.has("rural")) {
        addData('Rural', [dataset1?.nr_rural_total, dataset2?.nr_rural_total, dataset3?.nr_rural_total]);
    }
    if (params.has("urban")) {
        addData('Urban', [dataset1?.nr_urban_total, dataset2?.nr_urban_total, , dataset3?.nr_urban_total]);
    }
    if (params.has("education[]")) {
        let aux = params.getAll("education[]");
        console.log(aux);
        aux.forEach(element => {
            switch (element) {
                case 'none': console.log("1");
                    break;
                case 'primary': console.log("2");
                    break;
                case 'middle': console.log("1");
                    break;
                case 'high': console.log("1");
                    break;
                case 'post-secondary': console.log("1");
                    break;
                case 'professional': console.log("1");
                    break;
                case 'uni': console.log("1");
                    break;
                case 'all': console.log("all");
                    break;
                default: console.log("idk");
            }
        });
    }

    chart.update();
}

console.log(chart.data);

var canvas = document.getElementById('chart');
var context = canvas.getContext('2d');

document.getElementById('downloadPDF').addEventListener("click", exportToPDF);

function exportToPDF() {
    var canvas = document.querySelector('#chart');
    //creates image
    var canvasImg = canvas.toDataURL("image/png");

    //creates PDF from img
    var doc = new jsPDF('landscape');
    doc.setFontSize(20);
    doc.text(15, 15, "Cool Chart");
    doc.addImage(canvasImg, 'PNG', 10, 10, 280, 150);
    doc.save('canvas.pdf');
}