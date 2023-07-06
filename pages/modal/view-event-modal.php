<div id="fullCalModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-calendar" aria-hidden="true"></i> EVENT DETAILS
                </h5>
                <!-- <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button> -->
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <div class="col-md-12"> 
                        <div id="imageDiv"> </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-3">
                                <h4>
                                    <i class="fa fa-calendar-check-o" style="color: #04401f"></i> Event:
                                </h4>   
                            </div>
                            <div class="col-md-8">
                                <h6 id="modalTitle" style="font-weight: bold; font-size: 18pt;"></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">&nbsp;
                                <h6>
                                    <i class="fa fa-calendar" style="color: #04401f;"></i> Date:
                                </h6>   
                            </div>
                            <div class="col-md-8">
                                <p id="modalBody"></p>
                                <p id="startTime"></p>
                                <p id="endTime"></p>    
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6>
                                    <i class="fa fa-map-marker" style="color: #04401f"></i> Location:
                                </h6>   
                            </div>
                            <div class="col-md-8" style="margin-top: 3px">
                                <p id="modalBodyLoc"></p>    
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-3">
                                <h6>
                                    <i class="fa fa-user" style="color: #04401f"></i> In-Charge:
                                </h6>   
                            </div>
                            <div class="col-md-8" style="margin-top: 3px">
                                <p id="modalBodyRec"></p>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>