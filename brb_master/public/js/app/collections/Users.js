// Collection.js
// -------------
define(["jquery","backbone","models/User"],

	function($, Backbone, User) {

		// Creates a new Backbone Collection class object
		var Users = Backbone.Collection.extend({
			model: User,
			url : "http://localhost/taskmanager/Task-management/API_taskmanager/index.php/api/example/users/"
		});
		return Users;
	}
);