<?php
/* Copyright (c) 2017 Stefan Hecken <stefan.hecken@concepts-and-training.de> Extended GPL, see docs/LICENSE */

require_once("libs/composer/vendor/autoload.php");

ini_set("assert.active", "1");
ini_set("assert.bail", "0");
ini_set("assert.warning", "1");

/**
 * Testing the faytory of result objects
 *
 * @author Stefan Hecken <stefan.hecken@concepts-and-training.de>
 */
class ReadmeTests extends PHPUnit_Framework_TestCase {
	protected function setUp() {
		$this->old_active = ini_get("assert.active");
		$this->old_bail = ini_get("assert.bail");
		$this->old_warninig = ini_get("assert.warning");
	}

	protected function tearDown() {
		ini_set("assert.active", $this->old_active);
		ini_set("assert.bail", $this->old_bail);
		ini_set("assert.warning", $this->old_warninig);
	}

	public function testReadme() {
		require_once(__DIR__."/../../src/Data/README.md");
		$this->assertTrue(true);
	}
}