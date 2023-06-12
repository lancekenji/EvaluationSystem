<script>
    
    $(document).ready(function(){
        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control',
                popup: 'custom-width'
            },
        });

        $('#manageProfileForm').submit(function (event){
            event.preventDefault();

            var formData = $(this).serialize();
            swalInit.fire({
                position: 'top-end',
                toast: true,
                text: 'Please wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                timer: 3000
            });

            $.ajax({
                url: '/admin/manage',
                method: 'POST',
                data: formData,
                success: function(data){
                    data = JSON.parse(data);
                    $('#manageProfile').modal('hide');
                    if(data.success === 'false'){
                        swalInit.close();
                        swalInit.fire({
                            text: 'User modification failed!',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        swalInit.close();
                        swalInit.fire({
                            text: 'User modified successfully!',
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error: function(error){
                    swalInit.close();
                    swalInit.fire({
                        title: 'Error',
                        text: 'There is error occurred. Please contact the administrator.',
                        icon: 'error',
                        toast: true,
                        position: 'top-end',
                        timer: 3000
                    });
                    console.log("Error: ", error);
                }
            });
        });

        <?php if($currentUrl == '/admin/result') : ?>

            $.ajax({
                url: '/admin/department/list',
                method: 'GET',
                dataType: 'json',
                success: function(response){
                    var select = $("#department");

                    $.each(response, function(index, item){
                        var option = $("<option>").val(item.department_id).text(item.department_name);
                        select.append(option);
                    });
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });

            $("#department").change(function() {
                $.ajax({
                    url: '/admin/professors/list/'+$(this).val(),
                    method: 'GET',
                    dataType: 'json',
                    success: function(response){
                        var select = $("#professor");

                        $.each(response, function(index, item){
                            var option = $("<option>").val(item.professor_id).text(item.fname+' '+item.lname);
                            select.append(option);
                        });
                    },
                    error: function(xhr, status, error){
                        console.error(error);
                    }
                });
            });

            $("#professor").change(function() {
                $('#result').empty();
                $.ajax({
                    url: '/admin/result/'+$(this).val()+'/count',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#total').text(data.student_count);
                        
                    },
                    error: function(xhr, status, error){
                        console.error(error);
                    }
                });

                new gridjs.Grid({ 
                    columns: [
                        {
                            id: 'question',
                            name: 'Question',
                            width: '200px',
                        },
                        {
                            id: 'answer5',
                            name: gridjs.html('<div style="text-align: center">5</div>'),
                            width: '50px',
                            formatter: (_, row) => gridjs.html(`<div style="text-align: center">${row.cells[1].data}</div>`)
                        },
                        {
                            id: 'answer4',
                            name: gridjs.html('<div style="text-align: center">4</div>'),
                            width: '50px',
                            formatter: (_, row) => gridjs.html(`<div style="text-align: center">${row.cells[2].data}</div>`)
                        },
                        {
                            id: 'answer3',
                            name: gridjs.html('<div style="text-align: center">3</div>'),
                            width: '50px',
                            formatter: (_, row) => gridjs.html(`<div style="text-align: center">${row.cells[3].data}</div>`)
                        },
                        {
                            id: 'answer2',
                            name: gridjs.html('<div style="text-align: center">2</div>'),
                            width: '50px',
                            formatter: (_, row) => gridjs.html(`<div style="text-align: center">${row.cells[4].data}</div>`)
                        },
                        {
                            id: 'answer1',
                            name: gridjs.html('<div style="text-align: center">1</div>'),
                            width: '50px',
                            formatter: (_, row) => gridjs.html(`<div style="text-align: center">${row.cells[5].data}</div>`)
                        },
                    ],

                    server: {
                        url: '/admin/result/'+$(this).val()+'/total',
                        then: data => data.map(total => [
                            total.question_text, total.percentage5, total.percentage4, total.percentage3, total.percentage2, total.percentage1
                        ])
                    }

                }).render(document.getElementById('result')).forceRender();

                $("#printBtn").click(function() {
                    window.open('/admin/result/'+$("#professor").val()+'/'+$("#department").val()+'/print');
                });
                
            });
            
        <?php endif; ?>

        <?php if($currentUrl == '/admin/dashboard') : ?>

            $.ajax({
                url: '/admin/department/list',
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    var departments = data.length;
                    $('#departments').text(departments);
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });

            $.ajax({
                url: '/admin/section/list',
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    var sections = data.length;
                    $('#sections').text(sections);
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });

            $.ajax({
                url: '/admin/professors/list',
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    var professors = data.length;
                    $('#professors').text(professors);
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });

            $.ajax({
                url: '/admin/students/list',
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    var students = data.length;
                    $('#students').text(students);
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });
            
        <?php endif; ?>
        <?php if($currentUrl == '/admin/department') : ?>
            // Department Table

        var grid = new gridjs.Grid({ 
            columns: ['Department Name', 'Description', 'Actions'],
            server: {
                url: '/admin/department/list',
                then: data => data.map(department => [department.department_name, department.description, gridjs.html(`
                <button type="button" class="btn btn-warning text-white" onclick="$('#editDepartmentModal').modal('show');$('#editDepartmentModal #department_id').val('`+department.department_id+`');$('#editDepartmentModal #department_name').val('`+department.department_name+`');$('#editDepartmentModal #description').val('`+department.description+`');">Edit</button>&nbsp;<button type="button" class="btn btn-danger text-white" onclick="$('#deleteDepartmentModal').modal('show');$('#deleteDepartmentModal #department_id').val('`+department.department_id+`');">Delete</button>
                `)])
            },
            search: true
        }).render(document.getElementById('department'));
        
        $('#editDepartmentForm').submit(function (event){
            event.preventDefault();

            var formData = $(this).serialize();
            swalInit.fire({
                position: 'top-end',
                toast: true,
                text: 'Please wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                timer: 3000
            });

            $.ajax({
                url: '/admin/department/edit',
                method: 'POST',
                data: formData,
                success: function(data){
                    data = JSON.parse(data);
                    $('#editDepartmentModal').modal('hide');
                    grid.forceRender();
                    if(data.success === 'false'){
                        swalInit.close();
                        swalInit.fire({
                            text: 'Department modification failed!',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        swalInit.close();
                        swalInit.fire({
                            text: 'Department modified successfully!',
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error: function(error){
                    swalInit.close();
                    swalInit.fire({
                        title: 'Error',
                        text: 'There is error occurred. Please contact the administrator.',
                        icon: 'error',
                        toast: true,
                        position: 'top-end',
                        timer: 3000
                    });
                    console.log("Error: ", error);
                }
            });
        });

        $('#addDepartmentForm').submit(function (event){
            event.preventDefault();

            var formData = $(this).serialize();
            swalInit.fire({
                position: 'top-end',
                toast: true,
                text: 'Please wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                timer: 3000
            });

            $.ajax({
                url: '/admin/department/create',
                method: 'POST',
                data: formData,
                success: function(data){
                    data = JSON.parse(data);
                    $('#addDepartmentModal').modal('hide');
                    $('#department_name, #description').val('');
                    grid.forceRender();
                    if(data.success === 'false'){
                        swalInit.close();
                        swalInit.fire({
                            text: 'Department adding failed!',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        swalInit.close();
                        swalInit.fire({
                            text: 'Department added successfully!',
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error: function(error){
                    swalInit.close();
                    swalInit.fire({
                        title: 'Error',
                        text: 'There is error occurred. Please contact the administrator.',
                        icon: 'error',
                        toast: true,
                        position: 'top-end',
                        timer: 3000
                    });
                    console.log("Error: ", error);
                }
            });
        });

        $('#deleteDepartmentForm').submit(function (event){
            event.preventDefault();

            var formData = $(this).serialize();
            swalInit.fire({
                position: 'top-end',
                toast: true,
                text: 'Please wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                timer: 3000
            });

            $.ajax({
                url: '/admin/department/delete',
                method: 'POST',
                data: formData,
                success: function(data){
                    data = JSON.parse(data);
                    $('#deleteDepartmentModal').modal('hide')
                    grid.forceRender();
                    if(data.success === 'false'){
                        swalInit.close();
                        swalInit.fire({
                            text: 'Department deletion failed!',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        swalInit.close();
                        swalInit.fire({
                            text: 'Department deleted successfully!',
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error: function(error){
                    swalInit.close();
                    swalInit.fire({
                        title: 'Error',
                        text: 'There is error occurred. Please contact the administrator.',
                        icon: 'error',
                        toast: true,
                        position: 'top-end',
                        timer: 3000
                    });
                    console.log("Error: ", error);
                }
            });
        });
        
        <?php endif; ?>

        <?php if((rtrim(dirname($_SERVER['REQUEST_URI']), '/') . '/') === '/admin/questions/'): ?>
            // Question Table

            $.ajax({
                url: '/admin/category/list',
                method: 'GET',
                dataType: 'json',
                success: function(response){
                    var select = $("#category_id");

                    $.each(response, function(index, item){
                        var option = $("<option>").val(item.category_id).text(item.category_name);
                        select.append(option);
                    });
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });

            var grid = new gridjs.Grid({ 
                columns: ['Question Text', 'Actions'],
                server: {
                    url: '/admin/questions/<?=basename($_SERVER['REQUEST_URI'])?>/list',
                    then: data => data.map(question => [question.question_text, gridjs.html(`
                    <button type="button" class="btn btn-warning text-white" onclick="$('#editQuestionModal').modal('show');$('#editQuestionModal #question_id1').val('`+question.question_id+`');$('#editQuestionModal #question_text1').val('`+question.question_text+`');">Edit</button>&nbsp;<button type="button" class="btn btn-danger text-white" onclick="$('#deleteQuestionModal').modal('show');$('#deleteQuestionModal #question_id').val('`+question.question_id+`');">Delete</button>
                    `)])
                },
                search: true
            }).render(document.getElementById('questions'));

            $('#addQuestionForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/questions/<?=basename($_SERVER['REQUEST_URI'])?>/create',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#addQuestionModal').modal('hide');
                        $('#question_text').val('');
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Question adding failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Question added successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });

            $('#deleteQuestionForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/questions/<?=basename($_SERVER['REQUEST_URI'])?>/delete',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#deleteQuestionModal').modal('hide')
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Question deletion failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Question deleted successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });

            $('#editQuestionForm').submit(function (event){
            event.preventDefault();

            var formData = $(this).serialize();
            swalInit.fire({
                position: 'top-end',
                toast: true,
                text: 'Please wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                timer: 3000
            });

            $.ajax({
                url: '/admin/questions/<?=basename($_SERVER['REQUEST_URI'])?>/edit',
                method: 'POST',
                data: formData,
                success: function(data){
                    data = JSON.parse(data);
                    $('#editQuestionModal').modal('hide');
                    grid.forceRender();
                    if(data.success === 'false'){
                        swalInit.close();
                        swalInit.fire({
                            text: 'Question modification failed!',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        swalInit.close();
                        swalInit.fire({
                            text: 'Question modified successfully!',
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error: function(error){
                    swalInit.close();
                    swalInit.fire({
                        title: 'Error',
                        text: 'There is error occurred. Please contact the administrator.',
                        icon: 'error',
                        toast: true,
                        position: 'top-end',
                        timer: 3000
                    });
                    console.log("Error: ", error);
                }
            });
        });

        <?php endif; ?>

        <?php if($currentUrl == '/admin/section') : ?>
            // Section Table

            var grid = new gridjs.Grid({ 
                columns: ['Section Name', 'Actions'],
                server: {
                    url: '/admin/section/list',
                    then: data => data.map(section => [section.section_name, gridjs.html(`
                    <button type="button" class="btn btn-warning text-white" onclick="$('#editSectionModal').modal('show');$('#editSectionModal #section_id').val('`+section.section_id+`');$('#editSectionModal #section_name').val('`+section.section_name+`');">Edit</button>&nbsp;<button type="button" class="btn btn-danger text-white" onclick="$('#deleteSectionModal').modal('show');$('#deleteSectionModal #section_id').val('`+section.section_id+`');">Delete</button>
                    `)])
                },
                search: true
            }).render(document.getElementById('section'));

            $('#editSectionForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/section/edit',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#editSectionModal').modal('hide');
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Section modification failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Section modified successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });

            $('#addSectionForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/section/create',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#addSectionModal').modal('hide');
                        $('#section_name').val('');
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Section adding failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Section added successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });

            $('#deleteSectionForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/section/delete',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#deleteSectionModal').modal('hide')
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Section deletion failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Section deleted successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });
        <?php endif; ?>

        <?php if($currentUrl == '/admin/professors') : ?>
            // Professors Table

            $.ajax({
                url: '/admin/department/list',
                method: 'GET',
                dataType: 'json',
                success: function(response){
                    var select = $("#department_id");

                    $.each(response, function(index, item){
                        var option = $("<option>").val(item.department_id).text(item.department_name);
                        select.append(option);
                    });
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });

            var grid = new gridjs.Grid({ 
                columns: ['First Name', 'Last Name', 'Email', 'Department', 'Actions'],
                server: {
                    url: '/admin/professors/list',
                    then: data => data.map(professor => [professor.fname, professor.lname, professor.email, professor.department_name, gridjs.html(`
                    <button type="button" class="btn btn-warning text-white" onclick="
                    $('#editProfessorModal').modal('show').find('#professor_id').val('`+professor.professor_id+`').end().find('#fname1').val('`+professor.fname+`').end().find('#lname1').val('`+professor.lname+`').end().find('#email1').val('`+professor.email+`');
                    $('#department_id1').append($('<option selected>').val('`+professor.department_id+`').text('`+professor.department_name+`'));
                    ">Edit</button>&nbsp;<button type="button" class="btn btn-danger text-white" onclick="$('#deleteProfessorModal').modal('show');$('#deleteProfessorModal #professor_id1').val('`+professor.professor_id+`');">Delete</button>
                    `)])
                },
                search: true
            }).render(document.getElementById('professors'));

            $('#addProfessorForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/professors/create',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#addProfessorModal').modal('hide');
                        $('#editProfessorModal input, #editProfessorModal select').val('');
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Professor adding failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Professor added successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });

            $('#editProfessorForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/professors/edit',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#editProfessorModal').modal('hide');
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Professor modification failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Professor modified successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });

            $('#deleteProfessorForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/professors/delete',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#deleteProfessorModal').modal('hide')
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Professor deletion failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Professor deleted successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });
        <?php endif; ?>

        <?php if($currentUrl == '/admin/students') : ?>
            // Students Table

            $.ajax({
                url: '/admin/department/list',
                method: 'GET',
                dataType: 'json',
                success: function(response){
                    var select = $("#department_id");

                    $.each(response, function(index, item){
                        var option = $("<option>").val(item.department_id).text(item.department_name);
                        select.append(option);
                    });
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });

            $.ajax({
                url: '/admin/section/list',
                method: 'GET',
                dataType: 'json',
                success: function(response){
                    var select = $("#section");

                    $.each(response, function(index, item){
                        var option = $("<option>").val(item.section_id).text(item.section_name);
                        select.append(option);
                    });
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });

            var grid = new gridjs.Grid({ 
                columns: ['First Name', 'Last Name', 'Email', 'Year Level', 'Department', 'Section', 'Actions'],
                server: {
                    url: '/admin/students/list',
                    then: data => data.map(students => [students.fname, students.lname, students.email, students.year_level, students.department_name, students.section_name, gridjs.html(`
                    <button type="button" class="btn btn-warning text-white" onclick="
                    $('#editStudentModal').modal('show').find('#student_id').val('`+students.student_id+`').end().find('#fname1').val('`+students.fname+`').end().find('#lname1').val('`+students.lname+`').end().find('#email1').val('`+students.email+`');
                    $('#department_id1').append($('<option selected>').val('`+students.department_id+`').text('`+students.department_name+`'));$('#year_level1').append($('<option selected>').val('`+students.year_level+`').text('`+students.year_level+`'));$('#section1').append($('<option selected>').val('`+students.section_id+`').text('`+students.section_name+`'));
                    ">Edit</button>&nbsp;<button type="button" class="btn btn-danger text-white" onclick="$('#deleteStudentModal').modal('show');$('#deleteStudentModal #student_id1').val('`+students.student_id+`');">Delete</button>
                    `)])
                },
                search: true
            }).render(document.getElementById('students'));

            $('#addStudentForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/students/create',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#addStudentModal').modal('hide');
                        $('#editStudentModal input, #editStudentModal select').val('');
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Student adding failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Student added successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });

            $('#editStudentForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/students/edit',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#editStudentModal').modal('hide');
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Student modification failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Student modified successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });
            
            $('#deleteStudentForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/students/delete',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#deleteStudentModal').modal('hide')
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Student deletion failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Student deleted successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });
        <?php endif; ?>

        <?php if($currentUrl == '/admin/evaluation') : ?>
            // Evaluation Table
            var grid = new gridjs.Grid({ 
                columns: ['Category', 'Actions'],
                server: {
                    url: '/admin/category/list',
                    then: data => data.map(category => [category.category_name, gridjs.html(`
                    <button type="button" class="btn btn-primary text-white" onclick="window.location='/admin/questions/`+category.category_id+`'">Questions</button>&nbsp; 
                    <button type="button" class="btn btn-warning text-white" onclick="$('#editCategoryModal').modal('show');$('#editCategoryModal #category_id').val('`+category.category_id+`');$('#editCategoryModal #category_name').val('`+category.category_name+`');">Edit</button>&nbsp;<button type="button" class="btn btn-danger text-white" onclick="$('#deleteCategoryModal').modal('show');$('#deleteCategoryModal #category_id').val('`+category.category_id+`');">Delete</button>
                    `)])
                },
                search: true
            }).render(document.getElementById('category'));

            $('#editCategoryForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/category/edit',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#editCategoryModal').modal('hide');
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Category modification failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Category modified successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });

            $('#addCategoryForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/category/create',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#addCategoryModal').modal('hide');
                        $('#category_name').val('');
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Category adding failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Category added successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });

            $('#deleteCategoryForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/category/delete',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#deleteCategoryModal').modal('hide')
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'Category deletion failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'Category deleted successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });
        <?php endif; ?>

        <?php if($currentUrl == '/admin/users') : ?>
            // Users Table

            var grid = new gridjs.Grid({ 
                columns: ['Name', 'Email', 'Actions'],
                server: {
                    url: '/admin/users/list',
                    then: data => data.map(user => [user.name, user.username, gridjs.html(`
                    <button type="button" class="btn btn-warning text-white" onclick="$('#editUserModal').modal('show');$('#editUserModal #user_id2').val('`+user.user_id+`');$('#editUserModal #username1').val('`+user.username+`');$('#editUserModal #name1').val('`+user.name+`');">Edit</button>&nbsp;<button type="button" class="btn btn-danger text-white" onclick="$('#deleteUserModal').modal('show');$('#deleteUserModal #user_id1').val('`+user.user_id+`');">Delete</button>
                    `)])
                },
                search: true
            }).render(document.getElementById('users'));

            $('#addUserForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/users/create',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#addUserModal').modal('hide');
                        $('#username, #name, #password').val('');
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'User adding failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'User added successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });

            $('#deleteUserForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/users/delete',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#deleteUserModal').modal('hide')
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'User deletion failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'User deleted successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });

            $('#editUserForm').submit(function (event){
                event.preventDefault();

                var formData = $(this).serialize();
                swalInit.fire({
                    position: 'top-end',
                    toast: true,
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                $.ajax({
                    url: '/admin/users/edit',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);
                        $('#editUserModal').modal('hide');
                        grid.forceRender();
                        if(data.success === 'false'){
                            swalInit.close();
                            swalInit.fire({
                                text: 'User modification failed!',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            swalInit.close();
                            swalInit.fire({
                                text: 'User modified successfully!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error){
                        swalInit.close();
                        swalInit.fire({
                            title: 'Error',
                            text: 'There is error occurred. Please contact the administrator.',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                        console.log("Error: ", error);
                    }
                });
            });
        <?php endif; ?>
    });

</script>