<?php
	if( !defined('CMS_VERSION') ) exit;
	$limit = (isset($params['limit'])) ? (int) $params['limit'] : 1000;
	$limit = max(1,$limit);
	$detailpage = $returnid;
	if( isset($params['detailpage']) ) {
		$hm = CmsApp::get_instance()->GetHierarchyManager();
		$node = $hm->sureGetNodeByAlias($params['detailpage']);
		if( is_object($node) ) $detailpage = $node->get_tag('id');
	}
	$query = new HolidayQuery(array('published'=>1,'limit'=>$limit));
	$holidays = $query->GetMatches();
	$tpl = $smarty->CreateTemplate($this->GetTemplateResource('default.tpl'),null,null,$smarty);
	$tpl->assign('holidays',$holidays);
	$tpl->assign('detailpage',$detailpage);
	$tpl->display();
?>

