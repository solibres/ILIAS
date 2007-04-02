<?php
/*
	+-----------------------------------------------------------------------------+
	| ILIAS open source                                                           |
	+-----------------------------------------------------------------------------+
	| Copyright (c) 1998-2006 ILIAS open source, University of Cologne            |
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

include_once('Services/CopyWizard/classes/class.ilCopyWizardOptions.php');

/** 
* @defgroup ServicesCopyWizard Services/CopyWizard
* 
* @author Stefan Meyer <smeyer@databay.de>
* @version $Id$
* 
* 
* @ilCtrl_Calls 
* @ingroup 
*/

class ilCopyWizardPage
{
	private $type;
	private $source_id;
	private $obj_id;
	private $item_type;
	
	private $tree;
	private $lng;
	private $objDefinition;
	
	/**
	 * Constructor
	 *
	 * @access public
	 * @param
	 * 
	 */
	public function __construct($a_source_id,$a_item_type = '')
	{
		global $ilObjDataCache,$tree,$lng,$objDefinition;
		
		$this->source_id = $a_source_id;
		$this->item_type = $a_item_type;
		$this->obj_id = $ilObjDataCache->lookupObjId($this->source_id);
	 	$this->type = $ilObjDataCache->lookupType($this->obj_id);
	 	$this->tree = $tree;
	 	$this->lng = $lng;
	 	$this->objDefinition = $objDefinition;
	}
	
	/**
	 * Fill selection template
	 *
	 * @access public
	 * @param int ref_id of node
	 * @param string type of current node
	 * 
	 */
	public function fillTreeSelection($a_ref_id,$a_type)
	{
		global $tpl,$ilAccess;
		
		$selected = isset($_POST['cp_options'][$a_ref_id]['type']) ?
			$_POST['cp_options'][$a_ref_id]['type'] :
			ilCopyWizardOptions::COPY_WIZARD_COPY;
			
		$perm_copy = $ilAccess->checkAccess('copy','',$a_ref_id);
		$copy = $this->objDefinition->allowCopy($a_type); 
		$perm_link = $ilAccess->checkAccess('write','',$a_ref_id);
		$link = $this->objDefinition->allowLink($a_type); 

		$options = array();
		if($copy and $perm_copy)
		{
			$options[ilCopyWizardOptions::COPY_WIZARD_COPY] = $this->lng->txt('copy');
		}
		if($link and $perm_link)
		{
			$options[ilCopyWizardOptions::COPY_WIZARD_LINK] = $this->lng->txt('link');
		}
		$options[ilCopyWizardOptions::COPY_WIZARD_OMIT] = $this->lng->txt('omit');
		
		if(!$perm_copy or !$perm_link)
		{
			$tpl->setCurrentBlock('permission');
			$tpl->setVariable('TXT_MISSING_PERM',$this->lng->txt('missing_perm'));
			if(!$perm_copy)
			{
				$perms = $this->lng->txt('copy');				
			}
			if(!$perm_link)
			{
				if(strlen($perms))
				{
					$perms .= (', ');
				}
				$perms .= $this->lng->txt('link');
			}
			$tpl->setVariable('PERMS',$perms);
			$tpl->parseCurrentBlock();
		}
		
		$disabled = (!($copy or $perm_copy) and !($link or $perm_link));
		
		$tpl->setVariable('TREE_SELECT',ilUtil::formSelect($selected,'cp_options['.$a_ref_id.'][type]',
			$options,false,true,0,'','',$disabled));
		
	}
	

	
	/**
	 * Get wizard page block html
	 *
	 * @access public
	 * 
	 */
	public function getWizardPageBlockHTML()
	{
		$this->readItems();
		
		if(!count($this->items))
		{
			return '';
		}
	}
	
	/**
	 * init template
	 *
	 * @access protected
	 */
	protected function initTemplate()
	{
		$this->tpl = new ilTemplate('tpl.copy_wizard_block.html',true,true,'Services/CopyWizard');
	}
	
	/**
	 * 
	 *
	 * @access protected
	 */
	protected function fillMainBlock()
	{
		
		if(count($this->items) > 1)
		{	
			$this->tpl->setCurrentBlock('obj_options');
			$this->tpl->setVariable('NAME_OPTIONS',$this->lng->txt('omit_all'));
			$this->tpl->setVariable('JS_FIELD',$this->item_type.'_'.ilCopyWizardOptions::COPY_WIZARD_OMIT);
			$this->tpl->setVariable('JS_TYPE',$this->item_type.'_omit');
			$this->tpl->parseCurrentBlock();
			
			$this->tpl->setCurrentBlock('obj_options');
			$this->tpl->setVariable('NAME_OPTIONS',$this->lng->txt('copy_all'));
			$this->tpl->setVariable('OBJ_CHECKED','checked="checked"');
			$this->tpl->setVariable('JS_FIELD',$this->item_type.'_'.ilCopyWizardOptions::COPY_WIZARD_COPY);
			$this->tpl->setVariable('JS_TYPE',$this->item_type.'_copy');
			$this->tpl->parseCurrentBlock();
	
			if($this->objDefinition->allowLink($this->item_type))
			{
				$this->tpl->setCurrentBlock('obj_options');
				$this->tpl->setVariable('NAME_OPTIONS',$this->lng->txt('link_all'));
				$this->tpl->setVariable('JS_FIELD',$this->item_type.'_'.ilCopyWizardOptions::COPY_WIZARD_LINK);
				$this->tpl->setVariable('JS_TYPE',$this->item_type.'_link');
				$this->tpl->parseCurrentBlock();
				
			}
			$this->tpl->setVariable('OPTION_CLASS','option_value');
		}
		else
		{
			$this->tpl->setVariable('OPTION_CLASS','option');
		}		
		$this->tpl->setVariable('OBJ_IMG',ilUtil::getImagePath('icon_'.$this->item_type.'.gif'));
		$this->tpl->setVariable('OBJ_ALT',$this->lng->txt('objs_'.$this->item_type));
		$this->tpl->setVariable('ROWSPAN',count($this->items) + 1);
	}
	
	/**
	 * Fill item block
	 *
	 * @access protected
	 */
	protected function fillItemBlock()
	{
		foreach($this->items as $node)
		{
			$selected = $this->fetchSelected($node['child']);
			
			
			$this->tpl->setCurrentBlock('item_options');
			$this->tpl->setVariable('ITEM_CHECK_NAME','cp_options['.$node['child'].'][type]');
			$this->tpl->setVariable('ITEM_VALUE',ilCopyWizardOptions::COPY_WIZARD_OMIT);
			$this->tpl->setVariable('ITEM_NAME_OPTION',$this->lng->txt('omit'));
			if($selected == ilCopyWizardOptions::COPY_WIZARD_OMIT)
			{
				$this->tpl->setVariable('ITEM_CHECKED','checked="checked"');
			}
			$this->tpl->setVariable('ITEM_ID',$this->item_type.'_'.ilCopyWizardOptions::COPY_WIZARD_OMIT);
			$this->tpl->parseCurrentBlock();
			
			
			if($this->objDefinition->allowCopy($this->item_type))
			{
				$this->tpl->setCurrentBlock('item_options');
				if($selected == ilCopyWizardOptions::COPY_WIZARD_COPY)
				{
					$this->tpl->setVariable('ITEM_CHECKED','checked="checked"');
				}
				$this->tpl->setVariable('ITEM_CHECK_NAME','cp_options['.$node['child'].'][type]');
				$this->tpl->setVariable('ITEM_VALUE',ilCopyWizardOptions::COPY_WIZARD_COPY);
				$this->tpl->setVariable('ITEM_NAME_OPTION',$this->lng->txt('copy'));
				$this->tpl->setVariable('ITEM_ID',$this->item_type.'_'.ilCopyWizardOptions::COPY_WIZARD_COPY);
				$this->tpl->parseCurrentBlock();
			}
			if($this->objDefinition->allowLink($this->item_type))
			{
				$this->tpl->setCurrentBlock('item_options');
				if($selected ==ilCopyWizardOptions::COPY_WIZARD_LINK)
				{
					$this->tpl->setVariable('ITEM_CHECKED','checked="checked"');
				}
				$this->tpl->setVariable('ITEM_CHECK_NAME','cp_options['.$node['child'].'][type]');
				$this->tpl->setVariable('ITEM_VALUE',ilCopyWizardOptions::COPY_WIZARD_LINK);
				$this->tpl->setVariable('ITEM_NAME_OPTION',$this->lng->txt('link'));
				$this->tpl->setVariable('ITEM_ID',$this->item_type.'_'.ilCopyWizardOptions::COPY_WIZARD_LINK);
				$this->tpl->parseCurrentBlock();
			}
			
			
			$this->tpl->setCurrentBlock('item_row');
			$this->tpl->setVariable('ITEM_TITLE',$node['title']);
			$this->tpl->setVariable('DESCRIPTION',$node['description']);
			$this->tpl->parseCurrentBlock();
		}
	}
	
	/**
	 * Fill additional options
	 *
	 * @access protected
	 */
	protected function fillAdditionalOptions()
	{
	
	}
	
	/**
	 * Read items
	 *
	 * @access protected
	 */
	protected function readItems()
	{
		$nodes = $this->tree->getSubTree($this->tree->getNodeData($this->source_id),true,$this->item_type);
		
		$this->items = array();
		switch($nodes[0]['type'])
		{
			case 'fold':
			case 'grp':
			case 'crs':
			case 'cat':
				foreach($nodes as $node)
				{
					if($node['child'] != $this->source_id)
					{
						$this->items[] = $node;
					}
				}
				break;
			default:
				$this->items = $nodes;
				break;
		}
	}
	
	/**
	 * Check if it is checked
	 *
	 * @access protected
	 */
	protected function fetchSelected($a_node_id)
	{
		return $_POST['cp_options'][$a_node_id]['type'] ? 
			$_POST['cp_options'][$a_node_id]['type'] :
			ilCopyWizardOptions::COPY_WIZARD_COPY; 
	}
}


?>