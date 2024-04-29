<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\District;
use App\Models\Religion;
use App\Models\Caste;
use App\Models\Nationality;
use App\Models\CompanyType;
use App\Models\ResigningReason;
use App\Models\LocalOffice;
use App\Models\EsiDispensary;
use App\Models\PaymentMode;
use App\Models\RawMaterialType;
use App\Models\RawMaterial;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\OrderStatus;
class MasterSetting extends Controller
{
    public function setting()
    {

        $user_count = User::count();
        $country_count = Country::count();
        $state_count = State::count();
        $districts_count = District::count();
        $religion_count = Religion::count();
        $caste_count = Caste::count();
        $nationality_count = Nationality::count();
        $company_type_count = CompanyType::count();
        $resigning_reason_count = ResigningReason::count();
        $local_offices_count = LocalOffice::count();
        $esi_dispensary_count = EsiDispensary::count();
        $payment_mode_count = PaymentMode::count();
        $raw_material_type_count  = RawMaterialType::count();
        $raw_material_count  = RawMaterial::count();
        $product_count = Product::count();
        $product_size_count = ProductSize::count();
        $product_color_count = ProductColor::count();
        $order_status_count = OrderStatus::count();
        return view('settings.index',compact('user_count','country_count','state_count','districts_count','religion_count','caste_count','nationality_count','company_type_count','resigning_reason_count','local_offices_count','esi_dispensary_count','payment_mode_count','raw_material_type_count','raw_material_count','product_count','product_size_count','product_color_count','order_status_count'));
    }
}
