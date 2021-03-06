<?php
namespace Modules\News;

/**
 * News controller class.
 *
 * PHP Version 7.0
 *
 * @category   Modules
 * @package    Modules\News
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Controller extends \phpOMS\Module\ModuleAbstract implements \phpOMS\Module\WebInterface
{
    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $module = 'News';

    /**
     * Localization files.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $localization = [
        \phpOMS\Message\RequestDestination::BACKEND => ['backend'],
    ];

    /**
     * Providing.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $providing = [
        'Content',
    ];

    /**
     * Dependencies.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $dependencies = [
    ];

    /**
     * Constructor.
     *
     * @param \phpOMS\ApplicationAbstract $app Application reference
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     * {@inheritdoc}
     */
    public function call(\phpOMS\Message\RequestAbstract $request, \phpOMS\Message\ResponseAbstract $response, $data = null)
    {
        switch ($request->getRequestDestination()) {
            case \phpOMS\Message\RequestDestination::BACKEND:
                $this->showContentBackend($request, $response);
                break;
            case \phpOMS\Message\RequestDestination::API:
                $this->showAPI($request, $response);
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows module content.
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackend(\phpOMS\Message\RequestAbstract  $request, \phpOMS\Message\ResponseAbstract $response)
    {
        switch ($request->getPath(3)) {
            case 'dashboard':
                $newsDashboard = new \phpOMS\Views\View($this->app, $request, $response);
                $newsDashboard->setTemplate('/Modules/News/Theme/Backend/news-dashboard');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $newsDashboard->addData('nav', $navigation->getNav());
            
                $news = $this->getNewsListR($limit = 20, $offset = 0, $orderBy = 'news_publish', $ordered = 'DESC', $this->app->accountManager->get($request->getAccount()));
                $headline = $this->getHeadlineListR($limit = 20, $offset = 0, $orderBy = 'news_publish', $ordered = 'ASC', $this->app->accountManager->get($request->getAccount()));
                $newsDashboard->addData('newsList', $news);
                $newsDashboard->addData('headlineList', $headline);

                echo $newsDashboard->render();
                break;
            case 'single':
                $newsArticleView = new \phpOMS\Views\View($this->app, $request, $response);
                $newsArticleView->setTemplate('/Modules/News/Theme/Backend/news-single');

                $newsArticleMapper = new \Modules\News\Models\NewsArticleMapper($this->app->dbPool->get());
                $article = $newsArticleMapper->get((int) $request->getData('id'));
                $newsArticleView->addData('newsList', $article);

                echo $newsArticleView->render();
                break;
            case 'archive':
                $newArchive = new \phpOMS\Views\View($this->app, $request, $response);
                $newArchive->setTemplate('/Modules/News/Theme/Backend/news-archive');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $newArchive->addData('nav', $navigation->getNav());
                echo $newArchive->render();
                break;
            case 'create':
                $newsCreate = new \phpOMS\Views\View($this->app, $request, $response);
                $newsCreate->setTemplate('/Modules/News/Theme/Backend/news-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $newsCreate->addData('nav', $navigation->getNav());
                echo $newsCreate->render();
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows module content.
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showAPI(\phpOMS\Message\RequestAbstract  $request, \phpOMS\Message\ResponseAbstract $response)
    {
        switch ($request->getMethod()) {
            case \phpOMS\Message\RequestMethod::POST:
                $articleId = $this->createNews(
                    1, 
                    new \DateTime('NOW'),
                    new \DateTime('NOW'),
                    $request->getData('title'),
                    $request->getData('plain'),
                    '',
                    $request->getData('language') ?? $request->getL11n()->getLanguage(),
                    (int) $request->getData('type'),
                    (int) $request->getData('status'),
                    (bool) $request->getData('featured')
                );

                $notify = new \Model\Message\Notify();
                $notify->setMessage((string) $articleId);
                $response->set($request->__toString(), $notify);
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                $response->setHeader('Status', 'Status:406 Not acceptable');

                return;
        }
    }

    /**
     * Creating news.
     *
     * @param array $articleElements Article elements
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function createNews(...$articleElements) 
    {
        $newsArticle = new \Modules\News\Models\NewsArticle();
        $newsArticle->setAuthor($articleElements[0]);
        $newsArticle->setCreated($articleElements[1]);
        $newsArticle->setPublish($articleElements[2]);
        $newsArticle->setTitle($articleElements[3]);
        $newsArticle->setPlain($articleElements[4]);
        $newsArticle->setContent($articleElements[5]);
        $newsArticle->setLang($articleElements[6]);
        $newsArticle->setType($articleElements[7]);
        $newsArticle->setStatus($articleElements[8]);
        $newsArticle->setFeatured($articleElements[9]);

        $newsArticleMapper = new \Modules\News\Models\NewsArticleMapper($this->app->dbPool->get());
        return $newsArticleMapper->create($newsArticle);
    }

    /**
     * Get Newslists
     *
     * @param array $articleElements Article elements
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getNewsListR(int $limit = 50, int $offset = 0, string $orderBy = 'news_created', string $ordered = 'ASC', \phpOMS\Account\Account $account = null) 
    {
        $newsArticleMapper = new \Modules\News\Models\NewsArticleMapper($this->app->dbPool->get());
        $query = $newsArticleMapper->find('news.news_id', 'news.news_author', 'news.news_publish', 'news.news_title')
            ->where('news.news_type', '=', 1)
            ->where('news.news_status', '=', 1)
            ->orderBy($orderBy, $ordered)
            ->offset($offset)
            ->limit($limit);

        if(isset($account)) {
            $query->where('account_permission.account_permission_account', '=', $account->getId());
        }

        return $newsArticleMapper->populateIterable($newsArticleMapper->list($query));
    }

    /**
     * Get Headlinelist
     *
     * @param array $articleElements Article elements
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getHeadlineListR(int $limit = 50, int $offset = 0, string $orderBy = 'news_created', string $ordered = 'ASC', \phpOMS\Account\Account $account = null) 
    {
        $newsArticleMapper = new \Modules\News\Models\NewsArticleMapper($this->app->dbPool->get());
        $query = $newsArticleMapper->find('news.news_id', 'news.news_author', 'news.news_publish', 'news.news_title')
            ->where('news.news_type', '=', 0)
            ->where('news.news_status', '=', 1)
            ->orderBy($orderBy, $ordered)
            ->offset($offset)
            ->limit($limit);

        if(isset($account)) {
            $query->where('account_permission.account_permission_account', '=', $account->getId());
        }

        return $newsArticleMapper->populateIterable($newsArticleMapper->list($query));
    }
}
