<?php

class NP_MemberOnly extends NucleusPlugin {

function getName() { return 'MemberOnly';    }
function getAuthor() { return 'kimitake';    }
function getURL() { return 'http://kimitake.blogdns.net'; }
function getVersion() { return '0.1'; }
function getDescription() { return 'MemberOnly'; }

	function install() {
	}

	function getEventList() { return array('PreItem'); }

	function event_PreItem($data){
		global $member;
		
		$this->currentItem = &$data["item"]; 
		if ($member && $member->isLoggedIn())
		{
			$this->currentItem->more = preg_replace("#(</mox>)<br />\r\n#","$1",$this->currentItem->more);
			$this->currentItem->body = preg_replace('#<mox>(.*?)</mox>#s', "$1", $this->currentItem->body); 
			$this->currentItem->more = preg_replace('#<mox>(.*?)</mox>#s', "$1", $this->currentItem->more);
		}
		else
		{
			$this->currentItem->more = preg_replace("#(</mo>)<br />\r\n#","$1",$this->currentItem->more);
			$this->currentItem->body = preg_replace('#<mo>(.*?)</mo>#s', '', $this->currentItem->body); 
			$this->currentItem->more = preg_replace('#<mo>(.*?)</mo>#s', '', $this->currentItem->more);
		}
	}
}
