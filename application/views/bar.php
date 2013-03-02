<header>
	<ul id="menu_sprint" class="left">
		<?
		foreach ($sprint as $key => $item)
		{
			?><li class="left"><h3>
				<a href="<?=$item->pk_sprint+1?>" <? if ($item->pk_sprint == $sprint_actual[0]->pk_sprint) echo "class='current'"; ?>>
					<?=$item->nom?>
				</a>
			</h3><?
		}
		?>
	</ul>
	
	<a id="form_task_link" class="right" href="#"><img src="images/add_task.png" alt="Add Task" /></a>
</header>