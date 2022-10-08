<?php

namespace App\Imports;

use App\Models\ReportExportCountry;
use App\Models\ReportImportCountry;
use App\Models\ReportMapv2;
use App\Models\TradeProfile;
use App\Models\TradeProfileExportCategory;
use App\Models\TradeProfileExportCountry;
use App\Models\TradeProfileImportCategory;
use App\Models\TradeProfileImportCountry;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TradeProfileImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $profile = new TradeProfile();
        $profile->report_map_id = 0;
        $profile->description_import = $row['import_description'];
        $profile->description_export = $row['export_description'];
        $profile->country = $row['country'];
        $profile->save();

        //Category Export
        if (json_decode(str_replace("'", '"', $row['export_categories'])) != null) {
            foreach (json_decode(str_replace("'", '"', $row['export_categories'])) as $expCat) {
                $catExp = new TradeProfileExportCategory();
                $catExp->trade_profile_id = $profile->id;
                $catExp->category = $expCat[0];
                $catExp->trade_percentage = $expCat[1];
                $catExp->save();
            }
        }

        //Category Import
        if (json_decode(str_replace("'", '"', $row['import_categories'])) != null) {
            foreach (json_decode(str_replace("'", '"', $row['import_categories'])) as $impCat) {
                $catIMP = new TradeProfileImportCategory();
                $catIMP->trade_profile_id = $profile->id;
                $catIMP->category = $impCat[0];
                $catIMP->trade_percentage = $impCat[1];
                $catIMP->save();
            }
        }

        //Country Import
        if (json_decode(str_replace("'", '"', $row['import_countries'])) != null) {
            foreach (json_decode(str_replace("'", '"', $row['import_countries'])) as $impCoun) {
                $counIMP = new TradeProfileImportCountry();
                $counIMP->trade_profile_id = $profile->id;
                $counIMP->country = $impCoun[0];
                $counIMP->trade_percentage = $impCoun[1];
                $counIMP->save();

                $counIMP = new ReportImportCountry();
                $counIMP->report_map_id = ReportMapv2::where('country', $row['country'])->first()->id;
                $counIMP->country = $impCoun[0];
                $counIMP->trade_value = str_replace('%','',$impCoun[1])*10;
                $counIMP->save();
            }
        }

        //Country Export
        if (json_decode(str_replace("'", '"', $row['export_countries'])) != null) {
            foreach (json_decode(str_replace("'", '"', $row['export_countries'])) as $expCoun) {
                $counExp = new TradeProfileExportCountry();
                $counExp->trade_profile_id = $profile->id;
                $counExp->country = $expCoun[0];
                $counExp->trade_percentage = $expCoun[1];
                $counExp->save();

                $counIMP = new ReportExportCountry();
                $counIMP->report_map_id = ReportMapv2::where('country', $row['country'])->first()->id;
                $counIMP->country = $expCoun[0];
                $counIMP->trade_value = str_replace('%','',$expCoun[1])*10;
                $counIMP->save();
            }
        }
    }
}
