<?php
namespace App\Repositories\Job;


use App\Models\Career;
use App\Models\MiddleBanner;
use App\Models\Photo;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\DB;


class JobRepository extends BaseRepository
{
    public $photo;

    public function __construct(Career $career)
    {
        $this->career=$career;
    }


    public function getJobList(){
        return DB::table('careers')->get();
    }


}
