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
if (params.has("urban-men") || params.has("rural-men") || params.has("urban-women") || params.has("rural-women")) {
    query = query + '&categories[]=environment';
}
if (params.has("rate")) {
    query = query + '&categories[]=rate';
}

var i = 0;

let options = {
    type: chartType,
    data: {
    },
    options: {
        responsive: true,
        animation: true,
        plugins: {
            legend: {
                display: true,
                labels: {
                    color: 'black'
                }
            },
            datalabels: {
                formatter: function (value, context) {
                    return context.chart.data.labels[
                        context.dataIndex
                    ];
                }
            }
        }
    }
};

var chart = new Chart(ctx, options);

function addData(label, dataAdd) {
    chart.data.datasets.push({
        label: label,
        data: dataAdd,
        backgroundColor: colors[i],
        borderColor: colors[10]
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
        if (chartType == 'bar') {
            getBarChart(json);
        }
        else if (chartType == 'pie') {
            getPieChart(json);
        }
    });

function getBarChart(data) {
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
    if (params.has("urban-men")) {
        addData('Barbati - Urban', [dataset1?.nr_barbati_urban, dataset2?.nr_barbati_urban, dataset3?.nr_barbati_urban]);
    }
    if (params.has("rural-men")) {
        addData('Barbati - Rural', [dataset1?.nr_barbati_rural, dataset2?.nr_barbati_rural, dataset3?.nr_barbati_rural]);
    }
    if (params.has("urban-women")) {
        addData('Femei - Urban', [dataset1?.nr_femei_urban, dataset2?.nr_femei_urban, dataset3?.nr_femei_urban]);
    }
    if (params.has("rural-wpmen")) {
        addData('Femei - Rural', [dataset1?.nr_femei_rural, dataset2?.nr_femei_rural, dataset3?.nr_femei_rural]);
    }
    if (params.has("education[]")) {
        let aux = params.getAll("education[]");
        console.log(aux);
        aux.forEach(element => {
            switch (element) {
                case 'none': addData('Fără studii', [dataset1?.nr_fara_studii, dataset2?.nr_fara_studii, dataset3?.nr_fara_studii]);
                    break;
                case 'primary': addData('Inv. primar', [dataset1?.nr_primar, dataset2?.nr_primar, dataset3?.nr_primar]);
                    break;
                case 'middle': addData('Inv. gimnazial', [dataset1?.nr_gimnazial, dataset2?.nr_gimnazial, dataset3?.nr_gimnazial]);
                    break;
                case 'high': addData('Inv. liceal', [dataset1?.nr_liceal, dataset2?.nr_liceal, dataset3?.nr_liceal]);
                    break;
                case 'post-secondary': addData('Inv. postliceal', [dataset1?.nr_postliceal, dataset2?.nr_postliceal, dataset3?.nr_postliceal]);
                    break;
                case 'professional': addData('Inv. profesional', [dataset1?.nr_profesional, dataset2?.nr_profesional, dataset3?.nr_profesional]);
                    break;
                case 'uni': addData('Inv. universitar', [dataset1?.nr_universitar, dataset2?.nr_universitar, dataset3?.nr_universitar]);
                    break;
                case 'all': addData('Total', [dataset1?.nr_total, dataset2?.nr_total, dataset3?.nr_fara_total]);
                    break;
                default: console.log("idk");
            }
        });
    }
    if (params.has("age[]")) {
        let aux = params.getAll("age[]");
        console.log(aux);
        aux.forEach(element => {
            switch (element) {
                case 'under 25': addData('<25', [dataset1?.nr_sub_25, dataset2?.nr_sub_25, dataset3?.nr_sub_25]);
                    break;
                case '25-29': addData('25-29', [dataset1?.nr_25_29, dataset2?.nr_25_29, dataset3?.nr_25_29]);
                    break;
                case '30-39': addData('30-39', [dataset1?.nr_30_39, dataset2?.nr_30_39, dataset3?.nr_30_39]);
                    break;
                case '40-49': addData('40-49', [dataset1?.nr_40_49, dataset2?.nr_40_49, dataset3?.nr_40_49]);
                    break;
                case '50-55': addData('50-55', [dataset1?.nr_50_55, dataset2?.nr_50_55, dataset3?.nr_50_55]);
                    break;
                case 'over 55': addData('55<', [dataset1?.nr_peste_55, dataset2?.nr_peste_55, dataset3?.nr_peste_55]);
                    break;
                case 'all': addData('Total', [dataset1?.nr_total, dataset2?.nr_total, dataset3?.nr_total]);
                    break;
                default: console.log("idk");
            }
        });
    }
    chart.update();
}

function getPieChart(data) {
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
    if (params.has("urban-men")) {
        addData('Barbati - Urban', [dataset1?.nr_barbati_urban, dataset2?.nr_barbati_urban, dataset3?.nr_barbati_urban]);
    }
    if (params.has("rural-men")) {
        addData('Barbati - Rural', [dataset1?.nr_barbati_rural, dataset2?.nr_barbati_rural, dataset3?.nr_barbati_rural]);
    }
    if (params.has("urban-women")) {
        addData('Femei - Urban', [dataset1?.nr_femei_urban, dataset2?.nr_femei_urban, dataset3?.nr_femei_urban]);
    }
    if (params.has("rural-wpmen")) {
        addData('Femei - Rural', [dataset1?.nr_femei_rural, dataset2?.nr_femei_rural, dataset3?.nr_femei_rural]);
    }
    if (params.has("education[]")) {
        let aux = params.getAll("education[]");
        console.log(aux);
        aux.forEach(element => {
            switch (element) {
                case 'none': addData('Fără studii', [dataset1?.nr_fara_studii, dataset2?.nr_fara_studii, dataset3?.nr_fara_studii]);
                    break;
                case 'primary': addData('Inv. primar', [dataset1?.nr_primar, dataset2?.nr_primar, dataset3?.nr_primar]);
                    break;
                case 'middle': addData('Inv. gimnazial', [dataset1?.nr_gimnazial, dataset2?.nr_gimnazial, dataset3?.nr_gimnazial]);
                    break;
                case 'high': addData('Inv. liceal', [dataset1?.nr_liceal, dataset2?.nr_liceal, dataset3?.nr_liceal]);
                    break;
                case 'post-secondary': addData('Inv. postliceal', [dataset1?.nr_postliceal, dataset2?.nr_postliceal, dataset3?.nr_postliceal]);
                    break;
                case 'professional': addData('Inv. profesional', [dataset1?.nr_profesional, dataset2?.nr_profesional, dataset3?.nr_profesional]);
                    break;
                case 'uni': addData('Inv. universitar', [dataset1?.nr_universitar, dataset2?.nr_universitar, dataset3?.nr_universitar]);
                    break;
                case 'all': addData('Total', [dataset1?.nr_total, dataset2?.nr_total, dataset3?.nr_fara_total]);
                    break;
                default: console.log("idk");
            }
        });
    }
    if (params.has("age[]")) {
        let aux = params.getAll("age[]");
        console.log(aux);
        aux.forEach(element => {
            switch (element) {
                case 'under 25': addData('<25', [dataset1?.nr_sub_25, dataset2?.nr_sub_25, dataset3?.nr_sub_25]);
                    break;
                case '25-29': addData('25-29', [dataset1?.nr_25_29, dataset2?.nr_25_29, dataset3?.nr_25_29]);
                    break;
                case '30-39': addData('30-39', [dataset1?.nr_30_39, dataset2?.nr_30_39, dataset3?.nr_30_39]);
                    break;
                case '40-49': addData('40-49', [dataset1?.nr_40_49, dataset2?.nr_40_49, dataset3?.nr_40_49]);
                    break;
                case '50-55': addData('50-55', [dataset1?.nr_50_55, dataset2?.nr_50_55, dataset3?.nr_50_55]);
                    break;
                case 'over 55': addData('55<', [dataset1?.nr_peste_55, dataset2?.nr_peste_55, dataset3?.nr_peste_55]);
                    break;
                case 'all': addData('Total', [dataset1?.nr_total, dataset2?.nr_total, dataset3?.nr_total]);
                    break;
                default: console.log("idk");
            }
        });
    }
    chart.update();
}


var canvas = document.getElementById('chart');
var context = canvas.getContext('2d');

document.getElementById('downloadPDF').addEventListener("click", exportToPDF);

function exportToPDF() {
    var canvas = document.querySelector('#chart');
    //creates image
    var canvasImg = canvas.toDataURL("image/png");

    var width = document.getElementById('chart').offsetWidth;
    var height = document.getElementById('chart').offsetHeight;

    //creates PDF from img
    var doc = new jsPDF('landscape', 'px', [width, height]);
    doc.setFontSize(20);
    doc.addImage(canvasImg, 'PNG', 0, 0, width, height);
    doc.save('canvas.pdf');
}

// chart.options.animation = false;
// chart.options.responsive = false;
// createSvgLink('yeet.svg', 'SVG', chart, options);