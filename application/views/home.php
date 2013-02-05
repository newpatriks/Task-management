<div id="content" role="main" class="wraper">

<?
$this->view('bar.php');
?>
	<section id="main_box">
	<ul>
		<?
		$cont = 1;
		foreach ($list_usuaris as $key_u => $item_u)
		{
			?><li id="box_<?=$item_u->pk_usuari?>" class="box_usuari <? if ($cont % 5 == 0) echo "last"; ?> <? if ($key_u == 0) echo "first"; ?>">
				<h2><?=$item_u->nom;?></h2><span><?=$item_u->perfil?></span>
				<ul id="boxu_<?=$item_u->pk_usuari?>" class="box_content">
					<?
					foreach ($list_tasks as $key_t => $item_t)
					{
						if ($item_t->fk_usuari == $item_u->pk_usuari)
						{
							?>
							<li id="task_<?=$item_t->pk_tasca?>" class="task 
							<? if ($item_t->completada == 1) 
							{
								?> completada"><? 
							}else{
								?> pendent"><?
							}
								?><h4><a><?=$item_t->tasca_nom;?></a></h4>
								<div class="task_complete">
									<form class="form_task_complete" name="form_task_complete" method="post" action="tarea/updateComplete" >
										<input type="hidden" name="id_task" value="<?=$item_t->pk_tasca?>" />
										<input type="hidden" name="id_user" value="<?=$item_u->pk_usuari?>" />
										<input type="hidden" class="is_complete_aux" name="is_complete_aux" value="" />
										
										<input type="checkbox" class="chkbx_complete" name="is_complete" />
										<label for="chkbx_complete"><span></span></label>
									</form>
								</div>
								<div class="task_content">
									<?=$item_t->explicacio?><br/><br/>
									<!--
									Data finalització: <?=$item_t->dia_datafi?>/<?=$item_t->mes_datafi?>/<?=$item_t->any_datafi?><br/>
									-->
									Temps dedicat: <div class="timer_actual"><?=$item_t->temps_dedicat?></div> hores 
									<a class="btn_timer"><img src="images/clock.png" /></a>
									
									<div class="spiner_container">
										<form name="update_timer" class="update_timer" method="post" action="tarea/updateTimer">
											<input type="hidden" name="id_task" value="<?=$item_t->pk_tasca?>" />
											<input type="hidden" name="id_user" value="<?=$item_u->pk_usuari?>" />
											<input type="hidden" class="temps_aux" name="temps_aux" value="<?=$item_t->temps_dedicat?>" />
											
											<input name="temps" class="spiner" id="spiner_<?=$item_t->pk_tasca?>" value="<?=$item_t->temps_dedicat?>" />
											<a class="btn_tick"><img src="images/tick.png" /></a>
										</form>
									</div>
									
								</div>
							</li>
							<?
						}
					}
					?>
				</ul>
			</li><?	
			$cont++;
		}
		?>
	</ul>
	</section>
<section class="clean"></section>

</div>


<?	$this->view('form_task.php'); ?>


<script type="text/javascript">
	$(document).ready(function() {
			
		// per fer que cada tasca quan fem el drag passi per sobre de totes les altres.
		$('.task').mousedown(function() {
			$(this).css({'z-index':'10', 'box-shadow':'1px 2px 5px #000'});
		});
		$('.task').mouseup(function() {
			$(this).css({'z-index':'0', 'box-shadow':'none'});
		});
		
		
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
		
		$("#new_task_btn").submit(function() {
			
		});
		

		$('.task_content').hide();
		$('.task h4').click(function () {
			$(this).parent().children(".task_content").slideToggle(200);
		});
			
		$('.fancyclass').fancybox();
		$( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
		
		
		$( ".spiner" ).spinner({step : 0.5});
		$( ".spiner_container" ).hide();
			
		$( ".btn_timer" ).click(function() {
			$(this).parent().children(".spiner_container").slideToggle(200);
		});
		
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
		
		$(".task_complete").hide();
		$(".task").mouseover(function() {
			$(this).children(".task_complete").show();	
		});
		$(".task").mouseleave(function() {
			$(this).children(".task_complete").hide();	
		});
		
		var activat = 0;
		$("label span").click(function() {
			var elem = $(this);
			if (!activat) 
			{
				activat = 1;	
				$(this).css({'background-position':'-19px 0px'});	
			}else{
				activat = 0;	
				$(this).css({'background-position':'0px 0px'});
			}
			
			elem.parent().parent(".form_task_complete").children('.is_complete_aux').val("true");
			
			$.ajax({
		        url: elem.parent().parent(".form_task_complete").attr( 'action' ),
		        type: 'post',
		        data: elem.parent().parent(".form_task_complete").serialize(),
	        }).done( function(msg) {
	        	if (activat)
	        	{
		        	elem.parent().parent().parent().parent().addClass("completada");
	        	}else{
		        	elem.parent().parent().parent().parent().removeClass("completada");
	        	}
	        	
        	}).fail( function(jqXHR, textStatus) {
        	
        	});
		});
		
	});
	
</script>