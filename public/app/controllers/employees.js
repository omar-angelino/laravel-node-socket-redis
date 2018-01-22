app.controller('employeesController', function($scope, $http, API_URL) {
    //retrieve employees listing from API
    
    
    $http({
            method: 'GET',
            url: API_URL + "employees",
           headers: {'Content-Type': 'application/json'}
        }).then(function(response) {
            console.log(response.data.id);
             $scope.employees = response.data;
        }),(function(error) {
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });


    //show modal form
    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Employee";
                break;
            case 'edit':
                $scope.form_title = "Employee Detail";
                $scope.id = id;


                $http({
            method: 'GET',
            url: API_URL + "employees/" + id,
           headers: {'Content-Type': 'application/json'}
            }).then(function(response) {
                console.log(response);
                $scope.employee = response.data;
            }),(function(error) {
                console.log(response);
                alert('This is embarassing. An error has occured. Please check the log for details');
            });


                break;
            default:
                break;
        }
        console.log(id);
        $('#myModal').modal('show');
    }

    //save new record / update existing record
    $scope.save = function(modalstate, id) {
        var url = API_URL + "employees";
        
        //append employee id to the URL if the form is in edit mode
        if (modalstate === 'edit'){
            url += "/" + id;
        }
        
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.employee),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {
            console.log(response);
            location.reload();
        }),(function(error) {
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
    }

    //delete record
    $scope.confirmDelete = function(id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: API_URL + 'employees/' + id
            }).
                    then(function(data) {
                        console.log(data);
                        location.reload();
                    }).
                    error(function(data) {
                        console.log(data);
                        alert('Unable to delete');
                    });
        } else {
            return false;
        }
    }
});