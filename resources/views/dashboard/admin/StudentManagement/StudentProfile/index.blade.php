<x-layouts.administrator.layout>
  <x-slot name="css">

  </x-slot>

  <x-slot name="content">

    <x-layouts.administrator.content_header contentHeader="STUDENT PROFILE">

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

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Select Course" name="cmbCourse"
                  :options="$course"></x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Select Batch" name="cmbBatch"
                  :options="[]"></x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="" lblText="Select Gender" name="cmbGender"
                  :options="$gender"></x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="" lblText="Select Community" name="cmbCommunity"
                  :options="$community">
                </x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="" lblText="Is belogs to PwD category" name="cmbIsPwd"
                  :options="$is_active"></x-form.select2>

                <x-form.input grid="col-md-2" lblClass="" lblText="Search By Name / Enrl. No" type="text"
                  name="txtSearchBy" value=""></x-form.input>
              </div>

              <div class="input-group">
                <x-button.button grid="mb-3" type="button" btnClass="bg-primary mr-1" name="btnSearch"
                  faClass="fa-regular fa-paper-plane mr-2" tooltip="Search" btnText="GET"
                  dataId=""></x-button.button>

                <x-button.button grid="mb-3" type="button" btnClass="bg-danger mr-1 resetForm"
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

            <x-table.table id="tblStudentProfile" :tableHeaders="[
                'Sl No',
                'Enrollment No',
                'Univ. Regd. No',
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

    <x-modal.modal id="modalEditProfile" modalSize="modal-xl">

      <x-modal.modal-title id="modalEditProfileTitle"></x-modal.modal-title>

      <x-form.form action="" method="POST" name="modalEditProfileForm">

        <x-modal.modal-body>

          <input type="hidden" name="txtModalStudentId" id="txtModalStudentId">
          <input type="hidden" name="txtmodalImageUrl" id="txtmodalImageUrl">

          <div class="col-sm-12 col-md-12 bg-secondary">
            <h6 class="text-warning text-uppercase text-center">Student Profile</h6>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-12 col-md-3">

              <div class="col-md-12 text-center">

                <img id="preview" src="{{ asset('storage/media/web_images/student.png') }}" alt="Student Image"
                  class="img-thumbnail" style="min-height: 220px;" />

                <label class="btn btn-block btn-success mt-1 text-sm">
                  <i class="fas fa-cloud-upload-alt mr-2"></i> Browse <input type="file" name="student_image"
                    id="student_image" hidden>
                </label>
              </div>

            </div>
            <div class="col-sm-12 col-md-9">
              <div class="row">

                <x-form.select2 grid="col-sm-12 col-md-3" lblClass="required" lblText="Campus" name="cmbModalCampus"
                  :options="$campus" selectedOptionVariables="[]"></x-form.select2>

                <x-form.select2 grid="col-sm-12 col-md-3" lblClass="required" lblText="Department"
                  name="cmbModalDepartment" :options="$department"></x-form.select2>

                <x-form.select2 grid="col-sm-12 col-md-3" lblClass="required" lblText="Course" name="cmbModalCourse"
                  :options="$course"></x-form.select2>

                <x-form.select2 grid="col-sm-12 col-md-3" lblClass="required" lblText="Batch" name="cmbModalBatch"
                  :options="$batch"></x-form.select2>

              </div>

              <div class="row">

                <x-form.input grid="col-sm-12 col-md-2" lblClass="required" lblText="Roll Number" type="text"
                  name="txtModalRollNo"></x-form.input>

                <x-form.input grid="col-sm-12 col-md-2" lblClass="required" lblText="Admission Year" type="text"
                  name="txtModalEnrollmentYear"></x-form.input>

                <x-form.input grid="col-sm-12 col-md-2" lblClass="required" lblText="Registration Number"
                  type="text" name="txtModalRegistrationNumber"></x-form.input>

                <x-form.input grid="col-sm-12 col-md-2" lblClass="required" lblText="Registration Year"
                  type="text" name="txtModalRegistrationYear"></x-form.input>

                <x-form.input grid="col-sm-12 col-md-2" lblClass="" lblText="Exam Roll Number" type="text"
                  name="txtModalExaminationRollNumber"></x-form.input>

                <x-form.input grid="col-sm-12 col-md-2" lblClass="" lblText="Exam Regn. Year" type="text"
                  name="txtModalExaminationRollYear"></x-form.input>

              </div>

              <div class="row">

                <x-form.input grid="col-sm-12 col-md-12" lblClass="required" lblText="Student Name" type="text"
                  name="txtModalStudentName"></x-form.input>

              </div>

              <div class="row">
                <x-form.input grid="col-sm-12 col-md-4" lblClass="required" lblText="Father Name" type="text"
                  name="txtModalFatherName"></x-form.input>

                <x-form.input grid="col-sm-12 col-md-4" lblClass="required" lblText="Mother Name" type="text"
                  name="txtModalMotherName"></x-form.input>

                <x-form.input grid="col-sm-12 col-md-4" lblClass="" lblText="Guardian Name" type="text"
                  name="txtModalGuardianName"></x-form.input>
              </div>
            </div>
          </div>
          <div class="row">

            <x-form.input grid="col-sm-12 col-md-3" lblClass="required" lblText="Fee Receipt Date" type="text"
              name="txtModalDateOfBirth" value=""></x-form.input>

            <x-form.select2 grid="col-sm-12 col-md-3" lblClass="required" lblText="Gender" name="cmbModalGender"
              :options="$gender"></x-form.select2>

            <x-form.select2 grid="col-sm-12 col-md-3" lblClass="required" lblText="Community"
              name="cmbModalCommunity" :options="$community"></x-form.select2>

            <x-form.select2 grid="col-sm-12 col-md-3" lblClass="required" lblText="Religion" name="cmbModalReligion"
              :options="$religion"></x-form.select2>
          </div>

          <div class="row">

            <x-form.select2 grid="col-sm-12 col-md-3" lblClass="required" lblText="Blood Group"
              name="cmbModalBloodGroup" :options="$bloodGroup"></x-form.select2>

            <x-form.select2 grid="col-sm-12 col-md-3" lblClass="required" lblText="Mother Tongue"
              name="cmbModalMotherTongue" :options="$motherTongue"></x-form.select2>

            <x-form.select2 grid="col-sm-12 col-md-3" lblClass="required" lblText="Nationality"
              name="cmbModalNationality" :options="$nationality"></x-form.select2>

            <x-form.select2 grid="col-sm-12 col-md-3" lblClass="required" lblText="Is PwD" name="cmbModalIsPwd"
              :options="$is_active"></x-form.select2>

          </div>


          <hr>
          <div class="row">

            <div class="col-sm-12 col-md-6">
              <div class="col-sm-12 col-md-12 bg-secondary">
                <h6 class="text-warning text-uppercase mt-2 text-center">Local Address</h6>
              </div>
              <div class="row">

                <x-form.input grid="col-sm-12 col-md-12" type="text" lblClass="required"
                  lblText="Local Addrsss L1" type="text" name="txtModalLocalAddressL1" />

                <x-form.input grid="col-sm-12 col-md-12" type="text" lblClass="" lblText="Local Addrsss L2"
                  type="text" name="txtModalLocalAddressL2" />

                <x-form.input grid="col-sm-12 col-md-12" type="text" lblClass="required"
                  lblText="Post Office (Local)" name="txtModalLocalPostOffice" />

                <x-form.input grid="col-sm-12 col-md-12" type="text" lblClass="required"
                  lblText="District (Local) " name="txtModalLocalDistrict" />

                <x-form.input grid="col-sm-12 col-md-12" type="text" lblClass="required" lblText="State (Local)"
                  name="txtModalLocalState" />

                <x-form.input grid="col-sm-12 col-md-12" type="text" lblClass="required" lblText="Pin (Local)"
                  name="txtModalLocalPin" />
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="col-sm-12 col-md-12 bg-secondary">
                <h6 class="text-warning text-uppercase mt-2 text-center">Permanent Address</h6>
              </div>
              <div class="row">

                <x-form.input grid="col-sm-12 col-md-12" type="text" lblClass="required"
                  lblText="Permanent Addrsss L1" type="text" name="txtModalPermanentAddressL1" />

                <x-form.input grid="col-sm-12 col-md-12" type="text" lblClass=""
                  lblText="Permanent Addrsss L2" type="text" name="txtModalPermanentAddressL2" />

                <x-form.input grid="col-sm-12 col-md-12" type="text" lblClass="required"
                  lblText="Post Office (Permanent)" name="txtModalPermanentPostOffice" />

                <x-form.input grid="col-sm-12 col-md-12" type="text" lblClass="required"
                  lblText="District (Permanent) " name="txtModalPermanentDistrict" />

                <x-form.input grid="col-sm-12 col-md-12" type="text" lblClass="required"
                  lblText="State (Permanent)" name="txtModalPermanentState" />

                <x-form.input grid="col-sm-12 col-md-12" type="text" lblClass="required"
                  lblText="Pin (Permanent)" name="txtModalPermanentPin" />

              </div>
            </div>
          </div>

          <div class="row">

            <x-form.input grid="col-sm-12 col-md-6" lblClass="required" lblText="Email" type="email"
              name="txtModalEmail"></x-form.input>

            <x-form.input grid="col-sm-12 col-md-3" lblClass="required" lblText="Phone Number" type="text"
              name="txtModalPhoneNumber" minlength="10" maxlength="10"></x-form.input>

            <x-form.input grid="col-sm-12 col-md-3" lblClass="" lblText="Phone Number" type="text"
              name="txtModalPhoneNumberOther" minlength="10" maxlength="10"></x-form.input>

          </div>
          <hr>

          {{-- Admission Details Table --}}
          <div class="col-sm-12 col-md-12 bg-secondary">
            <h6 class="text-warning text-uppercase text-center">Admission Register</h6>
          </div>
          <x-table.table id="tblModalAdmissionDetails" :tableHeaders="['Enrollment Number', 'Roll Number', 'Academic Year', 'Grade', 'Admission Date']">
            <x-table.table-body>

            </x-table.table-body>
          </x-table.table>

          <hr>

          {{-- Examination Details Table --}}
          <div class="col-sm-12 col-md-12 bg-secondary">
            <h6 class="text-warning text-uppercase text-center">Examination Details</h6>
          </div>
          <x-table.table id="tblModalExaminationDetails" :tableHeaders="['Enrollment Number1', 'Roll Number', 'Academic Year', 'Grade', 'Admission Date']">
            <x-table.table-body>

            </x-table.table-body>
          </x-table.table>
        </x-modal.modal-body>

        <x-modal.modal-footer name="btnModalSubmitStudentProfileForm">

        </x-modal.modal-footer>

      </x-form.form>
    </x-modal.modal>

  </x-slot>

  <x-slot name="script">

    <script>
      // Course Change Function

      var courseId, batchId;

      $(document).ready(function() {


        $("#txtModalDateOfBirth").datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: "dd/mm/yy",
          showButtonPanel: true,
          yearRange: "-100:+0",
          maxDate: "+0D",
          showAnim: 'slide',
          beforeShow: function(input, inst) {
            $(document).off('focusin.bs.modal');
          },
          onClose: function() {
            $(document).on('focusin.bs.modal');
          },
        });

        // COURSE CHANGE
        $(document).on("change", "#cmbCourse", function() {

          courseId = $('option:selected', this).val();
          $("#tblStudentProfile tbody").empty();
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
                $('#cmbBatch').append('<option value=' + v.id + '>' + v
                  .title + '</option>');
              });
              $('#cmbBatch').val(null);
            }
          });

        });

        $('#btnSearch').on('click', function(e) {
          if ($("#cmbCourse").val() == null || $("#cmbCourse").val() == "") {
            toastr.error("Please Select Course")
          } else if ($("#cmbBatch").val() == null) {
            toastr.error("Please Select Batch")
          } else {
            fetchDataToTable();
          }
        });

        $(document).on("click", ".btnEditProfile", function(e) {
          //   e.preventDefault();
          var studentId = $(this).data('id');
          $('#preview').attr('src', "{{ asset('storage/media/web_images/student.png') }}");
          $.get("{{ route('admin.student_profile.index') }}" + '/' + studentId + '/edit', function(
            data) {

            var roll_no = data.enrollment_number.split("/")[0]
            var admission_year = data.enrollment_number.split("/")[1]

            if (data.examination_roll_number == 0) {
              var examRollNumber = ""
              var examRollYear = ""
            } else {
              var examRollNumber = data.examination_roll_number
              var examRollYear = data.examination_roll_number_year
            }

            $("#modalEditProfileTitle").html(data.student_name + "  ( " + data
              .enrollment_number + " )")

            $("#txtModalStudentId").val(data.id)
            $("#txtmodalImageUrl").val(data.image_url)


            var url = "{{ asset('storage/media/student_images') }}" + "/" + data
              .image_url +
              "?timestamp=" + new Date().getTime();

            urlExists(url, function(success) {

              if (success) {
                $('#preview').attr('src', url);
              } else {
                $('#preview').attr('src',
                  "{{ asset('storage/media/web_images/student.png') }}");
              }
            });

            $("#cmbModalCampus").val(data.campus_id).trigger('change')
            $("#cmbModalDepartment").val(data.department_id).trigger('change')
            $("#cmbModalCourse").val(data.course_id).trigger('change')
            $("#cmbModalBatch").val(data.batch_id).trigger('change')
            $("#cmbModalGender").val(data.gender_id).trigger('change')
            $("#cmbModalCommunity").val(data.community_id).trigger('change')
            $("#cmbModalReligion").val(data.religion_id).trigger('change')
            $("#cmbModalBloodGroup").val(data.blood_group_id).trigger('change')
            $("#cmbModalMotherTongue").val(data.mother_tongue_id).trigger('change')
            $("#cmbModalNationality").val(data.nationality_id).trigger('change')
            $("#cmbModalIsPwd").val(data.is_pwd).trigger('change')

            $("#txtModalRollNo").val(roll_no)
            $("#txtModalEnrollmentYear").val(admission_year)

            $("#txtModalRegistrationNumber").val(data.registration_number)
            $("#txtModalRegistrationYear").val(data.registration_year)

            $("#txtModalExaminationRollNumber").val(examRollNumber)
            $("#txtModalExaminationRollYear").val(examRollYear)

            $("#txtModalStudentName").val(data.student_name)
            $("#txtModalFatherName").val(data.father_name)
            $("#txtModalMotherName").val(data.mother_name)

            $('input[name=txtModalDateOfBirth]').val(moment(data.date_of_birth).format(
              "DD/MM/YYYY"));

            $("#txtModalEmail").val(data.email_id)
            $("#txtModalPhoneNumber").val(data.phone_no)
            $("#txtModalPhoneNumberOther").val(data.phone_no_other)

            $("#txtModalLocalAddressL1").val(data.local_address_l1)
            $("#txtModalLocalAddressL2").val(data.local_address_l2)
            $("#txtModalLocalPostOffice").val(data.local_po_name)
            $("#txtModalLocalDistrict").val(data.local_district)
            $("#txtModalLocalState").val(data.local_state)
            $("#txtModalLocalPin").val(data.local_pin)

            $("#txtModalPermanentAddressL1").val(data.permanent_address_l1)
            $("#txtModalPermanentAddressL2").val(data.permanent_address_l2)
            $("#txtModalPermanentPostOffice").val(data.permanent_po_name)
            $("#txtModalPermanentDistrict").val(data.permanent_district)
            $("#txtModalPermanentState").val(data.permanent_state)
            $("#txtModalPermanentPin").val(data.permanent_pin)

            $("#tblModalAdmissionDetails tbody").empty();

            $.each(data.admission_registers, function(i, v) {

              $("#tblModalAdmissionDetails tbody").append('<tr>' +
                '<td>' + v.enrollment_no + '</td>' +
                '<td>' + v.roll_no + '</td>' +
                '<td>' + v.academic_year.year.title + '</td>' +
                '<td>' + v.grade.title + '</td>' +
                '<td>' + moment(v.admission_date).format("DD/MM/YYYY") +
                '</td>' +
                '</tr>'
              )

            });

            $("#tblModalExaminationDetails tbody").empty();

            $("#modalEditProfile").modal('show');
          })

        });

        $(document).on("click", "#btnModalSubmitStudentProfileForm", function(e) {
          e.preventDefault();

          $.ajax({
            type: "POST",
            url: "{{ route('admin.student_profile.store') }}",
            data: $("#modalEditProfileForm").serialize(),
            dataType: "json",
            async: true,
            beforeSend: function() {
              $('.loading').show();
            },
            success: function(response) {
              fetchDataToTable()
              $("#modalEditProfile").modal('hide');
              $('.loading').show();
            }
          });

        });

      });

      function fetchDataToTable() {
        $.ajax({
          type: "GET",
          url: "{{ route('admin.student_profile.create') }}",
          data: $("#searchForm").serialize(),
          async: true,
          cache: false,
          dataType: 'json',
          beforeSend: function(xhr) {
            $("#tblStudentProfile tbody").empty();
            $('.loading').show();
          },
          success: function(response) {
            $('.loading').hide();
            var sl_no = 0;

            $.each(response, function(i, v) {

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

              $("#tblStudentProfile tbody").append('<tr>' +
                '<td>' + sl_no + '</td>' +
                '<td><span class="badge badge-success text-sm">' + v.enrollment_number +
                '</span></td>' +
                '<td>' + registration_number + '</td>' +

                '<td class="text-indigo">' + v.student_name +
                '<br><span class="text-teal">' + v
                .father_name + '</span>' + '<br><span class="text-pink">' + v
                .mother_name + '</span></td>' +

                '<td>' + v.gender.title + '</td>' +
                '<td>' + v.community.title + '</td>' +

                '<td>' + moment(v.date_of_birth).format("DD/MM/YYYY") + '</td>' +

                '<td><span class="badge badge-warning text-sm">' + is_pwd +
                '</span></td>' +
                '<td><span class="badge badge-danger text-sm">' + is_tc_withdrawn +
                '</span></td>' +
                '<td>' +
                '<div class="btn-group">' +
                '<button type="button" class="btn bg-indigo btnViewProfile" name="btnEditProfile" data-toggle="tooltip" title="View" data-id="' +
                v.id + '"><i class="fa-regular fa-eye"></i></button>' +
                '<button type="button" class="btn bg-pink btnEditProfile" name="btnEditProfile" data-toggle="tooltip" title="Edit" data-id="' +
                v.id + '"><i class="fa-regular fa-pen-to-square"></i></button>' +
                '</div>' +
                '</td>' +
                '</tr>'
              )
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

      // RESET MODAL ON POPUP
      function resetModal() {
        $("#modalEditProfile select").val(null).trigger("change");
        $('#modalEditProfile').trigger("reset");
      }

      $(".resetForm").click(function(e) {
        $("form select").val(null).trigger("change");
        $('form').trigger("reset");
      })
    </script>
  </x-slot>

</x-layouts.administrator.layout>
