    <script> const base_url = "<?= base_url(); ?>";</script>
    
    <!-- Essential javascripts for application to work-->
    <!-- Essential javascripts for application to work-->
    <!-- Essential javascripts for application to work-->
    <script src="<?= Assets(); ?>/js/plugins/jquery-3.3.1.min.js"></script>
    <script src="<?= Assets(); ?>/js/plugins/popper.min.js"></script>
    <script src="<?= Assets(); ?>/js/plugins/bootstrap.min.js"></script>
    <script src="<?= Assets(); ?>/js/main.js"></script>
    <script src="<?= Assets(); ?>/js/function-admin.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= Assets(); ?>/js/plugins/pace.min.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="<?= Assets(); ?>/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= Assets(); ?>/js/plugins/dataTables.bootstrap.min.js"></script>
    <!-- page specific javascript notification -->
    <script type="text/javascript" src="<?= Assets(); ?>/js/plugins/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?= Assets(); ?>/js/plugins/bootstrap-select.js"></script>
    <!-- botones de exportacion -->
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

    <script src="<?= Assets(); ?>/js/<?= $data['function_js'] ?>"></script>

    </body>
</html>