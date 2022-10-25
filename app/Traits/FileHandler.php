<?php


namespace App\Traits;


use Illuminate\Support\Facades\Storage;

trait FileHandler
{
    public function saveProductDetailsImages($images)
    {

        if (is_array($images)) {

            $image_names = [];
            foreach ($images as $image) {
                $image_name = uniqid() . '.png';
                $image->storeAs('imgs/product', $image_name, 's3');
                $image_names[] = "https://bennebos.s3.amazonaws.com/" . 'imgs/product/'.$image_name;
            }

            return  json_encode($image_names);
        }

        $image_name = uniqid() . '.png';
        $images->storeAs('imgs/product', $image_name, 's3');
        return "https://bennebos.s3.amazonaws.com/" . 'imgs/product/'.$image_name;
    }

    public function saveProductDetailsThumbnail($thumbnail):string
    {
        $image_path = "imgs/product/";
        $image_name = uniqid() . '.png';
        Storage::disk('s3')->put($image_path . $image_name, $thumbnail);
        return "https://bennebos.s3.amazonaws.com/" . 'imgs/product/'.$image_name;
    }

}
