<div class="table-responsive">
    <table id="example" class="table m-0 align-middle table-custom-space tr-hover">
        <thead class="text-nowrap bg-light">
            <tr>
                <th class="fz--14px text-title border-0">{{ translate('SL') }}</th>
                <th class="fz--14px text-title border-0">{{ translate('Category name') }}</th>
                <th class="fz--14px text-title border-0">{{ translate('Sub category count') }}</th>
                <th class="fz--14px text-title border-0">{{ translate('Zone count') }}</th>
                <th class="fz--14px text-title border-0">{{ translate('Is Featured') }}</th>
                <th class="fz--14px text-title border-0">{{ translate('Status') }}</th>
                <th class="fz--14px text-title border-0 text-end">{{ translate('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $key=>$category)
                <tr>
                    <td class="text-title">{{$categories->firstitem()+$key}}</td>
                    <td class="text-title">
                        {{$category->name}}
                    </td>
                    <td class="text-title">{{$category->children_count}}</td>
                    <td class="text-title">
                        <div>{{$category->zones_count}}</div>
                        @if($category->zones_count < 1)
                            <i class="material-icons" data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="{{translate('This category is not under any zone. Kindly update the category with zone')}}">
                            </i>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <label class="toggle-switch toggle-switch-sm" for="featuredCheckbox{{$category->id}}">
                                <input type="checkbox"
                                data-id="featuredCheckbox{{$category->id}}"
                                data-type="status"
                                data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                data-title-on="{{ translate('By_Turning_ON_category_featured!') }}"
                                data-title-off="{{ translate('By_Turning_OFF_category_featured!') }}"
                                data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_as_featured_on_user_app.') }}</p>"
                                data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_as_featured_on_user_app') }}</p>"
                                class="toggle-switch-input  dynamic-checkbox" id="featuredCheckbox{{$category->id}}" {{$category->is_featured?'checked':''}}>
                                <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                            <form action="{{route('admin.service.category.featured-update',['id' => $category->id, 'status' => $category->is_featured?0:1])}}"
                            method="get" id="featuredCheckbox{{$category->id}}_form">
                                <input type="hidden" name="status" value="{{$category->is_featured?0:1}}">
                                <input type="hidden" name="id" value="{{$category->id}}">
                            </form>
                        </div>
                    </td>
                    <td>
                         <div class="d-flex justify-content-start">
                            <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$category->id}}">
                                <input type="checkbox"
                                data-id="statusCheckbox{{$category->id}}"
                                data-type="status"
                                data-image-on="{{ asset('/public/assets/admin/img/modal/basic_campaign_on.png') }}"
                                data-image-off="{{ asset('/public/assets/admin/img/modal/basic_campaign_off.png') }}"
                                data-title-on="{{ translate('By_Turning_ON_category!') }}"
                                data-title-off="{{ translate('By_Turning_OFF_category!') }}"
                                data-text-on="<p>{{ translate('If_you_turn_on_this_status,_it_will_show_on_user_app.') }}</p>"
                                data-text-off="<p>{{ translate('If_you_turn_off_this_status,_it_won’t_show_on_user_app') }}</p>"
                                class="toggle-switch-input  dynamic-checkbox" id="statusCheckbox{{$category->id}}" {{$category->is_active?'checked':''}}>
                                <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                            <form action="{{route('admin.service.category.status-update',['id' => $category->id, 'status' => $category->is_active?0:1])}}"
                            method="get" id="statusCheckbox{{$category->id}}_form">
                                <input type="hidden" name="status" value="{{$category->is_active?0:1}}">
                                <input type="hidden" name="id" value="{{$category->id}}">
                            </form>
                        </div>
                    </td>
                    <td>
                        <div class="btn--container justify-content-end">
                            <a class="btn action-btn btn-outline-edit" href="{{route('admin.service.category.edit', ['id'=>$category->id])}}"
                                title="{{translate('messages.edit')}}"><i class="fi fi-sr-pencil"></i>
                            </a>
                            <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                data-id="delete-{{ $category->id }}" data-message="{{ translate('Want to delete this ?') }}">
                                <i class="fi fi-rr-trash"></i>
                            </a>
                            <form action="{{ route('admin.service.category.delete', ['id'=>$category->id]) }}"
                                                        id="delete-{{ $category->id }}" method="post" >
                                @csrf @method('delete')
                            </form>
                        </div>
                    </td>
                </tr>
             @empty
                <tr class="text-center">
                    <td colspan="10">
                        <div class="empty--data">
                            <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                            <h5>
                                {{translate('no_data_found')}}
                            </h5>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
