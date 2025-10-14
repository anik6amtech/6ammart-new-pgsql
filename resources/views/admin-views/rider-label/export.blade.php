<div class="row">
    <div class="col-lg-12 text-center"><h1>{{ translate('Driver Level List') }}</h1></div>
    <div class="col-lg-12">
        <table>
            <thead>
            <tr>
                <th></th>
                <th>
                    @if ($data['search'])
                        <br>
                        {{ translate('search_bar_content') }} : {{ $data['search'] }}
                    @endif

                    @if ($data['status'])
                        <br>
                        {{ translate('status') }} : {{ translate($data['status']) }}
                    @endif
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>{{ translate('messages.sl') }}</th>
                <th>{{ translate('Level Name') }}</th>
                <th>{{ translate('Target_to_proceed_level') }}</th>
                <th>{{ translate('total_trip') }}</th>
                <th>{{ translate('maximum cancellation rat') }}</th>
                <th>{{ translate('Total Rider') }}</th>
                <th>{{ translate('Status') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['levels'] as $key => $level)
                    <?php
                    $totalTrip = 0;
                    $completedTrip = 0;
                    $cancelledTrip = 0;
                    $trip_earning = 0;
                    ?>

                @forelse($level->users as $user)
                    @php($totalTrip += $user->driverTrips->count())
                    @php($completedTrip += $user->driverTrips?->where('current_status', 'completed')->count())
                    @php($cancelledTrip += $user->driverTrips?->where('current_status', 'cancelled')->count())
                @empty
                @endforelse
                <tr>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $level->name ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        <div class="d-flex flex-column gap-1 fs-12">
                            <div class="d-flex gap-4 align-items-left">
                                <span class="w-100px text-wrap text-muted">{{translate('Ride Complete')}}</span>:
                                <span>{{ $level->targeted_ride }} ({{$level->targeted_ride_point}} {{translate('points')}})</span>
                            </div><br>
                            <div class="d-flex gap-4 align-items-left">
                                <span class="w-100px text-wrap text-muted">{{translate('Earning Amount')}}</span>:
                                <span>{{ set_currency_symbol($level->targeted_amount ?? 0) }} ({{$level->targeted_amount_point}} {{translate('points')}})</span>
                            </div><br>
                            <div class="d-flex gap-4 align-items-left">
                                <span class="w-100px text-wrap text-muted">{{ translate('Cancellation Rate') }}</span>:
                                <span>{{ $level->targeted_cancel }}% ({{$level->targeted_cancel_point}} {{translate('points')}})</span>
                            </div><br>
                            <div class="d-flex gap-4 align-items-left">
                                <span class="w-100px text-wrap text-muted">{{translate("Given Review")}}</span>:
                                <span>{{ $level->targeted_review }} ({{$level->targeted_review_point}} {{ translate('points') }})</span>
                            </div>
                        </div>
                    </td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $completedTrip }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ number_format($totalTrip == 0 ? 0 : ($cancelledTrip / $totalTrip) * 100, 2) }} %</td>
                    <td style="border: 1px solid #000000; padding: 5px;">{{ $level->users->count() }}</td>
                    <td style="border: 1px solid #000000; padding: 5px;">
                        {{ $level->is_active ? 'Active' : 'Inactive' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
