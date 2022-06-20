function toggleActiveApplication(sys, uid, current_stage){
    var param = {
        system: sys,
        uid: uid,
        cstage: current_stage
    }
    var jxr = $.post(api + 'user?stage=toggle_app', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       if(snap.status != 'Success'){
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่สามารถดำเนินการได้',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ;
                       }
                   })
}

var user = {
    update_education(target_uid){
        $check = 0;
        $('.form-control').removeClass('is-invalid')

        if($('#txtDegree').val() == ''){ $check++; $('#txtDegree').addClass('is-invalid'); }
        if($('#txtCountry').val() == ''){ $check++; $('#txtCountry').addClass('is-invalid'); }
        if($('#txtEdudate').val() == ''){ $check++; $('#txtEdudate').addClass('is-invalid'); }
        if($('#txtEdumonth').val() == ''){ $check++; $('#txtEdumonth').addClass('is-invalid'); }
        if($('#txtEduyear').val() == ''){ $check++; $('#txtEduyear').addClass('is-invalid'); }
        if($('#txtStatus').val() == ''){ $check++; $('#txtStatus').addClass('is-invalid'); }
        if($('#txtAcademicYear').val() == ''){ $check++; $('#txtAcademicYear').addClass('is-invalid'); }
        

        

        if($check!=0){ return ; }

        $grad = ''; $grady = '';
        if($('#txtStatus').val() == 'graduated'){
            $grad = $('#txtGradyear').val() + '-' + $('#txtGradmonth').val() + '-' + $('#txtGraddate').val();
            $grady = $('#txtGraduateYear').val()
        }

        var param = {
            uid: $('#txtUid').val(),
            role: $('#txtRole').val(),
            student_id: $('#txtUsername').val(),
            target_uid: target_uid,
            degree: $('#txtDegree').val(),
            country: $('#txtCountry').val(),
            edudate: $('#txtEduyear').val() + '-' + $('#txtEdumonth').val() + '-' + $('#txtEdudate').val(),
            academicyear: $('#txtAcademicYear').val(),
            status: $('#txtStatus').val(),
            graddate: $grad,
            gradyear: $grady
        }

        preload.show()

        var jxr = $.post(api + 'user?stage=update_education_info', param, function(){}, 'json')
                   .always(function(snap){
                        preload.hide()
                        console.log(snap);
                       if(snap.status == 'Success'){
                            Swal.fire({
                                icon: "success",
                                title: 'Updated',
                                text: 'Education info update success',
                                confirmButtonClass: 'btn btn-success',
                            })
                       }else{
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: 'Can not update education information.',
                                confirmButtonClass: 'btn btn-danger',
                            })
                       }
                       return ;
                   })
    },
    register(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtPrefix').val() == ''){ $check++; $('#txtPrefix').addClass('is-invalid'); }
        if($('#txtFname').val() == ''){ $check++; $('#txtFname').addClass('is-invalid'); }
        if($('#txtLname').val() == ''){ $check++; $('#txtLname').addClass('is-invalid'); }
        if($('#txtUserRole').val() == ''){ $check++; $('#txtUserRole').addClass('is-invalid'); }
        if($('#txtUsername').val() == ''){ $check++; $('#txtUsername').addClass('is-invalid'); }
        if($('#txtEmail').val() == ''){ $check++; $('#txtEmail').addClass('is-invalid'); }
        if($('#txtPassword').val() == ''){ $check++; $('#txtPassword').addClass('is-invalid'); }

        if($check!=0){ return ; }

        var param = {
            uid: $('#txtUid').val(),
            role: $('#txtRole').val(),
            prefix: $('#txtPrefix').val(),
            fname: $('#txtFname').val(),
            mname: $('#txtMname').val(),
            lname: $('#txtLname').val(),
            username: $('#txtUsername').val(),
            targe_role: $('#txtUserRole').val(),
            email: $('#txtEmail').val(),
            password: $('#txtPassword').val()
        }

        preload.show()

        var jxr = $.post(authen_api + 'user?stage=check_available_sis', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       
                        if(snap.status == 'Available'){ //

                             var param = {
                                uid: $('#txtUid').val(),
                                role: $('#txtRole').val(),
                                prefix: $('#txtPrefix').val(),
                                fname: $('#txtFname').val(),
                                mname: $('#txtMname').val(),
                                lname: $('#txtLname').val(),
                                username: $('#txtUsername').val(),
                                targe_role: $('#txtUserRole').val(),
                                email: $('#txtEmail').val(),
                                password: $('#txtPassword').val(),
                                target_uid: snap.uid
                             }
                            
                             var jxr2 = $.post(api + 'user?stage=create', param, function(){}, 'json')
                                        .always(function(snap){
                                            console.log(snap);
                                            if(snap.status == 'Success'){
                                                   if($('#txtUserRole').val() == 'student'){
                                                       window.location = 'app-student-info?uid=' + snap.uid
                                                   }else{
                                                       window.location = 'app-user-info?uid=' + snap.uid
                                                   }
                                            }else{
                                                preload.hide()
                                                Swal.fire({
                                                    icon: "error",
                                                    title: 'Error',
                                                    text: 'Can not create new user.',
                                                    confirmButtonClass: 'btn btn-danger',
                                                })
                                                return ;
                                            }
                                        })
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: 'This E-mail address or ID is not available.',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ;
                        }
                   })

        // var jxr = $.post(api + 'user?stage=register', param, function(){}, 'json')
        //            .always(function(snap){
        //                preload.hide()
        //            })
    },
    update_info(target_uid){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtPrefix').val() == ''){ $check++; $('#txtPrefix').addClass('is-invalid'); console.log('a');}
        if($('#txtFname').val() == ''){ $check++; $('#txtFname').addClass('is-invalid'); console.log('b');}
        if($('#txtLname').val() == ''){ $check++; $('#txtLname').addClass('is-invalid'); console.log('c');}
        if($('#txtUserRole').val() == ''){ $check++; $('#txtUserRole').addClass('is-invalid'); console.log('d');}
        if($('#txtUsername').val() == ''){ $check++; $('#txtUsername').addClass('is-invalid'); console.log('e');}

        if($check != 0){ console.log('asd'); return ; }

        console.log('asd');

        var param = {
            uid: $('#txtUid').val(),
            role: $('#txtRole').val(),
            target_uid: target_uid,
            prefix: $('#txtPrefix').val(),
            fname: $('#txtFname').val(),
            mname: $('#txtMname').val(),
            lname: $('#txtLname').val(),
            username: $('#txtUsername').val(),
            targe_role: $('#txtUserRole').val(),
            position: $('#txtPosition').val(),
        }
        
        preload.show()

        var jxr = $.post(api + 'user?stage=update_basic_info', param, function(){}, 'json')
                   .always(function(snap){
                       preload.hide()
                       if(snap.status == 'Success'){
                            // Remove sis role from DOE
                           var jxr = $.post(authen_api + 'user?stage=update_user_info', param, function(snap){ console.log(snap); })
                        //    console.log(snap);
                        Swal.fire({
                            icon: "success",
                            title: 'Updated',
                            text: 'Update success',
                            confirmButtonClass: 'btn btn-success',
                        })
                        return ;
                           return ;
                        //    window.location = 'app-student-info?uid=' + $('#txtUid').val()
                       }else{
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: 'Can not delete.',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ;
                       }
                   })

    },
    delete(target_uid){
        Swal.fire({
            title: 'Confirmation',
            text: "You will be can not recovery this record after delete.",
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
                preload.show()
                var param = {
                    uid: $('#txtUid').val(),
                    role: $('#txtRole').val(),
                    target_uid: target_uid
                }
                var jxr = $.post(api + 'user?stage=delete', param, function(){}, 'json')
                   .always(function(snap){
                       preload.hide()
                       console.log(snap);
                       if(snap.status != 'Success'){
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: 'Can not delete.',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ;
                       }else{
                           // Remove sis role from DOE
                           var jxr = $.post(authen_api + 'user?stage=remove_sis_role', param, function(snap){ console.log(snap); })
                           window.location.reload()
                       }
                   })

            }
        })
    },
    saveScholar(target_uid){

        $('.form-control').removeClass('is-invalid')
        if($('#txtScholar').val() == ''){
            $('#txtScholar').addClass('is-invalid')
            return ;
        }

        if($('#txtScholar').val() == '11'){
            if($('#txtOtherScholar').val() == ''){
                $('#txtOtherScholar').addClass('is-invalid')
                return ;
            }
        }

        var param = {
            uid: $('#txtUid').val(),
            role: $('#txtRole').val(),
            target_uid: target_uid,
            target_student_id: $('#txtUsername').val(),
            scholar: $('#txtScholar').val(),
            scholar_other: $('#txtOtherScholar').val()
        }

        preload.show()

        var jxr = $.post(api + 'user?stage=addScholar', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       if(snap.status == 'Success'){
                           $('#modalScholarship').modal('hide')
                            user.loadScholar(target_uid, $('#txtUsername').val())
                       }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: 'Can not add scholar.',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ;
                       }
                   })

    },
    deleteScholar(sl_id){
        preload.show()
        var param = {
            uid: $('#txtUid').val(),
            role: $('#txtRole').val(),
            target_student_id: $('#txtUsername').val(),
            sl_id: sl_id
        }
        var jxr = $.post(api + 'user?stage=deleteScholar', param, function(){}, 'json')
                    .always(function(snap){
                        console.log(snap);
                        if(snap.status == 'Success'){
                            user.loadScholar(snap.target_uid, $('#txtUsername').val())
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: 'Can not delete scholar.',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ;
                        }
                    })
    },
    loadScholar(target_uid, target_student_id){
        var param = {
            uid: $('#txtUid').val(),
            role: $('#txtRole').val(),
            target_uid: target_uid,
            target_student_id: target_student_id
        }
        var jxr = $.post(api + 'user?stage=listScholar', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       preload.hide()
                       $('#listScholar').html('<tr><td colspan="2">No scholarship found.</td></tr>')
                       if(snap.status == 'Success'){
                            $('#listScholar').html('')
                            $c = 1;
                            $ext_fund = '';
                            
                            snap.data.forEach(i => {
                                if(i.sss_scholar == '11'){
                                    $ext_fund = ' (' + i.sss_scholar_info + ')'
                                }else{
                                    $ext_fund = ''
                                }
                                $('#listScholar').append('<tr><td>' + $c + '</td><td>' + i.fs_name + $ext_fund + '</td><td class="text-right"><button class="btn" onclick="user.deleteScholar(' + i.sss_id + ')"><i class="bx bx-trash"></i></button></td></tr>')
                                $c++;
                            });
                       }
                   })
    }
}

$(function(){
    $('#txtScholar').change(function(){
        $('#txtOtherScholar').val('')
        if($('#txtScholar').val() == '11'){
            $('#divScholar').removeClass('dn')
        }else{
            $('#divScholar').addClass('dn')
        }
    })
})