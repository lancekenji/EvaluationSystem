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
                url: '/professor/manage',
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
        <?php if($currentUrl == '/professor/result') : ?>

            $.ajax({
                url: '/professor/result/count',
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
                url: '/professor/result/total',
                then: data => data.map(total => [
                    total.question_text, total.percentage5, total.percentage4, total.percentage3, total.percentage2, total.percentage1
                ])
            }

        }).render(document.getElementById('result')).forceRender();
        <?php endif; ?>

    });
</script>