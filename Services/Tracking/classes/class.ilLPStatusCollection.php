<?php
/*
	+-----------------------------------------------------------------------------+
	| ILIAS open source                                                           |
	+-----------------------------------------------------------------------------+
	| Copyright (c) 1998-2001 ILIAS open source, University of Cologne            |
	|                                                                             |
	| This program is free software; you can redistribute it and/or               |
	| modify it under the terms of the GNU General Public License                 |
	| as published by the Free Software Foundation; either version 2              |
	| of the License, or (at your option) any later version.                      |
	|                                                                             |
	| This program is distributed in the hope that it will be useful,             |
	| but WITHOUT ANY WARRANTY; without even the implied warranty of              |
	| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               |
	| GNU General Public License for more details.                                |
	|                                                                             |
	| You should have received a copy of the GNU General Public License           |
	| along with this program; if not, write to the Free Software                 |
	| Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. |
	+-----------------------------------------------------------------------------+
*/

/**
* @author Stefan Meyer <smeyer@databay.de>
*
* @version $Id$
*
* @package ilias-tracking
*
*/

include_once './Services/Tracking/classes/class.ilLPStatus.php';
include_once './Services/Tracking/classes/class.ilLPStatusWrapper.php';

class ilLPStatusCollection extends ilLPStatus
{

	function ilLPStatusCollection($a_obj_id)
	{
		global $ilDB;

		parent::ilLPStatus($a_obj_id);
		$this->db =& $ilDB;
	}

	function _getNotAttempted($a_obj_id)
	{
		global $ilObjDataCache;

		switch($ilObjDataCache->lookupType($a_obj_id))
		{
			case 'crs':
				include_once 'course/classes/class.ilCourseMembers.php';
				$members = ilCourseMembers::_getMembers($a_obj_id);
				
				// diff in progress and completed (use stored result in LPStatusWrapper)
				$users = array_diff((array) $members,$inp = ilLPStatusWrapper::_getInProgress($a_obj_id));
				$users = array_diff((array) $users,$com = ilLPStatusWrapper::_getCompleted($a_obj_id));
				return $users;

			default:
				return array();
		}
	}

	function _getInProgress($a_obj_id)
	{
		include_once './Services/Tracking/classes/class.ilLPCollections.php';
		include_once './Services/Tracking/classes/class.ilLPEventCollections.php';


		global $ilBench,$ilObjDataCache;
		$ilBench->start('LearningProgress','9172_LPStatusCollection_inProgress');

		$in_progress = 0;
		foreach(ilLPCollections::_getItems($a_obj_id) as $item_id)
		{
			$item_id = $ilObjDataCache->lookupObjId($item_id);

			// merge arrays of users with status 'in progress'
			$users = array_unique(array_merge((array) $users,ilLPStatusWrapper::_getInProgress($item_id)));
			$users = array_unique(array_merge((array) $users,ilLPStatusWrapper::_getCompleted($item_id)));
		}

		// Handle status of events
		foreach(ilLPEventCollections::_getItems($a_obj_id) as $event_id)
		{
			#var_dump("<pre>","EVENT_ID: ",$event_id,"<pre>");
			$users = array_unique(array_merge((array) $users,ilLPStatusWrapper::_getInProgressByType($event_id,'event')));
			$users = array_unique(array_merge((array) $users,ilLPStatusWrapper::_getCompletedByType($event_id,'event')));
		}

		// Exclude all users with status completed.
		$users = array_diff((array) $users,ilLPStatusWrapper::_getCompleted($a_obj_id));

		switch($ilObjDataCache->lookupType($a_obj_id))
		{
			case 'crs':
				// Exclude all non members
				include_once 'course/classes/class.ilCourseMembers.php';
				$users = array_intersect(ilCourseMembers::_getMembers($a_obj_id),(array) $users);
				break;
		}

		$ilBench->stop('LearningProgress','9172_LPStatusCollection_inProgress');
		return $users;
	}

	function _getCompleted($a_obj_id)
	{
		include_once './Services/Tracking/classes/class.ilLPCollections.php';
		include_once './Services/Tracking/classes/class.ilLPEventCollections.php';

		global $ilBench,$ilObjDataCache;
		$ilBench->start('LearningProgress','9173_LPStatusCollection_completed');


		$counter = 0;
		foreach(ilLPCollections::_getItems($a_obj_id) as $item_id)
		{
			$item_id = $ilObjDataCache->lookupObjId($item_id);

			$tmp_users = ilLPStatusWrapper::_getCompleted($item_id);
			if(!$counter++)
			{
				$users = $tmp_users;
			}
			else
			{
				$users = array_intersect($users,$tmp_users);
			}

		}
		foreach(ilLPEventCollections::_getItems($a_obj_id) as $event_id)
		{
			$tmp_users = ilLPStatusWrapper::_getCompletedByType($event_id,'event');
			if(!$counter++)
			{
				$users = $tmp_users;
			}
			else
			{
				$users = array_intersect($users,$tmp_users);
			}
		}
			
		switch($ilObjDataCache->lookupType($a_obj_id))
		{
			case 'crs':
				// Exclude all non members
				include_once 'course/classes/class.ilCourseMembers.php';
				$users = array_intersect(ilCourseMembers::_getMembers($a_obj_id),(array) $users);
				break;
		}

		$ilBench->stop('LearningProgress','9173_LPStatusCollection_completed');
		return (array) $users;
	}

	function _getStatusInfo($a_obj_id)
	{
		include_once './Services/Tracking/classes/class.ilLPCollections.php';
		include_once './Services/Tracking/classes/class.ilLPEventCollections.php';

		$status_info['collections'] = ilLPCollections::_getItems($a_obj_id);
		$status_info['event_collections'] = ilLPCollections::_getItems($a_obj_id);

		$status_info['num_collections'] = count($status_info['collections']) + count($status_info['event_collections']);
		return $status_info;
	}

	function _getTypicalLearningTime($a_obj_id)
	{
		$status_info = ilLPStatusWrapper::_getStatusInfo($a_obj_id);
		foreach($status_info['collections'] as $item)
		{
			$tlt += ilLPStatusWrapper::_getTypicalLearningTime($item);
		}
		return $tlt;
	}

}	
?>