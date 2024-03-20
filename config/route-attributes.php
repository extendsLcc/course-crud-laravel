<?php

declare(strict_types=1);

return [
    /*
     *  Automatic registration of routes will only happen if this setting is `true`
     */
    'enabled' => true,

    /*
     * Controllers in these directories that have routing attributes
     * will automatically be registered.
     *
     * Optionally, you can specify group configuration by using key/values
     */
    'directories' => [
        /**
         * This will enforce that all controllers are auth guarded by default
         */
        app_path('Http/Controllers') => [
            'middleware' => ['auth', 'web'],
            'except' => ['AuthController.php'],
        ],
        /**
         * Except for the AuthController, which uses the guest middleware
         * since I cannot override auth:web middleware from above config
         */
        app_path('Http/Controllers/Auth') => [
            'middleware' => ['web'],
            'patterns' => ['AuthController.php'],
        ],

        /*
        app_path('Http/Controllers/Api') => [
           'prefix' => 'api',
           'middleware' => 'api',
            // only register routes in files that match the patterns
           'patterns' => ['*Controller.php'],
           // do not register routes in files that match the patterns
           'not_patterns' => [],
        ],
        */
    ],

    /**
     * This middleware will be applied to all routes.
     */
    'middleware' => [
        Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
];
