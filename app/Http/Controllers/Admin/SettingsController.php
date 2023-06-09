<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use DB;

class SettingsController extends Controller
{
    public function editShippingMethods($type)
    {

        //free , inner , outer for shipping methods

    if ($type === 'free')
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();


        elseif ($type === 'inner')
            $shippingMethod = Setting::where('key', 'local_label')->first();

        elseif ($type === 'outer')
            $shippingMethod = Setting::where('key', 'outer_label')->first();
        else
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();


        return view('dashboard.settings.shippings.edit', compact('shippingMethod'));

    }



    public function updateShippingMethods(ShippingsRequest $request, $id)
    {

        //validation

        //update db

        try {
            $shipping_method = Setting::find($id);

            DB::beginTransaction();
            $shipping_method->update(['plain_value' => $request->plain_value]);
            //save translations
            $shipping_method->value = $request->value;  // 'text',  I changed it to be disable 
            $shipping_method->save();

            DB::commit();
            return redirect()->back()->with(['success' => trans('admin/settings/shippings.success')]);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => trans('admin/settings/shippings.error')]);
            DB::rollback();
        }

    }

}