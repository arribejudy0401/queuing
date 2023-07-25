<!-- Modal -->
<div class="modal fade" id="addTransactionsModal" tabindex="-1" role="dialog" aria-labelledby="officeModal" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="addTransactionsModal">Add Transactions</h5>

                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true"><i class="fa fa-times"></i></span>

                </button>

            </div>

            <form action="" method="POST">

                <div class="modal-body">

                    <div class="d-flex">

                        <p></p>

                        <select name="office-name" id="" class="form-select  mb-2" required>

                            <option value="" selected disabled>--Please Choose--</option>

                            <?php
                            $select_office = "SELECT * FROM offices WHERE transaction_status = 'Continue' AND office_status = 'Active' AND office_name != 'Admin' AND office_name != 'Guard' ORDER BY office_name";

                            $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);

                            while ($row = mysqli_fetch_assoc($select_office_result)) {
                            ?>

                                <option value="<?= $row['office_name'] ?>"><?= $row['office_name'] ?></option>

                            <?php } ?>


                        </select>

                    </div>

                    <div class="d-flex">

                        <p></p>

                        <input type="Text" name="office-transactions" id="" class="form-control" placeholder="Enter Transactions" required>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-bg-main btn-bg-main-hover" name="add-transactions">Add</button>

                </div>

            </form>

        </div>

    </div>

</div>