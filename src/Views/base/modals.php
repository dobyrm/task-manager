<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form class="needs-validation" novalidate>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=LANG_NEW_TASK?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="validationName"><?=LANG_NAME?></label>
                        <input type="text" class="form-control" id="validationName" value="" required>
                    </div>
                    <div class="col-md-6">
                        <label for="validationEmail"><?=LANG_EMAIL?></label>
                        <input type="text" class="form-control" id="validationEmail" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="validationDescription"><?=LANG_DESCRIPTION?></label>
                        <textarea class="form-control" id="validationDescription" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?=LANG_SAVE_CHANGES?></button>
            </div>
        </form>
    </div>
    </div>
</div>