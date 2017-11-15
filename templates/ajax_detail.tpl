{if $holiday}
<div>
 <div class="row">{$holiday->name} @ {$holiday->the_date|date_format:'%x'}</div>
 <div class="row">
 {$holiday->description|strip_tags|summarize}
 </div>
</div>
{/if}
