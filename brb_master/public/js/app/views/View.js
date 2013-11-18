// View.js
// -------
define(["jquery", "backbone", "models/User", "collections/Users", "views/Task" , "text!templates/heading.html"],

    function($, Backbone, User, Users, Task, template){

        var View = Backbone.View.extend({

            // The DOM Element associated with this view
            el: ".example",

            // View constructor
            initialize: function() {
				this.collection = new Users;
			    this.listenTo(this.collection, 'reset', this.render);
			    // bind to other events as needed...
			    this.collection.fetch({ reset: true });
            },

            // View Event Handlers
            events: {
				
            },

            // Renders the view's template to the UI
            render: function() {
            	var that = this;
            	this.users = new Users();
				this.collection.each(function(user) {
					that.users.add(new User(user['attributes']));
				});
				
                // Setting the view's template property using the Underscore template method
                this.template = _.template(template, {users : this.users});

                // Dynamically updates the UI with the view's template
                this.$el.html(this.template);

                // Maintains chainability
                return this;

            }

        });

        // Returns the View class
        return View;

    }

);