<h3>{$mod->Lang('add_holiday')}</h3>
{form_start hid=$holiday->id}
<div class="pageoverflow">
	<p class="pageinput">
		<input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
		<input type="submit" name="{$actionid}cancel" value="{$mod->Lang('cancel')}"/>
	</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$mod->Lang('name')}:</p>
	<p class="pageinput">
		<input type="text" name="{$actionid}name" value="{$holiday->name}"/>
	</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$mod->Lang('date')}:</p>
	<p class="pageinput">
		<input type="date" name="{$actionid}the_date" value="{$holiday->the_date|date_format:'%Y-
		%m-%d'}"/>
	</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$mod->Lang('published')}:</p>
	<p class="pageinput">
		<select name="{$actionid}published">
			{cms_yesno selected=$holiday->published}
		</select>
	</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$mod->Lang('description')}:</p>
	<p class="pageinput">
		{cms_textarea prefix=$actionid name=description value=$holiday->description
		enablewysiwyg=true}
	</p>
</div>
{form_end}

