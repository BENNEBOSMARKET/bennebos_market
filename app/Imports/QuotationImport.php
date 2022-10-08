<?php

namespace App\Imports;

use App\Models\Qutotation;
use App\Models\QutotationCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class QuotationImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $getCategory = QutotationCategory::where('name', $row['main_category_titels'])->first();

        if($getCategory != ''){
            $category_id = $getCategory->id;
        }
        else{
            $category = new QutotationCategory();
            $category->name = $row['main_category_titels'];
            $category->slug = Str::slug($row['main_category_titels']).'-'.Str::lower(Str::random(5));
            $category->save();

            $category_id = $category->id;
        }

        $repitation = '';
        $days = '';
        $duration = '';
        if(json_decode($row['repeatation']) != null){
            $repitation = json_decode($row['repeatation'])[0];
            $days = json_decode($row['repeatation'])[1];
            $duration = json_decode($row['repeatation'])[2];
        }

        $arraySType = array('Customized Product','Non-customized Product','Total Solution','Business Service','Other');
        $sourcingtype = '';
        if($row['sourcing_type'] != null){
            $stype = $row['sourcing_type'];
        }
        else{
            $stype = array_rand($arraySType, 1);
        }
        $sourcingtype = $arraySType[$stype];

        $quantity = '';
        if($row['quantity'] != null){
            $quantity = $row['quantity'];
        }
        else{
            $quantity = rand(5,20);
        }

        $quantitytype = '';
        if($row['quantity_type'] != null){
            $quantitytype = $row['quantity_type'];
        }
        else{
            $quantitytype = 'Piece';
        }

        $quotation = new Qutotation();
        $quotation->user_id = rand(1,50);
        $quotation->category_id = $category_id;
        $quotation->name = $row['product_name'];
        $quotation->slug = Str::slug($row['product_name']).'-'.Str::lower(Str::random(5));
        $quotation->sourcing = $sourcingtype;
        // $quotation->sourcing_type = $sourcingtype;
        $quotation->quantity = $quantity;
        $quotation->piece = $quantitytype;
        // $quotation->trade_terms = $row['quantity'];
        $quotation->max_budget = $quantity>10?'1000-5000':'<1000';
        $quotation->curency = 'TRY';
        // $quotation->repitation = $repitation;
        // $quotation->days = $days;
        // $quotation->duration = $duration;
        $quotation->details = $row['descriptions'];
        // $quotation->image = $row['attachment_file'];
        // $quotation->shipping_method = $row['shipping_method'];
        $quotation->country = $row['citys'];
        // $quotation->lead_time = $row['lead_time'];
        // $quotation->payment_method = $row['payment_method'];
        $quotation->created_at = $row['dates'];
        $quotation->status = 1;
        $quotation->save();

        //Quotation updated
    }
}
