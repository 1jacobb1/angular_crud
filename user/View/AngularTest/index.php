<script type="text/javascript" src="/js/ng/app.js"></script>
<script type="text/javascript" src="/js/ng/controllers/product.js"></script>
<div ng-app="myApp" ng-controller="product">
	<h2>Username: {{firstName}}</h2>
	<div id="product-list">
		<div>
			<form class="form-inline">
				<input type="text" placeholder="Search.." class="form-control form-input" id="search-text" ng-model="searchProduct">
				<button class="btn"><i class="icon-search"></i>Search</button>
			</form>
			<br>
			<div>

				<form class="form" name="formProduct">
					<input type="hidden" ng-model="productId" ng-show="isEditProduct">
					<input type="text" placeholder="Name" class="form-control form-input" ng-model="productName" required>
					<textarea class="form-control" placeholder="Description" ng-model="productDescription" required></textarea>
					<input min="0" type="number" placeholder="Quantity" class="form-control form-input" ng-model="productQuantity" required>
					<button class="btn" ng-click="addProduct()" ng-disabled="formProduct.$invalid" ng-show="isNewProduct"><i class="icon-plus"></i>Add</button>
					<button class="btn" ng-click="saveProduct()" ng-disabled="formProduct.$invalid" ng-show="isEditProduct"><i class="icon-plus"></i>Save</button>
					<button class="btn" ng-click="cancelUpdateProduct()" ng-disabled="formProduct.$invalid" ng-show="isEditProduct"><i class="icon-plus"></i>Cancel</button>
				</form>
			</div>
		</div>
		<table class="table table-striped">
			<tr>
				<th>ID #</th>
				<th>NAME</th>
				<th>DESCRIPTION</th>
				<th>QUANTITY</th>
				<th>ACTION</th>
			</tr>
			<tr ng-repeat="product in products | filter: searchProduct" ng-model="product" id="product-id-{{product.id}}">
				<td ng-model="product.id">{{product.id}}</td>
				<td contenteditable="false" ng-class="product-name" ng-model="product.name">{{product.name}}</td>
				<td contenteditable="false" ng-model="product.description">{{product.description}}</td>
				<td contenteditable="false" ng-model="product.quantity">{{product.quantity}}</td>
				<td><button class="btn" ng-click="editProduct(product)" >edit</button> | <button class="btn" ng-click="deleteProduct(product)">delete</button></td>
			</tr>
		</table>
	</div>
</div>
<script>
	$(function(){
		getProducts();
	});

	function getProducts(){
		angular.element($("[ng-controller='product']")).scope().getProducts();
	}

</script>
