$(document).ready(function(){
    $('#btnLogin').click(function(){
        let txtEmail = $('#txtEmail').val();
        let txtPassword = $('#txtPassword').val();
        let remember = false;
        let errorCnt = 0;
        let errMsg = '';

        if ($('#remember').is(":checked")){
          // it is checked
          remember = true;
        }

        if(!ValidateEmail(txtEmail)){
            errMsg += 'Pleace check email format!<br>';
            errorCnt++;
        }
        if(txtEmail == ''){
            errMsg += 'Pleace fill-in email field!<br>';
            errorCnt++;
        }
        if(txtPassword == ''){
            errMsg += 'Pleace fill-in password field!<br>';
            errorCnt++;
        }

        if(errorCnt == 0){
            $.ajax({
                type: 'post',
                url : 'dashboard/login',
                data: {
                    'e': txtEmail,
                    'p': txtPassword
                },
                success: function(result){
                    console.log(result);
                    if(result == 'error'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Username / Password error!',
                          })
                    }else if(result == 'inactive'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'User is inactive!',
                          })
                    }else{
                        window.location = '/dashboard';
                    }
                }
            });

        }else{
            Swal.fire({
                title: 'Error!',
                html: errMsg,
                icon: 'error',
                confirmButtonText: 'Okay!'
            });
        }
    });
});