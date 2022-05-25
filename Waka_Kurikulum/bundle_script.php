<!-- jQuery 2.1.4 -->
<script src="../aset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="../aset/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../aset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../aset/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../aset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../aset/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="../aset/dist/js/app.min.js"></script>
<!-- Daterange Picker -->
<script src="../aset/plugins/daterangepicker/moment.min.js"></script>
<script src="../aset/plugins/daterangepicker/daterangepicker.js"></script>
<script src="../aset/plugins/select2/select2.full.min.js"></script>
<script src="../aset/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- page script -->
<script>
	$(function() {
		// Daterange Picker
		$('#Tanggal_Lahir').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			format: 'YYYY-MM-DD'
		});

		// Data Table
		$("#data").dataTable({
			scrollX: true
		});
	});
</script>

<!-- Date Time Picker -->
<script>
	$(function() {
		$('#Jam_Mulai').datetimepicker({
			format: 'HH:mm'
		});

		$('#Jam_Selesai').datetimepicker({
			format: 'HH:mm'
		});
	});
</script>

<!-- Javascript Edit-->
<script type="text/javascript">
	$(document).ready(function() {

		// Dosen
		$(".open_modal").click(function(e) {
			var m = $(this).attr("id");
			$.ajax({
				url: "dosen_modal_edit.php",
				type: "GET",
				data: {
					kode_guru: m,
				},
				success: function(ajaxData) {
					$("#ModalEditDosen").html(ajaxData);
					$("#ModalEditDosen").modal('show', {
						backdrop: 'true'
					});
				}
			});
		});

		// Mahasiswa
		$(".open_modal").click(function(e) {
			var m = $(this).attr("id");
			$.ajax({
				url: "siswa_modal_edit.php",
				type: "GET",
				data: {
					NIS: m,
				},
				success: function(ajaxData) {
					$("#ModalEditMahasiswa").html(ajaxData);
					$("#ModalEditMahasiswa").modal('show', {
						backdrop: 'true'
					});
				}
			});
		});

		// Ruangan
		$(".open_modal").click(function(e) {
			var m = $(this).attr("id");
			$.ajax({
				url: "kelas_modal_edit.php",
				type: "GET",
				data: {
					id_kelas: m,
				},
				success: function(ajaxData) {
					$("#ModalEditRuangan").html(ajaxData);
					$("#ModalEditRuangan").modal('show', {
						backdrop: 'true'
					});
				}
			});
		});

		// Matakuliah
		$(".open_modal").click(function(e) {
			var m = $(this).attr("id");
			$.ajax({
				url: "pelajaran_modal_edit.php",
				type: "GET",
				data: {
					kode_pelajaran: m,
				},
				success: function(ajaxData) {
					$("#ModalEditMatakuliah").html(ajaxData);
					$("#ModalEditMatakuliah").modal('show', {
						backdrop: 'true'
					});
				}
			});
		});

		// Jurusan
		$(".open_modal").click(function(e) {
			var m = $(this).attr("id");
			$.ajax({
				url: "jurusan_modal_edit.php",
				type: "GET",
				data: {
					Kode_Jurusan: m,
				},
				success: function(ajaxData) {
					$("#ModalEditJurusan").html(ajaxData);
					$("#ModalEditJurusan").modal('show', {
						backdrop: 'true'
					});
				}
			});
		});

		// Jenjang
		$(".open_modal").click(function(e) {
			var m = $(this).attr("id");
			$.ajax({
				url: "jenjang_modal_edit.php",
				type: "GET",
				data: {
					Kode_Jenjang: m,
				},
				success: function(ajaxData) {
					$("#ModalEditJenjang").html(ajaxData);
					$("#ModalEditJenjang").modal('show', {
						backdrop: 'true'
					});
				}
			});
		});

		$(".open_modal").click(function(e) {
			var m = $(this).attr("id");
			$.ajax({
				url: "absensi_modal_edit.php",
				type: "GET",
				data: {
					id_presensi: m,
				},
				success: function(ajaxData) {
					$("#ModalEditAbsensi").html(ajaxData);
					$("#ModalEditAbsensi").modal('show', {
						backdrop: 'true'
					});
				}
			});
		});

		$(".open_modal").click(function(e) {
			var m = $(this).attr("id");
			$.ajax({
				url: "tagihan_modal_edit.php",
				type: "GET",
				data: {
					id_tagihan: m,
				},
				success: function(ajaxData) {
					$("#ModalEdittagihan").html(ajaxData);
					$("#ModalEdittagihan").modal('show', {
						backdrop: 'true'
					});
				}
			});
		});


		// Jadwal
		$(".open_modal").click(function(e) {
			var m = $(this).attr("id");
			$.ajax({
				url: "jadwal_modal_edit.php",
				type: "GET",
				data: {
					Id_Jadwal: m,
				},
				success: function(ajaxData) {
					$("#ModalEditJadwal").html(ajaxData);
					$("#ModalEditJadwal").modal('show', {
						backdrop: 'true'
					});
				}
			});
		});
	});

	$(".open_modal").click(function(e) {
		var m = $(this).attr("id");
		$.ajax({
			url: "pengumuman_modal_edit.php",
			type: "GET",
			data: {
				id_pengumuman: m,
			},
			success: function(ajaxData) {
				$("#ModalEditPengumuman").html(ajaxData);
				$("#ModalEditPengumuman").modal('show', {
					backdrop: 'true'
				});
			}
		});
	});

	$(".open_modal").click(function(e) {
		var m = $(this).attr("id");
		$.ajax({
			url: "nilai_modal_edit.php",
			type: "GET",
			data: {
				kode_nilai: m,
			},
			success: function(ajaxData) {
				$("#ModalEditNilai").html(ajaxData);
				$("#ModalEditNilai").modal('show', {
					backdrop: 'true'
				});
			}
		});
	});

	$(".open_modal").click(function(e) {
		var m = $(this).attr("id");
		$.ajax({
			url: "tugas_modal_edit.php",
			type: "GET",
			data: {
				kode_tugas: m,
			},
			success: function(ajaxData) {
				$("#ModalEditTugas").html(ajaxData);
				$("#ModalEditTugas").modal('show', {
					backdrop: 'true'
				});
			}
		});
	});

	$('#cek').mouseenter(function(){
			// if($(this).is(':checked')){
			// 	$('.checkboxx').attr('type','text');
			// }else{
			// 	$('.checkboxx').attr('type','password');
			// }

			$('.checkboxx').attr('type', 'text');
			

		});

		$('#cek').mouseleave(function(){
			$('.checkboxx').attr('type', 'password');
		});

	$(".open_modal").click(function(e) {
		var m = $(this).attr("id");
		$.ajax({
			url: "tagihan_modal_edit.php",
			type: "GET",
			data: {
				id_tagihan: m,
			},
			success: function(ajaxData) {
				$("#ModalEdittagihan").html(ajaxData);
				$("#ModalEdittagihan").modal('show', {
					backdrop: 'true'
				});
			}
		});
	});

	$(".open_modal").click(function(e) {
		var m = $(this).attr("id");
		$.ajax({
			url: "pengguna_modal_edit.php",
			type: "GET",
			data: {
				Id_User: m,
			},
			success: function(ajaxData) {
				$("#ModalEditUser").html(ajaxData);
				$("#ModalEditUser").modal('show', {
					backdrop: 'true'
				});
			}
		});
	});

	

	$('#cari_kelas').on('submit', function(event) {
		event.preventDefault();
		let nama_kelas = $('#cari_kelass').val();
		
		if (nama_kelas == '') {
			alert("pilih nama kelas");
		}  else {
			
			$.ajax({
				url: `tagihan_add_modal.php?kelas=${nama_kelas}`,
				method: "GET",
				data: {
					kelas: nama_kelas,
				},
				success: function(data) {
					$("#ModalAddCariKelas").html(data);
					$("#ModalAddCariKelas").modal('show', {
					backdrop: 'true'
					});
				},
				error: function(data) {
					console.log(data.responseText)
				}
			})
		}
	});
</script>

<!-- Javascript Delete -->
<script>
	function confirm_delete(delete_url) {
		$("#modal_delete").modal('show', {
			backdrop: 'static'
		});
		document.getElementById('delete_link').setAttribute('href', delete_url);
	}
</script>