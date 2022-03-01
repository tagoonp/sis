// console.log($('#txtUid').val());
var line_oa_uid = ''
var line_oa_token = ''

var authen = {
    logout(){
        window.location = '../../../controller/close_session.php'
    },
    login(){
        var param = {
            username: $('#txtUsername').val(),
            password: $('#txtPassword').val()
        }
        
        preload.show()

        var jxr = $.post(authen_api + 'authen?stage=login', param, function(){}, 'json')
                   .always(function(snap){
                        if(snap.status == 'Fail'){
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: "Invalid user account.",
                                confirmButtonText: 'Retry login',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }else{
                            window.location = '../../../controller/create_session?uid=' + snap.uid + '&token=' + snap.token
                        }
                   })
    },
    gotoNext(){
        window.location = '../../../controller/create_session?uid=' + line_oa_uid + '&token=' + line_oa_token
    },
    linelink(){
        var param = {
            username: $('#txtUsername').val(),
            password: $('#txtPassword').val(),
            token: $('#txtToken').val(),
            photo: $('#txtPhoto').val(),
        }
        
        preload.show()

        var jxr = $.post(api + 'authen?stage=linelink', param, function(){}, 'json')
                   .always(function(snap){
                        if(snap.status == 'Fail'){
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: "Invalid username or password",
                                confirmButtonText: 'Try again',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }else{
                            preload.hide()
                            line_oa_uid = snap.uid
                            line_oa_token = snap.token
                            // window.location = '../../../controller/create_session?uid=' + snap.uid + '&token=' + snap.token
                            $('#modalLineOA').modal({backdrop: 'static', keyboard: false}) 
                        }
                   })
    },
    update_profile(){
        $check = 0; $('.form-control').removeClass('is-invalid');
        if($('#txtPrefixTh').val() == ''){ $check++; $('#txtPrefixTh').addClass('is-invalid'); }
        if($('#txtFnameTh').val() == ''){ $check++; $('#txtFnameTh').addClass('is-invalid'); }
        if($('#txtLnameTh').val() == ''){ $check++; $('#txtLnameTh').addClass('is-invalid'); }

        if($('#txtPrefixEn').val() == ''){ $check++; $('#txtPrefixEn').addClass('is-invalid'); }
        if($('#txtFnameEn').val() == ''){ $check++; $('#txtFnameEn').addClass('is-invalid'); }
        if($('#txtLnameEn').val() == ''){ $check++; $('#txtLnameEn').addClass('is-invalid'); }

        if($('#txtPosition').val() == ''){ $check++; $('#txtPosition').addClass('is-invalid'); }
        if($('#txtDept').val() == ''){ $check++; $('#txtDept').addClass('is-invalid'); }

        if($('#txtDept').val() == '19'){
            if($('#txtOtherDeptTh').val() == ''){ $check++; $('#txtOtherDeptTh').addClass('is-invalid'); }
            if($('#txtOtherDeptEn').val() == ''){ $check++; $('#txtOtherDeptEn').addClass('is-invalid'); }
        }

        if($('#txtPosition').val() == '9'){
            if($('#txtPositionOther').val() == ''){ $check++; $('#txtPositionOther').addClass('is-invalid'); }
        }

        if($check != 0){
            return ;
        }

        var param = {
            uid: $('#txtUid').val(),
            sid: $('#txtSid').val(),
            prefix_th: $('#txtPrefixTh').val(),
            prefix_en: $('#txtPrefixEn').val(),
            fname_th: $('#txtFnameTh').val(),
            fname_en: $('#txtFnameEn').val(),
            lname_th: $('#txtLnameTh').val(),
            lname_en: $('#txtLnameEn').val(),
            position: $('#txtPosition').val(),
            position_other: $('#txtPositionOther').val(),
            dept: $('#txtDept').val(),
            dept_th: $('#txtOtherDeptTh').val(),
            dept_en: $('#txtOtherDeptEn').val(),
            exp: $('#txtExpertise').val(),
            ri: $('#txtRi').val()
        }

        preload.show()

        var jxr = $.post(api + 'authen?stage=updateprofile', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                        if(snap.status == 'Success'){
                            preload.hide()
                            Swal.fire({
                                title: 'ปรับปรุงข้อมูลสำเร็จ',
                                text: "กดปุ่ม -ตกลง- เพื่อทำการรีโหลดข้อมูล",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'ตกลง',
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }
                            })
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด!',
                                text: "ไม่สามารถดำเนินการได้ กรุณาลองใหม่อีกครั้ง หรือแจ้งเจ้าหน้าที่",
                                confirmButtonText: 'รับทราบ',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })


    },
    update_password(id){
        $check = 0; $('.form-control').removeClass('is-invalid');
        if($('#txtPassword0').val() == ''){ $check++; $('#txtPassword0').addClass('is-invalid'); }
        if($('#txtPassword1').val() == ''){ $check++; $('#txtPassword1').addClass('is-invalid'); }
        if($('#txtPassword2').val() == ''){ $check++; $('#txtPassword2').addClass('is-invalid'); }
        if($('#txtPassword1').val() != $('#txtPassword2').val()){
            $check++; $('#txtPassword2').addClass('is-invalid');
        }

        if($check != 0){
            return ;
        }

        var param = {
             uid: id,
             old_pwd: $('#txtPassword0').val(),
             new_pwd: $('#txtPassword1').val(),
             sid: $('#txtSid').val()
        }

        preload.show()

        var jxr = $.post(api + 'authen?stage=updatepassword', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                        if(snap.status == 'Success'){
                            preload.hide()
                            Swal.fire({
                                title: 'ปรับปรุงรหัสผ่านสำเร็จ',
                                text: "กดปุ่ม -ตกลง- เพื่อทำการรีโหลดข้อมูล",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'ตกลง',
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }
                            })
                        }else if(snap.status == 'invalidpwd'){
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด!',
                                text: "รหัสผ่านเดิมของท่านไม่ถูกต้อง",
                                confirmButtonText: 'ลองใหม่อีกครั้ง',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด!',
                                text: "ไม่สามารถดำเนินการได้ กรุณาลองใหม่อีกครั้ง หรือแจ้งเจ้าหน้าที่",
                                confirmButtonText: 'รับทราบ',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })


    },
    update_contact(){
        $check = 0; $('.form-control').removeClass('is-invalid');
        if($('#txtPhone').val() == ''){ $check++; $('#txtPhone').addClass('is-invalid'); }
        if($('#txtOffice').val() == ''){ $check++; $('#txtOffice').addClass('is-invalid'); }

        if($check != 0){
            return ;
        }

        var param = {
            uid: $('#txtUid').val(),
            sid: $('#txtSid').val(),
            phone: $('#txtPhone').val(),
            office: $('#txtOffice').val(),
            address: $('#txtAddress').val(),
            fax: $('#txtFax').val()
        }

        preload.show()

        var jxr = $.post(api + 'authen?stage=updatecontact', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                        if(snap.status == 'Success'){
                            preload.hide()
                            Swal.fire({
                                title: 'ปรับปรุงข้อมูลสำเร็จ',
                                text: "กดปุ่ม -ตกลง- เพื่อทำการรีโหลดข้อมูล",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'ตกลง',
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }
                            })
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด!',
                                text: "ไม่สามารถดำเนินการได้ กรุณาลองใหม่อีกครั้ง หรือแจ้งเจ้าหน้าที่",
                                confirmButtonText: 'รับทราบ',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    }
}

$(function(){
    $('#txtDept').change(function(){
        if($('#txtDept').val() == '19'){
            $('.other_dept').removeClass('dn')
        }else{
            $('.other_dept').addClass('dn')
            $('#txtOtherDeptTh').val('')
            $('#txtOtherDeptEn').val('')
        }
    })

    $('#txtPosition').change(function(){
        if($('#txtPosition').val() == '9'){
            $('.other_position').removeClass('dn')
        }else{
            $('.other_position').addClass('dn')
            $('#txtPositionOther').val('')
        }
    })

    
})

$(function(){
    $('#loginForm').submit(function(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtUsername').val() == ''){
            $check++; $('#txtUsername').addClass('is-invalid')
        }
        if($('#txtPassword').val() == ''){
            $check++; $('#txtPassword').addClass('is-invalid')
        }

        if($check != 0){
            Swal.fire({
                icon: "error",
                title: 'Warning',
                text: "Please enter all require field",
                confirmButtonText: 'Retry',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        preload.show()
        authen.login()
    })

    $('#linkForm').submit(function(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtUsername').val() == ''){
            $check++; $('#txtUsername').addClass('is-invalid')
        }
        if($('#txtPassword').val() == ''){
            $check++; $('#txtPassword').addClass('is-invalid')
        }

        if($check != 0){
            Swal.fire({
                icon: "error",
                title: 'Warning',
                text: "Please enter all require field",
                confirmButtonText: 'Retry',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        preload.show()
        authen.linelink()
    })
})