<script type="text/javascript">
	var method;
	var url;
	$(function() {
		_getKota();
	});

	function _getKota() {
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
				"targets": [0, 2],
				"orderable": false
			}, ],
			"columns": [{
					"data": "no"
				},
				{
					"data": "col1"
				},
				{
					"data": "col2"
				},
			],
			"ajax": "<?= site_url('Kota/getData') ?>",
		});
	}
</script>
