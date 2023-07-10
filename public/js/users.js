$(document).ready(function(){
    $('#btnAddUser').click(function(){
        var txtFullName = $('#txtFullName').val();
        var txtPhone = $('#txtPhone').val();
        var txtEmail = $('#txtEmail').val();
        var txtPword = $('#txtPword').val();

        if(txtFullName != '' && txtPhone != '' && txtEmail != '' && txtPword != ''){
            $.ajax({
                type: 'post',
                url : 'users/add',
                data: {
                    'f': txtFullName,
                    't': txtPhone,
                    'e': txtEmail,
                    'p': txtPword
                },
                success: function(result){
                    // console.log(result)
                    alert(result);
                    if(result == 'A new user has been added!'){
                        window.location.reload();
                    }
    
                }
            });
        }else{
            alert('Please fill-in all fields!');
        }

    });

    $('.btnUserEdit').click(function(){
        var uid = $(this).data('id');
        var fname = $(this).data('fname');
        var email = $(this).data('email');
        var phone = $(this).data('phone');
        $('#txtUserId_e').val(uid);
        $('#txtFullName_e').val(fname);
        $('#txtPhone_e').val(phone);
        $('#txtEmail_e').val(email);

        $('#modal-editUser').modal('show');
    });

    $('.btnUserDelete').click(function(){
        var uid = $(this).data('id');
        var q = confirm('Are you sure you want to delete the user?')
        if(q){
            $.ajax({
                type: 'post',
                url : 'users/delete',
                data: {
                    'i': uid,
                },
                success: function(result){
                    alert(result);
                    if(result == 'Record has been deleted!'){
                        window.location.reload();
                    }
                }
            });
        }
    });


    $('#btnUpdateUser').click(function(){
        var txtUserId_e = $('#txtUserId_e').val();
        var txtFullName_e = $('#txtFullName_e').val();
        var txtPhone_e = $('#txtPhone_e').val();
        var txtEmail_e = $('#txtEmail_e').val();
        var txtPword_e = $('#txtPword_e').val();

        if(txtFullName_e != '' && txtPhone_e != '' && txtEmail_e != '' && txtPword_e != ''){
            $.ajax({
                type: 'post',
                url : 'users/edit',
                data: {
                    'i': txtUserId_e,
                    'f': txtFullName_e,
                    't': txtPhone_e,
                    'e': txtEmail_e,
                    'p': txtPword_e
                },
                success: function(result){
                    // console.log(result)
                    alert(result);
                    if(result == 'Record has been updated!'){
                        window.location.reload();
                    }

                }
            });
        }else{
            alert('Please fill-in all fields!');
        }
    });
});