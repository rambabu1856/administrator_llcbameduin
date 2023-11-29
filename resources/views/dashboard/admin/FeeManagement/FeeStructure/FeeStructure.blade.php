<x-layouts.administrator.layout>
  <x-slot name="css">
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/jquery_ui_info/jquery-ui.min.css') }}">
  </x-slot>

  <x-slot name="content">

    <x-layouts.administrator.content_header contentHeader="MANAGE FEE STRUCTURE">
    </x-layouts.administrator.content_header>

    <section class="content">
      <div class="container-fluid">

        {{-- SEARCH FORM --}}
        <x-card.card-heading heading="Set Fee for Current Academic Year" name="">

          <x-form.form action="" method="POST" name="searchForm">

            <x-card.card-body>
              <div class="row mb-3">
                <small class="text-danger">Note: First Create Academic Year for the class then Proceed if found
                  error. </small>
              </div>

              <div class="row">

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Select Fee Group Head"
                  name="cmbFeeGroupHead" :options="$fee_group_head">
                </x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Select Course" name="cmbCourse"
                  :options="$course">
                </x-form.select2>

                <x-form.select2 grid="col-md-3" lblClass="required" lblText="Select Batch" name="cmbBatch"
                  :options="[]"></x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Class" name="cmbGrade" :options="[]">
                </x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Academic Year" name="cmbAcademicYear"
                  :options="[]">
                </x-form.select2>


                <div class="col-sm-12 col-md-2">
                  <div class="input-group">
                    <x-button.button grid="mt-3" type="button" btnClass="bg-primary mr-1" name="btnSearch"
                      faClass="fa-regular fa-paper-plane mr-2" tooltip="Search" btnText="GET"
                      dataId=""></x-button.button>

                    <x-button.button grid="mt-3" type="button" btnClass="bg-danger mr-1 resetForm"
                      name="btnAdmissionDetail" faClass="fa-solid fa-rotate mr-2" tooltip="Reset" btnText="RESET"
                      dataId="">
                    </x-button.button>
                  </div>
                </div>

              </div>

            </x-card.card-body>
          </x-form.form>
        </x-card.card-heading>

        {{-- DATA TABLE --}}
        <div class="card">
          <x-card.card-body>

            <x-table.table id="tblFeeStructure" :tableHeaders="[
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


  </x-slot>

  <x-slot name="script">
    <script>
      $(document).ready(function() {

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

        $('#btnSearch').on('click', function() {

          // alert($('#cmbFeeGroupHead').val());

          $.ajax({
            type: "GET",
            url: "{{ route('admin.fee_structure.create') }}",
            data: {
              feeGroupHeadId: $('#cmbFeeGroupHead').val()
            },
            dataType: "json",
            success: function(response) {
              console.log(response);

            }
          });
        });

      });
    </script>

  </x-slot>

</x-layouts.administrator.layout>
