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
        <x-card.card-heading heading="Filter" name="">

          <x-form.form action="" method="POST" name="searchForm">

            <x-card.card-body>

              <div class="row">

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Select Fee Group Head" name="cmbFeeGroupHead" :options="$fee_group_head">
                </x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Select Course" name="cmbCourse" :options="$course">
                </x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Select Batch" name="cmbBatch" :options="[]">
                </x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Class" name="cmbFromGrade" :options="$grade">
                </x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Academic Year" name="cmbFromAcademicYear" :options="[]">
                </x-form.select2>
              </div>
              <div class="row">

                <x-form.select2 grid="col-md-2 offset-md-6" lblClass="required" lblText="Set Fee For Class" name="cmbToGrade" :options="[]">
                </x-form.select2>

                <x-form.select2 grid="col-md-2" lblClass="required" lblText="Set Fee For Academic Year" name="cmbToAcademicYear" :options="[]">
                </x-form.select2>


                <div class="col-sm-12 col-md-2">
                  <div class="input-group">
                    <x-button.button grid="mt-3" type="button" btnClass="bg-primary mr-1" name="btnSearch" faClass="fa-regular fa-paper-plane mr-2" tooltip="Search" btnText="GET" dataId=""></x-button.button>

                    <x-button.button grid="mt-3" type="button" btnClass="bg-danger mr-1 resetForm" name="btnAdmissionDetail" faClass="fa-solid fa-rotate mr-2" tooltip="Reset" btnText="RESET" dataId="">
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
              id: courseId,
              isActive: 1,
            },
            beforeSend: function() {
              $("#tblFeeStructure tbody").empty();
              $('#cmbBatch').empty();
              $('.loading').show();
            },
            success: function(response) {
              $('.loading').hide();
              $.each(response, function(i, v) {
                $('#cmbBatch').append('<option value=' + v.id + '>' + v.title + '</option>');
              });
              $('#cmbBatch').val(null);
            }
          });

        });

        $(document).on("change", "#cmbFromGrade", function() {

          courseId = $('option:selected', '#cmbCourse').val();
          batchId = $('option:selected', '#cmbBatch').val();
          gradeId = $('option:selected', this).val();

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
              $('#cmbFromAcademicYear').empty();
              // $('.loading').show();
            },
            success: function(response) {
              $('.loading').hide();
              console.log(response);

              $('#cmbFromAcademicYear').append('<option value=' + response.fromAcademicYearId + ' selected>' + response.fromAcademicYearTitle + '</option>');


              // Below mentioned Selectd options Used to Create Fee Structure
              $('#cmbToGrade').append('<option value=' + response.toGradeId + ' selected>' + response.toGradeTitle + '</option>');


              $('#cmbToAcademicYear').append('<option value=' + response.toAcademicYearId + ' selected>' + response.toAcademicYearTitle + '</option>');

              // This set attribute to Disable to avouid error and keystrokes;
              $('#cmbFromAcademicYear').val(response.fromAcademicYearId).trigger('change');
              $("#cmbFromAcademicYear").prop("disabled", true);

              $('#cmbToGrade').val(response.toGradeId).trigger('change');
              $("#cmbToGrade").prop("disabled", true);

              $('#cmbToAcademicYear').val(response.toAcademicYearId).trigger('change');
              $("#cmbToAcademicYear").prop("disabled", true);



            }
          });

        });

      });
    </script>

  </x-slot>

</x-layouts.administrator.layout>