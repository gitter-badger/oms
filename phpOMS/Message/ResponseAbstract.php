<?php
namespace phpOMS\Message;

/**
 * Response abstract class.
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\Response
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class ResponseAbstract implements \phpOMS\Message\ResponseInterface, \phpOMS\Contract\ArrayableInterface, \phpOMS\Contract\JsonableInterface
{
    /**
     * Localization.
     *
     * @var \phpOMS\Localization\Localization
     * @since 1.0.0
     */
    protected $l11n = null;

    /**
     * Responses.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected $response = [];

    /**
     * Response status.
     *
     * @var int
     * @since 1.0.0
     */
    protected $status = 200;

    /**
     * Account.
     *
     * @var int
     * @since 1.0.0
     */
    protected $account = null;

    /**
     * {@inheritdoc}
     */
    abstract public function setHeader($key, string $header, bool $overwrite = true);

    /**
     * {@inheritdoc}
     */
    public function getL11n() : \phpOMS\Localization\Localization
    {
        return $this->l11n;
    }

    /**
     * {@inheritdoc}
     */
    public function setL11n(\phpOMS\Localization\Localization $l11n)
    {
        return $this->l11n = $l11n;
    }

    /**
     * Get response by ID.
     *
     * @param mixed $id Response ID
     *
     * @return mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function &get($id)
    {
        return $this->response[$id];
    }

    /**
     * Add response.
     *
     * @param mixed $key       Response id
     * @param mixed $response  Response to add
     * @param bool  $overwrite Overwrite
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function set($key, $response, bool $overwrite = true) 
    {
        $this->response = \phpOMS\Utils\ArrayUtils::setArray($key, $this->response, $response, ':', $overwrite);
    }

    /**
     * {@inheritdoc}
     */
    public function setStatusCode(int $status)
    {
        $this->status = $status;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusCode() : int
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function getAccount() : int
    {
        return $this->account;
    }

    /**
     * {@inheritdoc}
     */
    public function setAccount(int $account)
    {
        $this->account = $account;
    }

    /**
     * {@inheritdoc}
     */
    public function toJson(int $options = 0) : string
    {
        return json_encode($this->toArray());
    }
}
