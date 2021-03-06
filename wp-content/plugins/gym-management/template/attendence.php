<?php 
$curr_user_id=get_current_user_id();
$obj_gym=new MJ_Gym_management($curr_user_id);
$obj_attend=new MJ_Gmgtattendence;
$obj_class=new MJ_Gmgtclassschedule;
$active_tab = isset($_GET['tab'])?$_GET['tab']:'add_attendence';
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
//SAVE Attendance DATA
if(isset($_POST['save_attendence']))
{
	$attend_by=get_current_user_id();
	$membersdata = get_users(array('meta_key' => 'class_id', 'meta_value' => $_POST['class_id'],'role'=>'member'));
	
	if(isset($_POST['attendence']))
	{
		$result=$obj_attend->MJ_gmgt_save_attendence($_POST['curr_date'],$_POST['class_id'],$_POST['attendence'],$attend_by,$_POST['status']);
		if($result)
		{
		 ?>
			<div id="message" class="updated below-h2">
					<p><?php _e('Attendance successfully saved!','gym_mgt');?></p>
				</div>
		<?php
		}
	}
	else
	{
		?>
		<div id="message" class="updated below-h2">
			<p><?php _e('Please select at least one member.','gym_mgt');?></p>
		</div>
		<?php
	}	
}
//DELETE Attendance DATA
if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')
{
	$result=$obj_product->MJ_gmgt_delete_product($_REQUEST['product_id']);
	if($result)
	{
		wp_redirect ( home_url().'?dashboard=user&page=attendence&tab=add_attendence&message=3');
	}
}
if(isset($_REQUEST['message']))
{
	$message =$_REQUEST['message'];
	if($message == 1)
	{?>
		<div id="message" class="updated below-h2 ">
		<p>
		<?php 
			_e('Attendance added successfully.','gym_mgt');
		?></p></div>
		<?php 		
	}
	elseif($message == 2)
	{?><div id="message" class="updated below-h2 "><p><?php
			_e("Attendance updated successfully.",'gym_mgt');
			?></p>
			</div>
		<?php 
		
	}
	elseif($message == 3) 
	{?>
	<div id="message" class="updated below-h2"><p>
	<?php 
		_e('Attendance deleted successfully.','gym_mgt');
	?></div></p><?php
			
	}
}
?>
<script type="text/javascript">
$(document).ready(function() 
{
	jQuery('#product_list').DataTable({
		responsive: true,
		language:<?php echo MJ_gmgt_datatable_multi_language();?>	
		});
		$('#product_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});	
		$.fn.datepicker.defaults.format =" <?php echo get_option('gmgt_datepicker_format');?>";
		$('#curr_date').datepicker(
		{
			endDate: '+0d',
			autoclose: true
		});
		$('.checkAll').change(function(){
			var state = this.checked;
			state? $(':checkbox').prop('checked',true):$(':checkbox').prop('checked',false);
			state? $(this).next('b').text('Uncheck All') :$(this).next('b').text('Check All')
		});				
} );
</script>
<div class="panel-body panel-white"><!--PANEL BODY DIV START-->   
	<ul class="nav nav-tabs panel_tabs" role="tablist"><!--NAV TABS MENU START-->   
			<li class="<?php if($active_tab=='add_attendence'){?>active<?php }?>">
				<a href="?dashboard=user&page=attendence&tab=add_attendence" class="tab <?php echo $active_tab == 'add_attendence' ? 'active' : ''; ?>">
				 <i class="fa fa-align-justify"></i> <?php _e('Member Attendance', 'gym_mgt'); ?></a>
			  </a>
			</li>
	</ul><!--NAV TABS MENU END-->   
	<div class="tab-content"><!--TAB CONTENT DIV START-->   
		<?php 
		if($active_tab == 'add_attendence')
		{ ?>	
			<style>
			.form-horizontal .form-group 
			{
			  margin-right: -15px;
			  margin-left: 25px;
			}
			
			</style>
			<?php $past_attendance=get_option('gym_enable_past_attendance'); ?>
			<div class="panel-body"> <!--PANEL BODY DIV START-->   
				<form method="post" >  
				    <input type="hidden" name="class_id" value="<?php if(isset($class_id))echo $class_id;?>" />
				    <div class="form-group col-md-3">
					<label class="control-label" for="curr_date"><?php _e('Date','gym_mgt');?></label>
						<input id="curr_date" class="form-control" data-date-format="<?php echo MJ_gmgt_bootstrap_datepicker_dateformat(get_option('gmgt_datepicker_format'));?>" type="text" 
						value="<?php if(isset($_POST['curr_date'])) echo $_POST['curr_date']; 
						else echo  MJ_gmgt_getdate_in_input_box(date("Y-m-d"));?>" name="curr_date">
				    </div>
					<div class="form-group col-md-3">
						<label for="class_id"><?php _e('Select Class','gym_mgt');?></label>			
						<?php $class_id=0; if(isset($_POST['class_id'])){$class_id=$_POST['class_id'];}?>							 
							<select name="class_id"  id="class_id"  class="form-control ">
								<option value=" "><?php _e('Select Class Name','gym_mgt');?></option>
								<?php 
								
								$classdata=$obj_class->MJ_gmgt_get_all_classes();
								  
								  foreach($classdata as $class)
								  {  
								  ?>
								   <option  value="<?php echo $class->class_id;?>" <?php selected($class->class_id,$class_id)?>><?php echo $class->class_name;?> ( <?php echo MJ_gmgt_timeremovecolonbefoream_pm($class->start_time).' - '.MJ_gmgt_timeremovecolonbefoream_pm($class->end_time);?>)</option>
							 <?php }?>
							</select>						
					</div>
					<div class="form-group col-md-3 button-possition">
						<label for="subject_id">&nbsp;</label>
						<input type="submit" value="<?php _e('Take/View  Attendance','gym_mgt');?>" name="attendence"  class="btn btn-success"/>
					</div>
				</form>
		    </div><!--PANEL BODY DIV END-->   
			<div class="clearfix"> </div>
			<?php 
				if(isset($_REQUEST['attendence']) || isset($_REQUEST['save_attendence']))
				{
					if(isset($_REQUEST['class_id']) && $_REQUEST['class_id'] != " ")
						$class_id =$_REQUEST['class_id'];
						else 
							$class_id = 0;
						if($class_id == 0)
						{
							?>
							<div class="panel-heading">
								<h4 class="panel-title" style="color:red"><?php _e('Please select any one class.','gym_mgt');?></h4> 
							</div>
							<?php 
						}
						else
						{
							$membersdata= array();
							
							$MemberClassData = MJ_gmgt_get_member_by_class_id($_REQUEST['class_id']);
							foreach($MemberClassData as $key=>$value)
							{
								$members= get_userdata($value->member_id);
								if($members!=false)
								{
									$role= $members->roles;					
									if($role[0]!='staff_member')
									{
										$membersdata[]=$members;						
									}
								}
							}
							?>
							<div class="panel-body"> <!--PANEL BODY DIV START-->     
								<form method="post"  class="form-horizontal">  
									<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
									<input type="hidden" name="curr_date" value="<?php if(isset($_POST['curr_date'])) echo $_POST['curr_date']; 
									  else echo  date("Y-m-d");?>" />
									<div class="panel-heading">
										<h4 class="panel-title"> <?php _e('Class','gym_mgt')?> : <?php echo $class_name=$obj_class->MJ_gmgt_get_class_name($class_id);?> , 
										<?php _e('Date','gym_mgt')?> : <?php echo $_POST['curr_date'];?></h4>
									</div>
									<!--nonce-->
									<?php wp_nonce_field( 'save_attendence_nonce' ); ?>
									<!--nonce-->
									<?php 
									if($past_attendance == "yes")
									{ ?>
									<div class="form-group">
										  <label class="radio-inline">
										  <input type="radio" name="status" value="Present" checked="checked"/> <?php _e('Present','gym_mgt');?>
										  </label>
										  <label class="radio-inline">
										  <input type="radio" name="status" value="Absent" /> <?php _e('Absent','gym_mgt');?><br />
										  </label>
									</div>	
									<?php
									}
									else
									{
										$curr_date=MJ_gmgt_get_format_for_db($_REQUEST['curr_date']); ?>
										<?php if($curr_date == date("Y-m-d"))
										{?> 
											<div class="form-group">
											  <label class="radio-inline">
											  <input type="radio" name="status" value="Present" checked="checked"/> <?php _e('Present','gym_mgt');?>
											  </label>
											  <label class="radio-inline">
											  <input type="radio" name="status" value="Absent" /> <?php _e('Absent','gym_mgt');?><br />
											  </label>
											</div>
										<?php }
									}?>
									<div class="col-md-12">
										<table class="table">
											<tr>
												 <?php
												 if($past_attendance == "yes")
												{ ?>
													<th width="46px"><h4><input type="checkbox" name="selectall" class="checkAll"  id="selectall"/></h4></th>
												<?php 
												}
												else
												{
													if($curr_date == date("Y-m-d"))
													{?> 
													  <th width="46px"><h4><input type="checkbox" name="selectall" class="checkAll"  id="selectall"/></h4></th>
													  <?php
													  
													}
													else 
													 {
														?>
														<th width="70px"><?php _e('Status','gym_mgt');?></th>
														<?php 
														
													 } 
												}
												 ?>
												<th width="250px"><h4><?php _e('Member Name','gym_mgt');?></h4></th>
												
											  <?php
												if($past_attendance == "yes")
												{ ?>
													<th><h4><?php _e('Status','gym_mgt');?></h4></th>
												 <?php 
												}
												else
												{
													if($curr_date == date("Y-m-d"))
													{?>
													   <th><h4><?php _e('Status','gym_mgt');?></h4></th>
													  <?php 
													}
												} ?>
											</tr>
											<?php
											
											 foreach ( $membersdata as $user ) {
												$date = $_POST['curr_date'];
												 $date=MJ_gmgt_get_format_for_db($date);
													$check_result=$obj_attend->MJ_gmgt_check_attendence($user->ID,$class_id,$date);
												echo '<tr>';
												if($past_attendance == "yes")
												{ ?>
													<td class="checkbox_field"><span><input type="checkbox" class="checkbox1" name="attendence[]" value="<?php echo $user->ID; ?>" <?php if($check_result=='true'){ echo "checked=\'checked\'"; } ?> /></span></td>
												<?php 
												}
												else
												{
													if($curr_date == date("Y-m-d"))
													{?> 
													<td class="checkbox_field"><span><input type="checkbox" class="checkbox1" name="attendence[]" value="<?php echo $user->ID; ?>" <?php if($check_result=='true'){ echo "checked=\'checked\'"; } ?> /></span></td>
													<?php
													}
													else 
													{
													?>
														<td><?php if($check_result=='true') _e('Present','gym_mgt'); else _e('Absent','gym_mgt');?></td>
														<?php 
													}
												}
												
												echo '<td><span>' .$user->first_name.' '.$user->last_name.' ('.$user->member_id.')</span></td>';
													if(!empty($check_result)){ 
														 echo '<td><span>' .$check_result->status.'</span></td>';
													}
													else 
														echo "<td>&nbsp;</td>";
												
												
												echo '</tr>';
													
												}?>
												   
										</table>
									</div>
									<div class="col-sm-12"> 
									<?php
										if($past_attendance == "yes")
										{ ?>
											<input type="submit" value="Save  Attendance" name="save_attendence" class="btn btn-success" />
										<?php 
										}
										else
										{
											if($curr_date == date("Y-m-d"))
											{?>       	      	
											 <input type="submit" value="Save  Attendance" name="save_attendence" class="btn btn-success" />
										   <?php
											}
										}
									?>
								   </div>
								</form>	
							</div> <!--PANEL BODY DIV END-->   
				<?php   }
				}
		}
	?>
	</div><!--TAB CONTENT DIV END-->   
</div><!--PANEL BODY DIV END-->   