


function RecipesViewModel(data) {
	window.model= this;
	var self = this;
	self.Init = function() {
		self.GetIngredients();
	}
	self.Recipe = ko.observable();
	self.Ingredients = ko.observableArray();
	self.Directions= ko.observableArray();
	self.DataLoaded = ko.observable(false);
	self.AddIngredient = function() {
		self.Ingredients.push({
			id:Math.random() * 100,
			measurement:null,
			name:null,
			quantity:null,
			weight:self.Ingredients().length + 1
		});

		$(".ingredients tr:last-child").find(".short").focus();
	}
	self.AddDirection = function() {
		self.Directions.push({
			id:Math.random() * 100,
			text:"",
			weight:self.Directions().length + 1
		});
	}
	self.RemoveIngredient = function(id) {
		self.Ingredients.remove(function(item) { return item.id == id });
	}
	self.RemoveDirection = function(id) {
		self.Directions.remove(function(item) { return item.id == id });
	}
	$.ajax({
		type:"POST",
		url:"/recipes/get",
		data:{rid:data},
		dataTye:"json"
	}).done(function(data) {
		data = JSON.parse(data);
		self.Recipe(data);
		self.Ingredients(data.ingredients);
		self.Directions(data.directions);
		self.DataLoaded(true)
	});
}



	
ko.bindingHandlers.tableDnD = {
	update:function(element,valueAccessor) {
		if(valueAccessor()) {
			$(element).tableDnD({
				dragHandle:".move",
				onDrop:function(table, row) {
					var rows = table.tBodies[0].rows;
					for(var i=0;i<rows.length;i++) {
						$(rows[i]).find(".row-weight").val($(rows[i]).index());
					}

				}
			});
		}
	}
}


$(document).ready(function() {
	ko.applyBindings(new RecipesViewModel(rid));
});