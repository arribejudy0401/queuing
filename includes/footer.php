<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- jquery -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery-3.5.1.js"></script>

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

    $('#error').modal('show');

  });
</script>

</body>

</html>