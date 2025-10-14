<?php

namespace Modules\Service\Http\Controllers\Web\Provider\EmployeeManagement;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\Service\Entities\EmployeeManagement\ProviderRole;

class CustomRoleController extends Controller
{
    public function create(Request $request)
    {
        $key = explode(' ', $request['search']);
        $rl = ProviderRole::where('provider_id',Helpers::get_provider_id())->orderBy('name')
            ->when( isset($key) , function($query) use($key){
                $query->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%");
                    }
                 });
                }
            )
            ->paginate(config('default_pagination'));
        return view('service::provider.employee-management.custom-role.create',compact('rl'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'modules'=>'required|array|min:1',
            'name' => [
                'required',Rule::unique('provider_roles')->where(function($query) {
                  $query->where('provider_id', Helpers::get_provider_id());
              })
            ],
            'name.0' => 'required',
        ],[
            'name.required'=>translate('messages.Role name is required!'),
            'modules.required'=>translate('messages.Please select atleast one module'),
            'name.0.required'=>translate('default_name_is_required'),
        ]);
        $role = new ProviderRole();
        $role->name=$request->name[array_search('default', $request->lang)];
        $role->modules=json_encode($request['modules']);
        $role->status=1;
        $role->provider_id=Helpers::get_provider_id();
        $role->save();

        $data = [];
        $default_lang = str_replace('_', '-', app()->getLocale());
        foreach ($request->lang as $index => $key) {
            if($default_lang == $key && !($request->name[$index])){
                if ($key != 'default') {
                    array_push($data, array(
                        'translationable_type' => 'Modules\Service\Entities\EmployeeManagement\ProviderRole',
                        'translationable_id' => $role->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $role->name,
                    ));
                }
            }else{
                if ($request->name[$index] && $key != 'default') {
                    array_push($data, array(
                        'translationable_type' => 'Modules\Service\Entities\EmployeeManagement\ProviderRole',
                        'translationable_id' => $role->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
            }
        }

        Translation::insert($data);


        Toastr::success(translate('messages.role_added_successfully'));
        return back();
    }

    public function edit($id)
    {
        $role = ProviderRole::withoutGlobalScope('translate')->where('provider_id',Helpers::get_provider_id())->where(['id'=>$id])->first(['id','name','modules']);
        return view('service::provider.employee-management.custom-role.edit',compact('role'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'modules'=>'required|array|min:1',
            'name' => [
                'required',Rule::unique('provider_roles')->where(function($query)use($id) {
                  $query->where('provider_id', Helpers::get_provider_id())->where('id','<>', $id);
              })
            ],
            'name.0' => 'required',
        ],[
            'name.required'=>translate('messages.Role name is required!'),
            'name.unique'=>translate('messages.Role name already taken!'),
            'modules.required'=>translate('messages.Please select atleast one module'),
            'name.0.required'=>translate('default_name_is_required'),
        ]);

        $role = ProviderRole::where('provider_id',Helpers::get_provider_id())->where(['id'=>$id])->first();
        $role->name = $request->name[array_search('default', $request->lang)];
        $role->modules = json_encode($request['modules']);
        $role->status = 1;
        $role->provider_id = Helpers::get_provider_id();
        $role->save();

        $default_lang = str_replace('_', '-', app()->getLocale());
        foreach ($request->lang as $index => $key) {
            if($default_lang == $key && !($request->name[$index])){
                if ($key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'Modules\Service\Entities\EmployeeManagement\ProviderRole',
                            'translationable_id' => $role->id,
                            'locale' => $key,
                            'key' => 'name'
                        ],
                        ['value' => $role->name]
                    );
                }
            }else{

                if ($request->name[$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'Modules\Service\Entities\EmployeeManagement\ProviderRole',
                            'translationable_id' => $role->id,
                            'locale' => $key,
                            'key' => 'name'
                        ],
                        ['value' => $request->name[$index]]
                    );
                }
            }
        }


        Toastr::success(translate('messages.role_updated_successfully'));
        return redirect()->back();
    }

    public function distroy($id)
    {
        $role=ProviderRole::where('provider_id',Helpers::get_provider_id())->where(['id'=>$id])->delete();
        Toastr::success(translate('messages.role_deleted_successfully'));
        return back();
    }
}
