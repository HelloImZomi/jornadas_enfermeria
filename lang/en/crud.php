<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'schools' => [
        'name' => 'Schools',
        'index_title' => 'Schools List',
        'new_title' => 'New School',
        'create_title' => 'Create School',
        'edit_title' => 'Edit School',
        'show_title' => 'Show School',
        'inputs' => [
            'name' => 'Name',
            'visible' => 'Visible',
        ],
    ],

    'convocations' => [
        'name' => 'Convocations',
        'index_title' => 'Convocations List',
        'new_title' => 'New Convocation',
        'create_title' => 'Create Convocation',
        'edit_title' => 'Edit Convocation',
        'show_title' => 'Show Convocation',
        'inputs' => [
            'name' => 'Name',
            'inscription_start_date' => 'Inscription Start Date',
            'inscription_end_date' => 'Inscription End Date',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'presencial_limit' => 'Presencial Limit',
            'virtual_limit' => 'Virtual Limit',
            'zoom_url' => 'Zoom Url',
            'whatsapp_url' => 'Whatsapp Url',
            'logo_path' => 'Logo Path',
        ],
    ],

    'inscriptions' => [
        'name' => 'Inscriptions',
        'index_title' => 'Inscriptions List',
        'new_title' => 'New Inscription',
        'create_title' => 'Create Inscription',
        'edit_title' => 'Edit Inscription',
        'show_title' => 'Show Inscription',
        'inputs' => [
            'convocation_id' => 'Convocation',
            'school_id' => 'School',
            'code' => 'Code',
            'name' => 'Name',
            'email' => 'Email',
            'education' => 'Education',
            'modality' => 'Modality',
            'receipt_path' => 'Receipt Path',
            'approved' => 'Approved',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
