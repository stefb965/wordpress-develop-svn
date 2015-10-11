<?php

if ( is_multisite() ) :

/**
 * Tests specific to network options in Multisite.
 *
 * @group option
 * @group ms-option
 * @group multisite
 */
class Tests_Option_NetworkOption extends WP_UnitTestCase {
	function test_add_network_option_not_available_on_other_network() {
		$id = $this->factory->network->create();
		$option = rand_str();
		$value = rand_str();

		add_site_option( $option, $value );
		$this->assertFalse( get_network_option( $id, $option, false ) );
	}

	function test_add_network_option_available_on_same_network() {
		$id = $this->factory->network->create();
		$option = rand_str();
		$value = rand_str();

		add_network_option( $id, $option, $value );
		$this->assertEquals( $value, get_network_option( $id, $option, false ) );
	}

	function test_delete_network_option_on_only_one_network() {
		$id = $this->factory->network->create();
		$option = rand_str();
		$value = rand_str();

		add_site_option( $option, $value );
		add_network_option( $id, $option, $value );
		delete_site_option( $option );
		$this->assertEquals( $value, get_network_option( $id, $option, false ) );
	}
}

endif;