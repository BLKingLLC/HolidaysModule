<?php
	class Holidays extends CMSModule
	{
		const MANAGE_PERM = 'manage_holidays';
		
		public function GetVersion() { return '0.1.1'; }
		public function GetFriendlyName() { return $this->Lang('friendlyname'); }
		public function GetAdminDescription() { return $this->Lang('admindescription'); }
		public function IsPluginModule() { return TRUE; }
		public function HasAdmin() { return TRUE; }
		public function VisibleToAdminUser() { return $this->CheckPermission(self::MANAGE_PERM); }
		
		public function GetAuthor() { return 'Your Name'; }
		public function GetAuthorEmail() { return 'yourname@somedomain.com'; }
		
		public function InitializeFrontend() {
			$this->SetParameterType('hid',CLEAN_INT);
			$this->SetParameterType('pagelimit',CLEAN_INT);
			$this->SetParameterType('detailpage',CLEAN_STRING);
			$this->RegisterModulePlugin();
			$this->SetParameterType('detailtemplate',CLEAN_STRING);
			
		}
		public function InitializeAdmin() {
			$this->CreateParameter('hid',null,$this->Lang('param_hid'));
			$this->CreateParameter('pagelimit',1000,$this->Lang('param_pagelimit'));
			$this->CreateParameter('detailpage',null,$this->Lang('param_detailpage'));
			$this->CreateParameter('detailtemplate', null,$this->Lang('detailtemplate'));
			$this->SetParameterType('junk',CLEAN_STRING);
			$this->RegisterRoute('/Holidays\/(?P<returnid>[0-9]+)\/(?P<hid>[0-9]+)\/(?P<junk>.*?)$/',array('action'=>'detail'));
			
			
		}
		
		public function get_pretty_url($id,$action,$returnid='',$params = array(),$inline = false)
		{
			if( $action != 'detail' || !isset($params['hid']) ) return;
			if( isset($params['detailtemplate']) ) return; // can't make a pretty URL 
			$holiday = HolidayItem::load_by_id((int)$params['hid']);
			if( !is_object($holiday) ) return;
			return "Holidays/$returnid/{$params['hid']}/".munge_string_to_url($holiday->name);
		}
		
		
		public function SearchReindex(&$search_module)
		
		{
			$query = new HolidayQuery();
			$matches = $query->GetMatches();
			foreach( $matches as $holiday ) {
				$search_module->AddWords($this->GetName(), $holiday->id, 'holiday', $holiday->name.' '.strip_tags($holiday->description));
			}
		}
		public function SearchResultWithParams($returnid, $articleid, $attr = '', $params = '')
		{
			// this method returns an array with 3 elements. The module name, the article/item name, and the URL to display it.
			if( $attr != 'holiday' ) return;
			$holiday = HolidayItem::load_by_id((int)$articleid);
			if( !$holiday ) return; // could not find the item.
			$result = array();
			$result[0] = $this->GetFriendlyName();
			$result[1] = $holiday->name;
			$detailpage = $returnid;
			if( isset($params['detailpage']) ) {
				$hm = CmsApp::get_instance()->GetHierarchyManager();
				$node = $hm->sureGetNodeByAlias($params['detailpage']);
				if( is_object($node) ) $detailpage = $node->get_tag('id');
			}
			$result[2] = $this->create_url('cntnt01','detail',$detailpage,
			array('hid'=>(int)$articleid));
			return $result;
		}
		
		public function LazyLoadAdmin() { return TRUE; }
		
		
	}
?>
