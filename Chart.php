<!DOCTYPE html>
<html lang="en" >

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Barangay Records Management System</title>
    <link rel ="icon" href="img/Barangay Logo.png" type ="image/x-icon">
    <link rel="stylesheet" href="css/index.css"/>
    <link type="text/css" rel="stylesheet" href="css/ionicons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css">

  </head>
  <body  ng-app="myapp" ng-controller="usercontroller" ng-init="displayData()">
      
      <nav id="nav" class="sidenav color-white">

          <div>
              <div class="center">
                <img src="img/Barangay Logo.png" class="icon">
              </div>
              <h4>Barangay Records Management System</h4>
              <hr>
              <b class="row center"><p>Hello !&nbsp;<p id="superName"></p></p></b>
          </div>

          <div class="col">

            <a href="Home.php"><i class="fa fa-user"></i> &nbsp; Home</a>
            <a href="Chart.php"><i class="fas fa-chart-pie"></i> &nbsp; Chart</a>
            <a href="ResidentClearance.php"><i class="fa fa-users"></i> &nbsp; Barangay Clearance</a>
            <a href="ResidentIndigency.php"><i class="fa fa-users"></i> &nbsp; Certificate of Indigency</a>
            <a href="ResidentPermit.php"><i class="fa fa-users"></i> &nbsp;  Barangay Permit</a>
            <a href="Contact.php"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp; Contact Us</a>
            <a ng-click="logout()"><i class="fa fa-sign-out" aria-hidden="true"></i> &nbsp; Logout</a>


          </div>

      </nav>
    
    <div id="main">

      <!-- HEADER -->
      <header>

        <button id="btn-open" class="button-17" role="button" ng-click="openNav()"><i class="fas fa-bars"></i></button> 
        <button id="btn-close" class="button-17" role="button" ng-click="closeNav()"><i class="fas fa-bars"></i></button> 

        <div id="time-container" class="center">
          <div id="time" class="column">
              <h3 id="timepiece"></h3>
          </div>
        </div>

        <div id="day-container" class="end color-white">
            <h3 id="day"></h3>&nbsp;
            <h3 id="calendar"></h3>
        </div>

      </header>

      <div class="center col">
        <br><br>
        <!-- CHART -->
        <div id="chartContainer" style="width:300px; height:350px"></div>


  </body>
  <script src="https://kit.fontawesome.com/c4442c2032.js" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js'></script>
  <script src="js/index.js"></script>
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/time.js"></script>
  <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script type="text/javascript" src='js/chart.js'></script>

</html>