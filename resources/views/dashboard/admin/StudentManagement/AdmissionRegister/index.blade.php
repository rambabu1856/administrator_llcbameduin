<x-layouts.administrator.layout>

  <x-slot name="css">
    {{-- <link rel="stylesheet" href="{{ asset('admin_assets/plugins/jquery_ui_info/jquery-ui.min.css') }}"> --}}


  </x-slot>

  <x-slot name="content">

    <x-layouts.administrator.content_header contentHeader="STUDENT ADMISSION REGISTER">

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
                  :options="$course"></x-form.select2>

                <x-form.select2 grid="col-md-3" lblClass="required" lblText="Select Batch" name="cmbBatch"
                  :options="[]"></x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Class" name="cmbGrade" :options="[]">
                </x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Academic Year" name="cmbAcademicYear"
                  :options="[]">
                </x-form.select2>


              </div>

              <div class="row"> <x-form.select2 grid="col-md-2" lblClass="" lblText="Select Gender"
                  name="cmbGender" :options="$gender"></x-form.select2>
                <x-form.select2 grid="col-sm-12 col-md-2" lblClass="" lblText="Select Community" name="cmbCommunity"
                  :options="$community">
                </x-form.select2>

                <x-form.select2 grid="col-sm-12 col-md-2" lblClass="required" lblText="Religion" name="cmbReligion"
                  :options="$religion"></x-form.select2>

                <x-form.select2 grid="col-sm-12 col-md-2" lblClass="" lblText="Is belogs to PwD category"
                  name="cmbIsPwd" :options="$yesNo"></x-form.select2>

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
        <div class="card">
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

  <x-modal.modal id="modalAdmissionRegister" modalSize="modal-xl">

    <x-modal.modal-title id="modalEditProfileTitle"></x-modal.modal-title>

    <x-form.form action="" method="POST" name="modalAdmissionRegisterForm">

      <x-modal.modal-body>

        <div class="row">
          <div class="col-sm-12 col-md-3">

            <div class="col-md-12 text-center">

              <img id="preview" src="{{ asset('storage/media/web_images/student.png') }}" alt="Student Image"
                class="img-thumbnail" style="min-height: 220px;" />

            </div>

          </div>

          <div class="col-sm-12 col-md-9">

            <div class="row">

              <x-form.input grid="col-sm-12 col-md-6" lblClass="required" lblText="Student Name" type="text"
                name="txtModalStudentName"></x-form.input>

              <x-form.input grid="col-sm-12 col-md-3" lblClass="required" lblText="Enrollment Number Number"
                type="text" name="txtModalEnrollmentNumber"></x-form.input>

              <x-form.input grid="col-sm-12 col-md-3" lblClass="required" lblText="Roll Number" type="text"
                name="txtModalRollNo"></x-form.input>
            </div>
            <hr>
            <div class="col-sm-12 col-md-12 bg-secondary">
              <h6 class="text-warning text-uppercase text-center">Admission Details</h6>
            </div>
            <x-table.table id="tblModalAdmissionDetails" :tableHeaders="['Enrollment Number', 'Roll Number', 'Academic Year', 'Grade', 'Admission Date', 'Action']">
              <x-table.table-body>

              </x-table.table-body>
            </x-table.table>
          </div>
        </div>
      </x-modal.modal-body>
    </x-form.form>
  </x-modal.modal>

  <x-slot name="script">
    {{-- <script src="{{ asset('admin_assets/plugins/jquery_ui_info/jquery-ui.min.js') }}"></script> --}}
    <script>
      // Course Change Function


      var courseId, batchId;

      $(document).ready(function() {

        // COURSE CHANGE
        $(document).on("change", "#cmbCourse", function() {

          courseId = $('option:selected', this).val();

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
              $('.loading').hide();
              $.each(response, function(i, v) {
                $('#cmbBatch').append('<option value=' + v.id + '>' + v.title + '</option>');
              });
              $('#cmbBatch').val(null).trigger('change');
            }
          });

        });

        $(document).on("change", "#cmbBatch", function() {

          courseId = $('option:selected', '#cmbCourse').val();
          batchId = $('option:selected', '#cmbBatch').val();

          if (batchId > 0) {
            $.ajax({
              type: "POST",
              url: "{{ url('admin/getGrade') }}",
              data: {
                courseId: courseId,
                batchId: batchId,
              },
              async: true,
              cache: false,
              dataType: 'json',
              beforeSend: function() {
                $('#cmbGrade').empty();
                $('.loading').show();
              },
              success: function(response) {
                $('.loading').hide();
                $.each(response, function(idx, val) {
                  $('#cmbGrade').append('<option value=' + val.grade.id + ' >' + val.grade.title +
                    '</option>');
                });
                $('#cmbGrade').val(null).trigger('change')
              }
            });
          }
        })

        $(document).on("change", "#cmbGrade", function() {

          courseId = $('option:selected', '#cmbCourse').val();
          batchId = $('option:selected', '#cmbBatch').val();
          gradeId = $('option:selected', this).val();
          if (gradeId > 0) {
            $.ajax({
              type: "POST",
              url: "{{ url('admin/getAcademicYearFromGradeAndBatch') }}",
              data: {

                courseId: courseId,
                batchId: batchId,
                gradeId: gradeId,

              },
              beforeSend: function() {
                $("#tblFeeStructure tbody").empty();
                $('#cmbAcademicYear').empty();
                // $('.loading').show();
              },
              success: function(response) {
                $('.loading').hide();

                if (response.isActive == 1) {
                  $('#cmbAcademicYear').append('<option value=' + response
                    .fromAcademicYearId + ' selected>' + response
                    .fromAcademicYearTitle + '</option>');
                  $('#cmbAcademicYear').val(response.fromAcademicYearId).trigger(
                    'change');
                  // $("#cmbAcademicYear").prop("disabled", true);
                } else if (response.isActive == 0) {
                  toastr.error("Error: Check Academic Year");
                }

              }
            });
          }
        });

        $('#btnSearch').on('click', function(e) {

          e.preventDefault();

          if ($("#cmbBatch").val() == null) {
            toastr.error("Please Select Batch")
          } else if ($("#cmbGrade").val() == null) {
            toastr.error("Please Select Class")
          } else {
            fetchDataToTable();
          }

        });

        $(document).on("click", ".btnShowModalAdmissionRegister", function(e) {
          e.preventDefault();
          var studentId = $(this).data('id');

          $('.loading').show();

          $.get("{{ route('admin.student_profile.index') }}" + '/' + studentId + '/edit', function(data) {

            $('.loading').hide();
            var roll_no = data.enrollment_number.split("/")[0]

            $("#modalEditProfileTitle").html(data.student_name + "  ( " + data.enrollment_number + " )")

            // hidden Inputs



            var url = "{{ asset('storage/media/student_images') }}" + "/" + data
              .image_url +
              "?timestamp=" + new Date().getTime();


            if (data.image_url) {
              $('#preview').attr('src', url);
            } else {
              $('#preview').attr('src', "{{ asset('storage/media/web_images/student.png') }}");
            }

            $("#txtModalStudentName").val(data.student_name).prop("disabled", true)

            $("#txtModalEnrollmentNumber").val(data.enrollment_number)
            $("#txtModalEnrollmentNumber").prop("disabled", true);

            $("#txtModalRollNo").val(roll_no)

            $("#tblModalAdmissionDetails tbody").empty();

            $.each(data.admission_registers, function(i, v) {
              $("#tblModalAdmissionDetails tbody").append('<tr>' +
                '<td>' + v.enrollment_no + '</td>' +

                '<td>' + '<input type="input" class="form-control form-control-sm "  value="' + v
                .roll_no +
                '" + id="' + 'admissionRollNo_' +
                v.id + '"/></td>' +

                '<td>' + v.academic_year.year.title + '</td>' +
                '<td>' + v.grade.title + '</td>' +

                '<td>' + '<input type="input" value="' + moment(v.admission_date)
                .format("DD/MM/YYYY") +
                '" class="form-control form-control-sm " id="' + 'txtAdmissionDate_' +
                v.id +
                '"/></td>' +

                '<td>' +
                '<button type="button" class="btn btnSubmitAdmissionDetails" name="btnSubmitAdmissionDetails" data-toggle="tooltip" title="Update" data-id="' +
                v.id + '"><i class="fa-regular fa-pen-to-square"></i></button></td>' +
                '</tr>'
              )

              $("#txtAdmissionDate_" + v.id).datepicker({
                container: '#modalAdmissionRegister table tbody',
                changeMonth: true,
                changeYear: true,
                dateFormat: "dd/mm/yy",
                maxDate: '+0D',
                showAnim: 'slide',
                yearRange: "-50:+0",
                showButtonPanel: true,
                beforeShow: function(input, inst) {
                  $(document).off('focusin.bs.modal');
                },
                onClose: function() {
                  $(document).on('focusin.bs.modal');
                },
              });

            });

            $('[data-toggle="tooltip"]').tooltip();
            $("#modalAdmissionRegister").modal('show');
          })

        });

        $(document).on("click", ".btnSubmitAdmissionDetails", function(e) {
          e.preventDefault();

          var admissionRegisterId = $(this).data('id');
          var admissionRollNo = $("#admissionRollNo_" + admissionRegisterId).val();
          var admissionDate = $("#txtAdmissionDate_" + admissionRegisterId).val();

          $.ajax({
            type: "POST",
            url: "{{ route('admin.student_admission_register.store') }}",
            data: {
              admissionRegisterId: admissionRegisterId,
              admissionRollNo: admissionRollNo,
              admissionDate: admissionDate,
            },
            dataType: "json",
            async: true,
            beforeSend: function() {

            },
            success: function(response) {
              $("#modalAdmissionRegister").modal('hide');
              fetchDataToTable();
              $('.loading').show();
            }
          });
        });
      });

      function fetchDataToTable() {
        $.ajax({
          type: "GET",
          url: "{{ route('admin.student_admission_register.create') }}",
          data: $("#searchForm").serialize(),
          async: true,
          cache: false,
          dataType: 'json',
          beforeSend: function(xhr) {
            $("#tblStudentAdmissionRegister tbody").empty();
            $('.loading').show();
          },
          success: function(response) {
            $('.loading').hide();
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
                  '<button type="button" class="btn bg-indigo btnViewProfile" name="btnviewProfile" data-toggle="tooltip" title="View" data-id="' +
                  v.id + '"><i class="fa-regular fa-eye"></i></button>' +
                  '<button type="button" class="btn bg-pink btnShowModalAdmissionRegister" name="btnShowModalAdmissionRegister" data-toggle="tooltip" title="Edit" data-id="' +
                  v.id + '"><i class="fa-regular fa-pen-to-square"></i></button>' +
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
    </script>
  </x-slot>

</x-layouts.administrator.layout>
