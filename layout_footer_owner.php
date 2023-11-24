<!-- /.container-fluid -->
<footer class="footer text-center"> 2021 &copy; yonandah APP Laundry</footer>
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->



<!-- All Jquery -->
<!-- ============================================================== -->
<!-- <script src="assets/js/jquery-3.6.0.min.js"></script> -->
<!-- <script src="assets/plugins/bower_components/jquery/dist/jquery.min.js"></script> -->

<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<script src="assets/js/jquery.slimscroll.js"></script>

<script src="assets/js/waves.js"></script>

<!-- <script src="assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="assets/plugins/bower_components/counterup/jquery.counterup.min.js"></script> -->

<script src="assets/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
<script src="assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>

<!-- <script src="assets/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script> -->
<script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>

<script src="assets/js/dashboard1.js"></script>
<script src="assets/js/custom.min.js"></script>
<script src="assets/plugins/bower_components/toast-master/js/jquery.toast.js"></script>

<script>
    const inpFile = document.getElementById("inpFile");
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = previewContainer.querySelector(".image-preview__image");
    const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

    inpFile.addEventListener("change", function(){
        const file = this.files[0];

        if (file){
            const reader = new FileReader();

            previewDefaultText.style.display = "none";
            previewImage.style.display = "block";

            reader.addEventListener("load", function(){
                console.log(this);
                previewImage.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        }else {
            previewDefaultText.style.display = null;
            previewImage.style = null;
            previewImage.setAttribute("src", "");
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.editbtn').on('click', function() {
            $('#editmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children('td').map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id').val(data[0]);
            $('#update_proses').val(data[1]);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.deletebtn').on('click', function() {
            $('#deletemodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children('td').map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id').val(data[0]);
        });
    });
</script>
<script>
    $('.btn_hapus').on('click', () => {
        return confirm('Yakin Menghapus data ?');
    });
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        var t = $('#table').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [1, 'asc'] 
            ],
            "language": {
                "sProcessing": "Sedang memproses ...",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecord": "Maaf data tidak tersedia",
                "info": "Menampilkan _PAGE_ halaman dari _PAGES_ halaman",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "sSearch": "Cari",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            }
        });
        t.on('order.dt search.dt', function() {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();


    });
    $('#btn-refresh').on('click', () => {
        $('#ic-refresh').addClass('fa-spin');
        var oldURL = window.location.href;
        var index = 0;
        var newURL = oldURL;
        index = oldURL.indexOf('?');
        if (index == -1) {
            window.location = window.location.href;

        }
        if (index != -1) {
            window.location = oldURL.substring(0, index)
        }

    });
</script>

<?php if ($_GET['crud'] == 'true') : ?>
    <script type="text/javascript">
        var title = "<?php echo $_GET['title'] ?>";
        var msg = "<?php echo $_GET['msg'] ?>";
        var type = "<?php echo $_GET['type'] ?>";
        $.toast({
            heading: title,
            text: msg,
            position: 'top-right',
            loaderBg: '#fff',
            icon: type,
            hideAfter: 3500,
            stack: 6
        })
    </script>
<?php endif; ?>

<script>
    $(document).on("click", "#tombolUbah", function() {
        let id = $(this).data('id');
        let proses = $(this).data('proses');

        $("#id_laundry").val(($this).data(id));
        $(".modal-body #proses_laundry").val(($this).data(proses));
    });
</script>
</body>

</html>