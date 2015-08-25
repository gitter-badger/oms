<?php
namespace phpOMS\Message\Http;

/**
 * Response class.
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
class Response extends \phpOMS\Message\ResponseAbstract implements \phpOMS\Contract\RenderableInterface
{
    /**
     * Header.
     *
     * @var string[][]
     * @since 1.0.0
     */
    private $header = [];

    /**
     * html head.
     *
     * @var \phpOMS\Model\Html\Head
     * @since 1.0.0
     */
    private $head = null;

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        $this->setHeader('Content-Type', 'text/html; charset=utf-8');
        $this->head = new \phpOMS\Model\Html\Head();
    }

    /**
     * Push header by ID.
     *
     * @param mixed $name Header ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function pushHeaderId($name)
    {
        foreach ($this->header[$name] as $key => $value) {
            header($name, $value);
        }
    }

    /**
     * Remove header by ID.
     *
     * @param int $key Header key
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function removeHeader(int $key) : bool
    {
        if (isset($this->header[$key])) {
            unset($this->header[$key]);
        
            return true;
        }

        return false;
    }

    /**
     * Set response.
     *
     * @param string $response Response to set
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setResponse(string $response)
    {
        $this->response = $response;
    }

    /**
     * Push a specific response ID.
     *
     * @param int $id Response ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function pushResponseId(int $id)
    {
        ob_start();
        echo $this->response[$id];
        ob_end_flush();
    }

    /**
     * Generate response.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getYield() : \Iterator
    {
        yield $this->head->render();

        foreach ($this->response as $key => $response) {
            yield $response;
        }
    }

    /**
     * Push all headers.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function pushHeader()
    {
        foreach ($this->header as $name => $arr) {
            foreach ($arr as $ele => $value) {
                header($name . ': ' . $value);
            }
        }
    }

    /**
     * Remove response by ID.
     *
     * @param int $id Response ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function remove(int $id) : bool
    {
        if (isset($this->response[$id])) {
            unset($this->response[$id]);
        
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * {@inheritdoc}
     */
    public function getProtocolVersion() : string
    {
        return '1.0';
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders() : array
    {
        return $this->header;
    }

    /**
     * {@inheritdoc}
     */
    public function hasHeader(string $name) : bool
    {
        return array_key_exists($name, $this->header);
    }

    /**
     * {@inheritdoc}
     */
    public function getBody() : string
    {
        return $this->render();
    }

    /**
     * Generate response.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function render() : string
    {
        $render = $this->head->render();

        foreach ($this->response as $key => $response) {
            if (is_object($response)) {
                $render .= $response->render();
            } elseif (is_string($response)) {
                $render .= $response;
            }
        }

        return $render;
    }

    /**
     * {@inheritdoc}
     */
    public function toCSV() : string
    {
        return \phpOMS\Utils\ArrayUtils::arrayToCSV($this->toArray());
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        $arr = [];

        foreach ($this->response as $key => $response) {
            if ($response instanceof \phpOMS\Contract\ArrayableInterface) {
                $arr = \phpOMS\Utils\ArrayUtils::setArray($key, $arr, $response->toArray(), ':');
            } else {
                $arr = \phpOMS\Utils\ArrayUtils::setArray($key, $arr, $response, ':');
            }
        }

        return $arr;
    }

    /**
     * {@inheritdoc}
     */
    public function getReasonPhrase() : string
    {
        return $this->getHeader('Status');
    }

    /**
     * {@inheritdoc}
     */
    public function getHeader(string $name)
    {
        if (isset($this->header[$name])) {
            return $this->header[$name];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function setHeader($key, string $header, bool $overwrite = false) : bool
    {
        if (!$overwrite && isset($this->header[$key])) {
            return false;
        } elseif ($overwrite) {
            unset($this->header[$key]);
        }

        if (!isset($this->header[$key])) {
            $this->header[$key] = [];
        }

        $this->header[$key][] = $header;

        return true;
    }
}
