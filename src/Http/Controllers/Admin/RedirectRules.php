<?php

namespace Facilitador\Http\Controllers\Admin;

use Support\Models\RedirectRule;

/**
 * Allow admin to manage redirection rules
 */
class RedirectRules extends Base
{
    /**
     * @var string
     */
    public $title = 'Redirects';
    
    public $model = RedirectRule::class;

    /**
     * @var string
     */
    public $description = 'Rules that redirect an internal URL path to another.';

    /**
     * @var array
     */
    public $columns = [
        'Rule' => 'getAdminTitleAttribute',
    ];

    /**
     * @var array
     */
    public $search = [
        'from',
        'to',
        'code' => [
            'type' => 'select',
            'options' => 'Support\Models\RedirectRule::getCodes()',
        ],
        'label',
    ];

    /**
     * Get the permission options.
     *
     * @return array An associative array.
     */
    public function getPermissionOptions()
    {
        return array_except(parent::getPermissionOptions(), ['publish']);
    }

    /**
     * Populate protected properties on init
     */
    public function __construct()
    {
        $this->title = __('pedreiro::redirect_rules.controller.title');
        $this->description = __('pedreiro::redirect_rules.controller.description');
        $this->columns = [
            __('pedreiro::redirect_rules.controller.column.rule') => 'getAdminTitleAttribute',
        ];
        $this->search = [
            'from' => [
                'label' => __('pedreiro::redirect_rules.controller.search.from'),
                'type' => 'text',
            ],
            'to' => [
                'label' => __('pedreiro::redirect_rules.controller.search.to'),
                'type' => 'text',
            ],
            'code' => [
                'label' => __('pedreiro::redirect_rules.controller.search.code'),
                'type' => 'select',
                'options' => 'Support\Models\RedirectRule::getCodes()',
            ],
            'label' => [
                'label' => __('pedreiro::redirect_rules.controller.search.label'),
                'type' => 'text',
            ],
        ];

        parent::__construct();
    }
}
