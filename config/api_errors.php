<?php

return [
    'login_failure' => [
        'type' => 'login_failure',
        'message' => 'Login Failure',
        'response_code' => 400,
    ],
    'duplicate_entry' => [
        'type' => 'duplicate_entry',
        'message' => 'Duplicate entry',
        'response_code' => 409,
    ],
    'invalid_email_address' => [
        'type' => 'invalid_email_address',
        'message' => 'Invalid email address.',
        'response_code' => 400,
    ],
    'invalid_password' => [
        'type' => 'invalid_password',
        'message' => 'Invalid password.',
        'response_code' => 400,
    ],
    '403Forbidden' => [
        'type' => '403_forbidden',
        'message' => '403 Forbidden.',
        'response_code' => 403,
    ],
    '401Unauthorized ' => [
        'type' => '401_Unauthorized',
        'message' => '401 Unauthorized .',
        'response_code' => 401,
    ],
    '404Notfound' => [
        'type' => '404_not_found',
        'message' => '404Notfound',
        'response_code' => 404,
    ],
    'internal_server_error' => [
        'type' => 'internal_server_error',
        'message' => 'Internal server error.',
        'response_code' => 500,
    ],
];
