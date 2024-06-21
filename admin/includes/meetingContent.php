<html>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage Meetings</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>
        <!-- form -->
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Meetings</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Meeting Date</th>
                          <th>Title</th>
                          <th>Active</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <?php
                      foreach($stmt->fetchAll() as $row){
                          $id = $row['id'] ;
                          $Date = $row['Date'];
                          $Title = $row['Title'];
                          $Active = $row['Active'];

                        ?>

                      <tbody>
                        <tr>
                          <td><?php echo $Date ?></td>
                          <td><?php echo $Title ?></td>
                          <td><?php echo $Active ?></td>
                      
                          <td>
                          <a href="editMeeting.php?id=<?php echo $id; ?>">
                              <img src="./images/edit.png" alt="Edit">
                          </a>
                        </td>

                        <!-- DELETE -->
                        <td>
                              <a href="deleteMeeting.php?id=<?php echo $id; ?>">
                              <img src="./images/delete.png" alt="Edit">
                          </a>
                        
                          </td>
                        </tr>
                        <?php
                           }
                         ?>
                      
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
</html>