
// ============================== APP RESIDENT PERMIT ================================= //

var app = angular.module("permit",[]);  
     app.controller("PermitController", function($scope, $http){   

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
 // --------------- PRINT -----------------------
 $scope.print = function(){  
     window.open("../../../../forms/Barangay Permit.pdf", '_blank');
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
                 confirmButtonColor: '#00ADB5'
               }
             }).then((result) => {
               if (result.isConfirmed) {
                    localStorage.removeItem("name");
                    Swal.fire('Logout!', '', 'success');
                    window.location.replace("../../login/Login.html");

               } else if (result.isDenied) {
                 Swal.fire('Logout Cancelled', '', 'info')
               }
          })
     } 
 // --------------- GET RESIDENTS -----------------------
     $scope.displayData = function(){  
          const name = localStorage.getItem("name");
          if (name != 'undefined'){
          }
          else if (name === 'undefined'){
               window.location.replace("Login.php");
          }
          else if (name === ''){
               window.location.replace("Login.php");
          }
          $http.get("../../../../api/api/permit/read.php")  
          .success(function(data){  
               $scope.names = data;  
          });  
          document.getElementById("superName").innerHTML = localStorage.getItem("name");
     }  
// --------------- CREATE RESIDENT -----------------------
     $scope.insertData = function(){  
          $http.post("../../../../api/api/permit/create.php", {
            'name':$scope.name,
            'reason':$scope.reason,
            'address':$scope.address
           })
          .success(function(data){  
               alert("record added successfully!");
               $scope.displayData();
               document.getElementById("add-modal").style.display = "none";
               $scope.name = "";
               $scope.email = "";
               $scope.reason = "";
          });  
     }  
// --------------- UPDATE RESIDENT -----------------------
     $scope.updateData = function(){
          $http.post("../../../../api/api/permit/update.php", {
               'id':$scope.edit_id,
               'name':$scope.edit_name,
               'reason':$scope.edit_reason,
               'address':$scope.edit_address
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
         $http.post("../../../../api/api/permit/delete.php/", {'id':id}) 
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
          $http.post("../../../../api/api/permit/search.php", {
            'search_query':$scope.search
          })
          .success(function(data){  
              $scope.names = data;
          });  
     }
// --------------- OPEN UPDATE MODAL -----------------------
     $scope.openEdit = function(data){
       document.getElementById("edit-modal").style.display = "block";
       document.getElementById("add-modal").style.display = "none";
       $scope.edit_id = data.id;
       $scope.edit_name = data.name;
       $scope.edit_reason = data.reason;
       $scope.edit_address = data.address;
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
// --------------- CLOCK  -----------------------

     $scope.startTime = function() {
          var today = new Date();
          var h = today.getHours();
          var m = today.getMinutes();
          var s = today.getSeconds();
          var day = today.getDay();
          var month = today.getMonth();
          var year = today.getFullYear();
          var date = today.getDate();
          var dd = (h >= 12) ? 'PM' : 'AM';
      
          h = (h > 12) ? (h - 12) : h;
          h = $scope.checkTime(h);
          m = $scope.checkTime(m);
          s = $scope.checkTime(s);
          day = $scope.checkDay(day);
          month = $scope.checkMonth(month);
      
          $('#timepiece').html(h + ":" + m + ":" + s + ' ' + dd );
          var t = setTimeout($scope.startTime, 500);
          $('#day').html(day);
          $('#calendar').html(month + ' ' + date +','+year );

     }
     $scope.checkTime = function (i) {
   
          if (i < 10) { i = "0" + i };
          return i;
      
     }
     $scope.checkDay = function(day) {
          if (day == 1) {
            return day = 'Monday';
          }
          else if(day == 2){
            return day = 'Tuesday';
          }
          else if(day == 3){
            return day = 'Wednesday';
          }
          else if(day == 4){
            return day = 'Thursday';
          }
          else if(day == 5){
            return day = 'Friday';
          }
          else if(day == 6){
            return day = 'Saturday';
          }
          else if(day == 0){
            return day = 'Sunday';
          } 
     }
     $scope.checkMonth = function (month){ 
          if (month == 0){
            return month = 'January';
          }
          else if(month == 1){
            return month = 'February';
          }
          else if(month == 2){
            return month = 'March';
          }
          else if(month == 3){
            return month = 'April';
          }
          else if(month == 4){
            return month = 'May';
          }
          else if(month == 5){
            return month = 'June';
          }
          else if(month == 6){
            return month = 'July';
          }
          else if(month == 7){
            return month = 'August';
          }
          else if(month == 8){
            return month = 'September';
          }
          else if(month == 9){
            return month = 'October';
          }
          else if(month == 10){
            return month = 'November';
          }
          else if(month == 11){
            return month = 'December';
          }     
     }

});
