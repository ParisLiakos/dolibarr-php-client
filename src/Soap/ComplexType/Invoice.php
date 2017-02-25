<?php

namespace DolibarPhpClient\Soap\ComplexType;

class Invoice extends \ArrayObject
{

    public function __construct(array $data)
    {
        $defaults = array_fill_keys([
            'id',
            'ref',
            'ref_ext',
            'thirdparty_id',
            'fk_user_author',
            'fk_user_valid',
            'date',
            'date_due',
            'date_creation',
            'date_validation',
            'date_modification',
            'payment_mode_id',
            'type',
            'total_net',
            'total_vat',
            'total',
            'note_private',
            'note_public',
            'status',
            'close_code',
            'close_note',
            'project_id',
            'lines',
        ], null);
        // Merge defaults.
        $data += $defaults;
        parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
    }
}
