<?php

namespace Automattic\WooCommerce\Admin\Features\PaymentGatewaySuggestions;

use Automattic\WooCommerce\Admin\DataSourcePoller;

/**
 * Specs data source poller class for payment gateway suggestions.
 */
class PaymentGatewaySuggestionsDataSourcePoller extends DataSourcePoller {

	/**
	 * Data Source Poller ID.
	 */
	const ID = 'payment_gateway_suggestions';

	/**
	 * Default data sources array.
	 */
	const DATA_SOURCES = array(
		'https://api.npoint.io/83d63d29d478ececdbc5',
	);

	/**
	 * Class instance.
	 *
	 * @var Analytics instance
	 */
	protected static $instance = null;

	/**
	 * Get class instance.
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			// Add country query param to data sources.
			$base_location = wc_get_base_location();
			$data_sources  = array_map(
				function( $url ) use ( $base_location ) {
					return add_query_arg(
						'country',
						$base_location['country'],
						$url
					);
				},
				self::DATA_SOURCES
			);

			self::$instance = new self( self::ID, $data_sources );
		}
		return self::$instance;
	}
}
