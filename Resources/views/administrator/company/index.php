<div class="container-fluid px-xl-5 mt-5">
        <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
            New Company <i class="fa fa-home"></i>
        </button>
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>COMPANIES</span><small class="px-1"></small></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Code</th>
                                            <th class="max-width">Name</th>
                                            <th class="max-width">Phone</th>
                                            <th class="max-width">Service Level</th>
                                            <th class="max-width">City</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody id="role">
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($companies as $comp): $i++; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i ?></td>
                                                <td><?php echo $comp->code; ?></td>
                                                <td><?php echo $comp->name; ?></td>
                                                <td><?php echo $comp->phonenumber; ?></td>
                                                <td><?php echo $comp->category_id=="1"?"<b class='text-danger'>Service Level</b>":"<bclass='text-success'>Non Services</b>"; ?></td>

                                                <td><?php echo $comp->city; ?></td>

                                                <td class="text-center">
                                                    <a class="text-success"  href="<?php route('/company/v/'.$comp->id) ?>" >
                                                        <i class="fa fa-edit mr-3 text-green"></i>
                                                    </a>
                                                    <a class="text-danger"  href="<?php route('/company/d/'.$comp->id) ?>" >
                                                        <i class="fa fa-trash mr-3 text-red"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
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
                <h5 class="modal-title text-white">CREATE COMPANY</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/company/register'); ?>" method="POST">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="name" placeholder="Company Name"
                                               required="required" id="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="city" placeholder="City" id="city">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                      <input type="text" class="form-control pl-3" name="address" placeholder="Physical Address" id="address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="googlemaplink" placeholder="Google Map link" id="googlemaplink">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="phonenumber" placeholder="Phone number" id="phonenumber">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="email" class="form-control pl-3" name="email" placeholder="Email Address" id="email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <select class="form-control" name="category_id" id="category_id" required="required">
                                            <option value="" disabled selected>Select Service level</option>
                                            <?php foreach ($categories as $sector){?>
                                                <option value="<?php echo $sector->id; ?>"><?php echo $sector->name; ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
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
