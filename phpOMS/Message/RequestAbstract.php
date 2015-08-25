<?php
namespace phpOMS\Message;

/**
 * Request class.
 *
 * PHP Version 7.0
 *
 * @property mixed request
 *
 * @category   Request
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class RequestAbstract implements RequestInterface
{
    /**
     * Uri.
     *
     * @var \phpOMS\Uri\UriInterface
     * @since 1.0.0
     */
    protected $uri = null;

    /**
     * Request type.
     *
     * @var \phpOMS\Message\RequestMethod
     * @since 1.0.0
     */
    protected $type = null;

    /**
     * Request data.
     *
     * @var array
     * @since 1.0.0
     */
    protected $data = null;

    /**
     * Request data.
     *
     * @var array
     * @since 1.0.0
     */
    protected $path = [];

    /**
     * Language.
     *
     * @var \phpOMS\Localization\Localization
     * @since 1.0.0
     */
    protected $l11n = null;

    /**
     * Account.
     *
     * @var int
     * @since 1.0.0
     */
    protected $account = null;

    /**
     * Request type.
     *
     * @var \phpOMS\Message\RequestSource
     * @since 1.0.0
     */
    private static $source = null;

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getUri() : \phpOMS\Uri\UriInterface
    {
        return $this->uri;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestSource()
    {
        return self::$source;
    }

    /**
     * {@inheritdoc}
     */
    public function setRequestSource($source)
    {
        self::$source = $source;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getMethod() : string;

    /**
     * {@inheritdoc}
     */
    public function getPath($key = null)
    {
        if ($key === null) {
            return $this->path;
        }

        return $this->path[$key] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function getData($key = null)
    {
        if ($key === null) {
            return $this->data;
        }

        return $this->data[$key] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function setData($key, $value, $overwrite = true)
    {
        if ($overwrite || !isset($this->data[$key])) {
            $this->data[$key] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setLocalization(\phpOMS\Localization\Localizatio $l11n)
    {
        return $this->l11n = $l11n;
    }

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
}
