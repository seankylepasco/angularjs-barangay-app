let baseURL = 'http://localhost/BarangaySystem/api/';
let app = angular.module("resident",[]);  
app.controller("ResidentController", function($scope, $http){   
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
// --------------- logout -----------------------
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
                  
                    Swal.fire('Logout!', '', 'success');
                    window.location.replace("../../login/Login.html");

               } else if (result.isDenied) {
                 Swal.fire('Logout Cancelled', '', 'info')
               }
          })
     } 
 // --------------- get residents -----------------------
     $scope.displayData = function(){  

          const name = localStorage.getItem("name");
          const img = localStorage.getItem("img");

          $scope.myImage = img;
          if (localStorage.getItem("name") === null) {
               window.location.replace("../../login/Login.html");
          }
          if (name != 'undefined'){
          }
          else if (name === 'undefined'){
               window.location.replace("../../login/Login.html");
          }
          else if (name === ''){
               window.location.replace("../../login/Login.html");
          }
          $http.post(baseURL+"residents")  
          .success(function(data){  

               $scope.names = data.payload;  
          });  

          document.getElementById("superName").innerHTML = localStorage.getItem("name");
          document.getElementById("myImage").src=img;
 
     }  
// --------------- create resident -----------------------
     $scope.insertData = function(){  
          
          if(!$scope.name){
               alert('missing name!')
          }
          else if(!$scope.birthdate){
               alert('missing birthdate!')
          }
          else if(!$scope.address){
               alert('missing address!')
          }
          else if(!$scope.gender){
               alert('missing gender!')
          }
          else if(!$scope.purok){
               alert('missing purok!')
          }
          let d = $scope.birthdate;
          if( !!d.valueOf() ) {
               year = d.getFullYear();
               month = d.getMonth()+1;
               day = d.getDate();
               d.setDate(day+1);
               d = d;
          }
          $http.post(baseURL+"addresident", {
            'name':$scope.name,
            'email':$scope.email,
            'birthdate':$scope.birthdate,
            'address':$scope.address,
            'gender':$scope.gender,
            'purok':$scope.purok,
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
               $scope.purok = "";
               $scope.voter_status = "";
               $scope.civil_status = "";
          })
          .fail(function(data){
               console.log(data)
          });  
     }  
// --------------- update resident -----------------------
     $scope.updateData = function(){
          $http.post(baseURL+"updateresident", {
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
             })
             .fail(function(data){
                  console.log(data);
             });  
        }
// --------------- delete resident -----------------------
     $scope.deleteData = function(id){

       if(confirm("are you sure?")){
         $http.post(baseURL+"deleteresident/"+id, {'id':id}) 
         .success(function(data){  
               alert("record deleted successfully!");
               $scope.displayData();
          })
          .fail(function(data){
               console.log(data)
          });   
       }
       else {
         return false;
       }
       
     }
// --------------- search resident -----------------------
     $scope.searchResident = function() {
          $http.post(baseURL+"residents/"+$scope.search, {
            'search_query':$scope.search
          })
          .success(function(data){  
              $scope.names = data.payload;
          })
          .fail(function(data){
               console.log(data)
          });  
     }
// --------------- select image -----------------------
     $scope.setPhoto = function(){
          $scope.img = event.target.files[0];
          let reader = new FileReader();
          reader.onload = (event) => { event.target.result; }
          reader.readAsDataURL($scope.img);
     }
// --------------- open edit modal -----------------------
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
// --------------- open add modal  -----------------------
     $scope.openAdd = function() {
       document.getElementById("add-modal").style.display = "block";
       document.getElementById("edit-modal").style.display = "none";
     }
     $scope.closeAdd = function() {
          document.getElementById("add-modal").style.display = "none";
     }
// --------------- clock  -----------------------
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
