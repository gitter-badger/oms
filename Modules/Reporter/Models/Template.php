<?php
namespace Modules\Reporter\Models;

/**
 * Template model.
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\Auth
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Template
{
    private $id = 0;

    private $status = \Modules\Reporter\Models\ReporterStatus::INACTIVE;

    private $title = '';

    private $description = '';

    private $created_at = null;

    private $created_by = 0;

    private $collection = null;

    private $sources = null;

    /**
     * Permissions.
     *
     * @var array
     * @since 1.0.0
     */
    private $permissions = [
        'r' => ['groups' => [],
                'users'  => [], ],
        'w' => ['groups' => [],
                'users'  => [], ],
        'p' => ['groups' => [],
                'users'  => [], ],
        'd' => ['groups' => [],
                'users'  => [], ],
    ];

    public function __construct()
    {
    }

    public function insert()
    {
    }
}
