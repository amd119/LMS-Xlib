</section>
</div>
<footer class="main-footer">
<strong>Copyright &copy; 2024-2025 D-Dev - CIPAYUNG.</strong>
All rights reserved.
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>

<!-- sweetalert2 -->
<script src="{{ asset('/adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- jQuery -->
<script src=" {{ asset('/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/adminlte/js/adminlte.js') }}"></script>
@if(session('alert'))
<script>
Swal.fire({
  title: "<?= $data[1]; ?>",
  icon: "<?= $data[0]; ?>",
  showConfirmButton: false,
  timer:2000
});
</script>
@endif
<script>
$(function () {
$("#example1").DataTable({
  "responsive": true, "lengthChange": false, "autoWidth": false
}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>
</body>
</html>
