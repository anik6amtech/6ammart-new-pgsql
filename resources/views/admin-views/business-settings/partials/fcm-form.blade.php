
@foreach($language as $lang)
    <div class="{{ $lang != $defaultLang ? 'd-none' : '' }} lang_form" id="{{ $lang }}-form">
        <div class="row">
            <div class="col-12 mb-2">
                <h3>{{ translate('messages.Customer Notification') }}</h3>
                <hr>
            </div>

            @php($notifications = NOTIFICATION_FOR_SERVICE_USER)
            @include('admin-views.business-settings.partials.notification-block', [
                'notifications' => $notifications,
                'lang' => $lang,
                'mod_type' => $mod_type,
                'user_type' => 'user',
                'notificationMessages' => $notificationMessages, // Pass it here
            ])

            <div class="col-12 mb-2 mt-3">
                <h3>{{ translate('messages.Provider Notification') }}</h3>
                <hr>
            </div>

            @php($notifications = NOTIFICATION_FOR_SERVICE_PROVIDER)
            @include('admin-views.business-settings.partials.notification-block', [
                'notifications' => $notifications,
                'lang' => $lang,
                'mod_type' => $mod_type,
                'user_type' => 'provider',
                'notificationMessages' => $notificationMessages, // Pass it here
            ])

            <div class="col-12 mb-2 mt-3">
                <h3>{{ translate('messages.Serviceman Notification') }}</h3>
                <hr>
            </div>

            @php($notifications = NOTIFICATION_FOR_SERVICE_SERVICEMAN)
            @include('admin-views.business-settings.partials.notification-block', [
                'notifications' => $notifications,
                'lang' => $lang,
                'mod_type' => $mod_type,
                'user_type' => 'serviceman',
                'notificationMessages' => $notificationMessages, // Pass it here
            ])

            <input type="hidden" name="lang[]" value="{{ $lang }}">
            <input type="hidden" name="module_type" value="{{ $mod_type }}">
        </div>
    </div>
@endforeach
