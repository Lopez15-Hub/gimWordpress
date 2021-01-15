<?php
$active_tab=isset($_REQUEST['tab'])?$_REQUEST['tab']:'staff_member_list';
//access right
$user_access=MJ_gmgt_get_userrole_wise_page_access_right_array();
if (isset ( $_REQUEST ['page'] ))
{	
	if($user_access['view']=='0')
	{	
		MJ_gmgt_access_right_page_not_access_message();
		die;
	}
}
?>
<script type="text/javascript">
$(document).ready(function() {
	jQuery('#staffmember_list').DataTable({
		"responsive": true,
		 "order": [[ 1, "asc" ]],
		 "aoColumns":[
	                  {"bSortable": false},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
					  {"bSortable": false}],
					language:<?php echo MJ_gmgt_datatable_multi_language();?>	  
		});
} );
</script>
<div class="panel-body panel-white"><!--PANEL BODY DIV START -->
	<ul class="nav nav-tabs panel_tabs" role="tablist"><!--NAV TABS MENU START -->
		  <li class="<?php if($active_tab == 'staff_member_list') echo "active";?>">
			  <a href="?dashboard=user&page=staff_member&tab=staff_member_list">
				 <i class="fa fa-align-justify"></i> <?php _e('Staff Member List', 'gym_mgt'); ?></a>
			  </a>
		  </li>
		  <?php 
			if(isset($_REQUEST['action']) && $_REQUEST['action'] =='view')
			{ ?>
			<li class="<?php if($active_tab == 'view_staffmember') echo "active";?>">
			<a href="?dashboard=user&page=staff_member&tab=view_staffmember&action=view&staff_member_id=<?php echo $_REQUEST['staff_member_id'];?>">
			<i class="fa fa-align-justify"></i> <?php		
				_e('View Staff Member', 'gym_mgt'); 		
			?></a> 
			</li>
			<?php 
			}
			?>		
	</ul><!--NAV TABS MENU END -->
	<?php
	if($active_tab == 'staff_member_list')
	{
		?>
		<div class="tab-content"><!--TAB CONTENT DIV START -->
			<div class="panel-body"><!--PANEL BODY DIV START -->
				<div class="table-responsive"><!--TABLE RESPONSIVE DIV START -->
					<table id="staffmember_list" class="display dataTable " cellspacing="0" width="100%"><!--Staff MEMBER LIST TABLE START -->
						<thead>
							<tr>
								<th style="width: 50px;height:50px;"><?php  _e( 'Photo', 'gym_mgt' ) ;?></th>
								<th><?php _e( 'Staff Member Name', 'gym_mgt' ) ;?></th>
								<th><?php _e( 'Role', 'gym_mgt' ) ;?></th>
								<th> <?php _e( 'Staff Member Email', 'gym_mgt' ) ;?></th>
								<th> <?php _e( 'Mobile No', 'gym_mgt' ) ;?></th>
								<th> <?php _e( 'Specialization', 'gym_mgt' ) ;?></th>
								<th><?php  _e( 'Action', 'gym_mgt' ) ;?></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th><?php  _e( 'Photo', 'gym_mgt' );?></th>
								<th><?php _e( 'Staff Member Name', 'gym_mgt' ) ;?></th>
								<th><?php _e( 'Role', 'gym_mgt' ) ;?></th>
								<th> <?php _e( 'Staff Member Email', 'gym_mgt' ) ;?></th>
								<th> <?php _e( 'Mobile No', 'gym_mgt' ) ;?></th>
								<th> <?php _e( 'Specialization', 'gym_mgt' ) ;?></th>
								<th><?php  _e( 'Action', 'gym_mgt' ) ;?></th>
							</tr>
						</tfoot>
						<tbody>
						<?php
						if($obj_gym->role == 'member')
						{	
							if($user_access['own_data']=='1')
							{
								
								$user_id=get_current_user_id();
								$staff_id = get_user_meta( $user_id,'staff_id', true ); 
								$staffdata=array();
								$staffdata[] = get_userdata($staff_id);
								
							}
							else
							{
								
								$get_staff = array('role' => 'Staff_member');
								$staffdata=get_users($get_staff);
							}	
						}
						elseif($obj_gym->role == 'staff_member')
						{
							if($user_access['own_data']=='1')
							{
								$staff_id=get_current_user_id();
								
								$staffdata=array();
								$staffdata[] = get_userdata($staff_id);
								
							}
							else
							{
								$get_staff = array('role' => 'Staff_member');
								$staffdata=get_users($get_staff);
							}
						}	
						else
						{
							$get_staff = array('role' => 'Staff_member');
							$staffdata=get_users($get_staff);
						}		
							if(!empty($staffdata))
							{
								foreach ($staffdata as $retrieved_data)
								{
								 ?>
									<tr>
										<td class="user_image"><?php $uid=$retrieved_data->ID;
													$userimage=get_user_meta($uid, 'gmgt_user_avatar', true);
												if(empty($userimage))
												{
													echo '<img src='.get_option( 'gmgt_system_logo' ).' height="50px" width="50px" class="img-circle" />';
												}
												else
													echo '<img src='.$userimage.' height="50px" width="50px" class="img-circle"/>';
										?></td>
										<td class="name"><?php echo $retrieved_data->display_name;?></td>
										<td class="department"><?php 
										$postdata=array();
										if($retrieved_data->role_type!="")
											$postdata=get_post($retrieved_data->role_type);
										if(!empty($postdata))
											echo $postdata->post_title;?>
										</td>
										<td class="email"><?php echo $retrieved_data->user_email;?></td>
										<td class="mobile"><?php echo $retrieved_data->mobile;?></td>
										<?php
										$specilization_array=explode(',',$retrieved_data->activity_category);
										$specilization_name_array=array();
										if(!empty($specilization_array))
										{
											foreach ($specilization_array as $data)
											{
												$specilization_name_array[]=get_the_title($data);
											}	
										}
										?>
										<td class=""><?php echo implode(',',$specilization_name_array); ?></td>
										<td class="action">									
										<a href="?dashboard=user&page=staff_member&tab=view_staffmember&action=view&staff_member_id=<?php echo $retrieved_data->ID?>" class="btn btn-success"> <?php _e('View', 'gym_mgt' ) ;?></a>										
										</td>
									</tr>
									<?php 
								}
							}
							?>
						</tbody>
					</table><!--Staff MEMBER LIST TABLE END -->
				</div><!--TABLE RESPONSIVE DIV END -->
			</div><!--PANEL BODY DIV END -->
		</div><!--TAB CONTENT DIV END -->
	<?php
	}
	if($active_tab == 'view_staffmember')
	{
		$obj_gyme = new MJ_Gym_management(); 
		$obj_activity = new MJ_Gmgtactivity(); 
	 
		  $staff_member_id=0;
		  if(isset($_REQUEST['staff_member_id']))
				$staff_member_id=$_REQUEST['staff_member_id'];
				$edit=0;					
				$edit=1;
				$user_info = get_userdata($staff_member_id);					
			?>				
		<div class="panel-body"><!--PANEL BODY DIV START -->
			<div class="member_view_row1"><!--MEMBER VIEW ROW 1 DIV START -->
				<div class="col-md-8 col-sm-12 membr_left">
					<div class="col-md-6 col-sm-12 left_side">
					<?php 
					if($user_info->gmgt_user_avatar == "") { ?>
						<img alt="" src="<?php echo get_option( 'gmgt_system_logo' ); ?>">
					<?php } 
					else { ?>
						<img style="max-width:100%;" src="<?php if($edit)echo esc_url( $user_info->gmgt_user_avatar ); ?>" />
					<?php }	?>
					</div>
					<div class="col-md-6 col-sm-12 right_side">
						<div class="table_row">
							<div class="col-md-5 col-sm-12 table_td">
								<i class="fa fa-user"></i> 
								<?php _e('Name','gym_mgt'); ?>	
							</div>
							<div class="col-md-7 col-sm-12 table_td">
								<span class="txt_color">
									<?php echo chunk_split($user_info->first_name." ".$user_info->middle_name." ".$user_info->last_name,24,"<BR>");?> 
								</span>
							</div>
						</div>
						<div class="table_row">
							<div class="col-md-5 col-sm-12 table_td">
								<i class="fa fa-envelope"></i> 
								<?php _e('Email','gym_mgt');?> 	
							</div>
							<div class="col-md-7 col-sm-12 table_td">
								<span class="txt_color"><?php echo chunk_split($user_info->user_email,24,"<BR>");?></span>
							</div>
						</div>
						<div class="table_row">
							<div class="col-md-5 col-sm-12 table_td">
							<i class="fa fa-phone"></i>
							<?php _e('Mobile No','gym_mgt');?> 
							</div>
							<div class="col-md-7 col-sm-12 table_td">
								<span class="txt_color">
									<span class="txt_color"><?php echo $user_info->mobile;?> </span>
								</span>
							</div>
						</div>
						<div class="table_row">
							<div class="col-md-5 col-sm-12 table_td">
								<i class="fa fa-calendar"></i>
								<?php _e('Date Of Birth','gym_mgt');?>	
							</div>
							<div class="col-md-7 col-sm-12 table_td">
								<span class="txt_color"><?php echo MJ_gmgt_getdate_in_input_box($user_info->birth_date);?></span>
							</div>
						</div>
						<div class="table_row">
							<div class="col-md-5 col-sm-12 table_td">
								<i class="fa fa-mars"></i>
								<?php _e('Gender','gym_mgt');?> 
							</div>
							<div class="col-md-7 col-sm-12 table_td">
								<span class="txt_color"><?php echo $user_info->gender;?></span>
							</div>
						</div>
						
						<div class="table_row">
							<div class="col-md-5 col-sm-12 table_td">
								<i class="fa fa-user"></i>
								<?php _e('User Name','gym_mgt');?>
							</div>
							<div class="col-md-7 col-sm-12 table_td">
								<span class="txt_color"><?php echo chunk_split($user_info->user_login,25,"<BR>");?> </span>
							</div>
						</div>
					
					</div>
				</div>
				<div class="col-md-4 col-sm-12 member_right">	
						<span class="report_title">
							<span class="fa-stack cutomcircle">
								<i class="fa fa-align-left fa-stack-1x"></i>
							</span> 
							<span class="shiptitle"><?php _e('More Info','gym_mgt');?></span>		
						</span>
						
						
						<div class="table_row">
							<div class="col-md-6 col-sm-12 table_td">
								<i class="fa fa-map-marker" style="padding-right: 15px;"></i>						
								<?php _e('Address','gym_mgt');?>
							</div>
							<div class="col-md-6 col-sm-12 table_td">
								<span class="txt_color"><?php 
									 if($user_info->address != '')
									 {
										echo chunk_split($user_info->address.", <BR>",15);
									 }
									 
									if($user_info->city_name != '')
									{
										echo chunk_split($user_info->city_name.", <BR>",15);
									}
									 ?>
								</span>
							</div>
						</div>
						
						<div class="table_row">
							<div class="col-md-6 col-sm-12 table_td">
								<i class="fa fa-map-marker" style="padding-right: 15px;"></i>						
								<?php _e('Activity','gym_mgt');?>
							</div>
							<div class="col-md-6 col-sm-12 table_td">
								<span class="txt_color">
								<?php 
									$activity_array=$obj_activity->MJ_gmgt_get_activity_staffmemberwise($user_info->ID);
									$class_name="-";
									$class_name_string="";
									if($activity_array)
									{												
										foreach($activity_array as $key=>$activity_id)
										{
										  echo chunk_split($activity_id,24,", ");
										}
										
									}						
									else
									{
										echo chunk_split($class_name,20,"<BR>");
									}
								?>
								</span>
							</div>
						</div>
						
						<div class="table_row">
							<div class="col-md-6 col-sm-12 table_td">
								<i class="fa fa-map-marker" style="padding-right: 15px;"></i>						
								<?php _e('Assign Role','gym_mgt');?>
							</div>
							
							<div class="col-md-6 col-sm-12 table_td">
								<span class="txt_color"><?php echo chunk_split(get_the_title($user_info->role_type),25,"<BR>");?> </span>
							</div>
						</div>
				</div>
			</div><!--MEMBER VIEW ROW 1 DIV END -->
		</div><!--PANEL BODY DIV END -->
		<?php	
	}
	?>	
</div><!--PANEL BODY DIV END -->