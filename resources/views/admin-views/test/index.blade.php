@extends('layouts.admin.app')

@section('title', translate('test'))

@push('css_or_js')
@endpush

@section('content')

@endsection

@push('script_2')

    $("img.svg").each(function () {
    let $img = jQuery(this);
    let imgID = $img.attr("id");
    let imgClass = $img.attr("class");
    let imgURL = $img.attr("src");

    jQuery.get(
      imgURL,
      function (data) {
        // Get the SVG tag, ignore the rest
        let $svg = jQuery(data).find("svg");

        // Add replaced image's ID to the new SVG
        if (typeof imgID !== "undefined") {
          $svg = $svg.attr("id", imgID);
        }
        // Add replaced image's classes to the new SVG
        if (typeof imgClass !== "undefined") {
          $svg = $svg.attr("class", imgClass + " replaced-svg");
        }

        // Remove any invalid XML tags as per http://validator.w3.organim
        $svg = $svg.removeAttr("xmlns:a");

        // Check if the viewport is set, else we gonna set it if we can.
        if (
          !$svg.attr("viewBox") &&
          $svg.attr("height") &&
          $svg.attr("width")
        ) {
          $svg.attr(
            "viewBox",
            "0 0 " + $svg.attr("height") + " " + $svg.attr("width")
          );
        }

        // Replace image with new SVG
        $img.replaceWith($svg);
      },
      "xml"
    );
  });

        $(document).ready(function () {
            $('.read-file').on('change', function () {
                readUrl(this);
            });
            function readUrl(input) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        let imgName = input.files[0].name;
                        input.setAttribute("data-title", imgName);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });

        $('.zip-upload').on('click', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let formData = new FormData(document.getElementById('theme_form'));
            $.ajax({
                type: 'POST',
                url: "{{route('admin.business-settings.system-addon.upload')}}",
                data: formData,
                processData: false,
                contentType: false,
                xhr: function() {
                    let xhr = new window.XMLHttpRequest();
                    $('#progress-bar').show();

                    // Listen to the upload progress event
                    xhr.upload.addEventListener("progress", function(e) {
                        if (e.lengthComputable) {
                            let percentage = Math.round((e.loaded * 100) / e.total);
                            $("#uploadProgress").val(percentage);
                            $("#progress-label").text(percentage + "%");
                        }
                    }, false);

                    return xhr;
                },
                beforeSend: function () {
                    $('#upload_theme').attr('disabled');
                },
                success: function(response) {
                    if (response.status == 'error') {
                        $('#progress-bar').hide();
                        toastr.error(response.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }else if(response.status == 'success'){
                        toastr.success(response.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        location.reload();
                    }
                },
                complete: function () {
                    $('#upload_theme').removeAttr('disabled');
                },
            });
        })

    $('.publish-addon').on('click', function () {
        let path = $(this).data('path');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                    url: '{{route('admin.business-settings.system-addon.publish')}}',
                    data: {
                        'path': path
                    },
                    success: function (data) {
                        if (data.flag === 'inactive') {
                            // console.log(data.view)
                            $('#activatedThemeModal').modal('show');
                            $('#activateData').empty().html(data.view);
                        } else {
                            if (data.errors) {
                                for (let i = 0; i < data.errors.length; i++) {
                                    toastr.error(data.errors[i].message, {
                                        CloseButton: true,
                                        ProgressBar: true
                                    });
                                }
                            } else {
                                toastr.success('{{ translate("updated successfully!") }}', {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                                setTimeout(function () {
                                    location.reload()
                                }, 2000);
                            }
                        }
                    }
                });
            })

        $('.theme-delete').on('click', function () {
            let path = $(this).data('path');
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.business-settings.system-addon.delete')}}',
                data: {
                    path
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    if (data.status === 'success') {
                        setTimeout(function () {
                            location.reload()
                        }, 2000);

                        toastr.success(data.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }else if(data.status === 'error'){
                        toastr.error(data.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        })

        let swiper = new Swiper(".mySwiper", {
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
        });
    </script>
@endpush
