var app = angular.module("myapp",[]);  
app.controller("usercontroller", function($scope, $http){  
// --------------- GET ALL DATA -----------------------
     $scope.displayData = function(){  
          $http.get("api/api/residents/read.php")  
          .success(function(data){  
               $scope.names = data;  
               $(document).ready(function () {
                });
               for (let value of Object.values($scope.names)) {
               }
          });  
          document.getElementById("superName").innerHTML = localStorage.getItem("name");
     }  

     $scope.logout = function(){  
          Swal.fire({
               title: 'Do you want to save the changes?',
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
                 window.location.replace("Login Page.php");

               } else if (result.isDenied) {
                 Swal.fire('Logout Cancelled', '', 'info')
               }
          })
     }  
// --------------- GET COOKIES -----------------------
     function getCookie(cName) {
          const name = cName + "=";
          const cDecoded = decodeURIComponent(document.cookie); //to be careful
          const cArr = cDecoded.split('; ');
          let res;
          cArr.forEach(val => {
            if (val.indexOf(name) === 0) res = val.substring(name.length);
          })
          return res
        }
// --------------- INSERT -----------------------
     $scope.insertData = function(){  
          var d = $scope.birthdate;
          if ( !!d.valueOf() ) {
               year = d.getFullYear();
               month = d.getMonth()+1;
               day = d.getDate();
               d.setDate(day+1);
               d = d;
           } 
          $http.post("api/api/residents/create.php", {
            'name':$scope.name,
            'email':$scope.email,
            'birthdate':$scope.birthdate,
            'address':$scope.address,
            'gender':$scope.gender,
            'nickname':$scope.nickname,
            'voter_status':$scope.voter_status,
            'civil_status':$scope.civil_status
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
               $scope.nickname = "";
               $scope.voter_status = "";
               $scope.civil_status = "";
          });  
     }  
// --------------- DELETE -----------------------
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
// --------------- OPEN UPDATE MODAL -----------------------
     $scope.openEdit = function(data){
       document.getElementById("edit-modal").style.display = "block";
       document.getElementById("add-modal").style.display = "none";
       $scope.edit_id = data.id;
       $scope.edit_name = data.name;
       $scope.edit_email = data.email;
       $scope.edit_gender = data.gender;
       $scope.edit_nickname = data.nickname;
       $scope.edit_birthdate = new Date(data.birthdate);
       $scope.edit_address = data.address;
       $scope.edit_voter_status = data.voter_status;
       $scope.edit_civil_status = data.civil_status;
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
// --------------- UPDATE -----------------------
     $scope.updateData = function(){
       $http.post("api/api/residents/update.php", {
            'id':$scope.edit_id,
            'name':$scope.edit_name,
            'email':$scope.edit_email,
            'birthdate':$scope.edit_birthdate,
            'address':$scope.edit_address,
            'gender':$scope.edit_gender,
            'nickname':$scope.edit_nickname,
            'voter_status':$scope.edit_voter_status,
            'civil_status':$scope.edit_civil_status
           })
          .success(function(data){  
               alert("record updated successfully!");
               document.getElementById("edit-modal").style.display = "none";
               $scope.displayData();
          });  
     }
// --------------- OPEN CREATE MODAL -----------------------
     $scope.searchResident = function() {
       $http.post("api/api/residents/search.php", {
         'search_query':$scope.search
       })
       .success(function(data){  
           $scope.names = data;
       });  
     }
});  