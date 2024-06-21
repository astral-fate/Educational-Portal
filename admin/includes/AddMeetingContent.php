<html>

<div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Add Meeting</h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Add Meeting</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <?php
                                    if (isset($msg)) {
                                        echo "<div class='alert $alertType'>$msg</div>";
                                    }
                                    ?>
                                    <br />
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="Date">Meeting Date <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="date" id="Date" name="Date" required="required" class="form-control">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="Title">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" id="Title" name="Title" required="required" class="form-control">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="Content">Content <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <textarea id="Content" name="Content" required="required" class="form-control">Contents</textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="Location" class="col-form-label col-md-3 col-sm-3 label-align">Location <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input id="Location" name="Location" class="form-control" type="text" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="Price" class="col-form-label col-md-3 col-sm-3 label-align">Price <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input id="Price" name="Price" class="form-control" type="number" required="required">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="flat" name="active" id="active" value="1" <?php echo $active ? 'checked' : ''; ?>>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="Image">Image <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="file" id="Image" name="Image" required="required" class="form-control" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="Category">Category <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <select class="form-control" name="Category" id="Category">
                                                    <?php
                                                    foreach ($categories as $row) {
                                                        $id = htmlspecialchars($row['id']);
                                                        $cat_name = htmlspecialchars($row['cat_name']);
                                                    ?>
                                                        <option value="<?php echo $id; ?>"><?php echo $cat_name; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 offset-md-3">
                                                <button class="btn btn-primary" type="button">Cancel</button>
                                                <button type="submit" class="btn btn-success">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
</html>