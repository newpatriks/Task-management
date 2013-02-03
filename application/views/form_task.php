<div id="form_task">
		<a id="close" href="#"></a>
		<form name="task" method="post" action="tarea/newTasca">
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
					<td><input type="text" class="txt datepicker" name="data_fi" value="<? if ($edit) echo $tasca_datafi;?>" /></td>
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
					<td>
						<select name="assignada" class="txt">
							<option value="">Selecciona un usuari &raquo;</option>
							<? foreach ($list_usuaris as $key_u => $item_u)
								{
								?><option value="<?=$key_u?>" 
								<? if ($edit) {
									if ($key_u == $tasca_assignada) {
										?>selected = "selected"<?
									}
								}?>
								><?=$item_u->nom?></option><?		
								}
							?>
							
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="submit" value="Enviar" class="btn" id="new_task_btn"/></td>
				</tr>
			</table>	
		</form>
</div>