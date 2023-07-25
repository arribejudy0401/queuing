<!-- Modal -->
<div class="modal fade" id="editOfficeModal<?= $office_id ?>" tabindex="-1" role="dialog" aria-labelledby="officeModal" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="editOfficeModal<?= $office_id ?>">Edit Office</h5>

                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true"><i class="fa fa-times"></i></span>

                </button>

            </div>

            <form action="" method="POST">

                <div class="modal-body">

                    <input type="hidden" name="office-id" value="<?= $office_id ?>">

                    <?php

                    $select_office = "SELECT * FROM offices WHERE id = '$office_id'";

                    $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);

                    while ($row = mysqli_fetch_assoc($select_office_result)) {

                    ?>

                        <input type="text" name="office-name" id="" class="form-control mb-2" placeholder="Enter office name" value="<?= $row['office_name'] ?>" required>

                        <input type="number" name="office-limit" id="" class="form-control" placeholder="Enter Limit" value="<?= $row['number_of_transaction'] ?>" required>

                    <?php } ?>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-bg-main btn-bg-main-hover" name="edit-office">Edit</button>

                </div>

            </form>

        </div>

    </div>

</div>