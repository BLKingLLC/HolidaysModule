<?php
	if( !defined('CMS_VERSION') ) exit;
	if( !isset($params['hid']) ) return;
	$detailtemplate = (isset($params['detailtemplate'])) ? trim($params['detailtemplate']) : 'detail.tpl';
	$holiday = HolidayItem::load_by_id( (int) $params['hid'] );
	$tpl = $smarty->CreateTemplate($this->GetTemplateResource($detailtemplate),null,null,$smarty);
	$tpl->assign('holiday',$holiday);
	$tpl->display();
?>
