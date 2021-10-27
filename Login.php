<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title> Barangay Records Management System</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/login.css">
	<link rel ="icon" href="img/Barangay Logo.png" type ="image/x-icon">
	<style type="text/css"></style> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css">
</head>

<body ng-app="login" ng-controller="login_controller">

    <!-- HEADER -->
    <header>
        <h4 style="margin-top:auto;margin-bottom:auto">Barangay Records Management System</h4>
        <div class="row">
            <div class="end">   
                <img src="img/subic-bg.png" alt="image">
                <img src="img/gcccs.png" alt="image">
            </div>
        </div>
    </header>

    <hr>

    <!-- CONTAINER -->
    <div class="container-body">

        <div class="center">
            <img src="img/Barangay Logo.png" alt="image">
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

    </div>
  
</body>

<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/index.js"></script>

</html>

