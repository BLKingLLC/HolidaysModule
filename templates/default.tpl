<script type="text/javascript">
$(document).ready(function(){
 $('a.preview').click(function(e){
 e.preventDefault();
 var url = $(this).attr('href')+'&showtemplate=false';
 $('#preview_area').load(url).show(0).delay(5000).hide(0);
 })
})
</script>
<div id="preview_area" class="well" style="display: none;"></div>


<div class="holidayWrapper">
 {foreach $holidays as $holiday}
 <div class="holiday">
 <div class="row">
 <div class="col-sm-6">
 <a href="{cms_action_url action='detail' hid=$holiday->id returnid=$detailpage}">{$holiday->name}</a>
&dash; <a class="preview" href="{cms_action_url action=detail hid=$holiday->id returnid=$detailpage forjs=1 detailtemplate='ajax_detail.tpl'}">{$mod->Lang('preview')}</a>

</div>
<div class="col-sm-6 text-right">{$holiday->the_date|date_format:'%x'}</div>
 </div>
 </div>
 {foreachelse}
 <div class=alert alert-danger>{$mod->Lang('sorry_noholidays')}</div>
 {/foreach}
</div>

