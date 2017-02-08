
$(document).ready(function(){
    $('#recent_list ul li:first a').click();
    $('#ChatInputForm').on('submit',function(e){
        e.preventDefault();
        var group = $('#group_active').val();
        // var msg = $('.chat-input').val();
        var formData = new FormData($("#ChatInputForm")[0]);

        if(group == 1){
            alert('group test');
            $.ajax({
                url: base_url + 'messages/add_grp_message',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    // $('#user-parent').html(data);
                    $('.chat-input').val('');
                    activaTab('top-divided-tab1');
                    loadMessages();
                }
            });
        }else {
            $.ajax({
                url: base_url + 'messages/add_message',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    $('.chat-input').val('');
                    activaTab('top-divided-tab1');
                    loadUsers();
                    loadMessages();
                }
            });
        }
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


$(document).on('click','#users_list ul li a',function(e){
    e.preventDefault();
    var user = $(this).data('id');
    $('#users_list').find('li').removeClass('active');
    $(this).parent('li').addClass('active');
    $('#active_user').val(user);
    $('.active_name').html($(this).data('name'));
    $('#group_active').val('');
    loadMessages(1);
    loadsidebar();
});

$(document).on('click','#recent_list ul li a',function(e){
    e.preventDefault();
    var user = $(this).data('id');
    $('#recent_list').find('li').removeClass('active');
    $(this).parent('li').addClass('active');
    $('#active_user').val(user);
    $('.active_name').html($(this).data('name'));
    $('#group_active').val($(this).data('group'));
    loadMessages(1);
    loadsidebar();
});

$(document).on('click','#group_list ul li a',function(e){
    e.preventDefault();
    var group = $(this).data('id');
    $('#recent_list').find('li').removeClass('active');
    $(this).parent('li').addClass('active');
    $('#active_user').val(group);
    $('.active_name').html($(this).data('name'));
    $('#group_active').val($(this).data('group'));
    loadMessages(1);
    loadsidebar();
});

$(document).on('keyup','#SearchUsers',function(e){
    e.preventDefault();
    var seval = $(this).val();
    if(seval.length > 1) {
        $.ajax({
            url: base_url + 'messages/searchUsers',
            type: 'POST',
            data: {seval: seval},
            success: function (data) {
                $('#searchViewUsers ul').html(data);
                $('#searchViewUsers').show();
            }
        });
    }else{
        $('#searchViewUsers').hide();
        $('#searchViewUsers ul').html('');
    }
    return false;
});

function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};

function loadUsers(){
    var uid = $('#active_user').val();
    var group = $('#group_active').val();
    var acttab = $("#MessageBox .tabbable ul.nav li.active a").attr('href');
    $.ajax({
        url: base_url+'messages/chat_userList',
        type: 'POST',
        dataType: 'json',
        data: {uid:uid,group:group,acttab:acttab},
        success: function(data){
            $('#recent_list ul').html(data.recent);
        }
    });

    return false;
}

function loadMessages(first = 0){
    var uid = $('#active_user').val();
    var group = $('#group_active').val();
    // console.log(uid);
    if(group == 1){
        $.ajax({
            url: base_url + 'messages/get_messages_by_group',
            type: 'POST',
            data: {userid: uid, group: group},
            success: function (data) {
                $('#user_messages_block').html(data);
                if(first ==1) {
                    $('.nano-content').mCustomScrollbar("scrollTo", "bottom", {
                        scrollInertia: 0
                    });
                }
            }
        });
    }else {
        $.ajax({
            url: base_url + 'messages/get_messages_by_user',
            type: 'POST',
            data: {userid: uid, group: group},
            success: function (data) {
                $('#user_messages_block').html(data);
                if(first ==1) {
                    $('.nano-content').mCustomScrollbar("scrollTo", "bottom", {
                        scrollInertia: 0
                    });
                }
            }
        });
    }
    return false;
}

