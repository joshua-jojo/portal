<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="<?= $path ?>assets/js/core/popper.min.js"></script>
<script src="<?= $path ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?= $path ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= $path ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="<?= $path ?>assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    // $('#tabel').DataTable();

    $('#tabel').DataTable({
        language: {
            'paginate': {
                'previous': '<span class="fa fa-arrow-left"></span>',
                'next': '<span class="fa fa-arrow-right"></span>'
            }
        }
    });
    $('#tabel2').DataTable({
        language: {
            'paginate': {
                'previous': '<span class="fa fa-arrow-left"></span>',
                'next': '<span class="fa fa-arrow-right"></span>'
            }
        }
    });

    // $('#tabel2').DataTable();
</script>
</body>

</html>