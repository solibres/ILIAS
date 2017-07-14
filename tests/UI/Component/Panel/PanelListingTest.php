<?php

/* Copyright (c) 2017 Alex Killing <killing@leifos.de> Extended GPL, see docs/LICENSE */

require_once(__DIR__."/../../../../libs/composer/vendor/autoload.php");
require_once(__DIR__."/../../Base.php");

use \ILIAS\UI\Component as C;


/**
 * Test listing panels
 */
class PanelListingTest extends ILIAS_UI_TestBase {

	/**
	 * @return \ILIAS\UI\Implementation\Factory
	 */
	public function getFactory() {
		return new \ILIAS\UI\Implementation\Factory();
	}

	public function test_implements_factory_interface() {
		$f = $this->getFactory();

		$std_list = $f->panel()->listing()->standard("List Title", array(
			$f->item()->group("Subtitle 1", array(
				$f->item()->standard("title1"),
				$f->item()->standard("title2")
			)),
			$f->item()->group("Subtitle 2", array(
				$f->item()->standard("title3")
			))
		));

		$this->assertInstanceOf( "ILIAS\\UI\\Component\\Panel\\Listing\\Standard", $std_list);
	}

	public function test_get_title_get_groups() {
		$f = $this->getFactory();

		$groups = array(
			$f->item()->group("Subtitle 1", array(
				$f->item()->standard("title1"),
				$f->item()->standard("title2")
			)),
			$f->item()->group("Subtitle 2", array(
				$f->item()->standard("title3")
			))
		);

		$c = $f->panel()->listing()->standard("title", $groups);

		$this->assertEquals($c->getTitle(), "title");
		$this->assertEquals($c->getItemGroups(), $groups);
	}

	public function test_render_base() {
		$f = $this->getFactory();
		$r = $this->getDefaultRenderer();

		$groups = array(
			$f->item()->group("Subtitle 1", array(
				$f->item()->standard("title1"),
				$f->item()->standard("title2")
			)),
			$f->item()->group("Subtitle 2", array(
				$f->item()->standard("title3")
			))
		);

		$c = $f->panel()->listing()->standard("title", $groups);

		$html = $r->render($c);

		$expected = <<<EOT
<div class="il-panel-listing-std-container">
	<h3>title</h3>
	<div class="il-item-group">
		<h4>Subtitle 1</h4>
		<div class="il-item-group-items">
			<div class="il-panel-listing-std-item-container"><div class="il-item il-std-item ">	
				<h5>title1</h5>
			</div></div><div class="il-panel-listing-std-item-container"><div class="il-item il-std-item ">
				<h5>title2</h5>
			</div></div>
		</div>
	</div><div class="il-item-group">
		<h4>Subtitle 2</h4>
	<div class="il-item-group-items">
	<div class="il-panel-listing-std-item-container"><div class="il-item il-std-item ">
			<h5>title3</h5>
		</div></div>
	</div>
</div>
</div>
EOT;
		$this->assertHTMLEquals($expected, $html);
	}

}
