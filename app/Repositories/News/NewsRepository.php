<?php
namespace App\Repositories\News;

use App\Models\NewsPage;
use App\Models\Photo;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\DB;

class NewsRepository extends BaseRepository
{
    public $photo;

    public function __construct(NewsPage $news)
    {
        $this->news=$news;
    }
    public function getAllNews(){
        return DB::table('news_pages')->get();
    }


}
