var app = angular.module('bittyApp');

app.factory('externData', ['$http', function($http){

	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
    $http.defaults.headers.post["Access-Control-Allow-Origin"] = "https://blockchain.info/ticker";
    
    // Access-Control-Request-Headers: X-Requested-With, accept, content-type;
    // Access-Control-Allow-Methods: GET, POST;

        var baseUrl = "https://blockchain.info/";
        var handle = {};

        handle.get = function (uri) {
            return $http.get(baseUrl + uri).then(function (results) {
                return results.data;
            });
            //console.log(baseUrl + uri);
        };
        handle.post = function (uri, data) {
            return $http.post(baseUrl + uri, data).then(function (results) {
                return results.data;
            });
        };
        handle.put = function (uri, data) {
            return $http.put(baseUrl + uri, data).then(function (results) {
                return results.data;
            });
        };
        handle.delete = function (uri) {
            return $http.delete(baseUrl + uri).then(function (results) {
                return results.data;
            });
        };
        handle.test = function(){
            return "hello world";
        };
        handle.testData = function(data){
        	return data;
        }

        return handle;
}])


app.factory('dataHandler', ['$http', function($http){

	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";


        var baseUrl = "http://localhost/bitty/";
        var handle = {};

        handle.get = function (uri) {
            return $http.get(baseUrl + uri).success(function (results) {
                return results.data;
            });
        };
        handle.post = function (uri, data) {
            return $http.post(baseUrl + uri, data).then(function (results) {
                return results.data;
            });
        };
        handle.put = function (uri, data) {
            return $http.put(baseUrl + uri, data).then(function (results) {
                return results.data;
            });
        };
        handle.delete = function (uri) {
            return $http.delete(baseUrl + uri).then(function (results) {
                return results.data;
            });
        };
        handle.test = function(){
            return "hello world";
        };
        handle.testData = function(data){
        	return data;
        }

        return handle;
}])