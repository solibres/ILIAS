<?php
/* Copyright (c) 2017 Nils Haagen <nils.haagen@concepts-and-training.de> Extended GPL, see docs/LICENSE */

namespace ILIAS\UI\Component\Breadcrumbs;

/**
 * Interface for Breadcrumbs
 * @package ILIAS\UI\Component\Breadcrumbs
 */
interface Breadcrumbs extends \ILIAS\UI\Component\Component {

	/**
	 * Get all crumbs.
	 *
	 * @return 	\ILIAS\UI\Component\Button\Shy[] 	a list of shy buttons
	 */
	public function getCrumbs();

	/**
	 * Append an crumb-entry to the bar.
	 *
	 * @param 	\ILIAS\UI\Component\Button\Shy 	$crumb
	 * @return 	Breadcrumbs
	 */
	public function withAppendedEntry($crumb);


}
