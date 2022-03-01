var comment_1 = null
if($('#txtComment_1').length){
    comment_1 = CKEDITOR.replace( 'txtComment_1', {
        wordcount : {
        showCharCount : false,
        showWordCount : true
        },
        height: '300px'
    });
}

var progress = {
    return_1(){
        $check = 0
        $('.form-control').removeClass('is-invalid')
        if($('#txtReturn_1').val() == ''){
            $check++;
            $('#txtReturn_1').addClass('is-invalid')
        }
        if(comment_1.getData() == ''){
            $check++;
        }
        if($check != 0){
            Swal.fire({
                icon: "error",
                title: 'คำเตือน',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        Swal.fire({
            title: 'คำเตือน',
            text: "หากมีการปรับปรุงข้อมูลในแบบฟอร์ม ให้กดปุ่มบันทึกการปรับปรุงข้อมูลก่อน",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ดำเนินการต่อ',
            cancelButtonText: 'กลับไปตรวจสอบ',
            confirmButtonClass: 'btn btn-danger mr-1',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false,
        }).then(function (result) {
            if (!result.value) {
                $('#modalOperation').modal('hide')
                return ;
            }
        })

        var param = {
            id_rs: $('#txtResearchId').val(),
            session_id: $('#txtSessionId').val(),
            uid: $('#txtUid').val(),
            role: $('#txtRole').val(),
            comment: comment_1.getData(),
            result: $('#txtReturn_1').val(),
            progress: $('#txtProgress').val()
        }
        console.log(param);
        return ;
        preload.show()

        var jxr = $.post(api + 'progress?stage=result_stage1', param, function(){}, 'json')
                   .always(function(snap){
                        if(snap.status == 'Fail'){
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่สามารถดำเนินการได้',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ;
                        }else{
                            preload.hide()
                            Swal.fire({
                                title: 'ดำเนินการสำเร็จ',
                                text: "กรุณากด ตกลง เพื่อกลับสู่หน้าหลัก",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'ตกลง',
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location = './'
                                }
                            })
                        }
                    })

        // if($('#txtReturn_1').val() == '1') // ส่งกลับนักวิจัย
        
    }
}

function showEcMessage(id_rs, session_id){
    $('#ec_msg_list').html('<tr><td class="text-center"><i class="bx bx-sync bx-spin text-primary" style="font-size: 3.5em;"></i></td></tr>')
    $('#modalEcMessage').modal()
    var param = {id_rs: id_rs, session_id: session_id}
    console.log(param);
    var jxr = $.post(api + 'progress?stage=get_ec_message', param, function(){}, 'json')
               .always(function(snap){
                   if(snap.status == 'Fail'){
                        $('#ec_msg_list').html('<tr><td class="text-center">ไม่พบข้อความจากสำนักงาน ฯ</td></tr>')
                   }else{
                        $check_unread = 0;
                        snap.data.forEach(element => {
                            if(element.msg_read == '0'){
                                $check_unread++
                            }
                            if($check_unread != 0){

                            }
                        });
                   }
               })
}

function openForm(form, id_rs, session_id){
    console.log(id_rs, session_id);
    window.location = 'progressform_' + form + '?id_rs=' + id_rs + '&session_id=' + session_id
}

function deleteFile(uid, file_id, session_id, id_rs){
    var param = {
        uid: uid,
        file_id: file_id,
        session_id: session_id,
        id_rs: id_rs
    }

    Swal.fire({
        title: 'คำเตือน',
        text: "หากลบไฟล์นี้แล้วจะไม่สามารถนำกลับมาได้อีก",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ลบ',
        cancelButtonText: 'ยกเลิก',
        confirmButtonClass: 'btn btn-danger mr-1',
        cancelButtonClass: 'btn btn-secondary',
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            preload.show()
            console.log(param);
        }
    })
}