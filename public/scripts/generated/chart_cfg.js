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

var ctx = document.getElementById('chart');
let params = new URLSearchParams(location.search);
var chartType = params.get("manner");
var query = '/api/query?' + '&from-json=false' + '&start-date=' + params.get("start-date") + '-01';

var county1, county2, county3;

if (params.has("county1")) {
    query = query + '&counties[]=' + params.get("county1").toLowerCase();
    county1 = params.get("county1");
}
if (params.has("county2")) {
    query = query + '&counties[]=' + params.get("county2").toLowerCase();
    county2 = params.get("county2");
}
if (params.has("county3")) {
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
if (params.has("women-rate") || params.has("men-rate")) {
    query = query + '&categories[]=rate';
}

console.log(query);

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
        borderColor: colors[i]
    });

    chart.update();
    i++;
}

function addPieData(color, dataAdd) {
    chart.data.datasets.push({
        backgroundColor: color,
        data: dataAdd
    })

    chart.update();
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
        else if (chartType == 'line') {
            getLineChart(json);
        }
    });

function getPieChart(data) {
    console.log(data);

    var repNr = 0;

    if (county1) {
        //addLabel(county1);
        var dataset1 = data[0];
        repNr++;
    }

    if (county2) {
        //addLabel(county2);
        var dataset2 = data[1];
        repNr++;
    }

    if (county3) {
        //addLabel(county3);
        var dataset3 = data[2];
        repNr++;
    }

    var ok = 0;
    var j;

    for (var j = 0; j < repNr; j++) {

        console.log("123");

        var auxArr = [];

        if (params.has("women")) {
            if (j == 0) addLabel('Femei');
            auxArr.push(data[i]?.nr_femei);
            ok = 1;
        }
        if (params.has("men")) {
            if (j == 0) addLabel('Barbati');
            auxArr.push(data[i]?.nr_barbati);
            ok = 1;
        }
        if (params.has("compensated")) {
            if (j == 0) addLabel('Indemnizați');
            auxArr.push(data[i]?.nr_indemnizati);
            ok = 1;
        }
        if (params.has("unpaid")) {
            if (j == 0) addLabel('Neindemnizați');
            auxArr.push(data[i]?.nr_neindemnizati);
            ok = 1;
        }
        if (params.has("urban-men")) {
            if (j == 0) addLabel('Barbati - Urban');
            auxArr.push(data[i]?.nr_barbati_urban);
            ok = 1;
        }
        if (params.has("rural-men")) {
            if (j == 0) addLabel('Barbati - Rural');
            auxArr.push(data[i]?.nr_barbati_rural);
            ok = 1;
        }
        if (params.has("urban-women")) {
            if (j == 0) addLabel('Femei - Urban');
            auxArr.push(data[i]?.nr_femei_urban);
            ok = 1;
        }
        if (params.has("rural-women")) {
            if (j == 0) addLabel('Femei - Rural');
            auxArr.push(data[i]?.nr_femei_rural);
            ok = 1;
        }
        if (params.has("women-rate")) {
            if (j == 0) addLabel('Femei - Rata');
            auxArr.push(data[i]?.rata_femei);
            ok = 1;
        }
        if (params.has("men-rate")) {
            if (j == 0) addLabel('Barbati - Rata');
            auxArr.push(data[i]?.rata_barbati);
            ok = 1;
        }
        if (ok == 0) {
            if (j == 0) addLabel('Total');
            auxArr.push(data[i]?.nr_total);
        }
        if (params.has("education[]")) {
            let aux = params.getAll("education[]");
            console.log(aux);
            aux.forEach(element => {
                switch (element) {
                    case 'none': if (j == 0) addLabel('Fără studii');
                        auxArr.push(data[i]?.nr_fara_studii);
                        break;
                    case 'primary': if (j == 0) addLabel('Inv. primar');
                        auxArr.push(data[i]?.nr_primar);
                        break;
                    case 'middle': if (j == 0) addLabel('Inv. gimnazial');
                        auxArr.push(data[i]?.nr_gimnazial);
                        break;
                    case 'high': if (j == 0) addLabel('Inv. liceal');
                        auxArr.push(data[i]?.nr_liceal);
                        break;
                    case 'post-secondary': if (j == 0) addLabel('Inv. postliceal');
                        auxArr.push(data[i]?.nr_postliceal);
                        break;
                    case 'professional': if (j == 0) addLabel('Inv. profesional');
                        auxArr.push(data[i]?.nr_profesional);
                        break;
                    case 'uni': if (j == 0) addLabel('Inv. universitar');
                        auxArr.push(data[i]?.nr_universitar);
                        break;
                    case 'all': if (j == 0) addLabel('Total');
                        auxArr.push(data[i]?.nr_total);
                        break;
                    default: console.log("idk");
                }
            });
        }
        if (params.has("age[]")) {
            let aux = params.getAll("age[]");
            aux.forEach(element => {
                switch (element) {
                    case 'under 25': if (j == 0) addLabel('<25');
                        auxArr.push(data[i]?.nr_sub_25);
                        break;
                    case '25-29': if (j == 0) addLabel('25-29');
                        auxArr.push(data[i]?.nr_25_29);
                        break;
                    case '30-39': if (j == 0) addLabel('30-39');
                        auxArr.push(data[i]?.nr_30_39);
                        break;
                    case '40-49': if (j == 0) addLabel('40-49');
                        auxArr.push(data[i]?.nr_40_49);
                        break;
                    case '50-55': if (j == 0) addLabel('50-55');
                        auxArr.push(data[i]?.nr_50_55);
                        break;
                    case 'over 55': if (j == 0) addLabel('55<');
                        auxArr.push(data[i]?.nr_peste_55);
                        break;
                    case 'all': if (j == 0) addLabel('Total');
                        auxArr.push(data[i]?.nr_total);
                        break;
                    default: console.log("idk");
                }
            });
        }

        var auxColors = [];
        for (i = 0; i < auxArr.length; i++) {
            auxColors.push(colors[i]);
        }

        addPieData(auxColors, auxArr);

    }




    chart.update();
}

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

    var ok = 0;

    if (params.has("women")) {
        addData('Femei', [dataset1?.nr_barbati, dataset2?.nr_femei, dataset3?.nr_femei]);
        ok = 1;
    }
    if (params.has("men")) {
        addData('Barbati', [dataset1?.nr_barbati, dataset2?.nr_barbati, dataset3?.nr_barbati]);
        ok = 1;
    }
    if (params.has("compensated")) {
        addData('Indemnizați', [dataset1?.nr_indemnizati, dataset2?.nr_indemnizati, dataset3?.nr_indemnizati]);
        ok = 1;
    }
    if (params.has("unpaid")) {
        addData('Neindemnizați', [dataset1?.nr_neindemnizati, dataset2?.nr_neindemnizati, dataset3?.nr_neindemnizati]);
        ok = 1;
    }
    if (params.has("urban-men")) {
        addData('Barbati - Urban', [dataset1?.nr_barbati_urban, dataset2?.nr_barbati_urban, dataset3?.nr_barbati_urban]);
        ok = 1;
    }
    if (params.has("rural-men")) {
        addData('Barbati - Rural', [dataset1?.nr_barbati_rural, dataset2?.nr_barbati_rural, dataset3?.nr_barbati_rural]);
        ok = 1;
    }
    if (params.has("urban-women")) {
        addData('Femei - Urban', [dataset1?.nr_femei_urban, dataset2?.nr_femei_urban, dataset3?.nr_femei_urban]);
        ok = 1;
    }
    if (params.has("rural-women")) {
        addData('Femei - Rural', [dataset1?.nr_femei_rural, dataset2?.nr_femei_rural, dataset3?.nr_femei_rural]);
        ok = 1;
    }
    if (params.has("women-rate")) {
        addData('Femei - Rata', [dataset1?.rata_femei, dataset2?.rata_femei, dataset3?.rata_femei]);
        ok = 1;
    }
    if (params.has("men-rate")) {
        addData('Barbati - Rata', [dataset1?.rata_barbati, dataset2?.rata_barbati, dataset3?.rata_barbati]);
        ok = 1;
    }
    if (ok == 0) {
        addData('Total', [dataset1?.nr_total, dataset2?.nr_total, dataset3?.nr_fara_total]);
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
                case 'all': addData('Total', [dataset1?.nr_total, dataset2?.nr_total, dataset3?.nr_total]);
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

function getLineChart(data) {

    var labelNr = 0;

    if (county1) {
        labelNr++;
    }

    if (county2) {
        labelNr++;
    }

    if (county3) {
        labelNr++;
    }

    var index = 0;
    var county1Array = [];
    var county2Array = [];
    var county3Array = [];

    data.forEach(element => {

        element.nr_total = 0;
        var aux = 0;

        if (element.nr_femei) {
            aux += element.nr_femei;
        }
        if (element.nr_barbati) {
            aux += element.nr_barbati;
        }
        if (element.nr_indemnizati) {
            aux += element.nr_indemnizati;
        }
        if (element.nr_neindemnizati) {
            aux += element.nr_neindemnizati;
        }
        if (element.nr_barbati_urban) {
            aux += element.nr_barbati_urban;
        }
        if (element.nr_barbati_rural) {
            aux += element.element?.nr_barbati_rural;
        }
        if (element.nr_femei_urban) {
            aux += element.nr_femei_urban;
        }
        if (element.nr_femei_rural) {
            aux += element.nr_femei_rural;
        }
        if (element.nr_fara_studii) {
            aux += element.nr_fara_studii;
        }
        if (element.nr_primar) {
            aux += element.nr_primar;
        }
        if (element.nr_gimnazial) {
            aux += element.nr_gimnazial;
        }
        if (element.nr_liceal) {
            aux += element.nr_liceal;
        }
        if (element.nr_postliceal) {
            aux += element.nr_postliceal;
        }
        if (element.nr_profesional) {
            aux += element.nr_profesional;
        }
        if (element.nr_universitar) {
            aux += element.nr_universitar;
        }
        if (element.nr_sub_25) {
            aux += element.nr_sub_25;
        }
        if (element.nr_25_29) {
            aux += element.nr_25_29;
        }
        if (element.nr_30_39) {
            aux += element.nr_30_39;
        }
        if (element.nr_40_49) {
            aux += element.nr_40_49;
        }
        if (element.nr_50_55) {
            aux += element.nr_50_55;
        }
        if (element.nr_peste_55) {
            aux += element.nr_peste_55;
        }
        if (element.rata_femei) {
            aux += element.rata_femei;
        }
        if (element.rata_barbati) {
            aux += element.rata_barbati;
        }

        element.nr_total += aux;

        if (index < labelNr) {
            index++;
        }

        if ((county1?.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "") == element.judet) && index == 1) {
            addLabel(element.luna);
            county1Array.push(element.nr_total);
            console.log(element.nr_total);
        }
        if ((county2?.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "") == element.judet) && index == 2) {
            county2Array.push(element.nr_total);
        }
        if ((county3?.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "") == element.judet) && index == 3) {
            county3Array.push(element.nr_total);
        }

        if (index == labelNr) {
            index = 0;
        }

    });

    if (county1) {
        addData(county1, county1Array);
    }
    if (county2) {
        addData(county2, county2Array);
    }
    if (county3) {
        addData(county3, county3Array);
    }

    console.log(data);
    chart.update();
}

console.log(options);

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

// console.log(options);

// chart.options.animation = false;
// chart.options.responsive = false;
// createSvgLink('yeet.svg', 'SVG', chart, options);