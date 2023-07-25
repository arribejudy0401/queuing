<!-- Modal -->
<div class="modal fade" id="editTransactionModal<?= $transaction_id ?>" tabindex="-1" role="dialog" aria-labelledby="transactionModal" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="editTransactionModal<?= $transaction_id ?>">Edit transaction</h5>

                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true"><i class="fa fa-times"></i></span>

                </button>

            </div>

            <form action="" method="POST">

                <div class="modal-body">

                    <input type="hidden" name="transaction-id" value="<?= $transaction_id ?>">

                    <select name="office-name" id="" class="form-select mb-2" required>

                        <?php

                        $select_transaction = "SELECT * FROM transactions WHERE id = '$transaction_id'";

                        $select_transaction_result = mysqli_query($GLOBALS['connection'], $select_transaction);

                        while ($row = mysqli_fetch_assoc($select_transaction_result)) {


                            $select_office = "SELECT * FROM offices  WHERE transaction_status = 'Continue' AND office_status = 'Active' AND office_name != 'Admin' AND office_name != 'Guard'  ORDER BY office_name";

                            $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);

                            while ($rows = mysqli_fetch_assoc($select_office_result)) {

                        ?>

                                <option value="<?= $rows['office_name'] ?>" <?php if ($rows['office_name'] == $row['office_name']) { ?> selected <?php } ?>><?= $rows['office_name'] ?></option>

                            <?php } ?>

                    </select>

                    <input type="text" name="transaction" id="" class="form-control" placeholder="Enter transaction" value="<?= $row['transaction'] ?>" required>

                <?php } ?>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-bg-main btn-bg-main-hover" name="edit-transaction">Edit</button>

                </div>

            </form>

        </div>

    </div>

</div>