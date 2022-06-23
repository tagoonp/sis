var staff = {
    check_before_add(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')

        if($('#txtDegree').val() == ''){ $check++; $('#txtDegree').addClass('is-invalid') }
        if($('#txtStatus').val() == ''){ $check++; $('#txtStatus').addClass('is-invalid') }
        if($('#txtStudentId').val() == ''){ $check++; $('#txtStudentId').addClass('is-invalid') }

        if($check != 0){ return ; }

        var param = {
            degree: $('#txtDegree').val(),
            status: $('#txtStatus').val(),
            student_id: $('#txtStudentId').val()
        }
        console.log(param);
        preload.show()

        var jxr = $.post(api + 'staff?stage=check_before_add', param, function(){}, 'json')
                   .always(function(snap){
                        preload.hide()
                        console.log(snap);
                        if(snap.status == 'Success'){
                            $('.addform').removeClass('dn')
                            $('#txtPrefix').focus()
                        }else{
                            Swal.fire({
                                icon: "error",
                                title: 'Duplicate ID',
                                text: "This student ID anready registered.",
                                confirmButtonText: 'Re-try',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    },
    update_student_status(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtStatusTo').val() == ''){ $check++; $('#txtStatusTo').addClass('is-invalid') }
        if($check != 0){ return ; }

        var param = {
            status: $('#txtStatusTo').val(),
            student_id: $('#txtStatusId').val(),
            uid: $('#txtUid').val()
        }

        preload.show()

        var jxr = $.post(api + 'staff?stage=update_student_status', param, function(){}, 'json')
                   .always(function(snap){
                        preload.hide()
                        console.log(snap);
                        if(snap.status == 'Success'){
                            // Swal.fire({
                            //     icon: "success",
                            //     title: 'Updated',
                            //     text: "Status of " + $('#txtStatusId').val() + ' updated.',
                            //     confirmButtonText: 'OK',
                            //     confirmButtonClass: 'btn btn-success',
                            // })
                            $('#textStatus_' + $('#txtStatusId').val()).text($('#txtStatusTo').val())
                        }else{
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: "Can not update status.",
                                confirmButtonText: 'Re-try',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    },
    save_student(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')

        if($('#txtDegree').val() == ''){ $check++; $('#txtDegree').addClass('is-invalid') }
        if($('#txtStatus').val() == ''){ $check++; $('#txtStatus').addClass('is-invalid') }
        if($('#txtStudentId').val() == ''){ $check++; $('#txtStudentId').addClass('is-invalid') }
        if($('#txtPrefix').val() == ''){ $check++; $('#txtPrefix').addClass('is-invalid') }
        if($('#txtFname').val() == ''){ $check++; $('#txtFname').addClass('is-invalid') }
        if($('#txtLname').val() == ''){ $check++; $('#txtLname').addClass('is-invalid') }
        if($('#txtStartyear').val() == ''){ $check++; $('#txtStartyear').addClass('is-invalid') }
        if($('#txtEdudate').val() == ''){ $check++; $('#txtEdudate').addClass('is-invalid') }

        if($check != 0){ return ; }

        var param = {
            degree: $('#txtDegree').val(),
            status: $('#txtStatus').val(),
            student_id: $('#txtStudentId').val(),
            prefix: $('#txtPrefix').val(),
            fname: $('#txtFname').val(),
            mname: $('#txtMname').val(),
            lname: $('#txtLname').val(),
            start_year: $('#txtStartyear').val(),
            start_edu_date: $('#txtEdudate').val(),
        }
        // console.log(param);
        // return ;
        preload.show()


        var jxr = $.post(api + 'staff?stage=add_new_student', param, function(){}, 'json')
                   .always(function(snap){
                        preload.hide()
                        console.log(snap);
                        if(snap.status == 'Success'){
                            // Send account to ISCORE
                            var param2 = {
                                username: $('#txtStudentId').val(),
                                fname: $('#txtFname').val(),
                                mname: $('#txtMname').val(),
                                lname: $('#txtLname').val(),
                                pid: $('#txtStudentId').val()
                            }

                            var jxr2 = $.post('https://medipe.app/iscore/application/api/api_user?stage=bypass_create_account', param2, function(){}, 'json')
                                        .always(function(snap2){ console.log(snap2); })

                            Swal.fire({
                                title: 'Success',
                                text: "Add new student success",
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Add next student',
                                cancelButtonText: 'View profile',
                                confirmButtonClass: 'btn btn-danger mr-1',
                                cancelButtonClass: 'btn btn-secondary',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }else{
                                    window.location = './app-student-info?id=' + $('#txtStudentId').val()
                                }
                            })
                        }else{
                            Swal.fire({
                                icon: "error",
                                title: 'Duplicate ID',
                                text: "This student ID anready registered.",
                                confirmButtonText: 'Re-try',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    }
}