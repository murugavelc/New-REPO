<?php $this->load->view('admin/header');
//print_r($user_det);
?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script>var target = {columnDefs: [{
        orderable: false,
        width: '200px',
        targets: [ 6 ]
    }],};</script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/datatables_basic.js"></script>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-xs">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user-plus position-left"></i> <span class="text-semibold"> Bidders</span></h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
<!--                    <a href="--><?php //echo BASE; ?><!--users/add" class="btn btn-success"><i class="icon-user-plus"></i> Add New User</a>-->
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="active">Bidders</li>
            </ul>

        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

        <?php if($this->session->flashdata('approved_msg')){
           echo $this->session->flashdata('approved_msg');
        }?>


        <div class="panel panel-flat">

            <table class="table datatable-basic table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>User Role</th>
                    <th>Approval</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php GLOBAL $USER_ROLES; if(!empty($users)){ foreach ($users as $user){ ?>
                        <tr>
                            <td><?php echo $user->first_name; ?></td>
                            <td><?php echo $user->last_name; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $USER_ROLES[$user->user_type]; ?></td>
                            <td class="text-center">
                                <?php if($user->approved == 1){ ?>
                                    <span class="label label-success">Approved</span>
                                <?php }else{ ?>
                                    <button data-popup="tooltip" title="Click to Approve" data-id="<?php echo $user->user_id; ?>" class="Uapproval label label-danger">Not Approved</button>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if($user->status == 1){ ?>
                                    <span class="label label-success">Active</span>
                                <?php }else{ ?>
                                    <span class="label label-warning">Inactive</span>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <ul class="actions icons-list">
                                    <li class=""><a data-popup="tooltip" title="View Document" target="_blank" href="<?php echo BASE; ?>uploads/users/<?php echo $user->user_id; ?>/<?php echo $user->doc_file; ?>" class="btn btn-success text-white btn-xs"><i class="icon-attachment"></i></a></li>
                                    <li class=""><a data-popup="tooltip" title="Edit" href="<?php echo ADMIN_URL; ?>users/edit/<?php echo $user->user_id; ?>" class="btn btn-info text-white btn-xs"><i class="icon-pencil"></i></a></li>
                                    <?php if($_SESSION['user_type'] == 1){ ?>
                                    <li class=""><a data-popup="tooltip" title="Delete" href=""  data-id="<?php echo $user->user_id; ?>" class="btn btn-danger text-white btn-xs delete"><i class="icon-trash"></i></a></li>
                                    <?php } ?>
                                </ul>
                            </td>
                        </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>


<?php $this->load->view('admin/footer'); ?>
<script>
    var base_url = '<?php echo BASE; ?>';
    $(document).ready(function(){
        $(document).on('click','.Uapproval',function (e) {
           e.preventDefault();
           var id = $(this).data('id');
           $.ajax({
               url: base_url+'admin/users/approval',
               type: 'POST',
               dataType: 'json',
               data: {id:id},
               beforeSend: function(){
                   swal({title:"Loading ...",imageUrl: "<?php echo BASE; ?>assets/images/loader.gif",showConfirmButton: false});
               },
               success: function(data){
                   console.log(data);
                   if(data.success){
                       location.reload();
                   }else if(data.error){
                       $('#UsersAlert').html(data.error);
                   }
               },
           });
        });

        $(document).on('click','.delete',function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this user!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    'url' : base_url+'admin/users/delete',
                    'type': 'POST',
                    'data': {id:id},
                    beforeSend: function(){
                        swal({title:"Loading ...",imageUrl: "<?php echo BASE; ?>assets/images/loader.gif",showConfirmButton: false});
                    },
                    success: function (data) {
//                                console.log(data);
                        swal({
                            title: "Deleted!",
                            text: "User has been deleted successfully!",
                            confirmButtonColor: "#66BB6A",
                            type: "success"
                        },function(){
                            location.reload();
                        });
                    }
                });

            });
            return false;
        });
    });
</script>