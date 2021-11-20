let baseURL = 'http://localhost/BarangaySystem/api/';
let app = angular.module("clearance",[]);  
app.controller("ClearanceController", function($scope, $http){   
// --------------- open side nav -----------------------
     $scope.openNav = function(){
          document.getElementById("nav").style.width = "250px";
          document.getElementById("nav").style.padding = "5px";
          document.getElementById("main").style.marginLeft = "260px";
          document.getElementById("btn-open").style.display = "none";
          document.getElementById("btn-close").style.display = "block";
     }
// --------------- close side nav -----------------------
     $scope.closeNav = function(){
          document.getElementById("nav").style.width = "0";
          document.getElementById("main").style.marginLeft= "0";
          document.getElementById("nav").style.padding = "0px";
          document.getElementById("btn-close").style.display = "none";
          document.getElementById("btn-open").style.display = "block";
     }
// --------------- logout user -----------------------
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
 // --------------- get residents -----------------------
     $scope.displayData = function(){  
          const img = localStorage.getItem("img");
          const name = localStorage.getItem("name");
          if (name != 'undefined'){
          }
          else if (name === 'undefined'){
               window.location.replace("Login.php");
          }
          else if (name === ''){
               window.location.replace("Login.php");
          }
          $http.post(baseURL+"clearance")  
          .success(function(data){  
               $scope.clearance = data.payload;  
          });  
          document.getElementById("superName").innerHTML = localStorage.getItem("name");
          document.getElementById("myImage").src=img;
     }  
 // --------------- open print -----------------------
     $scope.print = function(){  
          window.open("../../../../forms/Barangay Clearance.pdf", '_blank');
     }  
// --------------- create new resident -----------------------
     $scope.insertData = function(){  
          $http.post(baseURL+"addclearance", {
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
// --------------- update resident -----------------------
     $scope.updateData = function(){
          $http.post(baseURL+"updateclearance", {
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
// --------------- delete resident -----------------------
     $scope.deleteData = function(id){
       if(confirm("are you sure?")){
         $http.post(baseURL+"deleteclearance/"+id, {'id':id}) 
         .success(function(data){  
               alert("record deleted successfully!");
               $scope.displayData();
          });   
       }

       else {
         return false;
       }
       
     }
// --------------- search resident -----------------------
     $scope.searchResident = function() {
          $http.post(baseURL+"clearance/"+$scope.search, {
            'search_query':$scope.search
          })
          .success(function(data){  
              $scope.clearance = data.payload;
          });  
     }
// --------------- open edit modal -----------------------
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
// --------------- open create modal -----------------------
     $scope.openAdd = function() {
       document.getElementById("add-modal").style.display = "block";
       document.getElementById("edit-modal").style.display = "none";
     }
     $scope.closeAdd = function() {
          document.getElementById("add-modal").style.display = "none";
     }
// --------------- time scripts  -----------------------

     $scope.startTime = function() {
          let today = new Date();
          let h = today.getHours();
          let m = today.getMinutes();
          let s = today.getSeconds();
          let day = today.getDay();
          let month = today.getMonth();
          let year = today.getFullYear();
          let date = today.getDate();
          let dd = (h >= 12) ? 'PM' : 'AM';
      
          h = (h > 12) ? (h - 12) : h;
          h = $scope.checkTime(h);
          m = $scope.checkTime(m);
          s = $scope.checkTime(s);
          day = $scope.checkDay(day);
          month = $scope.checkMonth(month);
      
          $('#timepiece').html(h + ":" + m + ":" + s + ' ' + dd );
          let t = setTimeout($scope.startTime, 500);
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
