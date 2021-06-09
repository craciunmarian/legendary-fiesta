    const colors = [
        '#660033',
        '#009933',
        '#663300',
        '#990000',
        '#cc00cc',
        '#666633',
    ]
    var chartType;
    buildURL();

    function buildURL() {
        var URL = '/api/query?' + '&from-json=false' + '&start-date=2012-05-01';
        let params = new URLSearchParams(location.search);

        if(params.get("county1") != 'ALEGE JUDEȚUL'){
            URL = URL + '&counties[]=' + params.get("county1").toLowerCase();
        }
        if(params.get("county2") != 'ALEGE JUDEȚUL'){
            URL = URL + '&counties[]=' + params.get("county2").toLowerCase();
        }
        if(params.get("county3") != 'ALEGE JUDEȚUL'){
            URL = URL + '&counties[]=' + params.get("county3").toLowerCase();
        }
        if(params.has("women") || params.has("men")){
            URL = URL + '&categories[]=sex';
        }
        if(params.has("age[]")){
            URL = URL + '&categories[]=age';
        }
        if(params.has("education[]")){
            URL = URL + '&categories[]=education';
        }
        if(params.has("compensated") || params.has("unpaid")){
            URL = URL + '&categories[]=compensation';
        }
        if(params.has("urban") || params.has("rural")){
            URL = URL + '&categories[]=enviornment';
        }
        if(params.has("rate")){
            URL = URL + '&categories[]=rate';
        }
        chartType = params.get("manner");

        console.log(URL);

        fetch(URL)
        .then(response => {
            return response.json();
        })
        .then(jsonResponse => {
            console.log(jsonResponse);
    });
    }

    var ctx = document.getElementById('chart');

    const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'test',
            backgroundColor: '#660033',
            borderColor: '#660033',
            data: [200, 10, 5, 2, 20, 211, 555],
        },
        {
            label: 'test',
            backgroundColor: '#009933',
            borderColor: '#009933',
            data: [15, 213, 42, 21, 42, 44, 15],
        }]
    };

    const config = {
        type: chartType,
        data,
        options: {
            responsive: true,
            animation: true,
        }
    };

    var chartVar = new Chart(ctx,
        config
    );

    var canvas = document.getElementById('chart');
    var context = canvas.getContext('2d');

    // downloadSVG.addEventListener("click", function() {

    //     let svgContext = document.getElementById('chart');
    //     createSvgLink('chart.svg', 'SVG', chart, config);

    // }, false);

    
    downloadPDF.addEventListener("click", function() {

        var chartElem = document.getElementById('chart');
        var width = chartElem.offsetWidth;
        var height = chartElem.offsetHeight;
        
        var imgData = canvas.toDataURL("image/png", 1.0);
        var pdf = new jsPDF('l', 'px', [width, height]);
        
        pdf.addImage(imgData, 'PNG', 0, 0, width, height);
        pdf.save("download.pdf");
        
    }, false);