var progress = {
    update_pe_status(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtPeStatus').val() == ''){
            $('#txtPeStatus').addClass('is-invalid'); $check++;
        }

        if($('#txtPeStatus').val() == 'pass'){
            if($('#txtPePassDate').val() == ''){
                $('#txtPePassDate').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            status: $('#txtPeStatus').val(),
            pass_date: $('#txtPePassDate').val(),
            progress: 'pe'
        }
        console.log(param);
        preload.show()
        var jxr = $.post(api + 'progress?stage=update_status', param, function(){}, 'json')
                   .always(function(snap){
                        console.log(snap);
                        if(snap.status == 'Success'){
                            window.location.reload()
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: "Can not update progress status",
                                confirmButtonText: 'Re-try',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    },
    update_qe_status(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtQeStatus').val() == ''){
            $('#txtQeStatus').addClass('is-invalid'); $check++;
        }

        if($('#txtQeStatus').val() == 'pass'){
            if($('#txtQePassDate').val() == ''){
                $('#txtQePassDate').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            status: $('#txtQeStatus').val(),
            pass_date: $('#txtQePassDate').val(),
            progress: 'qe'
        }
        console.log(param);
        preload.show()
        var jxr = $.post(api + 'progress?stage=update_status', param, function(){}, 'json')
                   .always(function(snap){
                        console.log(snap);
                        if(snap.status == 'Success'){
                            window.location.reload()
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: "Can not update progress status",
                                confirmButtonText: 'Re-try',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    },
    update_pub_status(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtPubStatus').val() == ''){
            $('#txtPubStatus').addClass('is-invalid'); $check++;
        }

        if($('#txtPubStatus').val() == 'pass'){
            if($('#txtPubPassDate').val() == ''){
                $('#txtPubPassDate').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            status: $('#txtPubStatus').val(),
            pass_date: $('#txtPubPassDate').val(),
            progress: 'pub'
        }
        console.log(param);
        preload.show()
        var jxr = $.post(api + 'progress?stage=update_status', param, function(){}, 'json')
                   .always(function(snap){
                        console.log(snap);
                        if(snap.status == 'Success'){
                            window.location.reload()
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: "Can not update progress status",
                                confirmButtonText: 'Re-try',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    },
    save_pub(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtPubTitle').val() == ''){
            $('#txtPubTitle').addClass('is-invalid'); $check++;
        }

        if($('#txtPubAuthor').val() == ''){
            $('#txtPubAuthor').addClass('is-invalid'); $check++;
        }

        if($('#txtPubPublisher').val() == ''){
            $('#txtPubPublisher').addClass('is-invalid'); $check++;
        }

        if($('#txtPubDate').val() == ''){
            $('#txtPubDate').addClass('is-invalid'); $check++;
        }

        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            title: $('#txtPubTitle').val(),
            pub_date: $('#txtPubDate').val(),
            author: $('#txtPubAuthor').val(),
            publisher: $('#txtPubPublisher').val()
        }
        console.log(param);
        preload.show()
        var jxr = $.post(api + 'progress?stage=add_pub', param, function(){}, 'json')
                   .always(function(snap){
                        console.log(snap);
                        if(snap.status == 'Success'){
                            window.location.reload()
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: "Can not add record",
                                confirmButtonText: 'Re-try',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    },
    save_pe(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtTitle').val() == ''){
            $('#txtTitle').addClass('is-invalid'); $check++;
        }

        if($('#txtExamDate').val() != ''){
            if($('#txtExamStart').val() == ''){
                $('#txtExamStart').addClass('is-invalid'); $check++;
            }

            if($('#txtExamEnd').val() == ''){
                $('#txtExamEnd').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            title: $('#txtTitle').val(),
            exam_date: $('#txtExamDate').val(),
            exam_start: $('#txtExamStart').val(),
            exam_end: $('#txtExamEnd').val()
        }
        console.log(param);
        preload.show()
        var jxr = $.post(api + 'progress?stage=add_pe', param, function(){}, 'json')
                   .always(function(snap){
                        console.log(snap);
                        if(snap.status == 'Success'){
                            window.location.reload()
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: "Can not add record",
                                confirmButtonText: 'Re-try',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    },
    save_qe(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtQeTitle').val() == ''){
            $('#txtQeTitle').addClass('is-invalid'); $check++;
        }

        if($('#txtQeExamDate').val() != ''){
            if($('#txtQeExamStart').val() == ''){
                $('#txtQeExamStart').addClass('is-invalid'); $check++;
            }

            if($('#txtQeExamEnd').val() == ''){
                $('#txtQeExamEnd').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            title: $('#txtQeTitle').val(),
            exam_date: $('#txtQeExamDate').val(),
            exam_start: $('#txtQeExamStart').val(),
            exam_end: $('#txtQeExamEnd').val()
        }
        console.log(param);
        preload.show()
        var jxr = $.post(api + 'progress?stage=add_qe', param, function(){}, 'json')
                   .always(function(snap){
                        console.log(snap);
                        if(snap.status == 'Success'){
                            window.location.reload()
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: "Can not add record",
                                confirmButtonText: 'Re-try',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    },
    update_pe(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtPeTitleU').val() == ''){
            $('#txtPeTitleU').addClass('is-invalid'); $check++;
        }

        if($('#txtPeExamDateU').val() != ''){
            if($('#txtPeExamStartU').val() == ''){
                $('#txtPeExamStartU').addClass('is-invalid'); $check++;
            }

            if($('#txtPeExamEndU').val() == ''){
                $('#txtPeExamEndU').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            progress_id: $('#txtPeId').val(),
            title: $('#txtPeTitleU').val(),
            exam_date: $('#txtPeExamDateU').val(),
            exam_start: $('#txtPeExamStartU').val(),
            exam_end: $('#txtPeExamEndU').val()
        }
        console.log(param);
        // return ;
        preload.show()
        var jxr = $.post(api + 'progress?stage=update_pe', param, function(){}, 'json')
                   .always(function(snap){
                        console.log(snap);
                        if(snap.status == 'Success'){
                            window.location.reload()
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'Error',
                                text: "Can not add record",
                                confirmButtonText: 'Re-try',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    },
    delete_progress(id, progress){
        Swal.fire({
            title: 'Warning',
            text: "You will be can not recovert this record after delete",
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
                    progress: progress,
                    progress_id: id
                }
                var jxr = $.post(api + 'progress?stage=delete_progress', param, function(){}, 'json')
                           .always(function(snap){ 
                                if(snap.status == 'Success'){
                                    window.location.reload()
                                }else{
                                    preload.hide()
                                    Swal.fire({
                                        icon: "error",
                                        title: 'Error',
                                        text: "Can not delete record",
                                        confirmButtonText: 'Re-try',
                                        confirmButtonClass: 'btn btn-danger',
                                    })
                                }
                           })
            }
        })
    }
}

function update_pe_setup(id, title, d, s, e){
    $('#modalUpdaterecord').modal('show')
    $('#txtPeId').val(id)
    $('#txtPeTitleU').val(title)

    $('#txtPeExamDateU').val(d)
    if(d != ''){
        console.log(s.slice(0, -3));
        $('#txtPeExamStartU').val(s.slice(0, -3))
        $('#txtPeExamEndU').val(e.slice(0, -3))
    }
    
}