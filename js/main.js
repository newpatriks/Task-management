$(document).ready(function() {
				
	/*
		The sortable method is used to change the user assigned to this task. 
	*/
	$( "#boxu_1, #boxu_2, #boxu_3, #boxu_4, #boxu_5" ).sortable({
		placeholder: "ui-state-highlight",
		connectWith: ".box_content",
		receive: function(event, ui) {
			usr_sender = ui.sender.attr('id');
			usr_sender = usr_sender.split('boxu_');		 		
	 		
	 		usr_to = this.id;
	 		usr_to =  usr_to.split("boxu_");
	 				        
	        tasca = ui.item.attr('id');
	        tasca = tasca.split("task_");
	        
	        id_aux = ui.item.attr('id');
	        
	        //alert(usr_sender[1]+" | "+usr_to[1]+" | "+tasca[1]);
	        $("#"+id_aux).css({'background-color':'#1D1E24'});
	        $.ajax({
				type: "POST",
				url: "tarea/updateTasca",
				data: { tasca: tasca[1], usr_sender: usr_sender[1], usr_to: usr_to[1] }
			}).done(function( msg ) {
				//alert( "Data Saved: " + msg );
				$("#"+id_aux).animate({
					backgroundColor: 'none'
				}, 500, function() {
					
				});
			});
		}
	}).disableSelection();
	/*
		To notify to the user when a task is dragged.
	*/
	$('.task').mousedown(function() {
		$(this).css({'z-index':'10', 'box-shadow':'1px 2px 5px #000'});
	});
	$('.task').mouseup(function() {
		$(this).css({'z-index':'0', 'box-shadow':'none'});
	});
	
	/*
		The new task form can be opened and closed following the next funcions.
	*/
	$('#form_task_link').click(function() {
		$('#form_task').css({'z-index':'10'});
		$('#form_task').animate({
			'top': '100px',
		}, 1000, 'easeOutBack', function() {
	
		});
		
	});
	$('#close').click(function() {
		$('#form_task').animate({
			'top': '-500px',
		}, 1000, 'easeOutBack', function() {
	
		});
	});
	
	/*
		Next step: Configure the submit button from the new task form to 
		upload the information with $ajax
	*/
	$("#new_task_btn").submit(function() {
		
	});
	
	/*
		The app only shows the title from the task. The specifications
		showed when the user click over the title.
	*/
	$('.task_content').hide();
	$('.task h4').click(function () {
		$(this).parent().children(".task_content").slideToggle(200);
	});
		
	
	/*
		Datepicker UI to the new task form
	*/
	$( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
	
	
	
	/*
		The spinner from the timer is not showed everytime. The user needs to click on
		.btn_timer button to show it.
	*/	
	$( ".spiner" ).spinner({step : 0.5});
	$( ".spiner_container" ).hide();
	$( ".btn_timer" ).click(function() {
		$(this).parent().children(".spiner_container").slideToggle(200);
	});
	
	/*
		This is a handler that detects when user submit a new timer for a task. 
		The form sends the information throwgh the ajax function. 
	*/
	$( ".btn_tick" ).click(function() {
		var elem = $(this);
		var valor = $(this).parent().find(".spiner").spinner().spinner('value');
		
	    $.ajax({
	        url: $(this).parent(".update_timer").attr( 'action' ),
	        type: 'post',
	        data: $(this).parent(".update_timer").serialize(),
		}).done( function(msg) {
	    	elem.parent().parent().parent().children('.timer_actual').html(valor);
	    	elem.parent().parent().parent().children('.timer_actual').css({'font-size':'19px'});
	    	elem.parent().parent().parent().children('.timer_actual').animate({
	        	'font-size':'16px'
	    	},  200, function() {
	        	
	    	});
	    }).fail( function(jqXHR, textStatus) {
	    });			
	});
	
	
	/*
		The checkbox only shows when mouseover the task
	*/
	$(".task_complete").hide();
	$(".task").mouseover(function() {
		$(this).children(".task_complete").show();	
	});
	$(".task").mouseleave(function() {
		$(this).children(".task_complete").hide();	
	});
	
	
	/*
		Detecting if a Task i completed or is pending. When the user click on 
		the checkbox the application inspect the class of the checkbox. 
		If it's have the "checked" class it's because the tasks is completed.
	*/
	var completada;
	$("label span").click(function() {
		var elem = $(this);
		if (elem.attr('class') == "checked") 
		{
		/*
			 Task is complete and we have 
			 to update it to uncomplete task
		*/
			completada = true;
		}else{
		/*
			Task is not complete and We've
			to put it completed
		*/
			completada = false;
		}
		
		/*
			Assign to the input hidden element the 
			value the we want to update on the database 
		*/
		elem.parent().parent(".form_task_complete").children('.is_complete_aux').val(!completada);
		
		$.ajax({
	        url: elem.parent().parent(".form_task_complete").attr( 'action' ),
	        type: 'post',
	        data: elem.parent().parent(".form_task_complete").serialize(),
	    }).done( function(msg) {
	    	/*
	        	Update de interface with de class .completada
	    	*/
	    	if (completada)
	    	{
	        	elem.parent().parent().parent().parent().removeClass("completada");
	        	elem.removeClass("checked");
	    	}else{
	        	elem.parent().parent().parent().parent().addClass("completada");
	        	elem.addClass("checked");
	    	}
	    	
		}).fail( function(jqXHR, textStatus) {
		
		});
	});

});
