<?php
namespace App\Repositories\News;

use App\Models\NewsLetter;
use App\Models\NewsPage;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\DB;

class NewsLetterRepository extends BaseRepository
{
    public $photo;

    public function __construct(NewsLetter $newsLetter)
    {
        $this->newsLetter=$newsLetter;
    }
    public function postNewsLetter($newsLetterRequest){

        $newsLetter=NewsLetter::create([

            'email'=>$newsLetterRequest->email,
        ]);

        return $newsLetter;
    }


}
