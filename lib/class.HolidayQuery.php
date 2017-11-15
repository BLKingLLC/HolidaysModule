<?php
class HolidayQuery extends CmsDbQueryBase
{
 public function execute()
 {

 if( !is_null($this->_rs) ) return;

$sql = 'SELECT SQL_CALC_FOUND_ROWS H.* FROM '.CMS_DB_PREFIX.'mod_holidays H';
 if( isset($this->_args['published']) ) {
 // store only draft or published items
 $tmp = $this->_args['published'];
 if( $tmp === 0 ) {
 $sql .= ' WHERE published = 0';
 } else if( $tmp === 1 ) {
 $sql .= ' WHERE published = 1';
 }
 }
 $sql .= ' ORDER BY the_date DESC';

 $db = \cms_utils::get_db();
 $this->_rs = $db->SelectLimit($sql,$this->_limit,$this->_offset);
 IF( $db->ErrorMsg() ) throw new \CmsSQLErrorException($db->sql.' -- '.$db->ErrorMsg());
 $this->_totalmatchingrows = $db->GetOne('SELECT FOUND_ROWS()');
 }
 public function &GetObject()
 {
 $obj = new HolidayItem;
 $obj->fill_from_array($this->fields);
 return $obj;
 }

public function __construct($args = '')
{
 parent::__construct($args);
 if( isset($this->_args['limit']) ) $this->_limit = (int) $this->_args['limit'];
}



}
?>
