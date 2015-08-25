<?php
namespace phpOMS\Auth;

/**
 * Auth class.
 *
 * Responsible for authenticating and initializing the connection
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
class Auth implements \phpOMS\Config\OptionsInterface
{
    use \phpOMS\Config\OptionsTrait;

    /**
     * Session instance.
     *
     * @var \phpOMS\DataStorage\Session\SessionInterface
     * @since 1.0.0
     */
    private $session = null;

    /**
     * Database connection instance.
     *
     * @var \phpOMS\DataStorage\Database\Connection\ConnectionAbstract
     * @since 1.0.0
     */
    private $connection = null;

    /**
     * Constructor.
     *
     * @param \phpOMS\DataStorage\Database\Connection\ConnectionAbstract $connection Database connection
     * @param \phpOMS\DataStorage\Session\SessionInterface               $session    Session
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct(\phpOMS\DataStorage\Database\Connection\ConnectionAbstract $connection, \phpOMS\DataStorage\Session\SessionInterface $session)
    {
        $this->connection = $connection;
        $this->session    = $session;
    }

    /**
     * Authenticates user.
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function authenticate() : bool
    {
        $uid = $this->session->get('UID');

        if ($uid === null) {
            $uid = false;
        }

        return $uid;
    }

    /**
     * Login user.
     *
     * @param string $login    Username
     * @param string $password Password
     *
     * @return int Login code
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function login(string $login, string $password) : int
    {
        try {
            $result = null;

            switch ($this->connection->getType()) {
                case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:

                    $sth = $this->connection->con->prepare(
                        'SELECT
                            `' . $this->connection->prefix . 'account_data`.*,
                            `' . $this->connection->prefix . 'account`.*
                        FROM
                            `' . $this->connection->prefix . 'account_data`
                        LEFT JOIN
                            `' . $this->connection->prefix . 'account`
                        ON
                            `account_data_account` = `account_id`
                        WHERE
                            `account_data_login` = :login'
                    );
                    $sth->bindValue(':login', $login, \PDO::PARAM_STR);
                    $sth->execute();

                    $result = $sth->fetchAll();
                    break;
            }

            // TODO: check if user is allowed to login on THIS page (backend|frontend|etc...)

            if (!isset($result[0])) {
                return \phpOMS\Auth\LoginReturnType::WRONG_USERNAME;
            }

            $result = $result[0];

            if ($result['account_data_tries'] <= 0) {
                return \phpOMS\Auth\LoginReturnType::WRONG_INPUT_EXCEEDED;
            }

            if (password_verify($password, $result['account_data_password'])) {
                $this->session->set('UID', $result['account_id']);
                $this->session->save();

                return \phpOMS\Auth\LoginReturnType::OK;
            }

            return \phpOMS\Auth\LoginReturnType::WRONG_PASSWORD;
        } catch (\Exception $e) {
            return \phpOMS\Auth\LoginReturnType::FAILURE;
        }
    }

    /**
     * Logout the given user.
     *
     * @param int $uid User ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function logout(int $uid)
    {
        // TODO: logout other users? If admin wants to kick a user for updates etc.
        $this->session->remove('UID');
    }
}
