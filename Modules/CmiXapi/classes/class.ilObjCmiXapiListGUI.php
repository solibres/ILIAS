<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */


/**
 * Class ilObjCmiXapiListGUI
 *
 * @author      Uwe Kohnle <kohnle@internetlehrer-gmbh.de>
 * @author      Björn Heyser <info@bjoernheyser.de>
 * @author      Stefan Schneider <info@eqsoft.de>
 *
 * @package     Module/CmiXapi
 */
class ilObjCmiXapiListGUI extends ilObjectListGUI
{
	public function init()
	{
		global $DIC; /* @var \ILIAS\DI\Container $DIC */
		
		$this->static_link_enabled = true; // Create static links for default command (linked title) or not
		$this->delete_enabled = true;
		$this->cut_enabled = true;
		$this->subscribe_enabled = false;
		$this->link_enabled = true;
		$this->copy_enabled = true;
		$this->progress_enabled = true;
		$this->notice_properties_enabled = true;
		$this->info_screen_enabled = true;
		$this->type = "cmix";
		$this->gui_class_name = "ilObjCmiXapiGUI";

		$this->commands = ilObjCmiXapiAccess::_getCommands();
		
		$DIC->language()->loadLanguageModule('cmix');
	}
	
	public function getProperties()
	{
		global $DIC; /* @var \ILIAS\DI\Container $DIC */
		
		$props = array();
		
		if( ilObjCmiXapiAccess::_isOffline($this->obj_id) )
		{
			$props[] = array("alert" => true, "property" => $DIC->language()->txt("status"),
				"value" => $DIC->language()->txt("offline"));
		}
		
		$props[] = array(
			'alert' => false, 'property' => $DIC->language()->txt('type'),
			'value' => $DIC->language()->txt('obj_cmix')
		);
		
		return $props;
	}
	
	public function getCommandLink($a_cmd)
	{
		global $ilCtrl;
		
		$a_cmd = explode('::', $a_cmd);
		
		if( count($a_cmd) == 2 )
		{
			$cmd_link = $ilCtrl->getLinkTargetByClass(array('ilRepositoryGUI', 'ilObjCmiXapiGUI', $a_cmd[0]), $a_cmd[1]);
		}
		else
		{
			$cmd_link = $ilCtrl->getLinkTargetByClass(array('ilRepositoryGUI', 'ilObjCmiXapiGUI'), $a_cmd[0]);
		}
		
		return $cmd_link;
	}
}