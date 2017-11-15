{if $holiday}
{cms_action_url action=detail hid=$holiday->id assign='canonical'}
{$canonical=$canonical scope=global}
	<fieldset>
	 	<legend>{$mod->Lang('holiday_detail')}</legend>
 		<div class="row">
	 		<p class="col-sm-2 text-right">{$mod->Lang('name')}:</p>
 			<p class="col-sm-10">{$holiday->name}</p>
 		</div>
	 	<div class="row">
 			<p class="col-sm-2 text-right">{$mod->Lang('date')}:</p>
	 		<p class="col-sm-10">{$holiday->the_date|date_format:'%x'}</p>
 		</div>
	 	<div class="row">
 			{$holiday->description}
 		</div>
	</fieldset>
{else}
	<div class="alert alert-danger">{$mod->Lang('error_notfound')}</div>
{/if}

