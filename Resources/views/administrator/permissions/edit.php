<div class="container-fluid px-xl-5 mt-lg-5">
     
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>UPDATE <?php echo strtoupper($permission->name); ?></span><small class="px-1"></small></h6>
                            </div>

                            <div class="py-1">
                            <form action="<?php route('/perm/p/'.$permission->id); ?>" method="POST">
                                <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                                    <div class="form-group">
                                        <div class="rounded">
                                            <input type="text" class="form-control pl-3" name="name" placeholder="Category Name" value="<?php echo $permission->name; ?>">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="rounded-0">
                                        <input type="text" class="form-control pl-3" name="guard_name" placeholder="Guard Name" value="<?php echo $permission->guard_name; ?>">
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

    