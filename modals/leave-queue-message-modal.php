<!-- Modal -->
<div class="modal fade" id="leaveQueueModal" tabindex="-1" role="dialog" aria-labelledby="departmentModal" aria-hidden="true">


    <?php
    $email = $_GET['e'];
    $office = $_GET['o'];
    $date = $_GET['date'];
    ?>

    <form action="registered-number.php?e=<?= $email ?>&o=<?= $office ?>&date=<?= $date ?>" method="POST">


        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="leaveQueueModalLabel"></h5>

                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true"><i class="fa fa-times"></i></span>

                    </button>

                </div>

                <div class="modal-body text-justify">

                    <h4>Are you sure you want to leave the queue? Remember your number will be cancelled automatically.</h4>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-bg-main btn-bg-main-hover" name="leave-btn">Yes</button>

                </div>

            </div>

        </div>

    </form>

</div>