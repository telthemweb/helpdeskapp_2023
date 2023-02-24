<div class="container-fluid mt-lg-5 px-xl-5">
        <div class="row justify-content-center mb-lg-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="card-title text-white">UPDATE TICKET</h5>
                    </div>
                    <div class="card-body">
                        <div class="py-1">
                        <form action="<?php route('/company/ticket/u/'.$ticket->id) ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                    <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="title" value="<?php echo $ticket->title; ?>"
                                        required="required" id="title">
                            </div>
                        </div>
                        <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="description" value="<?php echo $ticket->description; ?>" id="description">
                                    </div>
                                </div>
                        <div class="form-group">
                            <select class="form-control" name="priority" id="priority">
                                <option value="<?php echo $ticket->priority; ?>" disabled selected><?php echo $ticket->priority; ?></option>
                                <option value="Normal">Normal</option>
                                <option value="High">High</option>
                                <option value="Extremely">Extremely High</option>
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <label for="">Expected Date to Complete</label>
                        <input type="date" class="form-control pl-3" name="expectedcompleted" value="<?php echo $ticket->expectedcompleted; ?>" id="ticketdocs">
                        </div>
                        <div class="float-lg-right">
                            <div class="">
                                <button type="submit" class="btn btn-primary login-btn btn-block">SUBMIT</button>
                            </div>
                        </div>
                    </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
