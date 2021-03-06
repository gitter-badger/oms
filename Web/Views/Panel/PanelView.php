<?php
namespace Web\Views\Panel;

/**
 * Form view.
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
class PanelView extends \Web\Views\WebViewAbstract
{
    /**
     * {@inheritdoc}
     */
    public function __construct(\phpOMS\ApplicationAbstract $app, \phpOMS\Message\RequestAbstract $request, \phpOMS\Message\ResponseAbstract $response)
    {
        parent::__construct($app, $request, $response);
    }
}
