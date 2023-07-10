$(document).ready(function(){
    $('#btnRegister').click(function(){
        // alert('register!');
        var txtFullName = $('#txtFullName').val();
        var txtPhone = $('#txtPhone').val();
        var txtEmail = $('#txtEmail').val();
        var txtPword = $('#txtPword').val();

        if(txtFullName != '' && txtPhone != '' && txtEmail != '' && txtPword != ''){
            $.ajax({
                type: 'post',
                url : 'register/add',
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
                        // window.location.reload();
                        window.location.href = '/index.php';
                    }
    
                }
            });
        }else{
            alert('Please fill-in all fields!');
        }
    });
});