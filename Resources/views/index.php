<div class="container mt-lg-5 mb-lg-5">
<div class="py-1">
                    <form action="<?php route('/role'); ?>" method="POST">
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
                                    <option value="BUSINESS ANALYST">BUSINESS ANALYST</option>
                                    <option value="MANAGER">MANAGER</option>
                                    <option value="SUPERADMIN ">SUPERADMIN </option>
                                    <option value="FINANCE">FINANCE</option>
                                    <option value="HUMAN RESOURCES">HR</option>
                                    <option value="ACCOUNTS">ACCOUNTS</option>
                                    <option value="PUBLIC RELATIONS">PR</option>
                                    <option value="PROJECT MANAGER">PROJECT MANAGER</option>
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