<?php $this->load->view('includes/sidebar_view')?>
<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              List of Members
                          </header>
                          <div class="panel-body">
                                <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="listing">
                                      <thead>
                                      <tr>
                                          <th>ID</th>
                                          <th>Fullname</th>
                                          <th>Gender</th>
                                          <th>Type of Subscription</th>
                                          <th>Expiration Date</th>
                                      </tr>
                                      </thead>
                                      <tbody>
									  <?php foreach($user as $member): ?>
                                      
									  <tr>
                                          <td><?php echo $member['user_id']?></td>
                                          <td><a href="<?php echo base_url('admin/user/detail/').'/'.$member['user_id']?>"><?php echo $member['firstname']?> <?php echo $member['lastname']?></a></td>
                                          <td><?php echo $member['gender']?></td>
                                          <td>no data</td>
                                          <td>no data</td>
                                      </tr>  
									  <?php endforeach?>									  
                                      </tbody>
                                      
                          </table>
                                </div>
                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->					
				  
    <!-- js placed at the end of the document so the pages load faster -->
    <!--<script src="js/jquery.js"></script>-->
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/plugins/advanced-datatable/media/js/jquery.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/respond.min.js" ></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/data-tables/DT_bootstrap.js"></script>


  <!--common script for all pages-->
    <script src="<?php echo base_url()?>assets/js/common-scripts.js"></script>
	 
  <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('#listing').dataTable( {
                  "aaSorting": [[ 4, "desc" ]]
            });
        });
      </script>
