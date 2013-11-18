// Users.js
// --------
define(["jquery", "backbone"],

    function($, Backbone) {

        // Creates a new Backbone Model class object
        var User = Backbone.Model.extend({
			url : "http://localhost/taskmanager/Task-management/API_taskmanager/index.php/api/example/users/",
            // Model Constructor
            initialize: function() {

            },

            // Default values for all of the Model attributes
            defaults: {

            },

            // Gets called automatically by Backbone when the set and/or save methods are called (Add your own logic)
            validate: function(attrs) {

            }

        });

        // Returns the Model class
        return User;

    }

);
