<?php
include('DynamicClass.php');
$ijDynamic = new IJDynamic();

$html = $ijDynamic->generateQuestions();
?>
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
                url: '/student/manage',
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

        $.ajax({
            url: '/student/professor/<?=$_SESSION['department_id']?>/list',
            method: 'GET',
            dataType: 'json',
            success: function(response){
                var select = $("#professor_names");

                $.each(response, function(index, item){
                    var option = $("<option>").val(item.professor_id).text(item.fname+' '+item.lname);
                    select.append(option);
                });
            },
            error: function(xhr, status, error){
                console.error(error);
            }
        });

        $("#professor_names").change(function() {
            $.ajax({
                url: '/student/evaluate/check/'+$(this).val(),
                method: 'POST',
                success: function(data){
                    if(data.length !== 0){
                        $("#form_container").html("<h1>You already submitted an evaluation. You cannot submit again.</h1>");
                        $("#submitForm").hide();
                    } else {
                        $("#form_container").html(`<?=$html?>`);
                        $("#submitForm").show();
                        $('input[type="radio"]').prop('required', true);
                    }
                    
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });
        });

        $('#EvaluateForm').submit(function (event){
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
                url: '/student/evaluate/submit',
                method: 'POST',
                data: formData,
                success: function(data){
                    data = JSON.parse(data);
                    $('#addQuestionModal').modal('hide');
                    if(data.success === 'false'){
                        swalInit.close();
                        swalInit.fire({
                            text: 'Submission failed!',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        swalInit.close();
                        swalInit.fire({
                            text: 'Submission success!',
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        }).then(() => {
                            window.location = '/student/evaluate';
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
    });
</script>