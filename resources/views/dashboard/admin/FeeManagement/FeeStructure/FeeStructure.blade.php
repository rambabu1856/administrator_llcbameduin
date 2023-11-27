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

								<x-form.select2 grid="col-md-2" lblClass="required" lblText="Select Course" name="cmbCourse"
									:options="$course"></x-form.select2>

								<x-form.select2 grid="col-md-2" lblClass="required" lblText="Select Batch" name="cmbBatch"
									:options="[]"></x-form.select2>

							</div>

							<div class="input-group">
								<x-button.button grid="mb-3" type="button" btnClass="bg-primary mr-1" name="btnSearch"
									faClass="fa-regular fa-paper-plane mr-2" tooltip="Search" btnText="GET" dataId=""></x-button.button>

								<x-button.button grid="mb-3" type="button" btnClass="bg-danger mr-1 resetForm" name="btnAdmissionDetail"
									faClass="fa-solid fa-rotate mr-2" tooltip="Reset" btnText="RESET" dataId="">
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


	</x-slot>

	<x-slot name="script">


	</x-slot>

</x-layouts.administrator.layout>