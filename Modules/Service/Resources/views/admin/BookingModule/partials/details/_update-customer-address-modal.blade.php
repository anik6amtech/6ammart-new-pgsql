<div class="modal fade" id="customerAddressModal--{{$booking['id']}}" tabindex="-1" aria-labelledby="customerAddressModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <form class="flex-grow-1" id="customerAddressModalSubmit">
            @csrf
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close bg-white text-dark border d-center w-30px h-30 rounded-circle" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="font-weight-bold">{{ translate('Change Service Location') }}</h4>

                    <div class="row mt-4">
                        <div class="col-md-6 col-12">
                            <div class="col-md-12 col-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <label>{{translate('contact_person_name')}} *</label>
                                        <input type="text" class="form-control" name="contact_person_name"
                                               placeholder="{{translate('contact_person_name')}} *"
                                               value="{{$booking->service_address?->contact_person_name}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <label>{{ translate('contact_person_number') }}</label>
                                        <input type="text" class="form-control company_phone phone-input-with-country-picker8 iti__tel-input"
                                               name="contact_person_number"
                                               id="contact_person_number"
                                               placeholder="{{translate('contact_person_number')}} *"
                                               value="{{$booking->service_address?->contact_person_number}}" required>
                                        <div class="">
                                            <input type="text" class="country-picker-phone-number8 w-50" value="{{$booking->service_address?->contact_person_number}}" id="number_with_country_code" name="contact_person_number_with_code" hidden="" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Google Maps API (callback method) -->
                            <script src="https://maps.googleapis.com/maps/api/js?key={{ \App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value }}&libraries=places&callback=initAutocomplete" async defer></script>

                            <div class="col-md-12 col-12">
                                <div id="location_map_div" class="location_map_class">
                                    <input id="pac-input" class="form-control w-auto"
                                           type="text"
                                           placeholder="{{ translate('search_here') }}" />

                                    <div id="location_map_canvas"
                                         class="overflow-hidden rounded canvas_class"
                                         style="height:400px;"></div>
                                </div>
                            </div>

                            <script>
                                function initAutocomplete() {
                                    var myLatLng = {
                                        lat: {{ json_decode($booking?->service_address_location, true)['latitude'] ?? 23.811842872190343 }},
                                        lng: {{ json_decode($booking?->service_address_location, true)['longitude'] ?? 90.356331 }}
                                    };

                                    const map = new google.maps.Map(document.getElementById("location_map_canvas"), {
                                        center: myLatLng,
                                        zoom: 13,
                                        mapTypeId: "roadmap",
                                    });

                                    var marker = new google.maps.Marker({
                                        position: myLatLng,
                                        map: map
                                    });

                                    var geocoder = new google.maps.Geocoder();

                                    // Map click
                                    google.maps.event.addListener(map, 'click', function (event) {
                                        var lat = event.latLng.lat();
                                        var lng = event.latLng.lng();

                                        marker.setPosition(event.latLng);
                                        map.panTo(event.latLng);

                                        document.getElementById("latitude").value = lat;
                                        document.getElementById("longitude").value = lng;

                                        geocoder.geocode({'location': event.latLng}, function (results, status) {
                                            if (status === "OK" && results[0]) {
                                                document.getElementById("address").value = results[0].formatted_address;
                                            }
                                        });
                                    });

                                    // Search box
                                    const input = document.getElementById("pac-input");
                                    const searchBox = new google.maps.places.SearchBox(input);
                                    map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

                                    map.addListener("bounds_changed", () => {
                                        searchBox.setBounds(map.getBounds());
                                    });

                                    searchBox.addListener("places_changed", () => {
                                        const places = searchBox.getPlaces();
                                        if (places.length == 0) return;

                                        const bounds = new google.maps.LatLngBounds();

                                        places.forEach((place) => {
                                            if (!place.geometry || !place.geometry.location) return;

                                            marker.setPosition(place.geometry.location);
                                            map.panTo(place.geometry.location);

                                            document.getElementById("latitude").value = place.geometry.location.lat();
                                            document.getElementById("longitude").value = place.geometry.location.lng();
                                            document.getElementById("address").value = place.formatted_address || place.name;

                                            if (place.geometry.viewport) {
                                                bounds.union(place.geometry.viewport);
                                            } else {
                                                bounds.extend(place.geometry.location);
                                            }
                                        });

                                        map.fitBounds(bounds);
                                    });
                                }
                            </script>

                        </div>
                        <div class="col-md-6 col-12 row">
                            <div class="col-md-12 col-12">
                                <div class="mb-30">
                                    <label>{{ translate('address_label') }}</label>
                                    <select class="form-control w-100" name="address_label">
                                        <option selected disabled>{{translate('Select_address_label')}}*</option>
                                        <option value="home" {{$booking->service_address?->address_label == 'home' ? 'selected' : ''}}>{{translate('Home')}}</option>
                                        <option value="office" {{$booking->service_address?->address_label == 'office' ? 'selected' : ''}}>{{translate('Office')}}</option>
                                        <option value="others" {{$booking->service_address?->address_label == 'others' ? 'selected' : ''}}>{{translate('others')}}</option>
                                    </select>
                                </div>
                            </div>
{{--                            <div class="col-md-12 col-12">--}}
{{--                                <div class="mb-30 d-flex gap-4 flex-wrap align-items-center">--}}
{{--                                    <div class="border rounded d-flex gap-2 px-3 py-2 align-items-center cursor-pointer address-option {{$booking->service_address?->address_label == 'home' ? 'border-primary' : ''}}" data-value="home">--}}
{{--                                        <input type="radio" name="address_label" value="home" class="d-none">--}}
{{--                                        <span class="material-icons {{$booking->service_address?->address_label == 'home' ? 'text-primary' : ''}}">home</span>--}}
{{--                                        Home--}}
{{--                                    </div>--}}
{{--                                    <div class="border rounded d-flex gap-2 px-3 py-2 align-items-center cursor-pointer address-option {{$booking->service_address?->address_label == 'office' ? 'border-primary' : ''}}" data-value="office">--}}
{{--                                        <input type="radio" name="address_label" value="office" class="d-none">--}}
{{--                                        <span class="material-icons {{$booking->service_address?->address_label == 'office' ? 'text-primary' : ''}}">domain</span>--}}
{{--                                        Office--}}
{{--                                    </div>--}}
{{--                                    <div class="border rounded d-flex gap-2 px-3 py-2 align-items-center cursor-pointer address-option {{$booking->service_address?->address_label == 'others' ? 'border-primary' : ''}}" data-value="others">--}}
{{--                                        <input type="radio" name="address_label" value="others" class="d-none">--}}
{{--                                        <span class="material-icons {{$booking->service_address?->address_label == 'others' ? 'text-primary' : ''}}">other_houses</span>--}}
{{--                                        Others--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-md-12 col-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <label>{{translate('address')}} *</label>
                                        <input type="text" class="form-control" name="address" id="address"
                                               placeholder="{{translate('address')}} *"
                                               value="{{$booking?->service_address?->address}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <label>{{translate('lat')}} *</label>
                                        <input type="text" class="form-control" name="latitude" id="latitude"
                                               placeholder="{{translate('lat')}} *"
                                               value="{{$booking?->service_address?->latitude ?? 0}}" required readonly
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               title="{{translate('Select from map')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <label>{{translate('long')}} *</label>
                                        <input type="text" class="form-control" name="longitude" id="longitude"
                                               placeholder="{{translate('long')}} *"
                                               value="{{$booking?->service_address?->longitude ?? 0}}" required readonly
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               title="{{translate('Select from map')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <label>{{translate('city')}}</label>
                                        <input type="text" class="form-control" name="city"
                                               placeholder="{{translate('city')}}"
                                               value="{{$booking->service_address?->city}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <label>{{translate('street')}}</label>
                                        <input type="text" class="form-control" name="street"
                                               placeholder="{{translate('street')}}"
                                               value="{{$booking?->service_address?->street}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <label>{{translate('zip_code')}}</label>
                                        <input type="text" class="form-control" name="zip_code"
                                               placeholder="{{translate('zip_code')}}"
                                               value="{{$booking?->service_address?->zip_code}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <label>{{translate('country')}}</label>
                                        <input type="text" class="form-control" name="country"
                                               placeholder="{{translate('country')}}"
                                               value="{{$booking?->service_address?->country}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end gap-3 border-0 pt-0 pb-4 m-4">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal" aria-label="Close">
                        {{translate('Cancel')}}</button>
                    <button type="submit" class="btn btn--primary">{{translate('Update')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>

