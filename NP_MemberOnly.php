<?php

class NP_MemberOnly extends NucleusPlugin {

    function getName()        { return 'MemberOnly';}
    function getAuthor()      { return 'kimitake';}
    function getURL()         { return 'https://github.com/NucleusCMS/NP_MemberOnly'; }
    function getVersion()     { return '0.2'; }
    function getDescription() { return 'MemberOnly'; }

    function getEventList() { return array('PreItem'); }

    function event_PreItem($data){
        global $member;
        
        $item = &$data['item']; 
        if ($member && $member->isLoggedIn())
        {
            $item->more = preg_replace("#(</mo>)<br />\r\n#","$1", $item->more);
            $item->body = preg_replace('#<mo>(.*?)</mo>#s',  "$1", $item->body); 
            $item->more = preg_replace('#<mo>(.*?)</mo>#s',  "$1", $item->more);
            $item->more = preg_replace("#(</mox>)<br />\r\n#",'',  $item->more);
            $item->body = preg_replace('#<mox>(.*?)</mox>#s', '',  $item->body); 
            $item->more = preg_replace('#<mox>(.*?)</mox>#s', '',  $item->more);
        }
        else
        {
            $item->more = preg_replace("#(</mox>)<br />\r\n#","$1", $item->more);
            $item->body = preg_replace('#<mox>(.*?)</mox>#s', "$1", $item->body); 
            $item->more = preg_replace('#<mox>(.*?)</mox>#s', "$1", $item->more);
            $item->more = preg_replace("#(</mo>)<br />\r\n#","$1",  $item->more);
            $item->body = preg_replace('#<mo>(.*?)</mo>#s', '',     $item->body); 
            $item->more = preg_replace('#<mo>(.*?)</mo>#s', '',     $item->more);
        }
    }
}
