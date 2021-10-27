<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Barangay Records Management System</title>
  <link rel ="icon" href="img/Barangay Logo.png" type ="image/x-icon">
  <link rel="stylesheet" href="css/index.css"/>
  <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />
  <link type="text/css" rel="stylesheet" href="css/ionicons.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" 
  href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <section id="sidebar">

        <div class="sidebar-brand" >
            <a href="#"><img src="img/Barangay Logo.png" width="120"><i class="logo"></a>
            <h3>Barangay Records Management System</h3>
            <hr>
            <br>
            <b><p id="superName"></p></b>
        </div>

        <div class="sidebar-menu">
		        <ul>
              <li><a href="Admin Panel Dashboard.php"><i class="fa fa-user"></i><span>Home Dashboard</span></a></li>
              <li><a href="Barangay Clearance User.php"><i class="fa fa-users"></i><span>Barangay Clearance</span></a></li>
              <li><a href="Certificate of Indigency User.php"><i class="fa fa-users"></i><span>Certificate of Indigency</span></a></li>
              <li><a href="Barangay Permit User.php"><i class="fa fa-users"></i><span>Barangay Permit</span></a></li>
				      <li><a href="Contact Form Page.php"><i class="fa fa-envelope" aria-hidden="true"></i><span>Contact Us</span></a></li>
              <li ng-click="logout()"><a><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></li>
		        </ul>
		    </div>

    </section>

    <header>
      <center>
		    <div id="time" style="padding-left:12.2vh; font-family: century gothic">
				  <div style="width: 100%;">
					  <div>
						  <h6 class="col s12" style="font-size: 30px !important;" id="timepiece"></h6>
						  <h6 class="col s5" id="day"></h6>
						  <h6 class="col s7" style="font-size: 15px;" id="calendar"></h6>
					  </div>
            <div class="clear"></div>
              <div class="main-content-info container">
                <section id="main-content">
              <div class="content"></div>
            </div>
          </div>
        </div>
      </center>
    </header>
  
  <div class="container crud-table" ng-app="myapp" ng-controller="usercontroller" ng-init="displayData()">
      <div class="container crud-table">
        <div class="clearfix">
          <div lass="form-inline pull-left">
            <!-- GENERATE BUTTON -->
            <button class="btn btn-success" ng-click="openAdd()"><span class="fa fa-plus"></span> Add a new resident</button>
            <div class="form-inline pull-right">Search by Name: 
              <div class="form-group">
              <input class="form-control" type="text" ng-model="search" ng-change="searchResident()" placeholder="Type name to search"/>
            </div>
          </div>
          </div>
        </div>
      </div>

      <br><br>

      <div>  
        <table class="table table-striped">  
          <tr>  
            <th>ID</th>  
            <th>Name</th>  
            <th>Email</th>  
            <th>birthdate</th>
            <th>address</th>
            <th>gender</th>
            <th>nickname</th>
            <th>voter status</th>
            <th>civil status</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>  
          <tr ng-repeat="x in names">  
            <td style="width:200px">{{x.id}}</td>  
            <td>{{x.name}}</td>  
            <td>{{x.email}}</td>  
            <td>{{x.birthdate}}</td>  
            <td>{{x.address}}</td>  
            <td>{{x.gender}}</td>  
            <td>{{x.nickname}}</td> 
            <td>{{x.voter_status}}</td>  
            <td>{{x.civil_status}}</td>  
            <td>
                <button class="btn btn-primary" ng-click="openEdit(x)">Edit/Update</button>
              </td>
              <td> 
                <button class="btn btn-danger" ng-click="deleteData(x.id)">Delete</button>
              </td>
              <td> 
              <a href="indigency/index.php"><button class="btn btn-generate" ng-click="generateUser(x)">Generate Certificate</button></a>
              </td>
          </tr>  
        </table>  
      </div>  

      <!-- UPDATE MODAL -->
      <div id="edit-modal" class="modal">
        <div class="modal-content">
          <h1>Edit Resident</h1>
          <hr>
          <br>
          <form>
            <input ng-model="edit_id" id="id" type="text" style="width: 90%" required>
            <br><br> 
            Fullname
            <input ng-model="edit_name" id="name" type="text" style="width: 90%" required>
            <br><br>
            Email
            <input  ng-model="edit_email"  id="email" type="text" style="width: 90%" required>
            <br><br>
            Nickname
            <input  ng-model="edit_nickname" id="nickname" type="text" style="width: 90%" required>
            <br><br>
            Birthdate
            <input ng-model="edit_birthdate" id="birthdate" type="date" style="width: 90%" required>
            <br><br>
            Address
            <input  ng-model="edit_address" id="address" type="text" style="width: 90%" required>
            Gender
            <select ng-model="edit_gender" style="width: 90%" required>
              <option value="Male">Male</option>
              <option value="Female">Fema</option>
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
            <div style="width: 40%; margin: auto">
              <button class="btn btn-info"  ng-click="updateData()">Save</button>
              <button type="button" class="btn btn-info"  ng-click="closeEdit()">close</button>
            </div>
          </form>
        </div>
      </div>

      <!-- ADD MODAL -->
      <div id="add-modal" class="modal">
        <div class="modal-content">
          <h2>Create New Resident</h2>
          <hr>
          <br>
          <form>
            <input ng-model="name" type="text" placeholder="name" style="width: 90%" required> 
            <br><br> 
            <input ng-model="email" type="text" placeholder="email" style="width: 90%" required> 
            <br><br> 
            <input ng-model="nickname" type="text" placeholder="nickname" style="width: 90%" required> 
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

            <div style="width: 40%; margin: auto">
              <br>
              <button type="submit" name="btnInsert" class="btn btn-info" ng-click="insertData()">Add</button>
              <button type="button" class="btn btn-info"  ng-click="closeAdd()">close</button>
            </div>
          </form>
        </div>
      </div>
  </div>
  
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js'></script>
 <script src="js/index.js"></script>  
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/time.js"></script>
</html>