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
				<h2 class="fit_txt"><?=$item_u->nom;?></h2><span class=""><?=$item_u->perfil?></span>
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
									<form class="form_task_complete" name="form_task_complete" method="post" action="<?=base_url()?>tarea/updateComplete" >
										<input type="hidden" name="id_task" value="<?=$item_t->pk_tasca?>" />
										<input type="hidden" name="id_user" value="<?=$item_u->pk_usuari?>" />
										<input type="hidden" class="is_complete_aux" name="is_complete_aux" value="" />
										
										<input type="checkbox" class="chkbx_complete" name="is_complete" />
										<label for="chkbx_complete"><span <?
										if ($item_t->completada)
										{
											?>class="checked"<?
										}
										?>></span></label>
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
										<form name="update_timer" class="update_timer" method="post" action="<?=base_url()?>tarea/updateTimer">
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