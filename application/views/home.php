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
		        
		        //alert(usr_sender[1]+" | "+usr_to[1]+" | "+tasca[1]);
		        
		        $.ajax({
					type: "POST",
					url: "tarea/updateTasca",
					data: { tasca: tasca[1], usr_sender: usr_sender[1], usr_to: usr_to[1] }
				}).done(function( msg ) {
					//alert( "Data Saved: " + msg );
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
			/*
			$.ajax({
				type: "POST",
				url: "tarea/new"
			}).done(function( msg ) {
				alert( "Data Saved: " + msg );
			});
			*/
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
		    }).fail( function(jqXHR, textStatus) {
		    });			
		});
	});
	
</script>