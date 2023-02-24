<div class="container-fluid ">

        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel">
                        <div class="row mb-lg-5">
                            <div class="col-lg-12 ">
                                <div id="switchPoint" class="e-panel card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title" id="f_name"><?php echo '<b>Name </b>: '.'<b class="float-right">'. $_SESSION['name'] ." ".$_SESSION['surname'].'</b>'; ?></h5>
                                            <div class="dropdown-divider mb-lg-5"></div>
                                            <p class="heading2" id="email"><?php echo '<b>Phone Number</b>:   ' .'<b class="float-right">'.$_SESSION['phone'] .'</b>'; ?></p>
                                            <div class="dropdown-divider mb-lg-5"></div>
                                            <p class="heading2" id="email"><?php echo '<b>E-mail Address:</b>   ' .'<b class="float-right">'.$_SESSION['email'] .'</b>'; ?></p>
                                            <div class="dropdown-divider mb-lg-5"></div>
                                            <p class="heading2" id="email"><?php echo '<b>Gender:</b>   ' .'<b class="float-right">'.$_SESSION['gender'] .'</b>'; ?></p>
                                            <div class="dropdown-divider mb-lg-5"></div>
                                            <p class="heading2" id="email"><?php echo '<b>Country:</b>   ' .'<b class="float-right">'.$_SESSION['country'] .'</b>'; ?></p>
                                            <div class="dropdown-divider mb-lg-5"></div>
                                            <p class="heading2" id="email"><?php echo '<b>City/Town:</b>   ' .'<b class="float-right">'.$_SESSION['city'] .'</b>'; ?></p>
                                            <div class="dropdown-divider mb-lg-5"></div>
                                            <p class="heading2" id="email"><?php echo '<b>Province:</b>   ' .'<b class="float-right">'.$_SESSION['province'] .'</b>'; ?></p>
                                            <div class="dropdown-divider mb-lg-5"></div>
                                            <p class="heading2" id="email"><?php echo '<b>Physical Address:</b>   ' .'<b class="float-right">'.$_SESSION['address'] .'</b>'; ?></p>

                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-success float-left rounded-0" data-toggle="modal" data-target="#user-form-modal" data-toggle="tooltip" title="edit">Edit Profile <i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-red float-right rounded-0  text-white" data-toggle="tooltip" title="delete" >Block Account</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                <h5 class="modal-title text-white">CHANGE PASSWORD</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/register'); ?>" method="POST">
                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="name" placeholder="Role Name"
                                       required="required" id="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" form-div">

                                <select class="form-control" name="level" id="level">
                                    <option value="" disabled selected>Select role Level</option>
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="USER">USER</option>
                                    <option value="EDITOR">EDITOR</option>
                                    <option value="USER">USER</option>
                                    <option value="MANAGER">MANAGER</option>
                                    <option value="SUPERADMIN ">SUPERADMIN </option>
                                    <option value="FINANCE">FINANCE</option>
                                    <option value="HR">HR</option>
                                    <option value="PROJECT MANAGER">PG</option>
                                    <option value="OPERATIONS">OPERATIONS</option>
                                </select>
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




