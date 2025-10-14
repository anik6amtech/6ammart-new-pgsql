@extends('layouts.admin.app')

@section('title',translate('Messages'))


@section('content')

    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2 mb-2">
                <img width="20" height="20" src="{{asset('public/assets/admin/img/icons/conversation-icon.png')}}" alt="">
                <h1 class="page-header-title mb-0">
                    {{ translate('messages.conversation_list') }}
                </h1>
            </div>
            <div>
                <button type="button" class="btn btn-primary filter-button-show">
                    <i class="tio tio-help"></i>
                    {{ translate('messages.view_save_answer') }}
                </button>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row g-3">
            <div class="col-lg-4 col-md-6">
                <!-- Card -->
                <div class="card h-100">
                    <div class="card-header border-0">
                        <div class="input-group input---group">
                            <div class="input-group-prepend border-inline-end-0">
                                <span class="input-group-text border-inline-end-0" id="basic-addon1"><i class="tio-search"></i></span>
                            </div>
                            <input type="text" class="form-control border-inline-start-0 pl-1" id="serach" placeholder="{{ translate('messages.search') }}" aria-label="Username"
                                aria-describedby="basic-addon1" autocomplete="off">
                        </div>
                    </div>
                    <!-- Body -->
                    <div class="card-body p-0 initial-19" id="conversation-list">
                        @include('admin-views.messages.data')
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
            <div class="col-lg-8 col-nd-6" id="admin-view-conversation">
                <div class="text-center mt-2">
                    <h4 class="initial-29">{{ translate('messages.view_conversation') }}
                    </h4>
                </div>
                {{-- view here --}}
            </div>
        </div>
        <!-- End Row -->
    </div>


    <!-- Order Filter Modal -->
    <div id="datatableFilterSidebar" class="hs-unfold-content_ sidebar sidebar-bordered sidebar-box-shadow initial-hidden">
        <div class="card card-lg sidebar-card sidebar-footer-fixed">
            <div class="card-header">
                <h4 class="card-header-title">{{translate('messages.Saved Answer')}}</h4>

                <!-- Toggle Button -->
                <a class="js-hs-unfold-invoker_ btn btn-icon btn-sm btn-ghost-dark ml-2 filter-button-hide" href="javascript:;">
                    <i class="tio-clear tio-lg"></i>
                </a>
                <!-- End Toggle Button -->
            </div>
            
            <!-- Body -->
            <div class="card-body sidebar-body sidebar-scrollbar">
                <div id="savedTopicAnswer" class="mt-2">
                    @foreach ($savedReplies as $savedReply)
                        <div class="bg-fafafa p-3 mb-3 rounded-10 saved-answer">
                            <div class="q-answer title-color d-flex gap-05 mb-3">
                                <div>{{ $loop->index + 1 }}.</div>
                                <div class="w-100">
                                    <div class="fw-medium">{{ translate('Topic') }}</div>
                                    <div class="border-bottom border-e2e2e2 opacity-75 mt-2 pb-3">{{ $savedReply->topic }}</div>
                                    <div class="fw-medium d-flex align-items-center justify-content-between gap-2 mt-3 mb-2">
                                        <span>{{ translate('Answer') }}</span>
                                        <button type="button" class="btn copy-btn bg-white box-shadow px-3 text-primary">
                                            <i class="tio-copy"></i> {{ translate('Copy') }}
                                        </button>
                                    </div>
                                    <div class="answer-text opacity-75">{{ $savedReply->answer }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- End Body -->
            
        </div>
    </div>
    <!-- End Order Filter Modal -->
@endsection

@push('script_2')
<script src="{{ asset('public/assets/admin/js/spartan-multi-image-picker.js') }}"></script>

    <script>
        "use strict";

        $('.view-admin-conv').on('click', function (){
            console.log('fiudegfuy')
            let url = $(this).data('url');
            let id_to_active = $(this).data('active-id');
            let conv_id = $(this).data('conv-id');
            let sender_id = $(this).data('sender-id');
            viewAdminConvs(url, id_to_active, conv_id, sender_id);
        })

        function viewAdminConvs(url, id_to_active, conv_id, sender_id) {
            $('.customer-list').removeClass('conv-active');
            $('#' + id_to_active).addClass('conv-active');
            let new_url= "{{ route('admin.message.list') }}" + '?conversation=' + conv_id+ '&user=' + sender_id;
            console.log(url);
            $.get({
                url: url,
                success: function(data) {
                    window.history.pushState('', 'New Page Title', new_url);
                    $('#admin-view-conversation').html(data.view);
                    conversationList();
                }
            });

        }
        let page = 1;
        $('#conversation-list').scroll(function() {
            if ($('#conversation-list').scrollTop() + $('#conversation-list').height() >= $('#conversation-list')
                .height()) {
                page++;
                loadMoreData(page);
            }
        });

        function loadMoreData(page) {
            $.ajax({
                    url: "{{ route('admin.message.list') }}" + '?page=' + page,
                    type: "get",
                    beforeSend: function() {

                    }
                })
                .done(function(data) {
                    if (data.html == " ") {
                        return;
                    }
                    $("#conversation-list").append(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('server not responding...');
                });
        }

        function fetch_data(page, query) {
            $.ajax({
                url: "{{ route('admin.message.list') }}" + '?page=' + page + "&key=" + query,
                success: function(data) {
                    $('#conversation-list').empty();
                    $("#conversation-list").append(data.html);
                }
            })
        }

        $(document).on('keyup', '#serach', function() {
            let query = $('#serach').val();
            fetch_data(page, query);
        });

        $(document).ready(function(){
            $('.filter-button-show').on('click', function(){
                $('#datatableFilterSidebar,.hs-unfold-overlay').show(500)
            });
            $('.filter-button-hide').on('click', function(){
                $('#datatableFilterSidebar,.hs-unfold-overlay').hide(500)
            });
        });

        // Copy Button Logic
        $(document).on('click', '.copy-btn', function () {
            let answerText = $(this)
                .closest('.q-answer')
                .find('.answer-text')
                .html()
                .replace(/\s+/g, ' ')
                .replace(/<\/?[^>]+(>|$)/g, "")
                .trim();

            navigator.clipboard.writeText(answerText)
                .then(() => {
                    $(this).text('Copied!');
                    // $("#conv-textarea").val(answerText);
                    emojioneArea.setText(answerText);
                })
                .catch((error) => {
                    console.error('Copy failed', error);
                    $(this).text('Failed to copy');
                });

            // reset button text after a delay
            setTimeout(() => {
                $(this).text('Copy');
            }, 2000);
        });
    </script>
@endpush
