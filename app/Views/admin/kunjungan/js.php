<script type="text/javascript">
	$(document).ready(function() {
		// Inisialisasi DataTable
		var table = $('#viewTable').DataTable({
			responsive: true,
			lengthChange: false,
			autoWidth: false,
			language: {
				searchPlaceholder: 'Cari...',
				sSearch: '',
				lengthMenu: '_MENU_',
				emptyTable: 'Data kunjungan tidak ditemukan'
			},
			order: [],
			"columnDefs": [{
				"targets": [1],
				"orderable": false
			}, ],
			ajax: {
				url: "<?= site_url('Kunjungan/getData') ?>",
				type: 'POST',
				data: function(d) {
					d.katakunci = $('#katakunci').val();
				}
			},
			columns: [{
					data: 'col1'
				},
				{
					data: 'col2'
				},
			]
		});

		// Trigger pencarian ketika tekan Enter
		$('#katakunci').on('keypress', function(e) {
			if (e.which === 13) {
				e.preventDefault();
				table.ajax.reload();
			}
		});
	});

	$(function() {
		// 1. Inisialisasi Select2 di dalam modal
		$('.select2').select2({
			dropdownParent: $('#modal-form')
		});

		// 2. Tombol “Tambah Kunjungan”
		$('#btnTambah').on('click', function() {
			// reset form
			$('#formKunjungan')[0].reset();
			// reset Select2
			$('#no_rm, #type_kunjungan, #status_kondisi')
				.val(null)
				.trigger('change');

			// ubah judul modal
			$('#modal-form .modal-title')
				.text('Tambah Data Kunjungan');

			// tampilkan modal
			$('#modal-form').modal('show');
		});

		// 3. Simpan data (pastikan ada name="no_rm" di form)
		$('#btnSimpan').on('click', function() {
			var form = $('#formKunjungan')[0];
			if (!form.checkValidity()) {
				$(form).addClass('was-validated');
				return;
			}
			if (!confirm('Yakin data akan disimpan?')) return;

			var data = new FormData(form);
			$.ajax({
				url: "<?= site_url('Kunjungan/insert_data') ?>",
				type: "POST",
				data: data,
				contentType: false,
				processData: false,
				dataType: 'json',
				success: function(res) {
					if (res.status) {
						toastr.success('Data berhasil disimpan');
						$('#modal-form').modal('hide');
						$('#viewTable').DataTable().ajax.reload();
					}
				},
				error: function() {
					toastr.error('Terjadi kesalahan server');
				}
			});
		});
	});
</script>
