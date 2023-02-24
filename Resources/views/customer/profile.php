<div class="container  mt-lg-5 mb-lg-5">
<div class="row ">
    <div class="col-md-5">
        <div class="text-center">
       
        <button class="btn btn-success" data-toggle="modal" data-target="#user-form-modal">Edit Profile</button>
         <button class="btn btn-danger" data-toggle="modal"  data-target="#changepassword">Change Password</button>
        </div>
        
    </div>
    <div class="col-md-7">
        <div class="card">
        <div class="card-header bg-blue">Company Details</div>
             <div class="card-body">
                 <h5 class="card-title mb-lg-3"><?php echo "<b>Company Name</b>    <span class='float-right'>" .$_SESSION['name'] ."</span>"?></h5>
                 <div class="dropdown-divider mb-lg-3"></div>
                  <h5 class="card-title"><?php echo "<b>Phone Number</b>    <span class='float-right'>" .$_SESSION['phonenumber'] ."</span>"?></h5>
                  <div class="dropdown-divider mb-lg-3"></div>
                  <h5 class="card-title"><?php echo "<b>E-mail Address</b>    <span class='float-right'>" .$_SESSION['email'] ."</span>"?></h5>
                  <div class="dropdown-divider mb-lg-3"></div>
                  <h5 class="card-title"><?php echo "<b>City/Town</b>    <span class='float-right'>" .$_SESSION['city'] ."</span>"?></h5>
                  
               </div>
        </div>
    </div>
 </div>
</div>



























<div class="modal fade" role="dialog" tabindex="-1" id="changepassword">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">CHANGE PASSWORD</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                <form action="<?php route('/company/changepassword/'.$_SESSION['user_id']) ?>" method="POST">
                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="newpassword" 
                                       required="required" placeholder="New Password">
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="cnewpassword" 
                                       required="required" placeholder="Confirm New Password">
                            </div>
                        </div>
                        <div class="float-lg-right">
                            <div class="">
                                <button type="submit" class="btn btn-danger login-btn btn-block">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">UPDATE INFORMATION</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                <form action="<?php route('/company/auth'); ?>" method="POST">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="name" value="<?php echo $_SESSION['name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="city" value="<?php echo $_SESSION['city'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                      <input type="text" class="form-control pl-3" name="address" value="<?php echo $_SESSION['address'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="googlemaplink" value="<?php echo $_SESSION['googlemaplink'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="phonenumber" value="<?php echo $_SESSION['phonenumber'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="email" class="form-control pl-3" name="email" value="<?php echo $_SESSION['email'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <select class="form-control" name="category_id" id="category_id" required="required">
                                            <option value="" disabled selected><?php echo $_SESSION['sectorname'] ?></option>
                                            <?php foreach ($categories as $sector){?>
                                                <option value="<?php echo $sector->id; ?>"><?php echo $sector->name; ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                    <input type="password" class="form-control pl-3" name="password" placeholder="Password" id="password">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="float-lg-right">
                            <div class="">
                                <button type="submit" class="btn btn-primary login-btn btn-block">CREATE ACCOUNT</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>




