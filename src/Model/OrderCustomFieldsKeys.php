<?php

declare(strict_types=1);

namespace Endereco\Shopware6Client\Model;

/**
 * Constants for the order custom field keys written by earlier plugin versions.
 *
 * The plugin no longer writes these custom fields. The keys are kept so the
 * uninstall routine can still remove leftover data from existing shops.
 */
final class OrderCustomFieldsKeys
{
    public const BILLING_ADDRESS_VALIDATION_DATA = 'endereco_order_billing_addresses_validation_data_gh';
    public const SHIPPING_ADDRESS_VALIDATION_DATA = 'endereco_order_shipping_addresses_validation_data_gh';

    /**
     * @var string[]
     */
    public const FIELDS = [
        self::BILLING_ADDRESS_VALIDATION_DATA,
        self::SHIPPING_ADDRESS_VALIDATION_DATA,
    ];

    private function __construct()
    {
        // Prevent instantiation
    }
}
