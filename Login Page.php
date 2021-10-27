<!DOCTYPE html>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title style="color: white">Barangay Records Management System</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/Login-Page Style.css">
	<link rel ="icon" href="img/Barangay Logo.png" type ="image/x-icon">
	<style type="text/css"></style> 
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css">
</head>

    <center>
        <h1 style="color:white">Barangay Records Management System</h1>
    </center>
<body ng-app="login" ng-controller="login_controller" >

        <div id="logo">
            <center>
                <img src="img/Barangay Logo.png" alt="image">
            </center>
        </div>

    <div class="container form_style">

        <div class="alert {{alertClass}} alert-dismissible" ng-show="alertMsg">
                <a href="#" class="close" ng-click="closeMsg()" aria-label="close">&times;</a>
                {{alertMessage}}
        </div>

        <div class="panel panel-default" ng-show="login_form">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">
                    <form method="post" ng-submit="submitLogin()">
                        <div ng-repeat="x in you">
                            <p style="display:none">{{x.id}}</p>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" name="email" ng-model="email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" ng-model="password" class="form-control" />
                        </div>
                        <div class="form-group" align="center">
                            <input type="submit" name="login" class="btn btn-primary" value="Log In" />
                            <input type="checkbox" /><span> Keep me Signed In</span>
                            <br>
                            <p><span>Not a member? </span>
                                <input type="button" name="register_link" class="btn btn-primary btn-link" ng-click="showRegister()" value="Register"/>
                            </p>
                        </div>
                    </form>
                </div>
        </div>
        
        <div class="panel panel-default" ng-show="register_form">
                <div class="panel-heading">
                    <h3 class="panel-title">CREATE ACCOUNT</h3>
                </div>
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label>Enter Your Fullname</label>
                            <input ng-model="register_name" type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Enter Your Email Address</label>
                            <input ng-model="register_email" type="text" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Enter Your Password</label>
                            <input ng-model="register_password" type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group" align="center">
                            <button type="submit" class="btn btn-primary" ng-click="submitRegister()">Register</button>
                            <br />
                            <input type="button" name="login_link" class="btn btn-primary btn-link" ng-click="showLogin()" value="Login">
                        </div>
                    </form>
                </div>
        </div>
    </div>
 </body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
<script>
var app = angular.module('login', []);
app.controller('login_controller', function($scope, $http){


    $scope.closeMsg = function(){
    $scope.alertMsg = false;
    };

    $scope.login_form = true;

    $scope.showRegister = function(){
    $scope.login_form = false;
    $scope.register_form = true;
    $scope.alertMsg = false;
    };

    $scope.showLogin = function(){
    $scope.register_form = false;
    $scope.login_form = true;
    $scope.alertMsg = false;
    };

    $scope.submitRegister = function(){
        $http.post("api/api/auth/register.php",
        {
            "name":$scope.register_name,
            "email":$scope.register_email,
            "password":$scope.register_password,
        })
        .success(function(data){  
        alert("you have registered successfully!");
            $scope.register_name = "";
            $scope.register_email = "";
            $scope.register_password = "";
        }); 
    }

    $scope.submitLogin = function(){
        $http.post("api/api/auth/login.php",{'email':$scope.email,'password':$scope.password}) 
        .success(function(data){  
            $scope.you = data;
            var id;
            var name;
            data.forEach(element => id=element.id);
            data.forEach(element => name=element.name);
            console.log(id);
            console.log(name);
            localStorage.setItem("name", name);
            if (data.message == "No users Found"){
                alert("No users Found");
            }
            else{
                Swal.fire(
                    'Good job!',
                    'Logged In successfully!',
                    'success'
                ).then(function () {
                    window.location.replace("Admin Panel Dashboard.php");
                });
            }
        });   
    }

});
</script>