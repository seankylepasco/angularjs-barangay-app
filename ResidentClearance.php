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

      <!-- GENERATE BUTTON -->
      <div id="add-container" class="row start">
        <button class="button-17" ng-click="openAdd()"><span class="fa fa-plus"></span> &nbsp;Add a new resident</button>&nbsp;
        <div id="search-container" class="center">
        <i class="fas fa-search"></i>&nbsp;
        <input class="center" type="text" ng-model="search" ng-change="searchResident()" placeholder="Type name to search"/>
        </div>
      </div>
        
      <div class="center col">

        <!-- TABLE -->
        <div class="table-container">  
          <table class="table table-striped">
            <thead>
              <tr>  
                <th>ID</th>  
                <th>Name</th>  
                <th>Email</th>  
                <th>birthdate</th>
                <th>address</th>
                <th>gender</th>
                <th>Purok No.</th>
                <th>voter status</th>
                <th>civil status</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>  
            </thead>
            <tbody>
              <tr ng-repeat="x in names">  
                <td style="width:200px">{{x.id}}</td>  
                <td>{{x.name}}</td>  
                <td>{{x.email}}</td>  
                <td>{{x.birthdate}}</td>  
                <td>{{x.address}}</td>  
                <td>{{x.gender}}</td>  
                <td>{{x.purok}}</td> 
                <td>{{x.voter_status}}</td>  
                <td>{{x.civil_status}}</td>  
                <td>
                    <button class="button-3" ng-click="openEdit(x)">Edit</button>
                  </td>
                  <td> 
                    <button class="button-1" ng-click="deleteData(x.id)">Delete</button>
                  </td>
              </tr>  
            </tbody>
          </table>  
        </div>  

      </div>

        <!-- UPDATE MODAL -->
        <div id="edit-modal" class="modal">
          <div class="modal-content">

            <div class="modal-header">
              <span class="close button-1" ng-click="closeEdit()">&times;</span>
              <h3>Edit Resident</h3>
            </div>

            <div class="modal-body">
              <form>
                <input ng-model="edit_id" id="id" type="hidden" style="width: 90%" required>
                <br><br> 
                Fullname
                <input ng-model="edit_name" id="name" type="text" style="width: 90%" required>
                <br><br>
                Email
                <input  ng-model="edit_email"  id="email" type="text" style="width: 90%" required>
                <br><br>
                Purok
                <select ng-model="edit_purok" style="width: 90%" required>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
                <br><br>
                Birthdate
                <input ng-model="edit_birthdate" id="birthdate" type="date" style="width: 90%" required>
                <br><br>
                Address
                <input  ng-model="edit_address" id="address" type="text" style="width: 90%" required>
                <br><br>
                Gender
                <select ng-model="edit_gender" style="width: 90%" required>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
                <br><br>
                voter status
                <select ng-model="edit_voter_status" style="width: 90%" required>
                  <option value="yes">yes</option>
                  <option value="no">no</option>
                </select>
                <br><br> 
                civil status
                <select ng-model="edit_civil_status" style="width: 90%" required>
                  <option value="married">married</option>
                  <option value="single">single</option>
                </select>
                <br><br>
                  <input type="file" ng-model="edit_img">
                <br><br>
                <div style="width: 40%; margin: auto">
                  <button class="button-1" type="button" ng-click="closeEdit()">close</button>
                  <button class="button-3"  ng-click="updateData()">Save</button>
                </div>
              </form>
            </div>

          </div>
        </div>

        <!-- ADD MODAL -->
        <div id="add-modal" class="modal">
          <div class="modal-content">
            <span ng-click="closeAdd()" class="close button-1">&times;</span>
            <h3>Create New Resident</h3>
            <form>
              <input ng-model="name" type="text" placeholder="name" style="width: 90%" required> 
              <br><br> 
              <input ng-model="email" type="text" placeholder="email" style="width: 90%" required> 
              <br><br> 
              Purok
              <select ng-model="purok" style="width: 90%" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
              <br><br>
              Gender
              <select ng-model="gender" style="width: 90%" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <br><br>
              birthdate
              <input ng-model="birthdate" type="date" placeholder="birthdate" style="width: 90%" required> 
              <br><br> 
              <input  ng-model="address" type="text" placeholder="address" style="width: 90%"> 
              <br><br> 
              voter status
              <select ng-model="voter_status" style="width: 90%" required>
                <option value="yes">yes</option>
                <option value="no">no</option>
              </select>
              <br><br> 
              civil status
              <select ng-model="civil_status" style="width: 90%" required>
                <option value="married">married</option>
                <option value="single">single</option>
              </select>
              <br><br>
              <input type="file" ng-model="img" file-input="files">
              <br><br>
              <img class="img" ng-src="{{img}}" />
              <div style="width: 40%; margin: auto">
                <br>
                <button class="button-1" type="button" ng-click="closeAdd()">close</button>
                <button class="button-3"  type="button" ng-click="insertData()">Create</button>
              </div>
            </form>
          </div>
        </div>
    </div>

  </body>
  <script src="https://kit.fontawesome.com/c4442c2032.js" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js'></script>
  <script src="js/index.js"></script>  
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/time.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>