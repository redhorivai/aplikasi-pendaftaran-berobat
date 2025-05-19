<script type="text/javascript">
	$(function() {
		$('#katakunci').on('keypress', function(e) {
			if (e.which === 13) { // 13 = Enter
				e.preventDefault();
				_cariData();
			}
		});
	});

	function _cariData() {
		var katakunci = $("#katakunci").val();
		if (katakunci) {
			$('#formData').empty().removeClass('d-none');
			$.ajax({
				url: "<?= site_url('Biodata/getData') ?>",
				type: "POST",
				data: {
					katakunci: katakunci,
				},
				success: function(response) {
					$('#formData').html(response);
					$('.select2').select2();
					// jika ada tombol Cari di dalam html baru,
					// bind ulang click/enter handler-nya
					bindCariEnter();
				},
			});
		} else {
			alert('Masukan No Rekam Medis')
		}
	}

	function bindCariEnter() {
		$('#katakunci').off('keypress').on('keypress', function(e) {
			if (e.which === 13) {
				e.preventDefault();
				_cariData();
			}
		});
	}

	function _tambahData() {
		$.ajax({
			url: "<?= site_url('Biodata/form_data') ?>",
			success: function(response) {
				$('#formData').html(response);
				// pastikan ditampilkan
				$('#formData').removeClass('d-none');
			},
			error: function() {
				alert('Gagal memuat form');
			}
		});
	}
	$(document).ready(bindCariEnter);

	function _updateData(id, nik) {
		var gelar_depan = $('#gelar_depan').val();
		var nama_lengkap = $('#nama_lengkap').val();
		var gelar_belakang = $('#gelar_belakang').val();
		var nik_val = $('#nik').val();
		var tgl_lahir = $('#tgl_lahir').val();
		var jenis_kelamin = $('#jenis_kelamin').val();
		var telepon = $('#telepon').val();
		var status = $('#status').val();
		var pekerjaan = $('#pekerjaan').val();
		var id_provinsi = $('#id_provinsi_' + id).val();
		var id_kota = $('#id_kota_' + id).val();
		var alamat = $('#alamat').val();
		var keterangan = $('#keterangan').val();
		if (confirm('Yakin data akan disimpan?')) {
			$.ajax({
				url: "<?= site_url('Biodata/update_data') ?>",
				type: 'POST',
				data: new FormData($('#form')[0]),
				dataType: 'JSON',
				contentType: false,
				processData: false,
				success: function(data) {
					if (data.sukses) {
						toastr.success('Data berhasil disimpan');
					}
					if (data.nik) {
						toastr.error('NIK: <b>' + nik_val + '</b> sudah ada, silakan coba yang lain');
					}
				},
				error: function() {
					alert('Gagal simpan');
				}
			});
		}
	}

	function _simpanData() {
		var gelar_depan = $('#gelar_depan').val();
		var nama_lengkap = $('#nama_lengkap').val();
		var gelar_belakang = $('#gelar_belakang').val();
		var nik = $('#nik').val();
		var tgl_lahir = $('#tgl_lahir').val();
		var jenis_kelamin = $('#jenis_kelamin').val();
		var telepon = $('#telepon').val();
		var status = $('#status').val();
		var pekerjaan = $('#pekerjaan').val();
		var id_provinsi = $('#id_provinsi').val();
		var id_kota = $('#id_kota').val();
		var alamat = $('#alamat').val();
		var keterangan = $('#keterangan').val();

		if (gelar_depan == "") {
			$("#gelar_depan").focus();
			$('#gelar_depan').addClass('is-invalid');
		} else {
			$('#gelar_depan').removeClass('is-invalid');
		}
		if (nama_lengkap == "") {
			$("#nama_lengkap").focus();
			$('#nama_lengkap').addClass('is-invalid');
		} else {
			$('#nama_lengkap').removeClass('is-invalid');
		}
		if (gelar_belakang == "") {
			$("#gelar_belakang").focus();
			$('#gelar_belakang').addClass('is-invalid');
		} else {
			$('#gelar_belakang').removeClass('is-invalid');
		}
		if (nik == "") {
			$("#nik").focus();
			$('#nik').addClass('is-invalid');
		} else {
			$('#nik').removeClass('is-invalid');
		}
		if (tgl_lahir == "") {
			$("#tgl_lahir").focus();
			$('#tgl_lahir').addClass('is-invalid');
		} else {
			$('#tgl_lahir').removeClass('is-invalid');
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
			$("#telepon").focus();
			$('#telepon').addClass('is-invalid');
		} else {
			$('#telepon').removeClass('is-invalid');
		}
		if (status == "") {
			$("#status + span").addClass("is-invalid");
			$("#status + span").focus(function() {
				$(this).addClass("is-invalid");
			});
		} else {
			$('#status').removeClass('is-invalid');
			$("#status + span").removeClass("is-invalid");
			$("#status + span").focus(function() {
				$(this).removeClass("is-invalid");
			});
		}
		if (pekerjaan == "") {
			$("#pekerjaan").focus();
			$('#pekerjaan').addClass('is-invalid');
		} else {
			$('#pekerjaan').removeClass('is-invalid');
		}
		if (id_provinsi == "") {
			$("#id_provinsi + span").addClass("is-invalid");
			$("#id_provinsi + span").focus(function() {
				$(this).addClass("is-invalid");
			});
		} else {
			$('#id_provinsi').removeClass('is-invalid');
			$("#id_provinsi + span").removeClass("is-invalid");
			$("#id_provinsi + span").focus(function() {
				$(this).removeClass("is-invalid");
			});
		}
		if (id_kota == "") {
			$("#id_kota + span").addClass("is-invalid");
			$("#id_kota + span").focus(function() {
				$(this).addClass("is-invalid");
			});
		} else {
			$('#id_kota').removeClass('is-invalid');
			$("#id_kota + span").removeClass("is-invalid");
			$("#id_kota + span").focus(function() {
				$(this).removeClass("is-invalid");
			});
		}
		if (confirm(`Yakin data akan disimpan?`)) {
			$.ajax({
				url: "<?= site_url('Biodata/simpan_data') ?>",
				type: 'POST',
				data: new FormData($('#form')[0]),
				dataType: 'JSON',
				contentType: false,
				processData: false,
				success: function(data) {
					if (data.sukses) {
						toastr.success('Data berhasil disimpan');
					}
					if (data.gagal) {
						toastr.error('NIK: <b>' + nik + '</b> sudah ada, silakan coba yang lain');
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
				}
			});
		}
	}
</script>
