var student = {
    reload_student_list(){
        window.location = window.location.pathname + '?filter1=' + $('#users-degree').val() + '&filter2=' + $('#users-status').val()
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
    getNote(std_id){
        preload.show()
        var jxr = $.post(api + 'student?stage=get_note', {uid: $('#txtUid').val(), std_id: std_id}, function(){}, 'json')
                   .always(function(snap){
                       if(snap.status == 'Success'){
                            $('#noteList').empty()
                            $i = 0;
                            snap.data.forEach(i => {
                                if($('#txtRole').val() == 'admin'){
                                    $del = ''
                                    if(i.note_delete == 'Y'){
                                        $del = '<span class="badge badge-danger round ml-1">Deleted</span>'
                                    }
                                    $data = '<tr>' + 
                                            '<td class="pt-0">' + i.note_datetime + '</td>' + 
                                            '<td class="pt-1 pb-1">'+
                                                i.note_message + 
                                                '<div style="padding: 3px 0px 0px 0px; border: solid; border-width: 0px 0px 0px 0px; border-color: #ccc; font-size: 0.8em;">' + 
                                                    '<span class="badge badge-secondary round">BY : ' + i.FNAME + ' ' + i.LNAME + '</span>' + $del + 
                                                    '<a href="Javascript:student.deleteNote(\'' + i.note_id + '\'); " class="btn text-danger pl-0 btn-sm mr-1 float-right" style="padding: 5px 0px 7px 0px;"><i class="bx bx-trash"></i></a>' +
                                                '</div>' +
                                            '</td>' +
                                        '</tr>'
                                    $('#noteList').append($data)
                                }else{
                                    
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
                                        $i++;
                                    }
                                }
                                
                            });
                            preload.hide()
                            if($i == 0){
                                $('#noteList').empty()
                                $('#noteList').html('<tr><td colspan="2">No record found.</td></tr>')
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
        console.log(param);
        preload.show()
        var jxr = $.post(api + 'student?stage=save_note', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       if(snap.status == 'Success'){
                        student.getNote($('#txtStudentId').val())
                        editor_doclist.setData('')
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