<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/visualizer/generated.css">
    <title>UnWe</title>
</head>

<body>

    <a class="back-btn" href="/visualizer">Inapoi</a>

    <div class="chart-container">
        <canvas id="chart" class="chart"></canvas>
    </div>

    <div class="btns" id="btns">
        <button id="downloadPDF" class="dlPDF">Save as PDF</button>
        <button id="downloadCSV" class="dlCSV">Save as CSV</button>
        <!-- <button id="downloadSVG">Save as SVG</button> -->
    </div>

    <script src="/scripts/generated/canvas2svg.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>
    <script src="/scripts/generated/export.js"></script>
    <script src="/scripts/generated/chart_cfg.js"></script>
    
</body>

</html>