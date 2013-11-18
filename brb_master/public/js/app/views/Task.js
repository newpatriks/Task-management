// View.js
// -------
define(["jquery", "backbone", "models/Model", "text!templates/task.html"],

    function($, Backbone, Model, template){

        var Task = Backbone.View.extend({
			el: ".task",
            initialize: function() {
                this.render();
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
        return Task;

    }

);