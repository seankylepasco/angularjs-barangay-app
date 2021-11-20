let app = angular.module('chart', []);
app.controller('ChartController', function($scope, $http){
// --------------- open side nav -----------------------
    $scope.openNav = function(){
        document.getElementById("nav").style.width = "250px";
        document.getElementById("nav").style.padding = "5px";
        document.getElementById("main").style.marginLeft = "260px";
        document.getElementById("btn-open").style.display = "none";
        document.getElementById("btn-close").style.display = "block";
    }
// --------------- close side nav -----------------------
    $scope.closeNav = function(){
        document.getElementById("nav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.getElementById("nav").style.padding = "0px";
        document.getElementById("btn-close").style.display = "none";
        document.getElementById("btn-open").style.display = "block";
    }
// --------------- get user -----------------------
    $scope.getUser = function(){  
        $scope.chart();
        const img = localStorage.getItem("img");
        const name = localStorage.getItem("name");
        if (localStorage.getItem("name") === null) {
            window.location.replace("../login/Login.html");
        }
        else if (name === 'undefined'){
            window.location.replace("../login/Login.html");
        }
        else if (name === ''){
            window.location.replace("../login/Login.html");
        }
        document.getElementById("superName").innerHTML = localStorage.getItem("name");
        document.getElementById("myImage").src=img;
    }  
// --------------- logout -----------------------
    $scope.logout = function(){  
        Swal.fire({
            title: 'Are you sure to logout?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
                confirmButtonColor: '#00ADB5'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                localStorage.removeItem("name");
                Swal.fire('Logout!', '', 'success');
                window.location.replace("../login/Login.html");
            } 
            else if (result.isDenied) {
               Swal.fire('Logout Cancelled', '', 'info')
            }
        })
    } 
// --------------- chart -----------------------
    $scope.chart = function(){

        $http.post("../../../api/totalresidents")  
        .success(function(data){  
            
            $scope.names = data.payload;  
            let keys;
            let values = [];

            for (let name of $scope.names) {

                values.push(name.clearance);
                values.push(name.indigency);
                values.push(name.residents);
                keys = Object.keys(name);
                $scope.drawChart(keys, values);
           }

        });  
    }
    $scope.drawChart = function(keys, values) {

        console.log(keys)
        console.log(values)

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: keys,
                datasets: [{
                    label: 'number of data',
                    data: values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        return myChart;
    }
});

