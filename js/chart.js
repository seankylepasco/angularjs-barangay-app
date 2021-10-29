window.onload = function() {

    var dataPoints = [];
    
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
            text: "Purok Categories",
            horizontalAlign: "left"
        },
        data: [{
            type: "doughnut",
            startAngle: 60,
            indexLabelFontSize: 17,
            indexLabel: "{label} - #percent%",
            toolTipContent: "<b>{label}:</b> {y} (#percent%)",
            dataPoints: dataPoints
        }]
    });
    
    function addData(data) {
        for (var i = 0; i < data.length; i++) {
            dataPoints.push({
                y: parseInt(data[i].total) ,label: "Purok No. "+data[i].purok
            });
        }
        chart.render();
    
    }
    $.getJSON("api/api/residents/purok.php", addData);    
}