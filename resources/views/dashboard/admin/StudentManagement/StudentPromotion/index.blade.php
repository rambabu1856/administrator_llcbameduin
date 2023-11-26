<x-layouts.administrator.layout>

  <x-slot name="css">
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/jquery-ui/jquery-ui.min.css') }}">
  </x-slot>

  <x-slot name="content">

    <x-layouts.administrator.content_header contentHeader="STUDENT PROMOTION">

      <x-button.dropdown :links="[
          ['url' => '/link1', 'text' => 'Long Roll'],
          ['url' => '/link2', 'text' => 'Contact Details'],
          ['url' => '/link2', 'text' => 'Migration Details'],
          ['url' => '/link2', 'text' => 'Phone Numbers'],
      ]" btnClass="btn btn-success dropdown-toggle" />

    </x-layouts.administrator.content_header>

    <section class="content">
      <div class="container-fluid">

        {{-- SEARCH FORM --}}
        <x-card.card-heading heading="Filter" name="headingSearchForm">

          <x-form.form action="" method="POST" name="searchForm">

            <x-card.card-body>

              <div class="row">

                <x-form.select2 grid="col-md-3" lblClass="required" lblText="Select Course" name="cmbCourse"
                  :options="$course" reqired></x-form.select2>

                <x-form.select2 grid="col-md-3" lblClass="required" lblText="Select Batch" name="cmbBatch"
                  :options="[]"></x-form.select2>

                <x-form.select2 grid="col-md-3" lblClass="required" lblText="Select Academic Year"
                  name="cmbAcademicYear" :options="[]"></x-form.select2>

                <x-form.select2 grid="col-md-3" lblClass="required" lblText="Select Class" name="cmbGrade"
                  :options="[]"></x-form.select2>
              </div>
              <div class="row">
                <x-form.input grid="col-sm-12 col-md-2" lblClass="required" lblText="Fee Receipt From Date"
                  type="text" name="txtFeeReceiptFromDate" value=""></x-form.input>

                <x-form.input grid="col-sm-12 col-md-2" lblClass="required" lblText="Fee Receipt From Date"
                  type="text" name="txtFeeReceiptToDate" value=""></x-form.input>

                <x-form.input grid="col-sm-12 col-md-2" lblClass="" lblText="Search By Name / Enrl. No"
                  type="text" name="txtSearchBy" value=""></x-form.input>

                <x-button.button grid="col- mt-3" type="button" btnClass="bg-primary mr-1" name="btnSearch"
                  faClass="fa-regular fa-paper-plane mr-2" tooltip="Search" btnText="GET"
                  dataId=""></x-button.button>

                <x-button.button grid="col- mt-3" type="button" btnClass="bg-danger mr-1 resetForm"
                  name="btnAdmissionDetail" faClass="fa-solid fa-rotate mr-2" tooltip="Reset" btnText="RESET"
                  dataId="">
                </x-button.button>

              </div>

            </x-card.card-body>
          </x-form.form>
        </x-card.card-heading>

        {{-- DATA TABLE --}}
        <div class="card ">
          <x-card.card-body>

            <x-table.table id="tblStudentAdmissionRegister" :tableHeaders="[
                'Sl No',
                'Enrollment No',
                'Roll No',
                'Class',
                'Student Name / Father Name / Mother Name',
                'Gender',
                'Community',
                'Date of Birth',
                'is PwD?',
                'Is CLC Withdrawn?',
                'Action',
            ]">
              <x-table.table-body></x-table.table-body>
            </x-table.table>

          </x-card.card-body>
        </div>

      </div>
    </section>

  </x-slot>

  <x-modal.modal id="modalPromoteStudent" modalSize="modal-xl">

    <x-modal.modal-title id="modalEditProfileTitle"></x-modal.modal-title>

    <x-form.form action="" method="POST" name="modalEditProfileForm">

      <x-modal.modal-body>

        <input type="hidden" name="txtModalStudentId" id="txtModalStudentId">
        <input type="hidden" name="txtModalImageUrl" id="txtModalImageUrl">

        <div class="row">
          <div class="col-sm-12 col-md-3">

            <div class="col-md-12 text-center">

              <img id="preview" src="{{ asset('storage/media/web_images/student.png') }}" alt="Student Image"
                class="img-thumbnail" style="min-height: 220px;" />

            </div>

          </div>

          <div class="col-sm-12 col-md-9">

            <div class="row">

              <x-form.input grid="col-sm-12 col-md-3" lblClass="required" lblText="Student Name" type="text"
                name="txtModalStudentName"></x-form.input>

              <x-form.input grid="col-sm-12 col-md-3" lblClass="required" lblText="Enrollment Number" type="text"
                name="txtModalEnrollmentNumber"></x-form.input>

              <x-form.input grid="col-sm-12 col-md-3" lblClass="required" lblText="Roll Number" type="text"
                name="txtModalRollNo"></x-form.input>

              <x-form.select2 grid="col-sm-12 col-md-3" lblClass="required" lblText="Mode of Transaction"
                name="cmbModalModeOfTransaction" :options="$modeOfTransaction"></x-form.select2>
            </div>

            <div class="row">

              <x-form.select2 grid="col-sm-12 col-md-6 sbcRefenceNumber" lblClass="required"
                lblText="SB Collect Reference Number" name="cmbModalSbcRefenceNumber"
                :options="[]"></x-form.select2>

              <x-form.input grid="col-sm-12 col-md-6   otherFeeReferenceNumber hide" lblClass="required"
                lblText="Fee Receipt ReferenceNumber" type="text"
                name="txtOtherFeeReferenceNumber"></x-form.input>

              <x-form.input grid="col-sm-12 col-md-3" lblClass="required" lblText="Fee Receipt Date" type="text"
                name="txtModalReceiptDate" value="" readonly></x-form.input>

              <x-form.input grid="col-sm-12 col-md-3 " lblClass="required" lblText="Fee Receipt Amount"
                type="text" name="txtModalReceiptAmount" readonly></x-form.input>

            </div>

            <div class="row">
              <table id="feeGroup" class="table-hover tablesorter table table-fixed">
                <thead>
                  <tr>
                    <th><input type="checkbox" aria-label="Checkbox for following text input" id="chkSelectAll"
                        name="chkSelectAll"></th>
                    <th style="width:15%">Academic Year</th>
                    <th style="width:15%">Semester</th>
                    <th style="width:50%">Fee Head</th>
                    <th style="width:15%">Amount</th>
                    <th style="width:15%;"><button class="btn btn-warning d-none" id="btnSaveFeeGroup">Save
                        Selected Fee Group</button></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </x-modal.modal-body>

    </x-form.form>
  </x-modal.modal>

  <x-slot name="script">
    <script src="{{ asset('admin_assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
      // Course Change Function
      var courseId, batchId;

      $(document).ready(function() {

        $("#txtFeeReceiptFromDate, #txtFeeReceiptToDate, #txtModalReceiptDate").datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: "dd/mm/yy",
          showButtonPanel: true,
          yearRange: "-100:+0",
          maxDate: "+0D",
          showAnim: 'slide'
        });

        // COURSE CHANGE
        $(document).on("change", "#cmbCourse", function() {

          courseId = $('option:selected', this).val();

          $('#cmbBatch').empty();

          if (courseId > 0) {
            $.ajax({
              type: "POST",
              url: "{{ url('admin/getBatch') }}",
              data: {
                id: courseId
              },
              beforeSend: function() {
                $('#cmbBatch').empty();
                $('.loading').show();
              },
              success: function(response) {
                $.each(response, function(i, v) {
                  $('#cmbBatch').append('<option value=' + v.id + '>' + v.title + '</option>');
                });
                $('#cmbBatch').val(null).trigger('change');
              },
              error: function(xhr, status, text) {

              },
              complete: function() {
                $('.loading').hide();
              }
            });
          }


        });

        // BATCH CHANGE
        $(document).on("change", "#cmbBatch", function() {

          $("#tblStudentAdmissionRegister tbody").empty();
          batchId = $('option:selected', this).val();

          if (batchId > 0 && batchId != null) {
            $.ajax({
              type: "POST",
              url: "{{ url('admin/getAcademicYear') }}",
              data: {
                batchId: batchId
              },
              beforeSend: function() {
                $('#cmbAcademicYear').empty();
                $('.loading').show();
              },
              success: function(response) {

                $('#cmbGrade').empty();
                $.each(response, function(i, v) {
                  $('#cmbAcademicYear').append('<option value=' + v.id + '>' + v.year.title +
                    '</option>');
                });
                $('#cmbAcademicYear').val(null).trigger('change');
              },
              error: function(xhr, status, text) {

              },
              complete: function() {
                $('.loading').hide();
              }
            });
          }
        });

        // ACADEMIC YEAR CHANGE
        $(document).on("change", "#cmbAcademicYear", function(e) {
          e.preventDefault();
          $("#tblStudentAdmissionRegister tbody").empty();

          academicYearId = $('option:selected', this).val();

          if (academicYearId > 0) {

            $("#tblStudentAdmissionRegister tbody").empty();

            $.ajax({
              type: "POST",
              url: "{{ url('admin/getAcademicYearGrade') }}",
              data: {
                batchId: batchId,
                academicYearId: academicYearId
              },
              beforeSend: function() {
                $('#cmbGrade').empty();
                $('.loading').show();
              },
              success: function(response) {

                $.each(response, function(i, v) {

                  $('#cmbGrade').append('<option value=' + v.grade.id + '>' + v.grade.title +
                    '</option>');

                });
                $('#cmbGrade').val(null).trigger('change');
              },
              error: function(xhr, status, text) {

              },
              complete: function() {
                $('.loading').hide();
              }
            });
          }

        });

        // SEARCH STUDENTS WITH FILTER
        $('#btnSearch').on('click', function(e) {

          e.preventDefault();

          if ($("#cmbCourse").val() == null || $("#cmbCourse").val() == "") {
            toastr.error("Please Select Course")
          } else if ($("#cmbBatch").val() == null) {
            toastr.error("Please Select Batch")
          } else if ($("#cmbAcademicYear").val() == null) {
            toastr.error("Please Select Academic Year")
          } else if ($("#cmbGrade").val() == null) {
            toastr.error("Please Select Class")
          } else {
            fetchDataToTable()
          }
        });

        // POPUP STUDENT PROMOTE MODAL
        $(document).on("click", ".btnPromoteStudent", function(e) {

          e.preventDefault();

          resetModal();

          var studentId = $(this).data('id');

          // GET FEE FOR BATCH, ACADEMIC YEAR AND GRADE
          $.ajax({
            type: 'POST',
            url: "{{ url('admin/getEligibleFee') }}",
            data: {
              studentId: studentId,
              feeGroupHeadId: 1,
              courseId: $('#cmbCourse').val(),
              batchId: $('#cmbBatch').val(),
              gradeId: $('#cmbGrade').val(),
            },
            dataType: "json",
            beforeSend: function() {
              $('#feeGroup tbody').empty();
              $('.loading').show();
            },
            success: function(response) {

              var sl_no = 0;
              var total_amount = 0;

              $.each(response, function(i, v) {

                sl_no = sl_no + 1;

                $("#feeGroup tbody").append('<tr>' +

                  '<td>' + sl_no + '</td>' +
                  '<td>' + v.batch.title + '</td>' +
                  '<td>' + v.fee_group_head.title + '</td>' +
                  '<td>' + v.fee_sub_group_head.title + '</td>' +
                  '<td>' + v.amount + '</td>' +

                  '</tr>'
                )

              });
              $('[data-toggle="tooltip"]').tooltip();
              //   $("#headingSearchForm").html('Total Record(s): ' + sl_no);
            },
            error: function(xhr, status, text) {
              $('.loading').hide();
            },
            complete: function() {
              $('.loading').hide();
            }
          });




          $.get("{{ route('admin.student_promotion.index') }}" + '/' + studentId, function(response) {

            var roll_no = response.data.enrollment_number.split("/")[0]

            $("#modalEditProfileTitle").html(response.data.student_name + "  ( " + response.data
              .enrollment_number + " )")

            // hidden Inputs
            $("#txtModalStudentId").val(response.data.id)
            $("#txtModalImageUrl").val(response.data.image_url)

            var url = "{{ asset('storage/media/student_images') }}" + "/" + response.data
              .image_url +
              "?timestamp=" + new Date().getTime();


            if (response.data.image_url) {
              $('#preview').attr('src', url);
            } else {
              $('#preview').attr('src', "{{ asset('storage/media/web_images/student.png') }}");
            }

            $("#txtModalStudentName").val(response.data.student_name).prop("disabled", true)

            $("#txtModalEnrollmentNumber").val(response.data.enrollment_number)
            $("#txtModalEnrollmentNumber").prop("disabled", true);

            $("#txtModalRollNo").val(roll_no)

            $("#tblModalAdmissionDetails tbody").empty();

            $.each(response.data.admission_register, function(i, v) {
              $("#tblModalAdmissionDetails tbody").append('<tr>' +
                '<td>' + v.enrollment_no + '</td>' +
                '<td>' + v.roll_no + '</td>' +
                '<td>' + v.academic_year.year.title + '</td>' +
                '<td>' + v.grade.title + '</td>' +
                '<td>' + moment(v.admission_date).format("DD/MM/YYYY") + '</td>' +
                '</tr>'
              )
            });

            $("#modalPromoteStudent").modal('show');
          })

        });

        // MODAL
        // MODE OF TRANSACTION CHANGE EVENT In Modal
        $(document).on("change", "#cmbModalModeOfTransaction", function(e) {

          e.preventDefault();

          var transactionModeId = $(this).val();

          var feeReceiptFromDate = $('#txtFeeReceiptFromDate').val()
          var feeReceiptToDate = $('#txtFeeReceiptToDate').val()
          var enrollmentNumber = $('#txtModalEnrollmentNumber').val()

          if (transactionModeId == 2) {
            // Toggle
            $(".otherFeeReferenceNumber").addClass(" hide");
            $(".sbcRefenceNumber").removeClass(" hide");

            var subStringOfName = $('#txtModalStudentName').val().split(" ", 1)[0]

            $.ajax({
              type: "POST",
              url: "{{ url('admin/getSbcReferenceNumber') }}",
              data: {
                'transactionModeId': transactionModeId,
                'feeReceiptFromDate': feeReceiptFromDate,
                'feeReceiptToDate': feeReceiptToDate,
                'enrollmentNumber': enrollmentNumber,
                'feeGroup': 1,
                'subStringOfName': subStringOfName,
              },
              dataType: "json",
              success: function(response) {

                $("#cmbModalSbcRefenceNumber").empty();

                $.each(response, function(i, v) {

                  var studentName = (v.student_name).toUpperCase()

                  $('#cmbModalSbcRefenceNumber').append('<option  value=' + v
                    .transaction_reference_no +
                    '><span class="text-uppercase">' + v.transaction_reference_no +
                    ' <- -> ' + studentName +
                    '</span></option>');
                });

                $('#cmbModalSbcRefenceNumber').val(null).trigger('change');
              }
            });
          } else {
            // Toggle
            $(".otherFeeReferenceNumber").removeClass(" hide");
            $(".sbcRefenceNumber").addClass(" hide");
          }
        });

        // SB COLLECT REFERENCE NUMBER CHANGE
        $(document).on("change", "#cmbModalSbcRefenceNumber", function(e) {

          e.preventDefault();

          var sbcRefenceNumber = $(this).val();

          if (sbcRefenceNumber !== null && sbcRefenceNumber != "") {
            $.ajax({
              type: "POST",
              url: "{{ url('admin/getSbcReferenceNumber') }}",
              data: {
                'sbcRefenceNumber': sbcRefenceNumber,
              },
              dataType: "json",
              success: function(response) {
                $('#txtModalReceiptDate').val(moment(response.transaction_date).format("DD/MM/YYYY"))
                $('#txtModalReceiptAmount').val(response.receipt_amount)
              }
            });
          }
        });


      });

      function fetchDataToTable() {
        $.ajax({
          type: "GET",
          url: "{{ route('admin.student_promotion.create') }}",
          data: $("#searchForm").serialize(),
          async: false,
          beforeSend: function(xhr) {
            $("#tblStudentAdmissionRegister tbody").empty();
          },
          success: function(response) {

            var sl_no = 0;

            $.each(response, function(i, v) {

              $.each(v.admission_registers, function(i, row) {

                sl_no = sl_no + 1;

                if (v.registration_number === null) {
                  var registration_number = ''
                } else {
                  var registration_number = v.registration_number + '/' + v.registration_year
                }

                if (v.is_pwd == 1) {
                  var is_pwd = "Yes"
                } else {
                  var is_pwd = ""
                }

                if (v.is_tc_withdrawn == 1) {
                  var is_tc_withdrawn = "Yes"
                } else {
                  var is_tc_withdrawn = ""
                }

                $("#tblStudentAdmissionRegister tbody").append('<tr>' +
                  '<td>' + sl_no + '</td>' +
                  '<td><span class="badge badge-warning text-sm">' + row.enrollment_no +
                  '</span></td>' +
                  '<td>' + row.roll_no + '</td>' +
                  '<td>' + row.grade.title + '</td>' +
                  '<td class="text-indigo">' + v.student_name + '<br><span class="text-teal">' + v
                  .father_name + '</span>' + '<br><span class="text-pink">' + v.mother_name +
                  '</span></td>' +

                  '<td>' + v.gender.title + '</td>' +
                  '<td>' + v.community.slug + '</td>' +

                  '<td>' + moment(row.admission_date).format("DD/MM/YYYY") + '</td>' +

                  '<td><span class="badge badge-warning text-sm">' + is_pwd + '</span></td>' +
                  '<td><span class="badge badge-danger text-sm">' + is_tc_withdrawn + '</span></td>' +
                  '<td>' +
                  '<div class="btn-group">' +
                  '<button type="button" class="btn bg-pink btnPromoteStudent" name="btnPromoteStudent" data-toggle="tooltip" title="Promote" data-id="' +
                  v.id + '"><i class="fa-regular fa-share-from-square" fa-lg></i></button>' +
                  '</div>' +
                  '</td>' +
                  '</tr>'
                )
              })
            });
            $('[data-toggle="tooltip"]').tooltip();
            $("#headingSearchForm").html('Total Record(s): ' + sl_no);
          },
          error: function(xhr, status, error) {
            toastr.info(status);
          },
          complete: function(xhr, status) {
            toastr.success(status);
          }
        });
      }

      $(".resetForm").click(function(e) {
        $("form select").val(null).trigger("change");
        $('form').trigger("reset");
      })

      function resetModal() {
        $("#modalEditProfileForm select").val(null).trigger("change");
        $('#modalEditProfileForm').trigger("reset");
      }
    </script>
  </x-slot>

</x-layouts.administrator.layout>
