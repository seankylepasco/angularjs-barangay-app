var myApp = angular.module('myApp', []);
myApp.controller('namesCtrl', function($scope, $filter) {
		$scope.triggerForm = false;
		$scope.editForm = false;
		$scope.addForm = false;
		$scope.order = 'fullname';

    $scope.users = [
        {id: 1, fullname:'Pascual, Piolo', birthdate:'12-01-80', age: 41, nickname: 'Papi', gender: 'Male', address: 'Purok 2', voterstatus: 'Yes', civilstatus: 'Single'},
		{id: 2, fullname:'Dee, Enchong', birthdate:'02-14-87', age: 34, nickname: 'Chong', gender: 'Male', address: 'Purok 1', voterstatus: 'No', civilstatus: 'Married'},
		{id: 3, fullname:'Dantes, Dingdong', birthdate:'02-02-78', age: 43, nickname: 'Dong', gender: 'Male', address: 'Purok 3', voterstatus: 'Yes', civilstatus: 'Married'},
		{id: 4, fullname:'Richards, Alden', birthdate:'12-12-87', age: 34, nickname: 'Alden', gender: 'Male', address: 'Purok 2', voterstatus: 'Yes', civilstatus: 'Single'},
		{id: 5, fullname:'Ford, Xander', birthdate:'07-04-90', age: 29, nickname: 'Marlou', gender: 'Male', address: 'Purok 4', voterstatus: 'No', civilstatus: 'Single'},
        ];
  
  	
  
    $scope.orderBy = function(filter){
    	$scope.order = filter;
    };
	
		$scope.editUser = function(user){
			var index = $scope.users.indexOf(user);
			$scope.triggerForm = true;
			$scope.editForm = true;
			$scope.addForm = false;
			$scope.civilstatusExisted = false;
			$scope.editUserId = index;
			$scope.crudFormFullname = $scope.users[index].fullname;
			$scope.crudFormBirthdate = $scope.users[index].birthdate;
			$scope.crudFormAge = $scope.users[index].age;
			$scope.crudFormNickname = $scope.users[index].nickname;
			$scope.crudFormGender = $scope.users[index].gender;
			$scope.crudFormAddress = $scope.users[index].address;
			$scope.crudFormVoterstatus = $scope.users[index].voterstatus;
			$scope.crudFormCivilstatus = $scope.users[index].civilstatus;
		};
		
		$scope.saveEdit = function(userId){
			if(userId == 'new'){
				var newUser = {
					fullname: $scope.crudFormFullname,
					birthdate: $scope.crudFormBirthdate,
					age: $scope.crudFormAge,
                    nickname: $scope.crudFormNickname,						
                    gender: $scope.crudFormGender,							
					address: $scope.crudFormAddress,
					voterstatus: $scope.crudFormVoterstatus,
					civilstatus: $scope.crudFormCivilstatus,					
				}
				$scope.users.push(newUser);
			}
			else {
				$scope.users[userId].fullname = $scope.crudFormFullname;
				$scope.users[userId].birthdate = $scope.crudFormBirthdate;
                $scope.users[userId].age = $scope.crudFormGender;
				$scope.users[userId].nickname = $scope.crudFormNickname;
                $scope.users[userId].gender = $scope.crudFormEmail;							
				$scope.users[userId].address = $scope.crudFormAddress;
				$scope.users[userId].voterstatus = $scope.crudFormVoterstatus;
				$scope.users[userId].civilstatus = $scope.crudFormCivilstatus;					
			}
			
			$scope.triggerForm = false;
			$scope.editForm = false;
			$scope.editUserId = 0;			
		}
	
		$scope.deleteUser = function(user) {
			var index = $scope.users.indexOf(user);
			$scope.users.splice(index, 1);  	
		}
  	
		$scope.addUser = function(){
			$scope.editUserId = 'new';
			$scope.triggerForm = true;
			$scope.editForm = false;
			$scope.addForm = true;
			$scope.civilstatusExisted = false;
			$scope.userForm.$setUntouched();
			$scope.crudFormFullname = '';
			$scope.crudFormBirthdate = '';
            $scope.crudFormAge = '';
			$scope.crudFormNickname = '';
            $scope.crudFormGender = '';						
			$scope.crudFormAddress = '';
			$scope.crudFormVoterstatus = '';
			$scope.crudFormCivilstatus = '';
		}
		$scope.checkCivilstatus = function(userId){
			
			if(userId === 'new' || $scope.crudFormCivilstatus !== $scope.users[userId].civilstatus){
				$scope.civilstatusExisted = $scope.users.some(function(user){
					return user.civilstatus === $scope.crudFormCivilstatus;
				});				
			}
		}
});