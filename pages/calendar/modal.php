<div class="modal fade" id="modal-event">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> Add New Event</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="calendarEvent">

                        <?= csrf_token(); ?>

                        <div class="form-group">
                            <div class="form-row">  
                                <div class="col-sm-12">
                                    <label for="inputName" class="">Title/Topic:</label>
                                    <textarea name="title" class="form-control" rows="4" required autofocus></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">  
                                <div class="col-sm-6">
                                    <label for="inputName" class="">Date Start:</label>
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="inputName" class="">Date End:</label>
                                    <input type="date" name="end_date" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-sm-12">
                                    <button type="submit" name="btn-submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> SAVE
                                    </button>

                                    <button type="reset" class="btn btn-warning">
                                        <i class="fa fa-refresh"></i> Reset
                                    </button>

                                    <button type="button" class="btn btn-success pull-right" data-dismiss="modal">
                                        <i class="fa fa-close"></i> Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
        </div>
    </div>
</div>