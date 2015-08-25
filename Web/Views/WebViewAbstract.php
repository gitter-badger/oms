<?php
namespace Web\Views;

/**
 * Web view abstract.
 *
 * PHP Version 7.0
 *
 * @category   Theme
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class WebViewAbstract extends \phpOMS\Views\View
{
    /**
     * Panel id.
     *
     * @var int
     * @since 1.0.0
     */
    protected $id = 0;

    /**
     * Module.
     *
     * @var int
     * @since 1.0.0
     */
    protected $module = 0;

    /**
     * Page.
     *
     * @var int
     * @since 1.0.0
     */
    protected $pageId = 0;

    /**
     * View title.
     *
     * @var string
     * @since 1.0.0
     */
    protected $title = '';

    /**
     * {@inheritdoc}
     */
    public function __construct(\phpOMS\ApplicationAbstract $app, \phpOMS\Message\RequestAbstract $request, \phpOMS\Message\ResponseAbstract $response)
    {
        parent::__construct($app, $request, $response);
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getModule() : int
    {
        return $this->module;
    }

    /**
     * @param int $module
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setModule(int $module)
    {
        $this->module = $module;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPageId() : int
    {
        return $this->pageId;
    }

    /**
     * @param int $pageId
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPageId(int $pageId)
    {
        $this->pageId = $pageId;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}
