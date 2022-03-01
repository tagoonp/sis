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
    }
}