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
    <a class="back-btn" href="/visualizer">Back</a>

    <div class="chart-container">
        <canvas id="chart"></canvas>
        <p class="warning" id="warning" style="display: none;">Alege un judet coaie</p>
    </div>

    <div class="btns" id="btns">
        <button id="downloadPDF">Save as PDF</button>
        <!-- <button id="downloadSVG">Save as SVG</button> -->
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="/scripts/generated/canvas2svg.js"></script>
    <script src="/scripts/generated/export.js"></script>
    <script src="/scripts/generated/chart_cfg.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>
</body>
</html>
