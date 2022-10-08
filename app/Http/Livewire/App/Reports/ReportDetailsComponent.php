<?php

namespace App\Http\Livewire\App\Reports;

use App\Models\ReportMap;
use App\Models\ReportMapv2;
use App\Models\TradeProfile;
use App\Models\TradeProfileExportCategory;
use App\Models\TradeProfileExportCountry;
use App\Models\TradeProfileImportCategory;
use App\Models\TradeProfileImportCountry;
use App\Models\TradeProfileTradeDeficit;
use App\Models\TradeProfileTradeSurplus;
use Livewire\Component;

class ReportDetailsComponent extends Component
{
    public $country_id, $tradeProfile, $trade_surplus, $trade_deficit, $category_import, $category_export, $country_import, $country_export;

    public function mount($slug)
    {
        $country = ReportMapv2::where('slug', $slug)->first();
        $this->country_id = $country->id;

        $details = TradeProfile::where('country', $country->country)->first();

        if($details){
            $this->tradeProfile = $details;

            $this->trade_surplus = TradeProfileTradeSurplus::where('trade_profile_id', $details->id)->get();
            $this->trade_deficit = TradeProfileTradeDeficit::where('trade_profile_id', $details->id)->get();

            //Category
            $this->category_import = TradeProfileImportCategory::where('trade_profile_id', $details->id)->get();
            $this->category_export = TradeProfileExportCategory::where('trade_profile_id', $details->id)->get();

            //Category
            $this->country_import = TradeProfileImportCountry::where('trade_profile_id', $details->id)->get();
            $this->country_export = TradeProfileExportCountry::where('trade_profile_id', $details->id)->get();
        }
    }

    public function render()
    {
        $country = ReportMapv2::find($this->country_id);

        return view('livewire.app.reports.report-details-component', ['country'=>$country])->layout('livewire.layouts.base');
    }
}
