<?php
namespace Modules\News\Models;

/**
 * News article class.
 *
 * PHP Version 7.0
 *
 * @category   Module
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class NewsArticle
{

    /**
     * Article ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Author ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $author = 0;

    /**
     * Title.
     *
     * @var string
     * @since 1.0.0
     */
    private $title = '';

    /**
     * Content.
     *
     * @var string
     * @since 1.0.0
     */
    private $content = '';

    /**
     * Plain.
     *
     * @var string
     * @since 1.0.0
     */
    private $plain = '';

    /**
     * News type.
     *
     * @var int
     * @since 1.0.0
     */
    private $type = \Modules\News\Models\NewsType::ARTICLE;

    /**
     * News status
     *
     * @var int
     * @since 1.0.0
     */
    private $status = \Modules\News\Models\NewsStatus::VISIBLE;

    /**
     * Language.
     *
     * @var string
     * @since 1.0.0
     */
    private $lang = \phpOMS\Localization\ISO639Enum::_EN;

    /**
     * Created
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $created = null;

    /**
     * Publish
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $publish = null;

    /**
     * Featured
     *
     * @var bool
     * @since 1.0.0
     */
    private $featured = false;

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        $this->created = new \DateTime('NOW');
        $this->publish = new \DateTime('NOW');
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getAuthor() : int
    {
        return $this->author;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreated() : \DateTime
    {
        return $this->created;
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
     * @param int $id Id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLanguage() : string
    {
        return $this->lang;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPlain() : string
    {
        return $this->plain;
    }

    /**
     * @param string $plain
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPlain(string $plain)
    {
        $this->plain = $plain;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPublish() : \DateTime
    {
        return $this->publish;
    }

    /**
     * @param string $lang
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLang(string $lang)
    {
        $this->lang = $lang;
    }

    /**
     * @param \DateTime $publish
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPublish(\DateTime $publish)
    {
        $this->publish = $publish;
    }

    /**
     * @param \DateTime $created
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @param int $author
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setAuthor(int $author)
    {
        $this->author = $author;
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
     * @return mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * @param int $type
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setType(int $type)
    {
        $this->type = $type;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function isFeatured() : bool
    {
        return $this->featured;
    }

    /**
     * @param bool $featured
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFeatured(bool $featured)
    {
        $this->featured = $featured;
    }
}
