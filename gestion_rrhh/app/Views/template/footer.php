
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo base_url('logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<?php if (isset($section) && $section === 'dashboard'): ?>
    <!-- Page level plugins -->
    <script src="<?php echo base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url('assets/'); ?>js/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/demo/chart-pie-demo.js"></script>
<?php endif; ?>
    <script src="<?php echo base_url('assets/'); ?>js/logueo.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/filterTable.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/jsRegister.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/jsModulesPermisos.js"></script>
    <script src='<?php echo base_url('assets/');?>js/message.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <?php if (isset($section) && $section === 'asistenciaUser'): ?>
    <!-- Calendario -->
    
    <script src='<?php echo base_url('assets/');?>calendar/fullcalendar/packages/core/main.js'></script>
    <script src='<?php echo base_url('assets/');?>calendar/fullcalendar/packages/interaction/main.js'></script>
    <script src='<?php echo base_url('assets/');?>calendar/fullcalendar/packages/daygrid/main.js'></script>
    <script src='<?php echo base_url('assets/');?>calendar/fullcalendar/packages/timegrid/main.js'></script>
    <script src='<?php echo base_url('assets/');?>calendar/fullcalendar/packages/list/main.js'></script>
    <script src='<?php echo base_url('assets/');?>js/jscalendar.js'></script>
    <?php endif; ?>
    

    <script>
        
        var nuevaAsis = '<?php echo base_url('/nuevaAsis'); ?>';
        var finAsis = '<?php echo base_url('/finAsis'); ?>';
        var horasTrab = '<?php echo base_url('/workHours'); ?>';
        var allAsist = '<?php echo base_url('/asistenciaUserAll'); ?>';
        var finalizarCompraUrl = '<?php echo base_url('/nuevoUser'); ?>';
        var permisos = '<?php echo base_url('/getPermisos'); ?>';
        var updatePermisos = '<?php echo base_url('/updatePermisos'); ?>';
        var allUsrDate = '<?php echo base_url('/allusr'); ?>';
        var sendNoti = '<?php echo base_url('/sendNoti'); ?>';
        var leida = '<?php echo base_url('/marcarLeida'); ?>';
        var getMessageCount = '<?php echo base_url('/getMessageCount'); ?>';
        var getNotCount = '<?php echo base_url('/getNotCount'); ?>';
        var getNoti = '<?php echo base_url('/getNot'); ?>';
        var getAllMessage = '<?php echo base_url('/getAllMessage'); ?>';
        var newNoti = '<?php echo base_url('/newNoti'); ?>';
    </script>
    
</body>

</html>