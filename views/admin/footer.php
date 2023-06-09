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
            new gridjs.Grid({ 
                columns: ['Category', 'Actions'],
                data: [
                    ['A. KNOWLEDGE OF THE SUBJECT MATTER', gridjs.html(`<button type="button" class="btn btn-primary text-white">Questions</button>&nbsp;<button type="button" class="btn btn-warning text-white">Edit</button>&nbsp;<button type="button" class="btn btn-danger text-white">Delete</button>`)]
                ],
                search: true
            }).render(document.getElementById('category'));
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