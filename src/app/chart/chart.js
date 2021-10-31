// ============================== APP CHART RESIDENTS ================================= //
var app = angular.module('chart', []);
app.controller('ChartController', function($scope, $http){

// --------------- NAVIGATION -----------------------
    $scope.openNav = function(){
        document.getElementById("nav").style.width = "250px";
        document.getElementById("nav").style.padding = "5px";
        document.getElementById("main").style.marginLeft = "260px";
        document.getElementById("btn-open").style.display = "none";
        document.getElementById("btn-close").style.display = "block";
    }
    $scope.closeNav = function(){
        document.getElementById("nav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.getElementById("nav").style.padding = "0px";
        document.getElementById("btn-close").style.display = "none";
        document.getElementById("btn-open").style.display = "block";
    }
// --------------- GET USER -----------------------
    $scope.getUser = function(){  
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
    }  
// --------------- LOGOUT -----------------------
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

});