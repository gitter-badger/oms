<?php
namespace Modules\Reporter\Models;

/**
 * Report model.
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
class Report
{
    private $id = 0;

    private $status = \Modules\Reporter\Models\ReporterStatus::INACTIVE;

    private $title = '';

    private $description = '';

    private $created_at = null;

    private $created_by = 0;

    private $template = 0;

    private $source = null;

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

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created)
    {
        $this->created_at = $created;
    }

    public function getCreatedBy()
    {
        return $this->created_by;
    }

    public function setCreatedBy($creator)
    {
        $this->created_by = $creator;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function setSource($source)
    {
        $this->source = $source;
    }

    public function insert()
    {
    }
}
