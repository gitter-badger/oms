<?php
namespace phpOMS\Message\Http;

/**
 * Request class.
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\Request
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Request extends \phpOMS\Message\RequestAbstract
{
    /**
     * Browser type.
     *
     * @var \phpOMS\Message\Http\BrowserType
     * @since 1.0.0
     */
    private $browser = null;

    /**
     * OS type.
     *
     * @var \phpOMS\Message\Http\OSType
     * @since 1.0.0
     */
    private $os = null;

    /**
     * Path.
     *
     * @var array
     * @since 1.0.0
     */
    protected $path = null;

    /**
     * Request information.
     *
     * @var string[]
     * @since 1.0.0
     */
    private $info = null;

    /**
     * Request hash.
     *
     * @var array
     * @since 1.0.0
     */
    private $hash = null;

    /**
     * Web request type.
     *
     * @var \phpOMS\Message\RequestDestination
     * @since 1.0.0
     */
    private $requestDestination = null;

    /**
     * Constructor.
     *
     * @param string $rootPath relative installation path
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct(string $rootPath)
    {
        $this->uri  = new \phpOMS\Uri\Http($rootPath);
        $this->l11n = new \phpOMS\Localization\Localization();
        \phpOMS\Uri\UriFactory::setQuery('/root', $rootPath);
    }

    /**
     * Init request.
     *
     * This is used in order to either initialize the current http request or a batch of GET requests
     *
     * @param string $uri URL
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function init(string $uri = null)
    {
        if ($uri === null) {
            $this->data = $_GET ?? [];

            if (isset($_SERVER['CONTENT_TYPE'])) {
                if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
                    $this->data += json_decode(file_get_contents('php://input'), true);
                } elseif ($_SERVER['CONTENT_TYPE'] === 'application/x-www-form-urlencoded') {
                    parse_str(file_get_contents('php://input'), $temp);
                    $this->data += $temp;
                }
            }

            $this->uri->set(\phpOMS\Uri\Http::getCurrent());
        } else {
            $this->setMethod($uri['type']); // TODO: is this correct?
            $this->uri->set($uri['uri']);
        }

        $this->path               = explode('/', $this->uri->getPath());
        $this->requestDestination = isset($this->path[1]) ? $this->path[1] : '';
        $this->l11n->setLanguage($this->path[0]);
        $this->hash = [];

        \phpOMS\Uri\UriFactory::setQuery('/scheme', $this->uri->getScheme());
        \phpOMS\Uri\UriFactory::setQuery('/host', $this->uri->getHost());
        \phpOMS\Uri\UriFactory::setQuery('/lang', $this->l11n->getLanguage());

        foreach ($this->path as $key => $path) {
            $paths = [];
            for ($i = 1; $i < $key + 1; $i++) {
                $paths[] = $this->path[$i];
            }

            $this->hash[] = $this->hashRequest($paths);
        }
    }

    /**
     * Set request type.
     *
     * @param \phpOMS\Message\RequestMethod $type Request type
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setMethod(\phpOMS\Message\RequestMethod $type)
    {
        $this->type = $type;
    }

    /**
     * Generate request hash.
     *
     * @param array $request Request array
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function hashRequest(array $request): string
    {
        return sha1(implode('', $request));
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestInfo() : array
    {
        if (!isset($this->info)) {
            $this->info['browser'] = $this->getBrowser();
            $this->info['os']      = $this->getOS();
        }

        return $this->info;
    }

    /**
     * Determine request browser.
     *
     * @return \phpOMS\Message\Http\BrowserType
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getBrowser() : \phpOMS\Message\Http\BrowserType
    {
        if (!isset($this->browser)) {
            $arr               = BrowserType::getConstants();
            $http_request_type = strtolower($_SERVER['HTTP_USER_AGENT']);
            foreach ($arr as $key => $val) {
                if (stripos($http_request_type, $val)) {
                    $this->browser = $val;
                    break;
                }
            }
        }

        return $this->browser;
    }

    /**
     * Determine request OS.
     *
     * @return \phpOMS\Message\Http\OSType
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getOS() : \phpOMS\Message\Http\OSType
    {
        if (!isset($this->os)) {
            $arr               = OSType::getConstants();
            $http_request_type = strtolower($_SERVER['HTTP_USER_AGENT']);
            foreach ($arr as $key => $val) {
                if (stripos($http_request_type, $val)) {
                    $this->os = $val;
                    break;
                }
            }
        }

        return $this->os;
    }

    /**
     * Get request hashes.
     *
     * @return array Request hashes
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getHash() : array
    {
        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrigin() : string
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Is request made via https.
     *
     * @param int $port Secure port
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function isHttps(int $port = 443) : bool
    {
        return
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
            || (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')
            || $_SERVER['SERVER_PORT'] == $port;
    }

    /**
     * Stringify request.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __toString()
    {
        $lastElement = end($this->hash);
        reset($this->hash);

        return $lastElement;
    }

    /**
     * Get request type.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getMethod() : string
    {
        if (!isset($this->type)) {
            $this->type = $_SERVER['REQUEST_METHOD'];
        }

        return $this->type;
    }

    /**
     * @return \phpOMS\Message\RequestDestination
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getRequestDestination() : string
    {
        return $this->requestDestination;
    }

    /**
     * @param \phpOMS\Message\RequestDestination $requestDestination
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setRequestDestination($requestDestination)
    {
        $this->requestDestination = $requestDestination;
    }

    /**
     * {@inheritdoc}
     */
    public function getProtocolVersion() : string
    {
        return $_SERVER['SERVER_PROTOCOL'];
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders() : array
    {
        return getallheaders();
    }

    /**
     * {@inheritdoc}
     */
    public function hasHeader(string $name) : bool
    {
        return array_key_exists($name, getallheaders());
    }

    /**
     * {@inheritdoc}
     */
    public function getHeader(string $name) : string
    {
        return getallheaders()[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function getBody() : string
    {
        return file_get_contents('php://input');
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestTarget() : string
    {
        return '/';
    }

    public function setHeader($key, string $header, bool $overwrite = true)
    {
        // NOT Required for Http request
    }

    public function getRoutify() : string
    {
        return $this->uri->__toString();
    }
}
