<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'LLC-BAM') }}</title>

  <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">

  <link rel="stylesheet" type='text/css' href="{{ asset('admin_assets/plugins/fontawesome-6/css/all.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('admin_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/sweetalert2/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('admin_assets/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/datatables-buttons/css/buttons.bootstrap4.css') }}">

  {{ $css }}

  <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/adminlte.min.css') }}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

  <link rel='stylesheet' type='text/css'
    href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900'>

  <link rel="stylesheet" href="{{ asset('style_newX.css') }}">

</head>

<div class="loading" id="loading">
  <div class="lds-ripple">
    <div class="lds-pos"></div>
    <div class="lds-pos"></div>
  </div>
</div>

<body
  class="hold-transition sidebar-mini layout-fixed sidebar-collapse layout-navbar-fixed layout-footer-fixed responsive text-sm">

  <div class="wrapper">
    <div class="content-wrapper">

      @component('components.layouts.administrator.nav_bar')
      @endcomponent
      @component('components.layouts.administrator.side_bar')
      @endcomponent
      {{ $slot }}
      {{ $content }}
      @component('components.layouts.administrator.footer')
      @endcomponent

      <aside class="control-sidebar control-sidebar-dark"></aside>

    </div>
  </div>


  <script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/moment/moment.min.js') }}"></script>

  <script src="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/select2/js/select2.full.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/datatables-rowgroup/js/dataTables.rowGroup.js') }}"></script>

  <script src="{{ asset('admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
  </script>
  <script src="{{ asset('admin_assets/plugins/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>



  {{ $script }}

  @stack('scripts')

  <script>
    var theme_color

    // $(document).bind("click", function() {
    //   $('[data-toggle="tooltip"]').tooltip("hide");
    // }).bind("ajaxSend", function() {
    //   $("[data-toggle='tooltip']").tooltip('hide');
    // });

    // document.addEventListener('contextmenu', event => {
    //   toastr.error('This function is not allowed.');
    //   event.preventDefault();
    // });

    // $(document).bind("ajaxSend", function() {
    //   $("#loading").show();
    // }).bind("ajaxStop", function() {
    //   $("#loading").hide();
    //   $("[data-toggle='tooltip']").tooltip('hide');
    // });

    // draggable modal
    (function($) {
      $.fn.drags = function(opt) {

        opt = $.extend({
          handle: ".modal-header",
          // cursor: "move"
        }, opt);

        if (opt.handle === "") {
          var $el = this;
        } else {
          var $el = this.find(opt.handle);
        }

        return $el.css('cursor', opt.cursor).on("mousedown", function(e) {
          if (opt.handle === "") {
            var $drag = $(this).addClass('draggable');
          } else {
            var $drag = $(this).addClass('active-handle').parent().addClass('draggable');
          }
          var z_idx = $drag.css('z-index'),
            drg_h = $drag.outerHeight(),
            drg_w = $drag.outerWidth(),
            pos_y = $drag.offset().top + drg_h - e.pageY,
            pos_x = $drag.offset().left + drg_w - e.pageX;
          $drag.css('z-index', 1000).parents().on("mousemove", function(e) {
            $('.draggable').offset({
              top: e.pageY + pos_y - drg_h,
              left: e.pageX + pos_x - drg_w
            }).on("mouseup", function() {
              $(this).removeClass('draggable').css('z-index', z_idx);
            });
          });
          // e.preventDefault(); // disable selection
        }).on("mouseup", function(e) {
          if (opt.handle === "") {
            $(this).removeClass('draggable');
          } else {
            $(this).removeClass('active-handle').parent().removeClass('draggable');
          }
          e.preventDefault();
        });

      }
    })(jQuery);

    $('.modal-content').drags();


    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#re-fresh').click(function() {
      location.reload();
    });

    $(document).ready(function() {

      $('[data-toggle="tooltip"]').tooltip();

      $("#loading").hide();

      $(".btn-sm").addClass("elevation-5");

      //   $(".select2").select2({

      //   });

      $('.select2').each(function() {
        $(this).select2({
          dropdownParent: $(this).parent(),
          placeholder: "Select",
          allowClear: true,
        });
      })

      $(document).on('select2:open', (e) => {
        const selectId = e.target.id
        $(".select2-search__field[aria-controls='select2-" + selectId + "-results']")
          .each(
            function(
              key, value, ) {
              value.focus();
            })
        $('input.select2-search__field').prop('placeholder', 'Search ...');
      })

      theme_color == "dark"
      theme();

    })

    $('#body_theme').click(function() {

      if (theme_color == "light") {
        sessionStorage.removeItem("theme");
        sessionStorage.setItem("theme", "dark");
        theme_color = sessionStorage.getItem("theme");
      } else if (theme_color == "dark") {
        sessionStorage.removeItem("theme");
        sessionStorage.setItem("theme", "light");
        theme_color = sessionStorage.getItem("theme");
      } else {
        sessionStorage.removeItem("theme");
        sessionStorage.setItem("theme", "light");
        theme_color = sessionStorage.getItem("theme");
      }

      theme();
    });

    function theme() {

      theme_color = sessionStorage.getItem("theme");

      if (theme_color == "dark") {
        $('body').removeClass('dark-mode');
        // $('table').removeClass('table-info');
        $('.table_header').removeClass('bg-dark');

        $('body').addClass('light-mode');
        // $('table').addClass('table-info');
        $('.table_header').addClass('bg-light');

      } else if (theme_color == "light") {
        $('body').removeClass('light-mode');
        // $('table').removeClass('table-dark');
        $('.table_header').removeClass('bg-light');

        $('body').addClass('dark-mode');
        // $('table').addClass('table-info');
        $('.table_header').addClass('bg-dark');
      } else {
        $('body').addClass('light-mode');
        // $('table').addClass('table-info');
        $('.table_header').addClass('bg-light');
      }
    }

    function dt_table() {
      var t = $('.data_table').DataTable({
        dom: "<'row'<'col-sm-4 mb-1'i><'col-sm-4 mb-1 text-center'l><'col-sm-4 mb-1'f>>" +
          "<'row'<'col-sm-12'tr>>",
        "scrollY": "300px",
        "scrollCollapse": true,
        "paging": false,
        //     + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "columnDefs": [{
          "searchable": false,
          "orderable": false,
          "targets": 0
        }],
        language: {
          lengthMenu: '<select class="select2 form-control form-control-sm " style="width:100px" >' +
            '<option value="5">5</option>' +
            '<option value="25">25</option>' +
            '<option value="50">50</option>' +
            '<option value="100">100</option>' +
            '<option value="-1">ALL</option>' +
            "</select> ",
          info: '<label class="text-sm" style="margin-top:-10px"> Showing _START_ to _END_ of _TOTAL_  entries</label>',
        },
        pageLength: -1,
        responsive: true,
        initComplete: function(settings, json) {
          $(".dataTables_length .select2").select2({
            minimumResultsForSearch: -1,
          });
        },
      });
      t.on('order.dt search.dt', function() {
        t.column(0, {
          search: 'applied',
          order: 'applied'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1;
        });
      }).draw();
      return t;
    }

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "progressBar": false,
      "positionClass": "toast-top-full-width mt-5 float-right", //top-right,bottom-left,top-left,top-full-width,bottom-full-width,top-center,bottom-center
      "onclick": null,
      "showDuration": "20000",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
      "preventDuplicates": true,
    }

    $("#dt_rng").daterangepicker({
      opens: "left",
      showDropdowns: true,
      minDate: moment().endOf('d').subtract(10, 'years'),
      maxDate: moment().endOf('d').add(2, 'months'),
      timePickerSeconds: true,
      autoUpdateInput: false,
      autoApply: false,
      timePicker: true,
      // "maxSpan": {
      // "days": 14
      // },
      // ranges: {
      // 'Today': [moment(), moment()],
      // 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      // 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      // 'This Month': [moment().startOf('month'), moment().endOf('month')],
      // 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      // },
      locale: {
        // format: "LL",
        separator: " - ",
        applyLabel: "Apply",
        cancelLabel: "Clear",
        // fromLabel: "From",
        // toLabel: "To",
        customRangeLabel: "Custom",
        weekLabel: "W",
        daysOfWeek: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
        monthNames: [
          "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
          "November", "December",
        ],
        firstDay: 1,
      },
      alwaysShowCalendars: true,
      drops: "down",
      applyClass: "btn-info",
      cancelClass: "btn-danger",
    }, function(start, end, label) {
      $("#dt_rng").val(
        start.format("DD-MM-YYYY") + " to " + end.format("DD-MM-YYYY")
      );
      $("#start_date").val(start.format("YYYY-MM-DD "));
      $("#end_date").val(end.format("YYYY-MM-DD"));
      // date_range = $("#dt_rng").val();
      // from_date = $("#start_date").val();
      // to_date = $("#end_date").val();
    });

    $("#dt_rng").on("cancel.daterangepicker", function(ev, picker) {
      $("#dt_rng").val("");
      $("#start_date").val("");
      $("#end_date").val("");
      // date_range = "";
      // from_date = [moment(), moment()];
      // to_date = [moment(), moment()];
    });

    function date_to_word(val) {
      if (val != '') {
        var wDays = [
          '', 'First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth', 'Ninth', 'Tenth', 'Eleventh',
          'Twelfth',
          'Thirteenth', 'Fourteenth', 'Fifteenth', 'Sixteenth', 'Seventeenth', 'Eighteenth', 'Nineteenth', 'Twentieth',
          'Twenty-First',
          'Twenty-Second', 'Twenty-Third', 'Twenty-Fourth', 'Twenty-Fifth', 'Twenty-Sixth', 'Twenty-Seventh',
          'Twenty-Eighth',
          'Twenty-Ninth', 'Thirtieth', 'Thirty-First',
        ];
        var wMonths = [
          '', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
          'November', 'December',
        ];
        var a = [
          '', 'One ', 'Two ', 'Three ', 'Four ', 'Five ', 'Six ', 'Seven ', 'Eight ', 'Nine ', 'Ten ', 'Eleven ',
          'Twelve ', 'Thirteen ',
          'Fourteen ', 'Fifteen ', 'Sixteen ', 'Seventeen ', 'Eighteen ', 'Nineteen ',
        ];
        var b = [
          '', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety',
        ];

        val = val.split('/');
        var pubdate = new Date(val[0], val[1], val[2]);

        var day = parseInt(val[0]);
        if (typeof month !== 'undefined') {
          var month = parseInt(val[1]);
        } else {
          var dtStr = {
            Jan: 1,
            Feb: 2,
            Mar: 3,
            Apr: 4,
            May: 5,
            Jun: 6,
            Jul: 7,
            Aug: 8,
            Sep: 9,
            Oct: 10,
            Nov: 11,
            Dec: 12,
            '01': 1,
            '02': 2,
            '03': 3,
            '04': 4,
            '05': 5,
            '06': 6,
            '07': 7,
            '08': 8,
            '09': 9,
            '10': 10,
            '11': 11,
            '12': 12,
          };
          month = parseInt(dtStr[val[1]]);
        }

        var year = val[2];

        function inWords(num) {
          if ((num = num.toString()).length > 9) return 'overflow';
          n = ('000000000' + num)
            .substr(-9)
            .match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
          if (!n) return;
          var str = '';
          str +=
            n[1] != 0 ?
            (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' :
            '';
          str +=
            n[2] != 0 ?
            (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' :
            '';
          str +=
            n[3] != 0 ?
            (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' :
            '';
          str +=
            n[4] != 0 ?
            (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' :
            '';
          str +=
            n[5] != 0 ?
            (str != '' ? '' : '') +
            (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) +
            '' :
            '';
          return str;
        }

        var dobword = wDays[day] + ' ' + wMonths[month] + ' ' + inWords(year);
      } else {
        var dobword = '';
        $('#date_of_birth_word').val('');
      }

      return dobword;
    }

    const toIndianCurrency = (num) => {
      if (num != null) {
        const curr = num.toLocaleString('en-IN', {
          style: 'currency',
          currency: 'INR'
        });
        return curr;
      } else {
        return '';
      }

    };

    function nl2br(str, is_xhtml) {
      if (typeof str === 'undefined' || str === null) {
        return '';
      }
      var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
      return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }


    function urlExists(url, callback) {
      $.ajax({
        type: 'HEAD',
        url: url,
        success: function() {
          callback(true);
        }
      });
    }
  </script>
</body>

@yield('script')

@if (Session::has('success'))
  <script>
    toastr.success("{{ Session::get('success') }}");
  </script>
@elseif(Session::has('error'))
  <script>
    toastr.error("{{ Session::get('error') }}");
  </script>
@elseif(Session::has('info'))
  <script>
    toastr.info("{{ Session::get('info') }}");
  </script>
@elseif(Session::has('message'))
  <script>
    toastr.success("{{ Session::get('message') }}");
  </script>
@endif

</html>
