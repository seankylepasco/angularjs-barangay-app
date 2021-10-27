// ============================== APP HOME ================================= //

var app = angular.module("myapp",[]);  
     app.controller("usercontroller", function($scope, $http){   

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
// --------------- LOGOUT USER -----------------------
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
               }
             }).then((result) => {
               if (result.isConfirmed) {
                 Swal.fire('Logout!', '', 'success');
                 window.location.replace("Login.php");

               } else if (result.isDenied) {
                 Swal.fire('Logout Cancelled', '', 'info')
               }
          })
     } 
 // --------------- GET RESIDENTS -----------------------
     $scope.displayData = function(){  
          $http.get("api/api/residents/read.php")  
          .success(function(data){  
               $scope.names = data;  
          });  
          document.getElementById("superName").innerHTML = localStorage.getItem("name");
     }  
// --------------- CREATE RESIDENT -----------------------
     $scope.insertData = function(){  
          var d = $scope.birthdate;
               if ( !!d.valueOf() ) {
                    year = d.getFullYear();
                    month = d.getMonth()+1;
                    day = d.getDate();
                    d.setDate(day+1);
                    d = d;
               }
          console.log($scope.img)
          $http.post("api/api/residents/create.php", {
            'name':$scope.name,
            'email':$scope.email,
            'birthdate':$scope.birthdate,
            'address':$scope.address,
            'gender':$scope.gender,
            'purok':$scope.purok,
            'voter_status':$scope.voter_status,
            'civil_status':$scope.civil_status,
            'img':$scope.img
           })
          .success(function(data){  
               alert("record added successfully!");
               $scope.displayData();
               document.getElementById("add-modal").style.display = "none";
               $scope.name = "";
               $scope.email = "";
               $scope.birthdate = "";
               $scope.address = "";
               $scope.gender = "";
               $scope.purok = "";
               $scope.voter_status = "";
               $scope.civil_status = "";
          });  
     }  
// --------------- UPDATE RESIDENT -----------------------
     $scope.updateData = function(){
          $http.post("api/api/residents/update.php", {
               'id':$scope.edit_id,
               'name':$scope.edit_name,
               'email':$scope.edit_email,
               'birthdate':$scope.edit_birthdate,
               'address':$scope.edit_address,
               'gender':$scope.edit_gender,
               'purok':$scope.edit_purok,
               'voter_status':$scope.edit_voter_status,
               'civil_status':$scope.edit_civil_status
              })
             .success(function(data){  
                  alert("record updated successfully!");
                  document.getElementById("edit-modal").style.display = "none";
                  $scope.displayData();
             });  
        }
// --------------- DELETE RESIDENT -----------------------
     $scope.deleteData = function(id){

       if(confirm("are you sure?")){
         $http.post("api/api/residents/delete.php/", {'id':id}) 
         .success(function(data){  
               alert("record deleted successfully!");
               $scope.displayData();
          });   
       }

       else {
         return false;
       }
       
     }
// --------------- SEARCH RESIDENT-----------------------
     $scope.searchResident = function() {
          $http.post("api/api/residents/search.php", {
            'search_query':$scope.search
          })
          .success(function(data){  
              $scope.names = data;
          });  
     }
// --------------- SELECT PHOTO -----------------------
     $scope.setPhoto = function(){
          console.log("HSOOSOSSO")
          console.log($scope.img)
          $scope.img = event.target.files[0];
          var reader = new FileReader();
          reader.onload = (event) => { event.target.result; }
          reader.readAsDataURL($scope.img);
     }
// --------------- OPEN UPDATE MODAL -----------------------
     $scope.openEdit = function(data){
       document.getElementById("edit-modal").style.display = "block";
       document.getElementById("add-modal").style.display = "none";
       $scope.edit_id = data.id;
       $scope.edit_name = data.name;
       $scope.edit_email = data.email;
       $scope.edit_gender = data.gender;
       $scope.edit_purok = data.purok;
       $scope.edit_birthdate = new Date(data.birthdate);
       $scope.edit_address = data.address;
       $scope.edit_voter_status = data.voter_status;
       $scope.edit_civil_status = data.civil_status;
       $scope.edit_img = data.img;
       $scope.id = data.id;  
     }

     $scope.closeEdit = function(){
          document.getElementById("edit-modal").style.display = "none";
     }
// --------------- OPEN CREATE MODAL -----------------------
     $scope.openAdd = function() {
       document.getElementById("add-modal").style.display = "block";
       document.getElementById("edit-modal").style.display = "none";
     }
     $scope.closeAdd = function() {
          document.getElementById("add-modal").style.display = "none";
     }
});

// ============================== APP LOGIN ================================= //
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
                    window.location.replace("Home.php");
                });
            }
        });   
    }

});

// ============================== APP CONTACT US ================================= //
function validate(){
     var name = document.getElementById("name").value;
     var subject = document.getElementById("subject").value;
     var phone = document.getElementById("phone").value;
     var email = document.getElementById("email").value;
     var message = document.getElementById("message").value;
     var error_message = document.getElementById("error_message");
     error_message.style.padding = "14px";
     var text;
     if(name.length < 20){
       text = "Please enter your specific valid name!!!";
       error_message.innerHTML = text;
       return false;
     }
     if(subject.length < 15){
       text = "Please enter your specific correct subject!!!";
       error_message.innerHTML = text;
       return false;
     }
     if(isNaN(phone) || phone.length != 11){
       text = "Please enter your specific valid phone or contact number!!!";
       error_message.innerHTML = text;
       return false;
     }
     if(email.indexOf("@") == -1 || email.length < 6){
       text = "Please enter your specific valid email address!!!";
       error_message.innerHTML = text;
       return false;
     }
     if(message.length <= 20){
       text = "Please enter more than 10 characters!!!";
       error_message.innerHTML = text;
       return false;
     }
     alert("Form Submitted Successfully!!!");
     return true;
}

// ============================== DATE FUNCTIONS ================================= //
