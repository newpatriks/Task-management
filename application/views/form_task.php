<div id="form_task">
		<a id="close" href="#"></a>
		<form name="task" id="f_newtask" method="post" action="<?=base_url()?>tarea/newTasca">
			<input type="hidden" name="edit" value="" />
			
			<table>
				<tr>
					<td><label for="name">Nom de la tasca:</label></td>
					<td><input type="text" class="txt" name="name" value="<? if ($edit) echo $tasca_nom;?>" /></td>
				</tr>
				<tr>
					<td><label for="explain">Explicaci&oacute;:</label></td>
					<td><textarea name="explain" class="txt"><? if ($edit) echo $tasca_explicacio;?></textarea></td>
				</tr>
				<tr>
					<td><label for="data_fi">Data fi:</label></td>
					<td><input type="text" class="txt datepicker" name="data_fi" value="<? if ($edit) echo $tasca_datafi; else echo $sprint_actual[0]->data_entrega ?>" /></td>
				</tr>
				<tr>
					<td><label for="durada">Durada (h):</label></td>
					<td><input type="text" class="txt" name="durada" value="<? if ($edit) echo $tasca_durada;?>" /></td>
				</tr>
				<tr>
					<td><label for="sprint">Sprint:</label></td>
					<td>
						<select name="sprint" class="txt">
							<option value="">Selecciona l'sprint &raquo;</option>
							<? foreach ($sprint as $key_s => $item_s)
								{
								?><option value="<?=$item_s->pk_sprint?>" 
								<? if ($edit) {
									if ($key_s == $tasca_sprint) {
										?>selected = "selected"<?
									}
								}?>
								><?=$item_s->nom?></option><?		
								}
							?>
							
						</select>
					</td>
				</tr>
				<tr>
					<td><label for="assignada">Assignada a:</label></td>
					<td class="txt_normal">
						<? foreach ($list_usuaris as $key_u => $item_u)
						{ 
						?>
							<?=$item_u->nom?>: <input type="checkbox" name="usr_<?=$item_u->pk_usuari?>" value="" />
							<? // if ($key_u % 2 == 0) echo "<br/>"; ?>
							<br/><?
						} 
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="button" value="Enviar" class="btn" id="new_task_btn"/></td>
				</tr>
			</table>	
		</form>
</div>