    var thing = 'line';

    const colors = [
        '#660033',
        '#009933',
        '#663300',
        '#990000',
        '#cc00cc',
        '#666633',
    ]

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
            label: 'asdasdf',
            backgroundColor: colors[0],
            borderColor: colors[0],
            data: [200, 10, 5, 2, 20, 211, 555],
        },
        {
            label: 'guccitest2',
            backgroundColor: colors[1],
            borderColor: colors[1],
            data: [15, 213, 42, 21, 42, 44, 15],
        }]
    };

    const config = {
        type: thing,
        data,
        options: {}
    };

    var myChart = new Chart(ctx,
        config
    );

    var canvas = document.getElementById('chart');
    var context = canvas.getContext('2d');

    downloadPDF.addEventListener("click", function() {

        var container = document.getElementById('chart');
        var width = container.offsetWidth;
        var height = container.offsetHeight;
        console.log(height);

        var imgData = canvas.toDataURL("image/png", 1.0);
        var pdf = new jsPDF('l', 'pt', [width, height]);
      
        pdf.addImage(imgData, 'PNG', 0, 0, width, height);
        pdf.save("download.pdf");
      }, false);