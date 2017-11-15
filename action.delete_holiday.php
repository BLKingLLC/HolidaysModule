<?php
if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(Holidays::MANAGE_PERM) ) return;
if( isset($params['hid']) && $params['hid'] > 1) {
 $holiday = HolidayItem::load_by_id((int)$params['hid']);
 $holiday->delete();
$search = \cms_utils::get_search_module();
if( is_object($search) ) $search->DeleteWords($this->GetName(), (int) $params['hid'],
'holiday');

 $this->SetMessage($this->Lang('holiday_deleted'));
 $this->RedirectToAdminTab();
}
