<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function parentCategories():Collection{
        return $this->model->where('parent_id',"0")->get();
    }
    public function subCategories($category_id, $limit){
        $subCategories = Category::where("parent_id", $category_id)->where('sub_parent_id',0)->paginate($limit);
        return $subCategories;
    }
    public function subSubCategories($category_id, $limit){
        $subSubCategories = Category::where('sub_parent_id',$category_id)->paginate($limit);
        return $subSubCategories;
    }
}
