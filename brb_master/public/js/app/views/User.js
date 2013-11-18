// View.js
// -------
define(["jquery", "backbone", "models/User", "collections/Users", "text!templates/user.html"],

    function($, Backbone, User, template){

        var User = Backbone.View.extend({
			el: ".box_usuari",
            initialize: function() {
                this.render();
            },
            
            toJSON: function(options) {
				return this.map(function(model){ return model.toJSON(options); });
			},
			
			sync: function() {
				return Backbone.sync.apply(this, arguments);
			},
            
            events: {
				
            },
            
            render: function() {
            	// 
                this.template = _.template(template, {});
                this.$el.html(this.template);
                return this;
            }

        });

        // Returns the View class
        return User;

    }

);