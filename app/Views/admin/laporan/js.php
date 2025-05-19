<script type="text/javascript">
	var method;
	var url;
	$(function() {
		_getLaporan();
	});

	function _getLaporan() {
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
				"targets": [0, 1, 3, 4, 5, 6,],
				"orderable": false
			}, ],
			"columns": [{
					"data": "col1"
				},
				{
					"data": "col2"
				},
				{
					"data": "col3"
				},
				{
					"data": "col4"
				},
				{
					"data": "col5"
				},
				{
					"data": "col6"
				},
				{
					"data": "col7"
				},
				{
					"data": "col8"
				}
			],
			"ajax": "<?= site_url('Laporan/getData') ?>",
		});
	}

</script>
