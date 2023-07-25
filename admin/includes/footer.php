</main>
<!-- jquery -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery-3.5.1.js"></script>

<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<!-- data table js -->
<script src="assets/js/jquery.dataTables.min.js"></script>

<script src="assets/js/dataTables.bootstrap5.min.js"></script>

<script src="assets/js/dataTables.responsive.min.js"></script>

<script src="assets/js/dataTables.buttons.min.js"></script>

<!-- execute data table -->
<script>
  $(document).ready(function() {
    $('#table').DataTable({
      responsive: false
    });

    $('table.display').DataTable();

    $('#error').modal('show');
  });
</script>

</body>

</html>