<script type="text/javascript">
	$(document).ready(function(){
		$('a.del_holiday').click(function(){
			return confirm('{$mod->Lang('confirm_delete')}');
		})
	});
</script>


<div class="pageoptions">
	<a href="{cms_action_url action=edit_holiday}">{admin_icon icon='newobject.gif'}
		{$mod->Lang('add_holiday')}
	</a>
</div>
{if !empty($holidays)}
<table class="pagetable">
	<thead>
		<tr>
			<th>{$mod->Lang('name')}</th>
			<th>{$mod->Lang('date')}</th>
			<th class="pageicon">{* edit icon *}</th>
			<th class="pageicon">{* delete icon *}</th>
		</tr>
	</thead>
	<tbody>
		{foreach $holidays as $holiday}
		{cms_action_url action=edit_holiday hid=$holiday->id assign='edit_url'}
		
		<tr>
			<td><a href="{$edit_url}" title="{$mod->Lang('edit')}">{$holiday->name}</a></td>
			<td>{$holiday->the_date|date_format:'%x'}</td>
			<td><a href="{$edit_url}" title="{$mod->Lang('edit')}">
			{admin_icon icon='edit.gif'}</a>
			</td>
			<td>
				<a class="del_holiday" href="{cms_action_url action=delete_holiday hid=$holiday->id}"title="{$mod->Lang('delete')}">{admin_icon icon='delete.gif'}</a>
			</td> 
		</tr>
		{/foreach}
	</tbody>
</table>
{/if}
