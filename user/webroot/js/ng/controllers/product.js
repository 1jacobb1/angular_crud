myApp
.controller('product', ['$scope', '$compile', '$http', '$rootScope', function($scope, $compile, $http, $rootScope){

	$scope.products = [];
	$scope.isNewProduct = true;
	$scope.isEditProduct = false;

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
						// index exists, delete current index
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
			$scope.isEditProduct = true;
			$scope.isNewProduct = false;
			$scope.productName = product.name;
			$scope.productDescription = product.description;
			$scope.productId = product.id;
			// convert to int
			product.quantity = product.quantity ? parseInt(product.quantity) : 0;

			$scope.productQuantity = product.quantity;
		}
	};

	$scope.saveProduct = function(){
		if ($scope.productName && $scope.productDescription && $scope.productQuantity){
			$http({
				method: "POST",
				url: "/user/angularTest/saveProduct",
				data: {
					id: $scope.productId,
					name: $scope.productName,
					description: $scope.productDescription,
					quantity: $scope.productQuantity
				}
			})
			.then(function(response){
				if (response.data.saved) {
					var idx = $rootScope.getIndex({id: $scope.productId}, $scope.products);
					// update product in array
					$scope.products[idx].name = $scope.productName;
					$scope.products[idx].description = $scope.productDescription;
					$scope.products[idx].quantity = $scope.productQuantity;
					// clear product input
					$scope.productName = "";
					$scope.productDescription = "";
					$scope.productQuantity = "";
					// hide edit product form
					$scope.isEditProduct = false;
					// show new product form
					$scope.isNewProduct = true;
				}
			})
			.catch(function(error){
				console.warn("Save Product Error: "+error);
			});
		}
	}

	$scope.cancelUpdateProduct = function(){
		$scope.productName = "";
		$scope.productDescription = "";
		$scope.productQuantity = "";
		$scope.isEditProduct = false;
		$scope.isNewProduct = true;
	}
}]);
