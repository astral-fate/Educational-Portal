<html>
            <!-- edit -->
            <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">

                            <div class="x_title">
                                <h2>Edit Meeting</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a class="dropdown-item" href="#">Settings 1</a></li>
                                            <li><a class="dropdown-item" href="#">Settings 2</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                       


                     <!-- edit -->

                     <div class="x_content">
                                <br />


                               


                            <div class="x_content">
                                <br />

                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="meeting-date">Meeting Date <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="date" id="meeting-date" name="Date" required="required" class="form-control" value="<?php echo htmlspecialchars($Date); ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="title" name="Title" required="required" class="form-control" value="<?php echo htmlspecialchars($Title); ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Content <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <textarea id="content" name="Content" required="required" class="form-control"><?php echo htmlspecialchars($Content); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="location" class="col-form-label col-md-3 col-sm-3 label-align">Location <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input id="location" class="form-control" type="text" name="Location" required="required" value="<?php echo htmlspecialchars($Location); ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="price" class="col-form-label col-md-3 col-sm-3 label-align">Price <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input id="price" class="form-control" type="number" name="Price" required="required" value="<?php echo htmlspecialchars($Price); ?>">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">active</label>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="flat" name="active" id="active" <?php echo $active ? 'checked' : ''; ?>>
                                            </label>
                                        </div>
                                    </div>
									
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Image <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="file" id="image" name="Image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Category <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <select class="form-control" name="Category" id="Category">
                                                <?php
                                                $sql = "SELECT * FROM category";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                foreach($stmt->fetchAll() as $row){
                                                    $cat_id = $row['id'];
                                                    $cat_name = $row['cat_name'];
                                                ?>
                                                <option value="<?php echo $cat_id; ?>" <?php echo $Category == $cat_id ? 'selected' : ''; ?>><?php echo htmlspecialchars($cat_name); ?></option>
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
                                            <button type="submit" name="update" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                                
                            </div>


                        </div>
                    </div>
                </div>
</html>