var student = {
    update_profile(username){

        $check = 0; $('.form-control').removeClass('is-invalid')

        if($('#txtCountry').val() == ''){ $check++; $('#txtCountry').addClass('is-invalid'); }
        if($('#txtFname').val() == ''){ $check++; $('#txtFname').addClass('is-invalid'); }
        if($('#txtLname').val() == ''){ $check++; $('#txtLname').addClass('is-invalid'); }
        if($('#txtTitle').val() == ''){ $check++; $('#txtTitle').addClass('is-invalid'); }

        if($check != 0){ return ;}

        var param = {
            username: username,
            contry: $('#txtCountry').val(),
            fname: $('#txtFname').val(),
            mname: $('#txtMname').val(),
            lname: $('#txtLname').val(),
            prefix: $('#txtTitle').val(),
            uid: $('#txtUid').val()
        }

        console.log(param);

        preload.show()
        var jxr = $.post(api + 'student?stage=update_student_profile', param, function(){}, 'json')
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
    update_address(username){
        $check = 0; $('.form-control').removeClass('is-invalid')

        if($('#txtEmail').val() == ''){ $check++; $('#txtEmail').addClass('is-invalid'); }

        if($check != 0){ return ;}

        var param = {
            username: username,
            email: $('#txtEmail').val(),
            tel: $('#txtPhone').val(),
            address: $('#txtAddress').val(),
            hmtel: $('#txtHomeTel').val(),
            hmaddress: $('#txtHomeAddress').val(),
            wptel: $('#txtWorkplaceTel').val(),
            wpaddress: $('#txtWorkplaceAddress').val(),
            uid: $('#txtUid').val()
        }

        console.log(param);
        preload.show()
        
        var jxr = $.post(api + 'student?stage=update_student_address', param, function(){}, 'json')
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
    update_immigration(username){
        var param = {
            username: username,
            cid: $('#txtCid').val(),
            cid_iss: $('#txtCidIssue').val(),
            cid_exp: $('#txtCidExp').val(),
            visa: $('#txtVisa').val(),
            visa_iss: $('#txtVisaIssue').val(),
            visa_exp: $('#txtVisaExp').val(),
            passport: $('#txtPassport').val(),
            passport_iss: $('#txtPassportIssue').val(),
            passport_exp: $('#txtPassportExp').val(),
            uid: $('#txtUid').val()
        }

        console.log(param);
        preload.show()
        
        var jxr = $.post(api + 'student?stage=update_student_immigration', param, function(){}, 'json')
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
    reload_student_list(){
        window.location = window.location.pathname + '?filter1=' + $('#users-degree').val() + '&filter2=' + $('#users-status').val() + '&filter3=' + $('#txtKeyword').val() + '&key=' + $('#txtKey').val()
    },
    deleteNote(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "This record will be can not recovery after delete.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'confirm',
            cancelButtonText: 'cancel',
            confirmButtonClass: 'btn btn-danger mr-1',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                preload.show()
                var jxr = $.post(api + 'student?stage=deletenote', {uid: $('#txtUid').val(), noteid: id}, function(){}, 'json')
                           .always(function(snap){
                               console.log(snap);
                               if(snap.status == 'Success'){
                                   student.getNote($('#txtStudentId').val())
                               }else{
                                   preload.hide()
                                   Swal.fire({
                                        icon: "error",
                                        title: 'Error',
                                        text: "Can not delete note",
                                        confirmButtonText: 'Re-try',
                                        confirmButtonClass: 'btn btn-danger',
                                    })
                               }
                           })

            }
        })
    },
    setNoteInfo(note_id){
        preload.show()
        var jxr = $.post(api + 'student?stage=get_note_info', {uid: $('#txtUid').val(), note_id: note_id}, function(){}, 'json')
                   .always(function(snap){
                        preload.hide()
                        if(snap.status == 'Success'){

                        }else{

                        }
                   })
    },
    getNote(std_id){
        preload.show()
        var jxr = $.post(api + 'student?stage=get_note', {uid: $('#txtUid').val(), std_id: std_id}, function(){}, 'json')
                   .always(function(snap){
                        console.log(snap);
                        console.log($('#txtRole').val());
                        if(snap.status == 'Success'){
                            $('#noteList').empty()
                            $i = 0;
                            snap.data.forEach(i => {
                                
                                if($('#txtRole').val() == 'admin'){
                                    $del = '<a href="Javascript:student.deleteNote(\'' + i.note_id + '\'); " class="btn text-danger pl-0 btn-sm mr-1 float-right" style="padding: 5px 0px 7px 0px;"><i class="bx bx-trash"></i></a>'
                                    if(i.note_delete == 'Y'){
                                        $del = '<span class="badge badge-danger round ml-1">Deleted</span>'
                                    }
                                    $data = '<tr>' + 
                                                '<td class="pt-0">' + i.note_datetime + '</td>' + 
                                                '<td class="pt-1 pb-1">'+
                                                    i.note_message + 
                                                    '<div style="padding: 3px 0px 0px 0px; border: solid; border-width: 0px 0px 0px 0px; border-color: #ccc; font-size: 0.8em;">' + 
                                                        '<span class="badge badge-secondary round">BY : ' + i.FNAME + ' ' + i.LNAME + '</span>' + $del + 
                                                    '</div>' +
                                                '</td>' +
                                            '</tr>'
                                    $('#noteList').append($data)

                                    

                                    console.log($('#noteList').html());
                                    $i++;
                                }else{
                                    console.log('b');
                                    if(i.note_delete == 'N'){
                                        $data = '<tr>' + 
                                            '<td class="pt-0">' + i.note_datetime + '</td>' + 
                                            '<td class="pt-1 pb-1">'+
                                                i.note_message + 
                                                '<div style="padding: 3px 0px 0px 0px; border: solid; border-width: 0px 0px 0px 0px; border-color: #ccc; font-size: 0.8em;">' + 
                                                    '<span class="badge badge-secondary round">BY : ' + i.FNAME + ' ' + i.LNAME + '</span>' +
                                                    '<a href="Javascript:student.deleteNote(\'' + i.note_id + '\'); " class="btn text-danger pl-0 btn-sm mr-1 float-right" style="padding: 5px 0px 7px 0px;"><i class="bx bx-trash"></i></a>' +
                                                '</div>' +
                                            '</td>' +
                                        '</tr>'
                                        $('#noteList').append($data)

                                        if($i == 0){
                                            $('#noteDiv_' + std_id).html(i.note_message)
                                        }

                                        $i++;
                                    }else{

                                        $del = '<a href="Javascript:student.deleteNote(\'' + i.note_id + '\'); " class="btn text-danger pl-0 btn-sm mr-1 float-right" style="padding: 5px 0px 7px 0px;"><i class="bx bx-trash"></i></a>'
                                        if(i.note_delete == 'Y'){
                                            $del = '<span class="badge badge-danger round ml-1">Deleted</span>'
                                        }
                                        
                                        $data = '<tr>' + 
                                            '<td class="pt-0">' + i.note_datetime + '</td>' + 
                                            '<td class="pt-1 pb-1">'+
                                                i.note_message + 
                                                '<div style="padding: 3px 0px 0px 0px; border: solid; border-width: 0px 0px 0px 0px; border-color: #ccc; font-size: 0.8em;">' + 
                                                    '<span class="badge badge-secondary round">BY : ' + i.FNAME + ' ' + i.LNAME + '</span>' +
                                                    $del +
                                                '</div>' +
                                            '</td>' +
                                        '</tr>'
                                        // $('#noteList').append($data)
                                        $i++;
                                    }
                                }
                                
                            });
                            preload.hide()
                            if($i == 0){
                                $('#noteList').empty()
                                $('#noteList').html('<tr><td colspan="2">No record found.</td></tr>')
                            }else{
                                if($('#noteList').html() == ''){
                                    $('#noteList').html('<tr><td colspan="2">No record found.</td></tr>')
                                }
                            }
                       }else{
                           preload.hide()
                           $('#noteList').empty()
                           $('#noteList').html('<tr><td colspan="2">No record found.</td></tr>')
                       }
                   })
    },
    save_note(){
        $message = editor_doclist.getData()
        if($message == ''){
            Swal.fire({
                icon: "error",
                title: 'Error',
                text: "Please enter the note.",
                confirmButtonText: 'Re-try',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        var param = {
            uid: $('#txtUid').val(),
            std_id: $('#txtStudentId').val(),
            msg: $message
        }
        // console.log(param);
        // return ;
        preload.show()
        var jxr = $.post(api + 'student?stage=save_note', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       if(snap.status == 'Success'){
                            student.getNote($('#txtStudentId').val())
                            editor_doclist.setData('')
                            if($('#modalNoteDialog').length){
                                $('#modalNoteDialog').modal('hide')
                            }
                       }else{
                        preload.hide()
                        Swal.fire({
                            icon: "error",
                            title: 'Error',
                            text: "Can not save note.",
                            confirmButtonText: 'Re-try',
                            confirmButtonClass: 'btn btn-danger',
                        })
                       }
                   })
    },
    setmonitor(std_id){

        $('#msg1').text(std_id)
        
        var to_stage = 'N'
        if($('#customSwitch1_' + std_id).is(":checked")){
            to_stage = 'Y'
        }

        var jxr = $.post(api + 'student?stage=setmonitor', {uid: $('#txtUid').val(), std_id: std_id, to: to_stage}, function(){}, 'json')
                   .always(function(snap){
                        if(snap.status == 'Success'){
                            $('.toast-light-toggler').trigger('click')
                        }else{
                            preload.hide()

                            Swal.fire({
                                title: 'Error',
                                text: "Can not update status.",
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'confirm',
                                cancelButtonText: 'cancel',
                                confirmButtonClass: 'btn btn-danger mr-1',
                                cancelButtonClass: 'btn btn-secondary',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    if($('#customSwitch1_' + std_id).is(":checked")){
                                        $('#customSwitch1_' + std_id).prop('checked', false);
                                    }else{
                                        $('#customSwitch1_' + std_id).prop('checked', true);
                                    }
                                }
                            })
                        }
                    })
    },
    unmonitor(std_id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Confirm to un-monitor student id : " + std_id + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'confirm',
            cancelButtonText: 'cancel',
            confirmButtonClass: 'btn btn-danger mr-1',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                preload.show()
                var jxr = $.post(api + 'student?stage=unmonitor', {uid: $('#txtUid').val(), std_id: std_id}, function(){}, 'json')
                           .always(function(snap){
                               if(snap.status == 'Success'){
                                   window.location.reload()
                               }else{
                                   preload.hide()
                                   Swal.fire({
                                        icon: "error",
                                        title: 'Error',
                                        text: "Can not update status",
                                        confirmButtonText: 'Re-try',
                                        confirmButtonClass: 'btn btn-danger',
                                    })
                                    $('#customSwitch1_' + std_id).prop('checked', true);
                               }
                           })

            }else{
                $('#customSwitch1_' + std_id).prop('checked', true);
            }
        })
    }
}