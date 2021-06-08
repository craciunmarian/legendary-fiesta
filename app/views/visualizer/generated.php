<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/visualizer/generated.css" rel="stylesheet">
    <title>UnWe</title>
</head>
<body>
    <a class="header__text" href="/visualizer">Back</a>

    <div class="chart_thing">
        <canvas id="chart"></canvas>
    </div>

    <div class="chart-container" id='chart-container'>
        <!-- <a href="#" id="export-thing" onclick="exportToPDF()">Export as PDF</a> -->
        <button id="downloadPDF">download</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>
    <script src="/scripts/generated/chart_cfg.js"></script>
</body>
</html>