<?php
if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(Holidays::MANAGE_PERM) ) return;
$holiday = new HolidayItem();
if( isset($params['hid']) && $params['hid'] > 1) {
 $holiday = HolidayItem::load_by_id((int)$params['hid']);
}


if( isset($params['cancel']) ) {
 $this->RedirectToAdminTab();
}
else if( isset($params['submit']) ) {
 $holiday->name = trim($params['name']);
 $holiday->published = cms_to_bool($params['published']);
 $holiday->the_date = strtotime($params['the_date']);
 $holiday->description = $params['description'];
 $holiday->save();
$search = \cms_utils::get_search_module();
if( is_object($module) ) {
 if( !$holiday->published ) {
 $search->DeleteWords($this->GetName(), $holiday->id, 'holiday');
 } else {
 $search->AddWords($this->GetName(), $holiday->id, 'holiday', $holiday->name.'
'.strip_tags($holiday->description));
 }
}


 $this->SetMessage($this->Lang('holiday_saved'));
 $this->RedirectToAdminTab();
}
$tpl = $smarty->CreateTemplate($this->GetTemplateResource('edit_holiday.tpl'),null,null,
$smarty);
$tpl->assign('holiday',$holiday);
$tpl->display();
?>
