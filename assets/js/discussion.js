
$(document).ready(function(){
    $('#DisUsers_list ul li:first a').click();
    $('#ChatInputForm').on('submit',function(e){
        e.preventDefault();
        // var msg = $('.chat-input').val();
        var formData = new FormData($("#ChatInputForm")[0]);
        $.ajax({
            url: base_url + 'discussions/add_message',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                $('.chat-input').val('');
                loadMessages(1);
            }
        });
        return false;
    });

    $('#msg_attachment').change(function(){
        $('#ChatInputForm').submit();
    });

    $('#AddGroup').on('submit',function(e){
        e.preventDefault();
        var formData = new FormData($("#AddGroup")[0]);
        var error = false;
        $('#AddGroup').find('*').removeClass('has-error');
        $('.c_error').remove();
        var name = $('#new_group_name');
        var users = $('#new_group_users');
        if(name.val() == ''){
            name.parent().addClass('has-error');
            name.after('<div class="c_error text-warning-800">This field is required</div>');
            error = true;
        }
        alert(users.val());
        if(users.val() == '' || users.val() == null){
            users.parent().addClass('has-error');
            users.parent().after('<div class="c_error text-warning-800">This field is required</div>');
            error = true;
        }
        if(error){
            return false;
        }
        $.ajax({
            url: base_url + 'messages/add_group',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                if(data.error){
                    swal.close();
                    if(data.error.img){
                        $('#new_group_img').parent().addClass('has-error');
                        $('#new_group_img').after('<div class="c_error text-warning-800">'+data.error.img+'</div>');
                    }
                    if(data.error.name){
                        name.parent().addClass('has-error');
                        name.after('<div class="c_error text-warning-800">'+data.error.name+'</div>');
                    }
                }else if(data.success){
                    swal({
                        title: "Success!",
                        text: "Group has been added successfully!",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    },function(){
                        location.reload();
                    });
                }
            }
        });
    });
});


$(document).on('click','#create_group',function(e){
    e.preventDefault();
    $('#AddGroupNew').modal('show');
});

$(document).on('click','.edit_group',function(e){
    e.preventDefault();
    var gid = $(this).data('gid');
    $.ajax({
        url: base_url+'messages/edit_group',
        type: 'POST',
        data: {gid:gid},
        success: function(data){
            $('#EditGroup .modal-content').html(data);
        }
    });
    $('#EditGroup').modal('show');
});

$(document).on('click','.panel-title .active_name',function(e){
    e.preventDefault();
    loadsidebar();
    $('#sidebar').fadeToggle();
});

$(document).on('click','#sidebar .profile_close',function(e){
    e.preventDefault();
    $('#sidebar').fadeToggle();
});

function loadsidebar(){
    var uid = $('#active_user').val();
    var group = $('#group_active').val();
    $.ajax({
        url: base_url+'messages/view_userdata',
        type: 'POST',
        data: {uid:uid,group:group},
        success: function(data){
            $('#sidebar-inner').html(data);
        }
    });
}


// AUTO LOAD SYSTEM
var t = setInterval(loadMessages, 2500);
var u = setInterval(loadUsers, 2500);


$(document).on('click','#DisUsers_list ul li',function(e){
    e.preventDefault();
    $(this).parent().find('li').removeClass('active');
    $(this).addClass('active');
    var id = $(this).data('id');
    $('#active_user').val(id);
    var url = $(this).children('.media-left').children('img').attr('src');
    var name = $(this).find('.uname').html();
    $('#discussion_msgs .panel-title').html('<img class="img-circle img-usr" src="'+url+'"> '+name);
    loadMessages(1);
    var project = $('#project_id').val();
    $.ajax({
        url: base_url+'discussions/update_read',
        type: 'POST',
        dataType: 'json',
        data: {uid:id,pid:project},
        success: function(data){
            console.log(data);
        }
    });
});

$(document).on('click','.search_clear',function(e){
   e.preventDefault();
    $('#SearchUsers').val('');
    $(this).hide();
    $('#searchViewUsers').hide();
    $('#searchViewUsers').html('');
    $('#regularUsersList').show();
});

$(document).on('keyup','#SearchUsers',function(e){
    e.preventDefault();
    var seval = $(this).val();
    var project = $('#project_id').val();
    if(seval.length > 0){
        $('.search_clear').show();
    }else{
        $('.search_clear').hide();
    }
    if(seval.length > 1) {
        $.ajax({
            url: base_url + 'discussions/searchUsers',
            type: 'POST',
            data: {seval: seval,pid:project},
            success: function (data) {
                $('#regularUsersList').hide();
                $('#searchViewUsers').html(data);
                $('#searchViewUsers').show();
            }
        });
    }else{
        $('#searchViewUsers').hide();
        $('#searchViewUsers').html('');
        $('#regularUsersList').show();
    }
    return false;
});

function loadUsers(){
    var uid = $('#active_user').val();
    var project = $('#project_id').val();
    $.ajax({
        url: base_url+'discussions/chat_userList',
        type: 'POST',
        dataType: 'json',
        data: {uid:uid,pid:project},
        success: function(data){
            $('#DisUsers_list #regularUsersList').html(data.recent);
        }
    });

    return false;
}

function loadMessages(first = 0){
    var uid = $('#active_user').val();
    var project = $('#project_id').val();
    // console.log(uid);

    $.ajax({
        url: base_url + 'discussions/get_messages_by_user',
        type: 'POST',
        data: {userid: uid, project: project},
        success: function (data) {

            $('#discussion_msgs .panel-inner').html(data);
            if(first ==1) {
                $('#discussion_msgs .panel-inner').scrollTop($('#discussion_msgs .panel-inner')[0].scrollHeight);
                // $('#discussion_msgs .panel-inner').mCustomScrollbar("scrollTo", "bottom", {
                //     scrollInertia: 0
                // });
            }
        }
    });

    return false;
}
