<?php
/**
 * Cms Configuration
 */

return [

    /**
     * Business Ativo
     */
    // 'business' => Data\Negocios\Clients\CarolNovaes::class,
    'business' => false,


    'login' => true,
    'packagesMenu' => true,
    'packagesRoutes' => true,

    /**
     * Se vai aparecer ou nao sub divisoes do menu na barra superior
     */
    'habilityTopNav' => false,

    'db-prefix' => '',
    // 'db-prefix' => 'siravel_',

    'influencia' => false,

    /**
     * Business Padrão
     */
    'default' =>  env('TENANCY_DEFAULT_HOSTNAME', 'ricasolucoes'),


    /**
     * Configurações Personalizadas
     */
    'can_register_free' => true,
    'terms' => 'Termos e condições para cadstro de usuários',

    /*
     * --------------------------------------------------------------------------
     * Features
     * --------------------------------------------------------------------------
    */

    'load-features' => true,
    'module-directory' => 'admin/features',
    'active-core-features' => [
        'writelabel',
        'menus',
        'pages',
        'faqs',

        'blog',
        'files',
        'images',
        'widgets',
        'events',

        'gamification',
        'casa',
        'bancario',
        'fa',
        'commerce',
        'marketing',
        'midia',
        'productions',
        'locaravel',
        // Libera Equipamentos, Acessorios, etc..
        'espolio'
    ],

    /*
    |--------------------------------------------------------------------------
    | Features for Home
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */
    'features' => \Cms\Logic\Features\FeatureBase::getFeatures(),

    /*
     * --------------------------------------------------------------------------
     * Front-end:
     * default
     * Themes Options
     * ricasolucoes
     * ricardosierra
     * snowevo
     * --------------------------------------------------------------------------
    */

    'frontend-namespace' => '\App\Http\Controllers\Admin',
    'frontend-theme' => 'default',

    
    /*
     * --------------------------------------------------------------------------
     * Admin management
     * --------------------------------------------------------------------------
    */
    'backend-title' => 'Cms',
    'backend-route-prefix' => 'admin',
    'root-route-prefix' => 'root',
    'backend-theme' => 'adminlte', // cosmo, cyborg, flatly, lumen, paper, sandstone, simplex, united, yeti
    'registration-available' => false,
    'pagination' => 25,

    /*
     * --------------------------------------------------------------------------
     * Languages
     * --------------------------------------------------------------------------
    */

    'auto-translate' => true,

    'default-language' => 'pt-BR',

    'languages' => [
        'pt' => 'portuguese',
        // 'en' => 'english',
        'en-US' => 'english',
        'pt-BR' => 'portuguese',
        // 'fr' => 'french',
    ],


    /*
     * --------------------------------------------------------------------------
     * Analytics
     * --------------------------------------------------------------------------
    */

    'analytics' => 'internal',   // google, internal

    /*
     * --------------------------------------------------------------------------
     * Pixabay
     * --------------------------------------------------------------------------
    */

    'pixabay' => env('PIXABAY'),

    /*
     * --------------------------------------------------------------------------
     * Live preview in editor
     * --------------------------------------------------------------------------
    */

    'live-preview' => true,
    
    /*
     * --------------------------------------------------------------------------
     * RSS
     * --------------------------------------------------------------------------
    */

    'rss' => [
        'title' => '',
        'link' => '',
        'description' => '',
        'name' => '',
    ],

    /*
     * --------------------------------------------------------------------------
     * Site Mapped Modules
     * --------------------------------------------------------------------------
    */

    'site-mapped-modules' => [
        'blog' => 'Cms\Repositories\BlogRepository',
        'page' => 'Cms\Repositories\Negocios\PageRepository',
        'events' => 'Cms\Repositories\EventRepository',
    ],


    /*
     * --------------------------------------------------------------------------
     * Images and File Storage
     * --------------------------------------------------------------------------
    */

    'storage-location' => 'local', // s3, local
    'max-file-upload-size' => 6291456, // 6MB
    'preview-image-size' => 800, // width - auto height
    'cloudfront' => null, // do not include http

    /**
     * Facilitador
     */
    'facilitador' => [
        'login' => true,
    ],

    /*
     * --------------------------------------------------------------------------
     * API key and token
     * --------------------------------------------------------------------------
    */

    'api-key' => env('GPOWER_API_KEY', 'apis-are-cool'),
    'api-token' => env('GPOWER_API_TOKEN', 'cms-token'),

    /*
     * --------------------------------------------------------------------------
     * Core Module Forms
     * --------------------------------------------------------------------------
    */

    'forms' => [
        'blog' => [
            'identity' => [
                'title' => [
                    'type' => 'string',
                ],
                'url' => [
                    'type' => 'string',
                ],
                'tags' => [
                    'type' => 'string',
                    'class' => 'tags',
                ],
            ],
            'content' => [
                'entry' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Content',
                ],
                'hero_image' => [
                    'type' => 'file',
                    'alt_name' => 'Hero Image',
                ],
            ],
            'seo' => [
                'seo_description' => [
                    'type' => 'text',
                    'alt_name' => 'SEO Description',
                ],
                'seo_keywords' => [
                    'type' => 'string',
                    'class' => 'tags',
                    'alt_name' => 'SEO Keywords',
                ],
            ],
            'publish' => [
                'is_published' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Published',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'alt_name' => 'Publish Date',
                    'custom' => 'autocomplete="off"',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
        ],

        'images' => [
            'is_published' => [
                'type' => 'checkbox',
                'value' => 1,
                'custom' => 'checked',
            ],
            'tags' => [
                'custom' => 'data-role="tagsinput"',
            ],
        ],

        'images-edit' => [
            'location' => [
                'type' => 'file',
                'alt_name' => 'File',
            ],
            'name' => [
                'type' => 'string',
            ],
            'alt_tag' => [
                'type' => 'string',
                'alt_name' => 'Alt Tag',
            ],
            'title_tag' => [
                'type' => 'string',
                'alt_name' => 'Title Tag',
            ],
            'tags' => [
                'type' => 'string',
                'class' => 'tags',
            ],
            'is_published' => [
                'type' => 'checkbox',
                'alt_name' => 'Published',
            ],
        ],

        'page' => [
            'identity' => [
                'title' => [
                    'type' => 'string',
                ],
                'url' => [
                    'type' => 'string',
                ],
            ],
            'content' => [
                'entry' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Content',
                ],
                'hero_image' => [
                    'type' => 'file',
                    'alt_name' => 'Hero Image',
                ],
            ],
            'seo' => [
                'seo_description' => [
                    'type' => 'text',
                    'alt_name' => 'SEO Description',
                ],
                'seo_keywords' => [
                    'type' => 'string',
                    'class' => 'tags',
                    'alt_name' => 'SEO Keywords',
                ],
            ],
            'publish' => [
                'is_published' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Published',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'alt_name' => 'Publish Date',
                    'custom' => 'autocomplete="off"',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
        ],

        'widget' => [
            'name' => [
                'type' => 'string',
            ],
            'slug' => [
                'type' => 'string',
            ],
            'content' => [
                'type' => 'text',
                'class' => 'redactor',
            ],
        ],

        'faqs' => [
            'question' => [
                'type' => 'string',
            ],
            'answer' => [
                'type' => 'text',
                'class' => 'redactor',
            ],
            'is_published' => [
                'type' => 'checkbox',
                'alt_name' => 'Published',
            ],
            'published_at' => [
                'type' => 'string',
                'class' => 'datetimepicker',
                'alt_name' => 'Publish Date',
                'custom' => 'autocomplete="off"',
                'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
            ],
        ],

        'menu' => [
            'name' => [
                'type' => 'string',
            ],
            'slug' => [
                'type' => 'string',
            ],
        ],

        'link' => [
            'name' => [
                'type' => 'string',
            ],
            'external' => [
                'type' => 'checkbox',
                'custom' => 'value="1"',
            ],
            'external_url' => [
                'type' => 'string',
                'alt_name' => 'Url',
            ],
        ],

        'files' => [
            'is_published' => [
                'type' => 'checkbox',
                'value' => 1,
            ],
            'tags' => [
                'custom' => 'data-role="tagsinput"',
            ],
            'details' => [
                'type' => 'textarea',
            ],
        ],

        'file-edit' => [
            'name' => [],
            'is_published' => [
                'type' => 'checkbox',
                'value' => 1,
            ],
            'tags' => [
                'custom' => 'data-role="tagsinput"',
            ],
            'details' => [
                'type' => 'textarea',
            ],
        ],

        'event' => [
            'identity' => [
                'title' => [
                    'type' => 'string',
                ],
                'start_date' => [
                    'type' => 'string',
                    'class' => 'datepicker',
                    'custom' => 'autocomplete="off"',
                ],
                'end_date' => [
                    'type' => 'string',
                    'class' => 'datepicker',
                    'custom' => 'autocomplete="off"',
                ],
            ],
            'content' => [
                'details' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Details',
                ],
            ],
            'seo' => [
                'seo_description' => [
                    'type' => 'text',
                    'alt_name' => 'SEO Description',
                ],
                'seo_keywords' => [
                    'type' => 'string',
                    'class' => 'tags',
                    'alt_name' => 'SEO Keywords',
                ],
            ],
            'publish' => [
                'is_published' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Published',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'alt_name' => 'Publish Date',
                    'custom' => 'autocomplete="off"',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
        ],
        'promotion' => [
            'identity' => [
                'slug' => [
                    'type' => 'string',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'custom' => 'autocomplete="off"',
                    'alt_name' => 'Publish Date',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
                'finished_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'custom' => 'autocomplete="off"',
                    'alt_name' => 'Finish Date',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
            'content' => [
                'details' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Details',
                ],
            ],
        ],


        /**
         * Market Modulo
         */

        'download' => [
            'file' => [
                'type' => 'file',
                'alt_name' => 'Product File',
            ],
        ],

        'discounts' => [
            'discount' => [
                'type' => 'number',
                'alt_name' => 'Discount (&dollar; or %)',
            ],
            'discount_type' => [
                'type' => 'select',
                'options' => [
                    'Dollars (&dollar;)' => 'cents',
                    'Percentage (%)' => 'percentage',
                ],
            ],
            'discount_start_date' => [
                'type' => 'date',
            ],
            'discount_end_date' => [
                'type' => 'date',
            ],
        ],

        'details' => [
            'identity' => [
                'name' => [
                    'type' => 'string',
                ],
                'url' => [
                    'type' => 'string',
                ],
            ],
            'price' => [
                'code' => [
                    'type' => 'string',
                    'alt_name' => 'SKU',
                ],
                'price' => [
                    'type' => 'float',
                    'custom' => 'min="0"',
                    'alt_name' => 'Price (&dollar;)',
                ],
            ],
            'content' => [
                'details' => [
                    'type' => 'text',
                    'class' => 'redactor',
                ],
                'hero_image' => [
                    'type' => 'file',
                    'alt_name' => 'Hero Image',
                ],
            ],
            'seo' => [
                'seo_keywords' => [
                    'type' => 'string',
                    'class' => 'tags',
                    'alt_name' => 'SEO Keywords',
                ],
                'seo_description' => [
                    'type' => 'text',
                    'alt_name' => 'SEO Description',
                ],
            ],
            'options' => [
                'is_published' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Published',
                ],
                'is_available' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Available',
                ],
                'is_download' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Is Downloaded',
                ],
                'is_featured' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Is Featured',
                ],
            ],
        ],

        'dimensions' => [
            'weight' => [
                'type' => 'string',
            ],
            'width' => [
                'type' => 'string',
            ],
            'height' => [
                'type' => 'string',
            ],
            'depth' => [
                'type' => 'string',
            ],
            'stock' => [
                'type' => 'number',
            ],
        ],

        'plans' => [
            'name' => [
                'type' => 'string',
            ],
            'amount' => [
                'type' => 'number',
                'alt_name' => 'Amount (&cent;)',
            ],
            'interval' => [
                'type' => 'select',
                'options' => [
                    'Weekly' => 'week',
                    'Monthly' => 'month',
                    'Yearly' => 'year',
                ],
            ],
            'currency' => [
                'type' => 'select',
                'options' => \Illuminate\Support\Facades\Config::get(
                    'cms.currencies', [
                    'AUD' => 'aud',
                    'CAD' => 'cad',
                    'USD' => 'usd',
                    'GBP' => 'gbp',
                    'DKK' => 'dkk',
                    'NOK' => 'nok',
                    'SEK' => 'sek',
                    ]
                ),
            ],
            'trial_days' => [
                'type' => 'number',
                'alt_name' => 'Trial Days',
            ],
            'descriptor' => [
                'type' => 'string',
                'alt_name' => 'Credit Card Descriptor',
            ],
            'description' => [
                'type' => 'textarea',
            ],
        ],

        'plans-edit' => [
            'name' => [
                'type' => 'string',
            ],
            'descriptor' => [
                'alt_name' => 'Descriptor (on Credit Card)',
                'type' => 'string',
            ],
            'description' => [
                'type' => 'textarea',
            ],
            'is_featured' => [
                'type' => 'checkbox',
                'alt_name' => 'Is Featured',
            ],
        ],

        'coupons' => [
            'code' => [
                'type' => 'string',
                'alt_name' => 'Coupon Code',
                'placeholder' => 'Coupon Code',
            ],
            'discount_type' => [
                'type' => 'select',
                'options' => [
                    'Dollar' => 'dollar',
                    'Percentage' => 'percentage',
                ]
            ],
            'amount' => [
                'type' => 'number',
                'alt_name' => 'Amount (&cent; or %)',
            ],
            'limit' => [
                'type' => 'number',
            ],
            'for_subscriptions' => [
                'type' => 'checkbox',
                'alt_name' => 'For Subscriptions',
            ],
            'start_date' => [
                'type' => 'date',
            ],
            'end_date' => [
                'type' => 'date',
            ],
        ],
    ],
];
