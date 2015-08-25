<?php
namespace Web\Views\Lists;

/**
 * Pagination view.
 *
 * PHP Version 7.0
 *
 * @category   Theme
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class PaginationView extends \phpOMS\Views\View
{
    /**
     * Maximum amount of pages.
     *
     * @var int
     * @since 1.0.0
     */
    protected $maxPages = 7;

    /**
     * Current page id.
     *
     * @var int
     * @since 1.0.0
     */
    protected $page = 50;

    /**
     * How many pages exists?
     *
     * @var int
     * @since 1.0.0
     */
    protected $pages = 100;

    /**
     * How many results exists?
     *
     * @var int
     * @since 1.0.0
     */
    protected $results = 0;

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getMaxPages() : int
    {
        return $this->maxPages;
    }

    /**
     * @param int $maxPages
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setMaxPages(int $maxPages)
    {
        $this->maxPages = $maxPages;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPages() : int
    {
        return $this->pages;
    }

    /**
     * @param int $pages
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPages(int $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPage() : int
    {
        return $this->page;
    }

    /**
     * @param int $page
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPage(int $page = 1) 
    {
        $this->page = $page;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getResults() : int
    {
        return $this->results;
    }

    /**
     * @param int $results
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setResults(int $results = 0)
    {
        $this->results = $results;
    }
}
