<div class="container-fluid px-xl-5 mt-5">
    <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
        New Ticket <i class="fa fa-user-plus"></i>
    </button>
    <div class="container user-list">
        <div class="row flex-lg-nowrap">
            <div class="col-lg-12">
                <div id="switchPoint" class="e-panel card">
                    <div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span>Support Ticket</span><small class="px-1"></small></h6>
                        </div>
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <tr>
                                        
                                        <th class="max-width">Code</th>
                                        <th class="max-width">Title</th>
                                        <th class="max-width">Priority</th>
                                        <th class="max-width">Company</th>
                                        <th class="max-width">Service level</th>
                                        <th class="max-width">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="practioner">
                                    <?php if(count($tickets)>0): ?>
                                    <?php
                                    $i =0; ?>
                                    <?php foreach ($tickets as $supticket): $i++; ?>
                                        <tr>
                                           
                                            <td><?php echo $supticket->ticket_number; ?></td>
                                            <td><?php echo $supticket->title; ?></td>
                                            <?php if($supticket->priority =="Normal"):?>
                                             <td class="text-success"><?php echo $supticket->priority; ?></td>
                                            <?php elseif($supticket->priority =="High"):?>
                                            <td class="text-warning"><b><?php echo $supticket->priority; ?></b></td>
                                            <?php elseif($supticket->priority =="Extremely"):?>
                                                <td class="text-danger"><b><?php echo $supticket->priority; ?></b></td>
                                            <?php endif;?>
                                            <td><?php echo $supticket->company->name; ?></td>

                                            <td><?php echo $supticket->company->category_id=="1"?"<b class='text-danger'>Service Level</b>":"<bclass='text-success'>Non Services</b>"; ?></td>

                                            <td><?php echo $supticket->status; ?></td>
                                           <td class="text-center">
                                               <a class="text-danger" data-toggle="tooltip" title="View Ticket"   href="<?php route('/ticket/v/'.$supticket->id); ?>">
                                                   <i class="fa fa-eye mr-3 text-success"></i>
                                               </a>
                                              
                                                <a class="text-danger" data-toggle="tooltip" title="Delete Ticket"   href="<?php route('/ticket/d/'.$supticket->id); ?>" >
                                                    <i class="fa fa-trash mr-3 text-red"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                    <?php else: ?>
                                        <td colspan="8" class="text-center"><b class="text-danger">No tickets yet!!</b></td>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
































<div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">CREATE TICKET</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/ticket/register') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="title" placeholder="Ticket Title"
                                               required="required" id="title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="description" placeholder="Short Description" id="description">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="company_id" id="company_id">
                                        <option value="" disabled selected>Select Company</option>
                                        <?php foreach ($companies as $cust){?>
                                            <option value="<?php echo $cust->id; ?>"><?php echo $cust->id.' | '.$cust->name; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="priority" id="priority">
                                        <option value="" disabled selected>Select Priority</option>
                                        <option value="Normal">Normal</option>
                                        <option value="High">High</option>
                                        <option value="Extremely">Extremely High</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="">Upload Image <b>[png|jpg]</b></label>
                                <input type="file" class="form-control pl-3" name="ticketimg" placeholder="Upload picture" id="ticketimg">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Upload Document <b>[docx|pdf]</b></label>
                                <input type="file" class="form-control pl-3" name="ticketdocs" placeholder="Upload document" id="ticketdocs">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Expected Date to Complete</label>
                            <input type="date" class="form-control pl-3" name="expectedcompleted" placeholder="Upload document" id="ticketdocs">
                            </div>
                        </div>
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
