<div class="container-fluid px-xl-5 mt-lg-5">
     
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>CHANGE PASSWORD</span><small class="px-1"></small></h6>
                            </div>

                            <div class="py-1">
                            <form action="<?php route('/changepassword/c/'.$_SESSION['admin_id']) ?>" method="POST">
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
        </div>
    </div>

    