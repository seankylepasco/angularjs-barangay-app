let baseURL = '../../../api/';
let app = angular.module('login', []);

app.controller('LoginController', function($scope, $http, fileReader){
     $scope.closeMsg = function(){
          $scope.alertMsg = false;
     };
    $scope.login_form = true;
// --------------- change to register mode -----------------------
    $scope.showRegister = function(){
     $scope.login_form = false;
     $scope.register_form = true;
     $scope.alertMsg = false;
    };
// --------------- change to login mode -----------------------
    $scope.showLogin = function(){
     $scope.register_form = false;
     $scope.login_form = true;
     $scope.alertMsg = false;
    };
// --------------- register user / add new user -----------------------

  $scope.submitRegister = function(){
    $http.post(baseURL+"register",
      {
        "name":$scope.register_name,
        "email":$scope.register_email,
        "password":$scope.register_password,
        "img":$scope.imageSrc
      })
      .success(function(data){  
        alert("you have registered successfully!");
        $scope.register_name = "";
        $scope.register_email = "";
        $scope.register_password = "";
        $scope.imageSrc = "";
        $scope.showLogin();
      }); 
  }
// --------------- login submitted data -----------------------
  $scope.submitLogin = function(){
    $http.post(baseURL+"login",
    {
      'email':$scope.email,
      'password':$scope.password
    }) 
    .success(function(data){  
      let id;
      let name;
      let img;
      let user_data;
      user_data = data.payload;
      if ($scope.email === ''){
        alert('missing email!')
      }
      else if($scope.password ===''){
        alert('missing password!')
      }
      if (data.message == "No users Found"){
        alert("No users Found");
      }
      else{
        id = user_data.id;
        name=user_data.name;
        img=user_data.img;
        localStorage.setItem("id", id);
        localStorage.setItem("name", name);
        localStorage.setItem("img", img);
        Swal.fire(
          'Good job!',
          'Logged In successfully!',
          'success'
        )
        .then(function () {
          window.location.replace("../residents/home/Home.html");
        });
      }
    });   
  }
// --------------- get user information -----------------------
  $scope.getUser = function(){  
    const name = localStorage.getItem("name");
    if (localStorage.getItem("name") != null) {
      window.location.replace("../residents/home/Home.html");
    }
    else if (name === 'undefined'){
      window.location.replace("Login.html");
    }
    else if (name === ''){
      window.location.replace("Login.html");
    }
  }  

// -------------- file in progress ------------------------------
  $scope.$on("fileProgress", function(e, progress) {
    $scope.progress = progress.loaded / progress.total;
  });

  $scope.imageSrc = "";
});

// ngFileSelect
app.directive("ngFileSelect", function(fileReader, $timeout) {
     return {
       scope: {
         ngModel: '='
       },
       link: function($scope, el) {
         function getFile(file) {
           fileReader.readAsDataUrl(file, $scope)
             .then(function(result) {
               $timeout(function() {
                 $scope.ngModel = result;
               });
             });
         }
         el.bind("change", function(e) {
           let file = (e.srcElement || e.target).files[0];
           getFile(file);
         });
       }
     };
   });
// file reader
 app.factory("fileReader", function($q, $log) {
   let onLoad = function(reader, deferred, scope) {
     return function() {
       scope.$apply(function() {
         deferred.resolve(reader.result);
       });
     };
   };
  // --------------- error -----------------------
   let onError = function(reader, deferred, scope) {
     return function() {
       scope.$apply(function() {
         deferred.reject(reader.result);
       });
     };
   };
    // --------------- on progress -----------------------
   let onProgress = function(reader, scope) {
     return function(event) {
       scope.$broadcast("fileProgress", {
         total: event.total,
         loaded: event.loaded
       });
     };
   };
   // --------------- reader -----------------------
   let getReader = function(deferred, scope) {
     let reader = new FileReader();
     reader.onload = onLoad(reader, deferred, scope);
     reader.onerror = onError(reader, deferred, scope);
     reader.onprogress = onProgress(reader, scope);
     return reader;
   };
     // --------------- change image to data url -----------------------
   let readAsDataURL = function(file, scope) {
     let deferred = $q.defer();
 
     let reader = getReader(deferred, scope);
     reader.readAsDataURL(file);
 
     return deferred.promise;
   };
 
   return {
     readAsDataUrl: readAsDataURL
   };
 })