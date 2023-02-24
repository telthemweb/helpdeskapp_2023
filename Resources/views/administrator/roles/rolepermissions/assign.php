<div class="container-fluid px-xl-5">
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span><i> Permission</span><small class="px-1">to <?php echo strtoupper($role->name); ?></small></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="max-width">Name</th>
                                            <th class="max-width">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="practioner">
                                        <?php $i =0;  ?>

                                        <?php foreach ($permissions as $perm): $i++;
                                            $hasAssigned=false;
                                            foreach ($role->permissions as $dev ){
                                                if($dev->id==$perm->id){
                                                    $hasAssigned=true;
                                                }
                                            }
                                            ?>

                                            <tr>
                                                <td class="text-center"><?php echo $i ?></td>

                                                <td><?php echo $perm->name; ?></td>
                                                <td class="text-center">
                                                    <?php if($hasAssigned==false){?>
                                                        <i class="fa fa-times mr-3 text-red"></i>
                                                    <?php }else{  ?>
                                                        <i class="fa fa-check-circle mr-3 text-success"></i>
                                                    <?php }?>

                                                </td>

                                                <td class="text-center">
                                                    <?php if($hasAssigned==false){?>
                                                        <form action="<?php route('/permission/assign'); ?>" method="POST">
                                                            <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                                                            <input type="hidden" name="permission_id" value="<?php echo $perm->id; ?>">
                                                            <input type="hidden" name="role_id" value="<?php echo $role->id; ?>">
                                                            <button type="submit" class="btn btn-success btn-sm">Assign</button>
                                                        </form>

                                                    <?php }else{  ?>

                                                        <div class="row justify-content-center">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <form action="<?php route('/permission/unassign'); ?>" method="POST">
                                                                           <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                                                                            <input type="hidden" name="permission_id" value="<?php echo $perm->id; ?>">
                                                                            <input type="hidden" name="role_id" value="<?php echo $role->id; ?>">
                                                                            <button type="submit" class="btn btn-danger btn-sm">Unassign</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }?>
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
