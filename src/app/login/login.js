// ============================== APP LOGIN ================================= //
var app = angular.module('login', []);
app.controller('LoginController', function($scope, $http){

    $scope.closeMsg = function(){
    $scope.alertMsg = false;
    };
    $scope.login_form = true;
// --------------- SHOW REGISTER -----------------------
    $scope.showRegister = function(){
     $scope.login_form = false;
     $scope.register_form = true;
     $scope.alertMsg = false;
    };
// --------------- SHOW LOGIN -----------------------
    $scope.showLogin = function(){
     $scope.register_form = false;
     $scope.login_form = true;
     $scope.alertMsg = false;
    };
// --------------- REGISTER -----------------------

    $scope.submitRegister = function(){

          $http.post("../../../api/api/auth/register.php",
          {
               "name":$scope.register_name,
               "email":$scope.register_email,
               "password":$scope.register_password
          })
          .success(function(data){  
               alert("you have registered successfully!");
               $scope.register_name = "";
               $scope.register_email = "";
               $scope.register_password = "";
               $scope.showLogin();
          }); 
    }
// --------------- LOGIN -----------------------

    $scope.submitLogin = function(){
        $http.post("../../../api/api/auth/login.php",{'email':$scope.email,'password':$scope.password}) 
        .success(function(data){  
          var id;
          var name;
          var img;
          $scope.you = data;
          if ($scope.email === ''){
               alert('missing email!')
          }
          else if($scope.password ===''){
               alert('missing password!')
          }
          if (data.message == "No users Found"){
               alert("No users Found");
          }
          else{
               data.forEach(element => id=element.id);
               data.forEach(element => name=element.name);
               data.forEach(element => img=element.img);
               localStorage.setItem("id", id);
               localStorage.setItem("name", name);
               localStorage.setItem("img", img);
               Swal.fire(
                    'Good job!',
                    'Logged In successfully!',
                    'success'
               ).then(function () {
                    window.location.replace("../residents/home/Home.html");
               });
          }
        });   
    }
// --------------- GET USER -----------------------
     $scope.getUser = function(){  
          const name = localStorage.getItem("name");
          if (localStorage.getItem("name") != null) {
               window.location.replace("../residents/home/Home.html");
          }
          else if (name === 'undefined'){
          window.location.replace("Login.html");
          }
          else if (name === ''){
          window.location.replace("Login.html");
          }
     }  
});