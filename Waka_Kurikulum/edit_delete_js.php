<!-- Javascript Edit-->
<script type="text/javascript">
  $(document).ready(function() {

    // Dosen
    $(".open_modal").click(function(e) {
      var m = $(this).attr("id");

      $.ajax({
        url: "api_edit_guru.php",
        type: "GET",
        data: {
          kode_guru: m,
        },
        success: function(ajaxData) {

          $("#ModalEditDosen").html(ajaxData);

        }
      });
    });

    // Siswa
    $(".open_modal").click(function(e) {
      var m = $(this).attr("id");

      $.ajax({
        url: "api_edit_siswa.php",
        type: "GET",
        data: {
          kode_guru: m,
        },
        success: function(ajaxData) {

          $("#ModalEditSiswa").html(ajaxData);

        }
      });
    });
  });



  function confirm_delete(delete_url) {
    $("#modal_delete").modal('show', {
      backdrop: 'static'
    });

    document.getElementById('delete_link').setAttribute('href', delete_url);
  }
</script>