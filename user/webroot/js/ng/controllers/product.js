myApp
.controller('product', ['$scope', '$compile', '$http', '$rootScope', function($scope, $compile, $http, $rootScope){

	$scope.products = [];

	$scope.getProducts = function(){
		$http({
			method: 'POST',
			url: '/user/angularTest/getProducts',
			data: {}
		})
		.then(function(response){
			$scope.products = response.data.data;
		})
		.catch(function(err){
			console.warn("Get Product Error: "+err);
		});
	};

	$scope.addProduct = function(){
		if ($scope.productName && $scope.productDescription && $scope.productQuantity){
			$http({
				method: "POST",
				url: '/user/angularTest/addProduct',
				data: {
					name: $scope.productName,
					description: $scope.productDescription,
					quantity: $scope.productQuantity
				}
			})
			.then(function(response){
				var success = response.data.success;
				if (success){
					$scope.products.push(response.data.content);
				} else {
					console.warn("adding failed");
				}
			})
			.catch(function(err){
				console.warn("Add Product Error: "+err);
			});
		}
	};

	$scope.deleteProduct = function(product){
		if (product) {
			$http({
				method: "POST",
				url: '/user/angularTest/deleteProduct',
				data: product
			})
			.then(function(response){
				var error = response.data.error;
				if (error){
					console.log(error);
				} else {
					var idx = $rootScope.getIndex({id: product.id}, $scope.products);
					if (idx > -1){
						// index exists
						$scope.products.splice(idx,1);
					}
				}
			})
			.catch(function(err){
				console.warn("Delete Product Error: "+err);
			})
		}
	};

	$scope.editProduct = function(product){
		if (product){
			var idx = $rootScope.getIndex({id: product.id}, $scope.products);
		}
	}
}]);
