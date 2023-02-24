<div class="container mb-5 mt-lg-5">
    <div class="row">
        <div class="col-md-12">
        <form action="<?php route('/company/auth'); ?>" method="POST">
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