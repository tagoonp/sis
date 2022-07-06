var staff = {
    update_student_profile(username){
        $check = 0; $('.form-control').removeClass('is-invalid')

        if($('#txtCountry').val() == ''){ $check++; $('#txtCountry').addClass('is-invalid'); }
        if($('#txtFname').val() == ''){ $check++; $('#txtFname').addClass('is-invalid'); }
        if($('#txtLname').val() == ''){ $check++; $('#txtLname').addClass('is-invalid'); }
        if($('#txtTitle').val() == ''){ $check++; $('#txtTitle').addClass('is-invalid'); }
        if($('#txtStartyear').val() == ''){ $check++; $('#txtStartyear').addClass('is-invalid'); }
        if($('#txtFirstacademicdate').val() == ''){ $check++; $('#txtFirstacademicdate').addClass('is-invalid'); }

        if($check != 0){ return ;}

        var param = {
            username: username,
            contry: $('#txtCountry').val(),
            fname: $('#txtFname').val(),
            mname: $('#txtMname').val(),
            lname: $('#txtLname').val(),
            prefix: $('#txtTitle').val(),
            syear: $('#txtStartyear').val(),
            ssdate: $('#txtFirstacademicdate').val(),
            uid: $('#txtUid').val()
        }

        console.log(param);

        preload.show()
        var jxr = $.post(api + 'staff?stage=update_student_profile', param, function(){}, 'json')
                   .always(function(snap){
                        preload.hide()
                        console.log(snap);
                        if(snap.status == 'Success'){
                            Swal.fire({
                                icon: "success",
                                title: 'Success',
                                text: "Profile update success",
                                confirmButtonText: 'OK',
                                confirmButtonClass: 'btn btn-success',
                            })
                        }else{
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: "Can not update",
                                confirmButtonText: 'Re-try',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    },
    check_before_add(role){
        $check = 0;
        $('.form-control').removeClass('is-invalid')

        if(role == 'student'){
            if($('#txtDegree').val() == ''){ $check++; $('#txtDegree').addClass('is-invalid') }
            if($('#txtStatus').val() == ''){ $check++; $('#txtStatus').addClass('is-invalid') }
            if($('#txtStudentId').val() == ''){ $check++; $('#txtStudentId').addClass('is-invalid') }

            if($check != 0){ return ; }

            var param = {
                degree: $('#txtDegree').val(),
                status: $('#txtStatus').val(),
                student_id: $('#txtStudentId').val(),
                checktype: 'student'
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
        }else{
            if($('#txtStaffId').val() == ''){ $check++; $('#txtStaffId').addClass('is-invalid') }
            if($('#txtType').val() == ''){ $check++; $('#txtType').addClass('is-invalid') }
            

            if($check != 0){ return ; }

            var param = {
                staff_id: $('#txtStaffId').val(),
                staff_type: $('#txtType').val(),
                checktype: 'staff'
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
                                    text: "This staff ID anready registered.",
                                    confirmButtonText: 'Re-try',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                            }
                    })
        }

        
    },
    deleteUser(id, role){
        Swal.fire({
            title: 'Warning',
            text: "This record will be can not recovery after delete.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mr-1',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                var param = {
                    uid: $('#txtUid').val(),
                    delete_id: id
                }
                preload.show()
                var jxr = $.post(api + 'staff?stage=delete_account', param, function(){}, 'json')
                           .always(function(snap){
                                if(snap.status == 'Success'){
                                    if(role == 'student'){
                                        window.location = 'app-student'
                                    }else{
                                        window.location = 'app-users'
                                    }
                                }else{
                                    preload.hide()
                                    Swal.fire({
                                        icon: "error",
                                        title: 'Error',
                                        text: "Can not delete account.",
                                        confirmButtonText: 'Re-try',
                                        confirmButtonClass: 'btn btn-danger',
                                    })
                                }
                           })
            }
        })
    },
    save_advisor(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')

        if($('#txtAdv').val() == ''){ $check++; $('#txtAdv').addClass('is-invalid') }
        if($('#txtAdvtype').val() == ''){ $check++; $('#txtAdvtype').addClass('is-invalid') }

        if($check != 0){ return ; }

        preload.show()
        var param = {
            uid: $('#txtUid').val(),
            adv: $('#txtAdv').val(),
            adv_type: $('#txtAdvtype').val(),
            std_id: $('#txtStudentId').val()
        }

        var jxr = $.post(api + 'staff?stage=add_advisor', param, function(){}, 'json')
                   .always(function(snap){
                        if(snap.status == 'Success'){
                            window.location.reload()
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: "Can not add advisor",
                                confirmButtonText: 'Re-try',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    },
    resetAdvDialog(cotype, id){
        Swal.fire({
            title: 'Warning',
            text: "Related information will be delete.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-danger mr-1',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                preload.show()
                var param = {
                    uid: $('#txtUid').val(),
                    adv_id: id
                }
                var jxr = $.post(api + 'staff?stage=delete_adv', param, function(){}, 'json')
                           .always(function(snap){ 
                                if(snap.status == 'Success'){
                                    window.location.reload()
                                }else{

                                }
                           })
            }
        })
    },
    toggle_role(role, id){
        var param = {
            uid: $('#txtUid').val(),
            username: id,
            target_role: role
        }
        var jxr = $.post(api + 'staff?stage=update_role', param, function(){}, 'json')
                   .always(function(snap){ console.log(snap); })
    },
    save_staff(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtPrefix').val() == ''){ $check++; $('#txtPrefix').addClass('is-invalid') }
        if($('#txtStaffId').val() == ''){ $check++; $('#txtStaffId').addClass('is-invalid') }
        if($('#txtType').val() == ''){ $check++; $('#txtType').addClass('is-invalid') }
        if($('#txtFname').val() == ''){ $check++; $('#txtFname').addClass('is-invalid') }
        if($('#txtLname').val() == ''){ $check++; $('#txtLname').addClass('is-invalid') }
        if($('#txtEmail').val() == ''){ $check++; $('#txtEmail').addClass('is-invalid') }
        if($('#txtPassword').val() == ''){ $check++; $('#txtPassword').addClass('is-invalid') }

        if($check != 0){ return ; }

        preload.show()
        var param = {
            staff_type: $('#txtType').val(),
            staff_id: $('#txtStaffId').val(),
            prefix: $('#txtPrefix').val(),
            fname: $('#txtFname').val(),
            mname: $('#txtMname').val(),
            lname: $('#txtLname').val(),
            email: $('#txtEmail').val(),
            password: $('#txtPassword').val()
        }

        var jxr = $.post(api + 'staff?stage=add_new_staff', param, function(){}, 'json')
                   .always(function(snap){
                        preload.hide()
                        console.log(snap);
                        if(snap.status == 'Success'){
                            // Send account to ISCORE
                            var param2 = {
                                username: $('#txtStaffId').val(),
                                fname: $('#txtFname').val(),
                                mname: $('#txtMname').val(),
                                lname: $('#txtLname').val(),
                                pid: $('#txtStaffId').val()
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
                                confirmButtonText: 'Add next staff',
                                cancelButtonText: 'View profile',
                                confirmButtonClass: 'btn btn-danger mr-1',
                                cancelButtonClass: 'btn btn-secondary',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }else{
                                    window.location = './app-staff-info?id=' + $('#txtStaffId').val()
                                }
                            })
                        }else{
                            Swal.fire({
                                icon: "error",
                                title: 'Duplicate ID',
                                text: "This staff ID already registered.",
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
    },
    setAdvDialog(adv_type){
        $('#modalAdvDialog').modal()
        $('#txtAdvtype').val(adv_type)
    }
}


function showModalType(){
    $('#modalType').modal()
}