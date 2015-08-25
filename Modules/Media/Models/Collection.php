<?php
namespace Modules\Media\Models;

/**
 * Media class.
 *
 * PHP Version 7.0
 *
 * @category   Modules
 * @package    Modules\Media
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Collection
{
    /**
     * Database instance.
     *
     * @var \phpOMS\DataStorage\Database\Connection\ConnectionAbstract
     * @since 1.0.0
     */
    private $connection = null;

    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    private $name = '';

    /**
     * File size in bytes.
     *
     * @var int
     * @since 1.0.0
     */
    private $size = 0;

    /**
     * Author.
     *
     * @var int
     * @since 1.0.0
     */
    private $created_by = 0;

    /**
     * Uploaded.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $created_at = null;

    /**
     * Resource path.
     *
     * @var \Modules\Media\Models\Media[]
     * @since 1.0.0
     */
    private $sources = [];

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

    /**
     * Constructor.
     *
     * @param \phpOMS\DataStorage\Database\Connection\ConnectionAbstract $connection Database pool instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Init task.
     *
     * @param int $id Article ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function init($id)
    {
        $this->id = $id;
        $data     = null;

        switch ($this->dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $sth = $this->dbPool->get('core')->con->prepare('SELECT
                            `' . $this->dbPool->get('core')->prefix . 'media`.*
                        FROM
                            `' . $this->dbPool->get('core')->prefix . 'media`
                       WHERE `' . $this->dbPool->get('core')->prefix . 'media`.`media_id` = :id');

                $sth->bindValue(':id', $id, \PDO::PARAM_INT);
                $sth->execute();

                $data = $sth->fetchAll()[0];
                break;
        }

        $this->name       = $data['name'];
        $this->created_by = $data['creator'];
        $this->created_at = new \DateTime($data['created']);
        $this->size       = $data['size'];
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getAuthor()
    {
        return $this->created_by;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreated()
    {
        return $this->created_at;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getSize()
    {
        if ($this->size == 0) {
            $this->size = 0;
            foreach ($this->sources as $source) {
                $this->size += $source->getSize();
            }
        }

        return $this->size;
    }

    /**
     * {@inheritdoc}
     */
    public function insert()
    {
        $sth = $this->connection->con->prepare('INSERT INTO ' . $this->connection->prefix . 'media
        (media_name, media_file, media_extension, media_size, media_created_by, media_created_at)
        VALUES (:media_name, NULL, \'collection\', :media_size, :media_created_by, :media_created_at)');

        $sth->bindParam(':media_name', $this->name, \PDO::PARAM_STR);
        $sth->bindParam(':media_size', $this->size, \PDO::PARAM_INT);
        $sth->bindParam(':media_created_by', $this->created_by, \PDO::PARAM_INT);
        $sth->bindParam(':media_created_at', $this->created_at, \PDO::PARAM_INT);
        $sth->execute();
    }

    /**
     * @param \Modules\Media\Models\Media $source Media source
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addSource($source)
    {
        $this->size += $source->getSize();

        // Update file size
        $sth = $this->connection->con->prepare('UPDATE ' . $this->connection->prefix . 'media
        SET media_size = :media_size WHERE media_id = :media_id');

        $sth->bindParam(':media_id', $this->id, \PDO::PARAM_INT);
        $sth->bindParam(':media_size', $this->size, \PDO::PARAM_INT);
        $sth->execute();

        // Add reference
        $sth = $this->connection->con->prepare('INSERT INTO ' . $this->connection->prefix . 'media_reference
        (media_relation_src, media_relation_dest)
        VALUES (:media_relation_src, :media_relation_dest)');

        $sth->bindParam(':media_relation_src', $source->getId(), \PDO::PARAM_INT);
        $sth->bindParam(':media_relation_dest', $this->id, \PDO::PARAM_INT);
        $sth->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($data)
    {
    }
}
