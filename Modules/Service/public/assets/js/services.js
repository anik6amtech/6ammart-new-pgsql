

//Data Backgorund Color Add in Html 
$(document).ready(function () {
  $('[data-bg-color]').each(function () {
    var bgColor = $(this).data('bg-color');
    $(this).css('background-color', bgColor);
  });
});
//End

//Dtata text color inside html
$(document).ready(function () {
  $('[data-text-color]').each(function () {
    var textColor = $(this).data('text-color');
    $(this).css('color', textColor);
  });
});
//End

//---- global Image Upload -----
  $(document).on('change', '.global-image-upload input[type="file"]', function () {
      const file = this.files[0];
      const $container = $(this).closest('.global-image-upload');
      const $uploadBox = $container.find('.global-upload-box');
      const $imagePreview = $container.find('.global-image-preview');
      const $overlayIcons = $container.find('.overlay-icons');

      if (file && file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function (e) {
              $imagePreview.attr('src', e.target.result).removeClass('d-none');
              $uploadBox.hide();
              $overlayIcons.removeClass('d-none');
              $container.addClass('has-image'); // trigger hover icon logic
          };
          reader.readAsDataURL(file);
      }
  });
  // View icon - display the image in a specific container with a class
  $(document).on('click', '.view-icon', function (e) {
      e.stopPropagation();
      const src = $(this).closest('.global-image-upload').find('.global-image-preview').attr('src');
      if (src) {
          // Display the image in a container with the class .image-display-container
          const $imageDisplayContainer = $('.image-display-container'); // Find container by class
          $imageDisplayContainer.html('<img src="' + src + '" alt="Preview" style="max-width: 100%; max-height: 300px;" />');
      }
  });
  // Remove icon - reset upload
  $(document).on('click', '.remove-icon', function (e) {
      e.stopPropagation();
      const $container = $(this).closest('.global-image-upload');
      $container.find('.global-image-preview').attr('src', '').addClass('d-none');
      $container.find('.global-upload-box').show();
      $container.find('.overlay-icons').addClass('d-none');
      $container.find('input[type="file"]').val('');
      $container.removeClass('has-image');
  });
  // Edit icon - reopen file input
  $(document).on('click', '.edit-icon', function (e) {
      e.stopPropagation();
      $(this).closest('.global-image-upload').find('input[type="file"]').click();
  });
  // View icon - show image and image name in container with class
  $(document).on('click', '.view-icon', function (e) {
      e.stopPropagation();
      const $container = $(this).closest('.global-image-upload');
      const src = $container.find('.global-image-preview').attr('src');
      const fileInput = $container.find('input[type="file"]')[0];
      const fileName = fileInput.files[0]?.name || '';

      if (src) {
          const $imageDisplayContainer = $('.image-display-container'); // Target by class
          // Inject image + filename into the container
          $imageDisplayContainer.html(`
              <!-- inside show image name -->
              <div style="font-size: 14px; color: #000;">${fileName}</div>
              <!-- inside show image -->
              <img src="${src}" alt="Preview" style="display: height: 200px; aspect-ratio: 7/2; flex; justify-content: center; margin: 18px auto 6px; width: 100%; max-width: 100%; object-fit: cover;" />
          `);
      }
  });

    // ----Daterangepicker Initialization----
    $(function () {
    $('.date-range-picker2').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        showCustomRangeLabel: true,
        startDate: $(this).data("startDate"),
        endDate: $(this).data("endDate"),
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        },
        "alwaysShowCalendars": true,
    });

    $('.date-range-picker2').attr('placeholder', "03/05/2025 - 03/08/2025");

    $('.date-range-picker2').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('.date-range-picker2').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
    });

    //Select2 Selected then Counting 
    $(document).ready(function () {
        $('.select-couting').each(function () {
            var $wrapper = $(this);
            var $select = $wrapper.find('select');
            var $countBox = $wrapper.find('.countBox');

            function updateCount() {
                var selected = $select.val() || [];
                var count = selected.includes('all')
                    ? $select.find('option').length - 1 // subtract "all" option
                    : selected.length;
                $countBox.text('+' + count);
            }

            // Initial count update
            updateCount();

            // On change
            $select.on('change', function () {
                updateCount();
            });
        });
    });

    //Pdf file and image same time upload 
    $('.access-pdf__doc input[type="file"]').on('change', function () {
        const file = this.files[0];
        const $wrapper = $(this).closest('.access-pdf__doc');
        const $imagePreview = $wrapper.find('.global-image-preview');
        const $filePreview = $wrapper.find('.file-preview');
        const $fileNameEl = $wrapper.find('.file-name, .image-file-name'); // support both class names
        const $overlayIcons = $wrapper.find('.overlay-icons');
        const $uploadBox = $wrapper.find('.global-upload-box');
        // Reset all previews
        $imagePreview.addClass('d-none');
        $filePreview.addClass('d-none');
        $overlayIcons.addClass('d-none');
        $fileNameEl.text('');
        if (file) {
            const fileType = file.type;

            if (fileType.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $imagePreview.attr('src', e.target.result).removeClass('d-none');
                };
                reader.readAsDataURL(file);
            } else if (
                fileType === 'application/pdf' ||
                file.name.endsWith('.doc') ||
                file.name.endsWith('.docx')
            ) {
                $fileNameEl.text(file.name);
                $filePreview.removeClass('d-none');
            }
            $overlayIcons.removeClass('d-none');
            // Remove upload box after successful file selection
            $uploadBox.remove();
        }
    });


    // --- Offcanvas ---
    let isTransitioning = false;
    $(document).on('click', '.offcanvas-toggle', function () {
        if (isTransitioning) return;
        isTransitioning = true;
        let target = $(this).data('target');
        let $newOffcanvas = $(target);
        let newOverlay = $newOffcanvas.data('overlay');
        let $currentOffcanvas = $('.offcanvas.open');
        if ($currentOffcanvas.length) {
            let currentOverlay = $currentOffcanvas.data('overlay');
            $currentOffcanvas.removeClass('open');
            $(currentOverlay).removeClass('active');
            setTimeout(function () {
                $newOffcanvas.addClass('open');
                $(newOverlay).addClass('active');
                $('body').addClass('modal-open');
                isTransitioning = false;
            }, 300);
        } else {
            $newOffcanvas.addClass('open');
            $(newOverlay).addClass('active');
            $('body').addClass('modal-open');
            isTransitioning = false;
        }
    });

    $(document).on('click', '.offCanvasoverlay', function () {
        let overlayId = '#' + $(this).attr('id');
        let $offcanvas = $('.offcanvas[data-overlay="' + overlayId + '"]');
        $offcanvas.removeClass('open');
        $(this).removeClass('active');
        $('body').removeClass('modal-open');
    });

    $(document).on('click', '.closeOfcanvus', function () {
        let $offcanvas = $(this).closest('.offcanvas');
        let overlaySelector = $offcanvas.data('overlay');
        $offcanvas.removeClass('open');
        $(overlaySelector).removeClass('active');
        $('body').removeClass('modal-open');
    });

    $(document).on('keydown', function (e) {
        if (e.key === 'Escape' || e.keyCode === 27) {
            let $openOffcanvas = $('.offcanvas.open');
            if ($openOffcanvas.length) {
                let overlaySelector = $openOffcanvas.data('overlay');
                $openOffcanvas.removeClass('open');
                $(overlaySelector).removeClass('active');
                $('body').removeClass('modal-open');
            }
        }
    });
    // --- Offcanvas End ---

    // --- Select2 Counting ---
    $(".js-select2-counting").select2({
        placeholder: "Select tags",
        closeOnSelect: false,
        templateSelection: function (data) {
            return data.text;
        }
        }).on("select2:open select2:close select2:select select2:unselect", function () {
        setTimeout(updateCounting, 10);
        });
        $(window).on("load resize", updateCounting);
        function updateCounting() {
        $(".js-select2-counting").each(function () {
            const $container  = $(this).next(".select2-container");
            const $rendered   = $container.find(".select2-selection__rendered"); // the <ul>
            const $choices    = $rendered.children(".select2-selection__choice");

            const availableWidth = $rendered.width();
            let usedWidth = 0;
            let hiddenCount = 0;

            // reset
            $choices.show();

            // hide overflowed tags
            $choices.each(function () {
            const $c = $(this);
            usedWidth += $c.outerWidth(true);
            if (usedWidth > availableWidth - 30) {
                $c.hide();
                hiddenCount++;
            }
            });

            // remove old counter next to the UL
            $rendered.siblings(".select2-counting-btn").remove();

            // insert the counter **outside** the UL, as a sibling
            if (hiddenCount > 0) {
            $('<button type="button" class="select2-counting-btn btn btn--primary px-1 py-1">+' + hiddenCount + '</button>')
                .insertAfter($rendered);
            }
        });
    }