
@if(count($leadDriver)>0)
<div class="d-flex flex-wrap flex-xl-nowrap gap-5">
    <div class="flex-grow-1">
        <div class="leader-board-wrap d-flex gap-4 gap-lg-40px justify-content-center justify-content-lg-start align-items-end">
            @if ($leadDriver->has(1))
                <a href="{{ route('admin.users.delivery-man.preview', ['id' => $leadDriver[1]?->driver?->id, 'tab' => 'ride_list']) }}" class="leader-board d-flex flex-column align-items-center">
                    <h4 class="mb-0 font-bold" style="color: #FFA800;">{{ $leadDriver[1]->total_records }}</h4>
                    <h6 class="fs-12 fw-semibold" style="color: #FFA800;">{{ translate('Rides') }}</h6>
                    <div class="custom-box-size rounded-circle position-relative">
                        <img src="{{ $leadDriver[1]?->driver?->image_full_url }}"
                            alt="" class="fit-object rounded-circle dark-support">
                    </div>
                    <div class="leader-board-column second mt-3"  style="background-color: #FFA800;">
                        <span class="leader-board-position bg-white mx-auto" data-color="#FFA800" style="color: #FFA800;"> 2 </span>
                        <h6 class="fs-12 mt-2 font-bold text-center text-white">
                            {{ substr($leadDriver[1]?->driver?->f_name, 0, 16) }}</h6>
                    </div>
                </a>
            @else
                <div class="leader-board d-flex flex-column align-items-center">
                    <h4 class="mb-0 font-bold" data-color="#FFA800" style="color: #FFA800;">{{ 0 }}</h4>
                    <h6 class="fs-12 fw-semibold" data-color="#FFA800" style="color: #FFA800;">{{ translate('Rides') }}</h6>
                    <div class="custom-box-size rounded-circle position-relative">

                        <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}"
                                alt="" class="fit-object rounded-circle dark-support">
                    </div>
                    <div class="leader-board-column second mt-3"  style="background-color: #FFA800;">
                        <span class="leader-board-position bg-white mx-auto" data-color="#FFA800" style="color: #FFA800;"> 2 </span>
                        <h6 class="fs-12 mt-2 font-bold text-center text-white">
                            {{ translate('no_Rider') }}</h6>
                    </div>
                </div>
            @endif
            @if ($leadDriver->has(0))
                <a href="{{ route('admin.users.delivery-man.preview', ['id' => $leadDriver[0]?->driver?->id, 'tab' => 'ride_list']) }}"  class="leader-board d-flex flex-column align-items-center">
                    <h4 class="mb-0 font-bold" data-color="#14B19E" style="color: #14B19E;">{{ $leadDriver[0]->total_records }}</h4>
                    <h6 class="fs-12 fw-semibold" data-color="#14B19E" style="color: #14B19E;">{{ translate('Rides') }}</h6>
                    <div class="custom-box-size rounded-circle position-relative">
                        <img src="{{ $leadDriver[0]?->driver?->image_full_url }}"
                            alt="" class="fit-object rounded-circle dark-support">
                        <img width="36" src="{{ asset('Modules/RideShare/public/assets/img/ride-share/badge.png') }}"
                            class="dark-support leader-board-badge" alt="">
                    </div>
                    <div class="leader-board-column first mt-3" data-bg-color="#0177CD" style="background-color: #0177CD;">
                        <span class="leader-board-position bg-white mx-auto"
                                                        data-color="#0177CD" style="color: #0177CD;"> 1 </span>
                        <h6 class="fs-12 mt-2 font-bold text-center text-white">
                            {{ substr($leadDriver[0]?->driver?->f_name, 0, 16) }}</h6>
                    </div>
                </a>
            @else
                <div class="leader-board d-flex flex-column align-items-center">
                    <h4 class="mb-0 font-bold" data-color="#14B19E" style="color: #14B19E;">{{ 0 }}</h4>
                    <h6 class="fs-12 fw-semibold" data-color="#14B19E" style="color: #14B19E;">{{ translate('Rides') }}</h6>
                    <div class="custom-box-size rounded-circle position-relative">
                        <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}"
                                alt="" class="fit-object rounded-circle dark-support">
                        <img width="36" src="{{ asset('Modules/RideShare/public/assets/img/ride-share/badge.png') }}"
                                class="dark-support leader-board-badge" alt="">
                    </div>
                    <div class="leader-board-column first mt-3" data-bg-color="#0177CD" style="background-color: #0177CD;">
                        <span class="leader-board-position bg-white mx-auto"
                                                        data-color="#0177CD" style="color: #0177CD;"> 1 </span>
                        <h6 class="fs-12 mt-2 font-bold text-center text-white">
                            {{ translate('no_Driver') }}</h6>
                    </div>
                </div>
            @endif
            @if ($leadDriver->has(2))
                <a href="{{ route('admin.users.delivery-man.preview', ['id' => $leadDriver[2]?->driver?->id, 'tab' => 'ride_list']) }}"  class="leader-board d-flex flex-column align-items-center">
                    <h4 class="mb-0 font-bold" data-color="#C7870C" style="color: #C7870C;">{{ $leadDriver[2]->total_records }}</h4>
                    <h6  class="fs-12 fw-semibold" data-color="#C7870C" style="color: #C7870C;">{{ translate('rides') }}</h6>
                    <div class="custom-box-size rounded-circle position-relative">
                        <img src="{{ $leadDriver[2]?->driver?->image_full_url }}"
                            alt="" class="fit-object rounded-circle dark-support">
                    </div>
                    <div class="leader-board-column mt-3" data-bg-color="#9DAAFF" style="background-color: #9DAAFF;">
                        <span class="leader-board-position bg-white mx-auto" data-color="#6378FF" style="color: #6378FF;"> 3 </span>
                        <h6 class="fs-12 mt-2 font-bold text-center text-white">{{ substr($leadDriver[2]->driver?->f_name, 0, 16) }}</h6>
                    </div>
                </a>
            @else
                <div class="leader-board d-flex flex-column align-items-center">
                    <h4 class="mb-0 font-bold" data-color="#C7870C" style="color: #C7870C;">{{ 0 }}</h4>
                    <h6  class="fs-12 fw-semibold" data-color="#C7870C" style="color: #C7870C;">{{ translate('rides') }}</h6>
                    <div class="custom-box-size rounded-circle position-relative">
                        <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}"
                                alt="" class="fit-object rounded-circle dark-support">
                    </div>
                    <div class="leader-board-column mt-3" data-bg-color="#9DAAFF" style="background-color: #9DAAFF;">
                        <span class="leader-board-position bg-white mx-auto" data-color="#6378FF" style="color: #6378FF;"> 3 </span>
                        <h6 class="fs-12 mt-2 font-bold text-center text-white">{{ translate('no_Driver') }}</h6>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="flex-grow-1 ps-xxl-5">
        <ol class="leader-board-list leader-board-list__custom max-h-345px mb-0 overflow-y-auto pl-0">
            @forelse($leadDriver as $key => $ld)
                <li>
                    <div class="d-flex align-items-center gap-3">
                        <div>{{ ++$key }}.</div>
                        <div class="media align-items-center gap-2">
                            <div class="rounded-circle">
                                <img src="{{ $ld?->driver?->image_full_url }}"
                                    alt="" class="dark-support rounded-circle custom-box-size"
                                    style="--size: 36px">
                            </div>
                            <a  href="{{ route('admin.users.delivery-man.preview', ['id' => $ld?->driver?->id, 'tab' => 'ride_list']) }}" class="media-body text-title font-bold">{{ $ld->driver?->f_name . ' ' . $ld->driver?->l_name }}
                            </a>
                        </div>
                    </div>
                    <h6 class="fs-12 font-bold">{{ $ld->total_records }} {{ translate('Rides') }}</h6>
                </li>
            @empty
                <div class="text-center p-4">
                    <div class="empty--data">
                        <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                        <h5>
                            {{translate('no_data_found')}}
                        </h5>
                    </div>
                </div>
            @endforelse
        </ol>
    </div>
</div>
@else
    <div class="text-center p-4">
        <div class="empty--data">
            <img src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
            <h5>
                {{translate('no_data_found')}}
            </h5>
        </div>
    </div>
@endif
