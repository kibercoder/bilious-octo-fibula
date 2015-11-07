<?php
namespace frontend\widgets;

use yii\data\Pagination;
use yii\widgets\LinkPager;


class PostLinkPager extends LinkPager
{
    public $pageUrl;

    protected function createPageUrl($page)
    {
        if ($page)
            return $this->pageUrl.$page+1;
        return '/';
    }

}