<div class="container-fluid px-xl-5 mt-lg-5">
     
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>UPDATE <?php echo strtoupper($company->name); ?></span><small class="px-1 float-right"><?php echo "Code  #". $company->code; ?></small></h6>
                            </div>

                            <div class="py-1">
                    <form action="<?php route('/company/u/'.$company->id); ?>" method="POST">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="name" value="<?php echo $company->name; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="city" value="<?php echo $company->city; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                      <input type="text" class="form-control pl-3" name="address" value="<?php echo $company->address; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="googlemaplink" value="<?php echo $company->googlemaplink; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="phonenumber" value="<?php echo $company->phonenumber; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="email" class="form-control pl-3" name="email" value="<?php echo $company->email; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <select class="form-control" name="category_id" id="category_id" required="required">
                                            <option value="" disabled selected><?php echo $company->category->name; ?></option>
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
        </div>
    </div>

    