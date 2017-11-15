<?php
if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(Holidays::MANAGE_PERM) ) return;
$query = new HolidayQuery;
$holidays = $query->GetMatches();
$tpl = $smarty->CreateTemplate($this->GetTemplateResource('defaultadmin.tpl'),null,null,
$smarty);
$tpl->assign('holidays',$holidays);
$tpl->display();
