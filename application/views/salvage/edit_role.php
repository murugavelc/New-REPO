<?php $this->load->view('header');
//print_r($user_det);
GLOBAL $APPMODULES;

?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/switchery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/styling/switch.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/notifications/pnotify.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_layouts.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/form_checkboxes_radios.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
<!--    <div class="page-header">-->
<!--        <div class="page-header-content">-->
<!--            <div class="page-title">-->
<!--                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">User Roles</span> - Edit Role - --><?php //echo $role[0]->name; ?><!--</h4>-->
<!--            </div>-->
<!---->
<!--            <div class="heading-elements">-->
<!--                <div class="heading-btn-group">-->
<!--                    <a href="--><?php //echo BASE; ?><!--roles" class="btn btn-success"><i class="icon-circle-left2"></i> Back to Roles</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="breadcrumb-line">-->
<!--            <ul class="breadcrumb">-->
<!--                <li><a href="--><?php //echo BASE; ?><!--"><i class="icon-home2 position-left"></i> Home</a></li>-->
<!--                <li><a href="--><?php //echo BASE; ?><!--roles"> Roles</a></li>-->
<!--                <li class="active">Edit - --><?php //echo $role[0]->name; ?><!--</li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

        <div class="row page_header">
            <div class="col-sm-6">
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold">User Roles</span> - Edit Role - <?php echo $role[0]->name; ?></h4>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo BASE; ?>roles" class="btn btn-success"><i class="icon-circle-left2"></i> Back to Roles</a>
            </div>
        </div>

        <!-- 2 columns form -->
        <form id="addRoleForm" action="#" novalidate>
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <legend class="text-semibold"><i class="icon-user-plus position-left"></i> Edit Role</legend>
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Role Name:</label>
                                            <input type="text" placeholder="Role Name" required name="type_name" value="<?php echo $role[0]->name; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <?php echo $all; ?>
                                    <div class="col-md-4">
                                        <br>
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="check_all" class="control-primary" <?php echo ($all == true?'checked="checked"':''); ?> >Select All / Deselect All</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-12">

                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th class="text-center">Add</th>
                                        <th class="text-center">View</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($APPMODULES as $module_id => $module){ ?>
                                        <tr>
                                            <td class="text-left"><?php echo $module; ?></td>
                                            <td><input type="checkbox" class="control-primary" name="module_<?php echo $module_id; ?>_add" <?php echo ($role[$module_id-1]->padd == 1?'checked="checked"':''); ?> ></td>
                                            <td><input type="checkbox" class="control-primary" name="module_<?php echo $module_id; ?>_view" <?php echo ($role[$module_id-1]->pview == 1?'checked="checked"':''); ?> ></td>
                                            <td><input type="checkbox" class="control-primary" name="module_<?php echo $module_id; ?>_edit" <?php echo ($role[$module_id-1]->pedit == 1?'checked="checked"':''); ?> ></td>
                                            <td><input type="checkbox" class="control-primary" name="module_<?php echo $module_id; ?>_delete" <?php echo ($role[$module_id-1]->pdelete == 1?'checked="checked"':''); ?> ></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="clearfix"></div>
                        <br>
                    </div>

                    <div class="text-right">
                        <input type="hidden" name="type_id" value="<?php echo $role[0]->type_id; ?>">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /2 columns form -->
<?php $this->load->view('footer'); ?>
<script>
$(document).ready(function(){
    $('#check_all').change(function(){
        if($('#check_all').prop('checked') == true){
            $('input:checkbox').attr('checked',true);
            $('input:checkbox').parent().addClass('checked');
        }else{
            $('input:checkbox').prop('checked',false);
            $('input:checkbox').parent().removeClass('checked');
        }
    });

    $(document).on('keyup keydown','input',function(e){
        //e.preventDefault();
        if($.trim($(this).val()) != '') {
            $(this).parent().removeClass('has-error');
            $(this).next('.c_error').remove();
        }
    });

    $('#addRoleForm').submit(function(e){
        e.preventDefault();
        var role = $('input[name="type_name"]');
        var error = false;
        $(this).find('*').removeClass('has-error');
        $('.c_error').remove();
        if($.trim(role.val()) == ''){
            error = true;
            role.parent().addClass('has-error');
            role.after('<div class="c_error text-warning-800">This field is required</div>');
        }
        if(error){
            return false;
        }
        $.ajax({
            url: "<?php echo BASE; ?>roles/update",
            type: 'POST',
            dataType: 'json',
            data: $(this).serializeArray(),
            beforeSend: function(){
                swal({title:"Loading ...",imageUrl: "<?php echo BASE; ?>assets/images/loader.gif",showConfirmButton: false});
            },
            success: function(data){
                console.log(data);
                if(data.error){
                    swal.close();
                    if(data.error.type_name){
                        role.parent().addClass('has-error');
                        role.after('<div class="c_error text-warning-800">'+data.error.type_name+'</div>');
                    }else{
                        new PNotify({
                            title: 'Failed!',
                            text: 'Add role has been failed to update.',
                            icon: 'icon-blocked',
                            type: 'error'
                        });
                    }
                }else{
                    swal({
                        title: "Success!",
                        text: "Role has been updated successfully!",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    },function(){
                        window.location.href = '<?php echo BASE; ?>roles';
                    });
                }
            },
            error: function(){

            }
        });
    });
});
</script>
