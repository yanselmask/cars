<?php

return [
    'show_custom_fields' => true,
    'custom_fields' => [
        'address' => [
            'type' => 'text',
            'label' => 'Address',
            'placeholder' => 'Address',
            'required' => false,
            'rules' => 'nullable|string|max:255',
        ],
        'phone_number' => [
            'type' => 'text',
            'label' => 'Phone Number',
            'placeholder' => 'Phone Number',
            'required' => false,
            'rules' => 'nullable|string|max:255',
        ],
        'whatsapp' => [
            'type' => 'text',
            'label' => 'WhatsApp',
            'placeholder' => 'WhatsApp',
            'required' => false,
            'rules' => 'nullable|string|max:255',
        ],
        'instagram' => [
            'type' => 'text',
            'label' => 'Instagram',
            'placeholder' => 'Instagram',
            'required' => false,
            'rules' => 'nullable|string|max:255',
        ],
        'facebook' => [
            'type' => 'text',
            'label' => 'Facebook',
            'placeholder' => 'Facebook',
            'required' => false,
            'rules' => 'nullable|string|max:255',
        ],
        // 'custom_field_2' => [
        //     'type' => 'select',
        //     'label' => 'Custom Select 2',
        //     'placeholder' => 'Select',
        //     'required' => true,
        //     'options' => [
        //         'option_1' => 'Option 1',
        //         'option_2' => 'Option 2',
        //         'option_3' => 'Option 3',
        //     ],
        // ],
        // 'custom_field_3' => [
        //     'type' => 'textarea',
        //     'label' => 'Custom Textarea 3',
        //     'placeholder' => 'Textarea',
        //     'rows' => '3',
        //     'required' => true,
        // ],
        // 'custom_field_4' => [
        //     'type' => 'datetime',
        //     'label' => 'Custom Datetime 4',
        //     'placeholder' => 'Datetime',
        //     'seconds' => false,
        // ],
        // 'custom_field_5' => [
        //     'type' => 'boolean',
        //     'label' => 'Custom Boolean 5',
        //     'placeholder' => 'Boolean'
        // ],
    ]
];
