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

	$http.get('http://localhost/festapay/svr/class/v1/values').then(function(res){
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

	$http.get('http://localhost/festapay/svr/office/assets/js/temp.json').then(function(res){
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

	$http.get('http://localhost/festapay/svr/class/v1/values').then(function(res){
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

    $http.get('http://localhost/festapay/svr/class/v1/balance').then(function(res){
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

    $http.get('http://localhost/festapay/svr/class/v1/getrans').then(function(res){
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



app.controller('transCtrl', ['$scope', '$http', function($scope,$http){
	$http.get('http://localhost/festapay/svr/class/v1/getransactions').then(function(res){
		var me = res.data.value;
		$scope.values = me;
		// console.log(me);	
	})

	$http.get('http://localhost/festapay/svr/class/v1/getsent').then(function(res){
		var sent = res.data.value;
		$scope.datas = sent;
		// console.log(me);	
	})

	$http.get('http://localhost/festapay/svr/class/v1/getreceive').then(function(res){
		var receive = res.data.value;
		$scope.received = receive;
		// console.log(me);	
	})
}]);



app.controller('loginController', ['$scope', '$http', function($scope,$http){
    var menu = document.getElementById('menu'),
    panelMenu = menu.querySelectorAll('li'),
    panelBoxes = document.querySelectorAll('.panel__box'),
    signUp = document.getElementById('signUp'),
    signIn = document.getElementById('signIn');

    function removeSelection(){
        for(var i = 0, len = panelBoxes.length; i < len; i++){panelBoxes[i].classList.remove('active');
        }
    }


    signIn.onclick = function(e){
      e.preventDefault();
      removeSelection();
      panelBoxes[0].classList.add('active');
      menu.classList.remove('second-box');
    }

    signUp.onclick = function(e){
      e.preventDefault();
      removeSelection();
      panelBoxes[1].classList.add('active');
      menu.classList.add('second-box');
    }
}]);