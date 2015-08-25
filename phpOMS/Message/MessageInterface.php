<?php
namespace phpOMS\Message;

/**
 * Message interface.
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
interface MessageInterface
{
    /**
     * Retrieves the HTTP protocol version as a string.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getProtocolVersion();

    /**
     * Retrieves all message header values.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getHeaders() : array;

    /**
     * Checks if a header exists by the given case-insensitive name.
     *
     * @param string $name Header name
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function hasHeader(string $name) : bool;

    /**
     * Retrieves a message header value by the given case-insensitive name.
     *
     * @param string $name Header name
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getHeader(string $name);

    /**
     * Add header by ID.
     *
     * @param mixed  $key       Header ID
     * @param string $header    Header string
     * @param bool   $overwrite Overwrite existing headers
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setHeader($key, string $header, bool $overwrite = true);

    /**
     * Gets the body of the message.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getBody() : string;

    /**
     * Set status code.
     *
     * @param int $status Status code
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setStatusCode(int $status);

    /**
     * Get status code.
     *
     * @return int Status code
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStatusCode() : int;

    /**
     * Get account id.
     *
     * @return int Account id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getAccount() : int;

    /**
     * Set account id.
     *
     * @param int $account Account id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setAccount(int $account);
}
