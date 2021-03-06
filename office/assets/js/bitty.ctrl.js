var app = angular.module('bittyApp');
app.controller('bctrl', ['$scope','$http', function($scope,$http){
	$http.get('http://localhost/bitty/class/v1/gettsession').then(function(res){
    	var ssid = res.data.sessid;
    	if (ssid === "") {
    		$state.go('login');
    	}else{
    		console.log(ssid);
    	}
	});

	$http.get('http://localhost/revenge/svr/class/v1/values').then(function(res){
        var username = res.data.username;
        var email = res.data.email;
        var phone = res.data.phone;
        var bitaddress = res.data.bitaddress;
        var box_id = res.data.kilo_box;

        $scope.address = bitaddress;
        // console.log(bitaddress);
    },
    function(res){
            // console.log('error', res);
    });
}])

app.controller('seCtrl', ['$scope', '$http', '$uibModal', '$log',  function($scope,$http,$uibModal,$log){
	$scope.my = { message: false };
	$scope.test = "emmanuel";
	console.log($scope.test);


    $(function() {
        $("button#savet").click(function(){
            var pass = $('#pass').val();
            // $('form.contact').serialize()
            console.log(pass);
        });
    });

}])

app.controller('secmodalCtrl', ['$scope', '$http', '$uibModal', '$log', function($scope, $http,$uibModal,$log){
	console.log("modal view");
    $scope.cancel = function() {
        $uibModal.dismiss('cancel');
    };
}])

app.controller('bctrl.nav', ['$scope','$http', function($scope,$http){
	$scope.test = "oop";
	$('#navigation ul li').on('click', function(){
		$('li.active').removeClass('active');
		$(this).addClass('active');
	});

	var current = localStorage.getItem('cur');

	if(current === null){
		localStorage.setItem("cur", JSON.stringify({pref: "USD"}));
		current = "USD";
		$scope.myCur = current;
	} else {
		var current = JSON.parse(localStorage.getItem('cur'));
		$scope.myCur = current.pref;
	}

	$http.get('http://localhost/revenge/svr/office/assets/js/temp.json').then(function(res){
		var dat = res.data; $scope.currencies = [];

		Object.keys(dat).forEach(key => {
			$scope.currencies.push(key);
		})

		//watch the currency changer for changes....
		$scope.$watch('myCur', () =>{
			console.log($scope.myCur);
			localStorage.setItem('cur', JSON.stringify({pref: $scope.myCur}));
		})
	})

}]);

app.controller('bctrl.dash', function($scope,$http,externData){
	$scope.transfer = function(data){
        data.cont = 'user';
        $http.post('', JSON.stringify(data)).then(function(res){
            $scope.feedback.hide = false;
            if(res.data.status == 200){
                $scope.feedback.body = res.data.message;
                $scope.feedback.type = 'success';

                $scope.f = "animated shake";

                setTimeout(function() {
                    $scope.f = '';
                    return $scope.feedback.hide = true;
                }, 1000);

            } else {
                $scope.feedback.body = res.data.message;
                $scope.feedback.type = 'danger';
                console.log(res.data.message);

                $scope.f = "animated shake";

                setTimeout(function() {
                    $scope.f = '';
                    return $scope.feedback.hide = true;
                }, 1000);
            }
        })
    }

	$http.get('http://localhost/revenge/svr/class/v1/values').then(function(res){
        var username = res.data.username;
        var email = res.data.email;
        var phone = res.data.phone;
        var bitaddress = res.data.bitaddress;
        var box_id = res.data.kilo_box;

        $scope.usern = username;
        console.log($scope.usern);
    },
        function(res){
            // console.log('error', res);
    });

    $http.get('http://localhost/revenge/svr/class/v1/balance').then(function(res){
        var address = res.data.bitaddress;
        var bitbalance = res.data.avail_bal;
        $scope.bitbalance = bitbalance;
        $scope.address = address;
        // console.log(address);
        // console.log(bitbalance);

    },
        function(res){
            console.log('error', res);
    });

    $http.get('http://localhost/revenge/svr/class/v1/getrans').then(function(res){
        var amount = res.data.transamount;
        $scope.transget = amount;
        // console.log($scope.transget);
    });

	$scope.todollar = '';

	var current = localStorage.getItem('cur');

	//console.log(current);
	//  api key for dashboard datas http://localhost/bitty/class/v1/values

	if(current === null){
		localStorage.setItem("cur", JSON.stringify({pref: "USD"}));
		current = "USD";
		$scope.current = current;
	} else {
		var current = JSON.parse(localStorage.getItem('cur'));
		$scope.current = current.pref;
	}

	/*externData.get('ticker?cors=true').then(function(res){*/
	$http.get('https://blockchain.info/ticker?cors=true').then(function(r){
		var res = r.data;
		$scope.all = res;
		Object.keys(res).forEach(key => { //key is the current key
		    if(key == $scope.current){
		    	//console.log(res[key]);
		    	$scope.currentData = $scope.all[key];
		    }
		});

		$scope.date = new Date().now();
	})

	$scope.your = 0.931;


});



app.controller('trans', ['$scope', function($scope, ShareData) {
	$scope.itsData2 = ShareData;
	$scope.accnt = [
		{
			id: 'FSP330045BD',
			date: '12-09-2018',
			to: 'Jude',
			from: 'James',
		},
		{
			id: 'FSP443610XF',
		},
		{
			id: 'FSP130045SS',
		},
		{
			id: 'FSP558948GB',
		}
	];
}]);

app.controller('TransSearch', ['$scope', function($scope, ShareData) {
	$scope.itsData1 = ShareData;
	$scope.lookup = {
		text: 'FSP',
		word: /^\s*\w*\s*$/
	};
}]);

app.service('ShareData', function() {
	return {
		scoop: "FSP"
	}
});


app.controller('transCtrl', ['$scope', '$http', function($scope,$http){
	$http.get('http://localhost/revenge/svr/class/v1/getransactions').then(function(res){
		var me = res.data.value;
		$scope.values = me;
		// console.log(me);	
	})

	$http.get('http://localhost/revenge/svr/class/v1/getsent').then(function(res){
		var sent = res.data.value;
		$scope.datas = sent;
		// console.log(me);	
	})

	$http.get('http://localhost/revenge/svr/class/v1/getreceive').then(function(res){
		var receive = res.data.value;
		$scope.received = receive;
		// console.log(me);	
	})
}]);

app.controller('ProfileInfo', ['$scope', '$http', function($scope, $http) {
	$scope.editInfo = function() {
		$state.go('userinfo');
	}
	$scope.insertData = function() {
		if ($scope.gender == null)
		{
			alert('Please select a gender!');
		}
		else if ($scope.bio == null)
		{
			alert('Bio is required!');
		}
		else if ($scope.location == null)
		{
			alert('Location is required!');
		}
		else if ($scope.avatar == null)
		{
			alert('Avatar is required!');
		}
		else if ($scope.cover == null)
		{
			alert('Background image is required!');
		}
		else if ($scope.mobile == null)
		{
			alert('Mobile number is required!');
		}
		else if ($scope.languages == null)
		{
			alert('Please specify language!');
		}
		else if ($scope.occupation == null)
		{
			alert('Occupation is required!');
		}
		else
		{
			$http.post('insert.php', {
				'gender': $scope.gender, 
				'bio': $scope.bio, 
				'location': $scope.location, 
				'avatar': $scope.avatar,
				'cover': $scope.cover,
				'mobile': $scope.mobile, 
				'language': $scope.languages,
				'occupation': $scope.occupation,
				'id': $scope.id
			}).success(function(data) {
				alert(data);
				$scope.avatar = null;
				$scope.cover = null;
			});
		}
	}
	$scope.displayData = function() {
		$http.get('select.php').success(function(data) {
			$scope.user = data;
		});
	}
}]);

app.controller('UserInfo', ['$scope', '$http', function($scope, $http) {
	$scope.previewPhoto = function(event) {
		var files = event.target.files;
		var file = files[files.length-1];
		var reader = new FileReader();
		reader.onload = function(e) {
			$scope.$apply(function() {
				$scope.avatar = e.target.result;
			})
		}
		reader.readAsDataURL(file);
	}
	$scope.getData = function() {
		$http.get('select.php').success(function(data) {
			$scope.userdata = data;
		});
	}
	$scope.updateData = function(id, bio, location, avatar, cover, email, mobile) {
		$scope.id = id;
		$scope.bio = bio;
		$scope.location = location;
		$scope.avatar = avatar;
		$scope.cover = cover;
		$scope.email = email;
		$scope.mobile = mobile;
	} 
}]);

app.directive('photoFile', function($parse) {
	return {
		restrict : 'A',
		link: function(scope, element, attributes) {
			var set = $parse(attributes.photoFile);
			element.bind('change', function() {
				set.assign(scope, element[0].files);
				scope.$apply();
			});
		}
	}
});

app.controller('settings', ['$scope', '$http', function($scope, $http) {
	$scope.deleteAccount = function(id) {
		if (confirm('Are you sure you want to delete this account?'))
		{
			$http.post('deactivate.php', {'id': id})
			.success(function(data) {
				alert(data);
			});
		}
		else
		{
			return false;
		}
	}
}]);