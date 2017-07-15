<?php

return [
    'app' => [
        'domain'    => env('APP_DOMAIN'),
        'subdomain' => '',
    ],
    'flash_messages' => [
        'dataSaved'      => 'Data has been saved successfully.',
        'dataNotSaved'   => 'Data could not be saved at this moment. Please try later.',
        'dataDeleted'    => 'Data have been deleted successfully.',
        'dataNotDeleted' => 'Data could not be deleted at this moment. Please try later.',
        'invitationSent' => 'Invitation has been sent.',
    ],
    'module_types' => [
        'Page'   => 'Page',
        'Module' => 'Module',
    ],
    'is_publicly_visible' => [
        '1' => 'Yes',
        '0' => 'No',
    ],
    'select_status' => [
        '1' => 'Yes',
        '0' => 'No',
    ],
    'is_shown_on_menu' => [
        '1' => 'Yes',
        '0' => 'No',
    ],
    'widget_widths' => [
        '20%'  => '20%',
        '25%'  => '25%',
        '33%'  => '33%',
        '50%'  => '50%',
        '75%'  => '75%',
        '100%' => '100%',
    ],
    'gender' => [
        '0' => 'Male',
        '1' => 'Female',
    ],
    'user_status' => [
        '1' => 'Activate',
        '0' => 'InActive',
    ],
    'search_section' => [
        'status' => [
            '1' => 'Activate',
            '0' => 'InActive',
        ],
    ],
    'menu_item_permission_identifier' => 'm',
    'widget_permission_identifier'    => 'w',
    'job_type' => [
        '1' => 'Yes',
        '0' => 'No'
    ],
    'user_job_types' => [
        'Probation' => 'Probation',
        'Contract' => 'Contract',
        'Consultant' => 'Consultant',
        'Permanent' => 'Permanent'
    ],
    'incremental_durations' => [
        'Annually' => 'Annually',
        'Half yearly' => 'Half yearly'
    ],
    'salary_modes' => [
        'Cash' => 'Cash',
        'Cheque' => 'Cheque',
        'Online' => 'Online'
    ],
    'project_priorities' => [
        'High' => 'High',
        'Medium' => 'Medium',
        'Low' => 'Low'
    ],
    'project_status' => [
        'New' => 'New',
        'In progress' => 'In progress',
        'Completed' => 'Completed',
        'On Hold' => 'On Hold'
    ],
    'project_types' => [
        'HTML' => 'HTML',
        'Development' => 'Development'
    ],
    'positions' => [
        'Wordpress' => 'Wordpress',
        'Angular JS' => 'Angular JS',
        'Laravel' => 'Laravel',
        'Magento' => 'Magento'
    ],
    'assigned_to' => [
        'Vishal Rajpurohit' => 'Vishal Rajpurohit',
        'Manish Yadav' => 'Manish Yadav',
        'Mansi bhatt' => 'Mansi bhatt'
    ],
    'last_status' => [
        'Round-1' => 'Round-1',
        'Round-2' => 'Round-2',
        'Round-3' => 'Round-3',
        'Round-4' => 'Round-4'
    ]
];
