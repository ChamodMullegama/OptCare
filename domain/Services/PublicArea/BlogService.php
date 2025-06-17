<?php

namespace domain\Services\PublicArea;

use domain\Facades\AdminArea\BlogFacade as AdminBlogFacade;

class BlogService
{
    public function getLatestBlogs($limit = 3)
    {
        return AdminBlogFacade::allForPublic()->take($limit);
    }
}
