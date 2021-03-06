<?php
namespace Modules\News\Models;

class NewsArticleMapper extends \phpOMS\DataStorage\Database\DataMapperAbstract
{
    /**
     * Columns
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected $columns = [
        'news_id' => ['name' => 'news_id', 'type' => 'string', 'internal' => 'id'],
        'news_author' => ['name' => 'news_author', 'type' => 'string', 'internal' => 'author'],
        'news_publish' => ['name' => 'news_publish', 'type' => 'DateTime', 'internal' => 'publish'],
        'news_title' => ['name' => 'news_title', 'type' => 'string', 'internal' => 'title'],
        'news_plain' => ['name' => 'news_plain', 'type' => 'string', 'internal' => 'plain'],
        'news_content' => ['name' => 'news_content', 'type' => 'string', 'internal' => 'content'],
        'news_status' => ['name' => 'news_status', 'type' => 'int', 'internal' => 'status'],
        'news_type' => ['name' => 'news_type', 'type' => 'int', 'internal' => 'type'],
        'news_featured' => ['name' => 'news_featured', 'type' => 'bool', 'internal' => 'featured'],
        'news_created' => ['name' => 'news_created', 'type' => 'DateTime', 'internal' => 'created'],
    ];

    /**
     * Primary table
     *
     * @var string
     * @since 1.0.0
     */
    protected $table = 'news';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected $primaryField = 'id';

    /**
     * Constructor.
     *
     * @param \phpOMS\DataStorage\Database\Connection\ConnectionAbstract $con Database connection
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct(\phpOMS\DataStorage\Database\Connection\ConnectionAbstract $con)
    {
        $this->db = $con;
    }

    /**
     * Create article
     *
     * @param \Modules\News\Models\NewsArticle $article News article
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function create(\Modules\News\Models\NewsArticle $article)
    {
        try {
            $query = new \phpOMS\DataStorage\Database\Query\Builder($this->db);
            $query->prefix($this->db->getPrefix())
                ->insert(
                    'news_author', 
                    'news_title', 
                    'news_plain', 
                    'news_content', 
                    'news_type', 
                    'news_status', 
                    'news_featured', 
                    'news_lang', 
                    'news_created', 
                    'news_publish'
                )
                ->into($this->table)
                ->values(
                    $article->getAuthor() ?? '', 
                    $article->getTitle() ?? '', 
                    $article->getPlain() ?? '', 
                    $article->getContent() ?? '',
                    $article->getType() ?? 0, 
                    $article->getStatus() ?? 0, 
                    $article->isFeatured() ?? false, 
                    $article->getLanguage() ?? 'en', 
                    $article->getCreated() ?? \DateTime('NOW'), 
                    $article->getPublish() ?? \DateTime('NOW')
                );

            $this->db->con->prepare($query->toSql())->execute();
            $articleId = $this->db->con->lastInsertId();

            $query = new \phpOMS\DataStorage\Database\Query\Builder($this->db);
            $query->prefix($this->db->getPrefix())
                ->insert(
                    'account_permission_account', 
                    'account_permission_from', 
                    'account_permission_for', 
                    'account_permission_id1', 
                    'account_permission_id2', 
                    'account_permission_r', 
                    'account_permission_w', 
                    'account_permission_m', 
                    'account_permission_d', 
                    'account_permission_p'
                )
                ->into('account_permission')
                ->values($article->getAuthor(), 'news', 'news', 1, $articleId, 1, 1, 1, 1, 1);

            $this->db->con->prepare($query->toSql())->execute();
        } catch(\Exception $e) {
            return false;
        }

        return $articleId;
    }

    /**
     * Populate.
     *
     * @param array $result Query result set
     *
     * @return \Modules\News\Models\NewsArticle
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function populate(array $result) : \Modules\News\Models\NewsArticle
    {
        $article = new \Modules\News\Models\NewsArticle();

        foreach($result as $column => $value) {
            if($this->columns[$column]['type'] === 'string' || $this->columns[$column]['type'] === 'int' || $this->columns[$column]['type'] === 'float') {
                $article->{'set' . ucfirst($this->columns[$column]['internal'])}($value);
            } elseif($this->columns[$column]['type'] === 'DateTime') {
                $article->{'set' . ucfirst($this->columns[$column]['internal'])}(new \DateTime($value));
            } else {
                throw new \Exception();
            }
        }

        return $article;
    }

    /**
     * Populate.
     *
     * @param array $result Query result set
     *
     * @return \Modules\News\Models\NewsArticle[]
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function populateIterable(array $data) : array
    {
        $articles = [];

        foreach($data as $element) {
            if(isset($element['news_id'])) {
                $articles[$element['news_id']] = $this->populate($element);
            } else {
                $articles[] = $this->populate($element);
            }
        }

        return $articles;
    }

    /**
     * Find.
     *
     * @param array $columns Columns to select
     *
     * @return \phpOMS\DataStorage\Database\Query\Builder
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function find(...$columns) : \phpOMS\DataStorage\Database\Query\Builder
    {
        return parent::find(...$columns)->from('account_permission')
            ->where('account_permission.account_permission_for', '=', 'news')
            ->where('account_permission.account_permission_id1', '=', 1)
            ->where('news.news_id', '=', new \phpOMS\DataStorage\Database\Query\Column('account_permission.account_permission_id2'))
            ->where('account_permission.account_permission_r', '=', 1);
    }
}
