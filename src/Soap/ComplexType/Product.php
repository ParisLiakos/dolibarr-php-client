<?php

namespace DolibarPhpClient\Soap\ComplexType;

class Product extends \ArrayObject
{

    public function __construct(array $data)
    {
        $defaults = array_fill_keys([
            'id',
            'ref',
            'ref_ext',
            'type',
            'label',
            'description',
            'date_creation',
            'date_modification',
            'note',
            'status_tobuy',
            'status_tosell',
            'barcode',
            'barcode_type',
            'country_id',
            'country_code',
            'customcode',
            'price_net',
            'price',
            'price_min_net',
            'price_min',
            'price_base_type',
            'vat_rate',
            'vat_npr',
            'localtax1_tx',
            'localtax2_tx',
            'stock_alert',
            'stock_real',
            'stock_pmp',
            'warehouse_ref',
            'canvas',
            'import_key',
            'dir',
            'images',
        ], null);
        // Merge defaults.
        $data += $defaults;
        parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
    }
}
