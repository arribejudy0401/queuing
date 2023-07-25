<!-- search record per office -->
<?php
function office_record()
{

?>

  <form action="record-result.php" method="GET">

    <div class="d-flex text-muted hidden-print">

      <label for="date-from" class="p-2 fw-bold">From: </label>

      <input type="date" name="date-from" class="form-control" required>

      <label for="date-to" class="p-2 fw-bold">To: </label>

      <input type="date" name="date-to" class="form-control" required>

      <button class="btn btn-bg-main btn-bg-main-hover ms-1"><i class="fa-solid fa-search"></i></button>

    </div>

  </form>

<?php
}
?>