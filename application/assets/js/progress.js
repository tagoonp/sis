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
    update_eng_status(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtEngStatus').val() == ''){
            $('#txtEngStatus').addClass('is-invalid'); $check++;
        }

        if($('#txtEngStatus').val() == 'pass'){
            if($('#txtEngPassDate').val() == ''){
                $('#txtEngPassDate').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            status: $('#txtEngStatus').val(),
            pass_date: $('#txtEngPassDate').val(),
            progress: 'eng'
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
    update_ce_status(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtCeStatus').val() == ''){
            $('#txtCeStatus').addClass('is-invalid'); $check++;
        }

        if($('#txtEngStatus').val() == 'pass'){
            if($('#txtCePassDate').val() == ''){
                $('#txtCePassDate').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            status: $('#txtCeStatus').val(),
            pass_date: $('#txtCePassDate').val(),
            progress: 'ce'
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
    update_te_status(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtTeStatus').val() == ''){
            $('#txtTeStatus').addClass('is-invalid'); $check++;
        }

        if($('#txtTeEngStatus').val() == 'pass'){
            if($('#txtTePassDate').val() == ''){
                $('#txtTePassDate').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            status: $('#txtTeStatus').val(),
            pass_date: $('#txtTePassDate').val(),
            progress: 'te'
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
    update_ec_status(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtEcStatus').val() == ''){
            $('#txtEcStatus').addClass('is-invalid'); $check++;
        }

        if($('#txtEcStatus').val() == 'pass'){
            if($('#txtEcPassDate').val() == ''){
                $('#txtEcPassDate').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            status: $('#txtEcStatus').val(),
            pass_date: $('#txtEcPassDate').val(),
            progress: 'ec'
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
    update_pub(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtPubTitleU').val() == ''){
            $('#txtPubTitleU').addClass('is-invalid'); $check++;
        }

        if($('#txtPubAuthorU').val() == ''){
            $('#txtPubAuthorU').addClass('is-invalid'); $check++;
        }

        if($('#txtPubPublisherU').val() == ''){
            $('#txtPubPublisherU').addClass('is-invalid'); $check++;
        }

        if($('#txtPubDateU').val() == ''){
            $('#txtPubDateU').addClass('is-invalid'); $check++;
        }

        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            progress_id: $('#txtPubId').val(),
            title: $('#txtPubTitleU').val(),
            pub_date: $('#txtPubDateU').val(),
            author: $('#txtPubAuthorU').val(),
            publisher: $('#txtPubPublisherU').val()
        }

        var jxr = $.post(api + 'progress?stage=update_pub', param, function(){}, 'json')
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
    save_ce(){
        $check = 0;
        console.log('asd');
        $('.form-control').removeClass('is-invalid')
        if($('#txtCeTitle').val() == ''){
            $('#txCetTitle').addClass('is-invalid'); $check++;
        }

        if($('#txtCeExamDate').val() != ''){
            if($('#txtCeExamStart').val() == ''){
                $('#txtCeExamStart').addClass('is-invalid'); $check++;
            }

            if($('#txtCeExamEnd').val() == ''){
                $('#txtCeExamEnd').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            title: $('#txtCeTitle').val(),
            exam_date: $('#txtCeExamDate').val(),
            exam_start: $('#txtCeExamStart').val(),
            exam_end: $('#txtCeExamEnd').val()
        }
        console.log(param);
        preload.show()
        var jxr = $.post(api + 'progress?stage=add_ce', param, function(){}, 'json')
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
    save_te(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtTeTitle').val() == ''){
            $('#txtTeTitle').addClass('is-invalid'); $check++;
        }

        if($('#txtTeExamDate').val() != ''){
            if($('#txtTeExamStart').val() == ''){
                $('#txtTeExamStart').addClass('is-invalid'); $check++;
            }

            if($('#txtTeExamEnd').val() == ''){
                $('#txtTeExamEnd').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            title: $('#txtTeTitle').val(),
            exam_date: $('#txtTeExamDate').val(),
            exam_start: $('#txtTeExamStart').val(),
            exam_end: $('#txtTeExamEnd').val()
        }
        console.log(param);
        preload.show()
        var jxr = $.post(api + 'progress?stage=add_te', param, function(){}, 'json')
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
    save_eng(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtEngTitle').val() == ''){
            $('#txtEngTitle').addClass('is-invalid'); $check++;
        }

        if($('#txtEngExamname').val() == ''){
            $('#txtEngExamname').addClass('is-invalid'); $check++;
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            exam_info: $('#txtEngTitle').val(),
            exam_name: $('#txtEngExamname').val(),
            exam_date: $('#txtEngExamDate').val()
        }
        console.log(param);
        preload.show()
        var jxr = $.post(api + 'progress?stage=add_eng', param, function(){}, 'json')
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
    update_qe(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtQeTitleU').val() == ''){
            $('#txtQeTitleU').addClass('is-invalid'); $check++;
        }

        if($('#txtQeExamDateU').val() != ''){
            if($('#txtQeExamStartU').val() == ''){
                $('#txtQeExamStartU').addClass('is-invalid'); $check++;
            }

            if($('#txtQeExamEndU').val() == ''){
                $('#txtQeExamEndU').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            progress_id: $('#txtQeId').val(),
            title: $('#txtQeTitleU').val(),
            exam_date: $('#txtQeExamDateU').val(),
            exam_start: $('#txtQeExamStartU').val(),
            exam_end: $('#txtQeExamEndU').val()
        }
        console.log(param);
        preload.show();
        // return ;

        var jxr = $.post(api + 'progress?stage=update_qe', param, function(){}, 'json')
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
    update_ce(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtCeTitleU').val() == ''){
            $('#txtCeTitleU').addClass('is-invalid'); $check++;
        }

        if($('#txtCeExamDateU').val() != ''){
            if($('#txtCeExamStartU').val() == ''){
                $('#txtCeExamStartU').addClass('is-invalid'); $check++;
            }

            if($('#txtCeExamEndU').val() == ''){
                $('#txtCeExamEndU').addClass('is-invalid'); $check++;
            }
        }
        
        if($check != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            progress_id: $('#txtCeId').val(),
            title: $('#txtCeTitleU').val(),
            exam_date: $('#txtCeExamDateU').val(),
            exam_start: $('#txtCeExamStartU').val(),
            exam_end: $('#txtCeExamEndU').val()
        }
        console.log(param);
        // return ;
        preload.show()
        var jxr = $.post(api + 'progress?stage=update_ce', param, function(){}, 'json')
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
        $('#txtPeExamStartU').val(s.slice(0, -3))
        $('#txtPeExamEndU').val(e.slice(0, -3))
    }
}

function update_pub_setup(id, title, d, s, e){
    $('#modalPubUpdaterecord').modal('show')
    $('#txtPubId').val(id)
    $('#txtPubTitleU').val(title)
    $('#txtPubAuthorU').val(e)
    $('#txtPubPublisherU').val(s)
    $('#txtPubDateU').val(d)


    // $('#txtPeExamDateU').val(d)
    // if(d != ''){
    //     console.log(s.slice(0, -3));
    //     $('#txtPeExamStartU').val(s.slice(0, -3))
    //     $('#txtPeExamEndU').val(e.slice(0, -3))
    // }
}

function update_ce_setup(id, title, d, s, e){
    $('#modalCeUpdaterecord').modal('show')
    $('#txtCeId').val(id)
    $('#txtCeTitleU').val(title)

    $('#txtCeExamDateU').val(d)
    if(d != ''){
        console.log(s.slice(0, -3));
        $('#txtCeExamStartU').val(s.slice(0, -3))
        $('#txtCeExamEndU').val(e.slice(0, -3))
    }
}

function update_qe_setup(id, title, d, s, e){
    $('#modalQeUpdaterecord').modal('show')
    $('#txtQeId').val(id)
    $('#txtQeTitleU').val(title)

    $('#txtQeExamDateU').val(d)
    if(d != ''){
        console.log(s.slice(0, -3));
        $('#txtQeExamStartU').val(s.slice(0, -3))
        $('#txtQeExamEndU').val(e.slice(0, -3))
    }
}