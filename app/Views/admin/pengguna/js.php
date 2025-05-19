<script type="text/javascript">
	var method;
	var url;
	$(function() {
		_getPengguna();
	});

	function _getPengguna() {
		$("#viewTable").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false,
			language: {
				searchPlaceholder: 'Cari...',
				sSearch: '',
				lengthMenu: '_MENU_',
				emptyTable: 'Tidak ada data'
			},
			"order": [],
			"columnDefs": [{
				"targets": [0, 2, 3, 4],
				"orderable": false
			}, ],
			"columns": [{
					"data": "no"
				},
				{
					"data": "name"
				},
				{
					"data": "user"
				},
				{
					"data": "level"
				},
				{
					"data": "action"
				},
			],
			"ajax": "<?= site_url('Pengguna/getData') ?>",
		});
	}

	function _btnDelete(id, username, nama) {
		if (confirm(`Apakah Anda Yakin Hapus Data ${nama} ?`)) {
			$.ajax({
				url: "<?= site_url('Pengguna/del_data') ?>",
				type: "POST",
				data: {
					id: id
				},
				dataType: "JSON",
				success: function(response) {
					if (response.sukses) {
						toastr.error(`anda telah menghapus akun <b>${nama}</b>`);
						$('#viewTable').DataTable().ajax.reload();
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
				},
			});
		}
	}

	function _tambahData() {
		method = 'save';
		$('.select2').select2();
		$('#modal-form').modal('show');
		$('#modal-title').text('Tambah Data');
	}

	function _simpanData() {
		if (method == "save") {
			url = "<?= site_url('Pengguna/insert_data') ?>";
		} else {
			url = "<?= site_url('Pengguna/update_data') ?>";
		}
		var nama 			= $("#nama").val();
		var jenis_kelamin 	= $("#jenis_kelamin").val();
		var telepon 		= $("#telepon").val();
		var email 			= $("#email").val();
		var username 		= $("#username").val();
		var level 			= $("#level").val();
		var status_user 	= $("#status_user").val();
		var alamat 			= $("#alamat").val();
		if (nama == "") {
			$("#nama").focus();
			$('#nama').addClass('is-invalid');
		} else {
			$('#nama').removeClass('is-invalid');
		}
		if (jenis_kelamin == "") {
			$("#jenis_kelamin + span").addClass("is-invalid");
			$("#jenis_kelamin + span").focus(function() {
				$(this).addClass("is-invalid");
			});
		} else {
			$('#jenis_kelamin').removeClass('is-invalid');
			$("#jenis_kelamin + span").removeClass("is-invalid");
			$("#jenis_kelamin + span").focus(function() {
				$(this).removeClass("is-invalid");
			});
		}
		if (telepon == "") {
			$('#telepon').addClass('is-invalid');
		} else {
			$('#telepon').removeClass('is-invalid');
		}
		if (email == "") {
			$('#email').addClass('is-invalid');
		} else {
			$('#email').removeClass('is-invalid');
		}
		if (username == "") {
			$('#username').addClass('is-invalid');
		} else {
			$('#username').removeClass('is-invalid');
		}
		if (level == "") {
			$("#level + span").addClass("is-invalid");
			$("#level + span").focus(function() {
				$(this).addClass("is-invalid");
			});
		} else {
			$('#level').removeClass('is-invalid');
			$("#level + span").removeClass("is-invalid");
			$("#level + span").focus(function() {
				$(this).removeClass("is-invalid");
			});
		}
		if (status_user == "") {
			$("#status_user + span").addClass("is-invalid");
			$("#status_user + span").focus(function() {
				$(this).addClass("is-invalid");
			});
		} else {
			$('#status_user').removeClass('is-invalid');
			$("#status_user + span").removeClass("is-invalid");
			$("#status_user + span").focus(function() {
				$(this).removeClass("is-invalid");
			});
		}
		if (confirm(`Yakin data akan disimpan?`)) {
			$.ajax({
				url: url,
				type: "POST",
				data: new FormData($('#form')[0]),
				dataType: 'JSON',
				contentType: false,
				processData: false,
				success: function(data) {
					if (data.status) {
						toastr.success(`data berhasil disimpan`);
						$('#modal-form').modal('hide');
						$('.form-data')[0].reset();
						$('#viewTable').DataTable().ajax.reload();
					}
					if (data.username) {
						toastr.error(`username: <b>${username}</b> sudah ada, silakan coba yang lain`);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert('Data wajib diisi');
				}
			});
		}
	}

	function _btnEdit(id, username, nama) {
		method = "edit";
		$.ajax({
			url: "<?= site_url('Pengguna/get_edit') ?>",
			type: 'GET',
			dataType: "JSON",
			data: {
				id: id
			},
			success: function(data) {
					$('[name=id]').val(data.id),
					$('[name=nama]').val(data.nama),
					$('[name=jenis_kelamin]').val(data.jenis_kelamin),
					$('[name=telepon]').val(data.telepon),
					$('[name=email]').val(data.email),
					$('[name=username]').val(data.username),
					$('[name=level]').val(data.level),
					$('[name=status_user]').val(data.status_user),
					$('[name=alamat]').val(data.alamat),
					$('.select2').select2();
					$('#modal-form').modal('show');
					$('#modal-title').text('Ubah Data');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error');
			}
		});
	}
</script>
