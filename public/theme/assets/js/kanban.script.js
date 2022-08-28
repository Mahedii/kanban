$(document).ready(function () {

    function showtoDoData(data){

        $("#to-do .kanban-drag").html("");

        $.each(data, function( index, value ) {
            var row = $("<div class='kanban-item' id='to-do-"+value.TASK_ID+"'>" +
                "<div class='dropdown'>" +
                "<i class='fa-solid fa-ellipsis'></i>" +
                "<div class='dropdown-content'>" +
                "<a href='javascript:void(0)' data-id='"+value.TASK_ID+"' data-status='"+value.STATUS+"' data-url='/kanban-board/task/update' class='change-status-to-in-progress'>In-Progress</a>" +
                "<a href='javascript:void(0)' data-id='"+value.TASK_ID+"' data-status='"+value.STATUS+"' data-url='/kanban-board/task/update' class='change-status-to-done'>Done</a>" +
                "<a href='javascript:void(0)' data-id='"+value.TASK_ID+"' data-status='"+value.STATUS+"' data-url='/kanban-board/task/delete/"+value.TASK_ID+"' class='delete-task'>Delete</a>" +
                "</div>" +
                "</div>" +
                "<span class='font-weight-bold'>" + value.DESCRIPTION + "</span>" +
                "</div>");

            $("#to-do .kanban-drag").append(row);
        });

    }

    function showInProgressData(data){ 

        $("#in-progress .kanban-drag").html("");

        $.each(data, function( index, value ) {
            var row = $("<div class='kanban-item' id='in-progress-"+value.TASK_ID+"'>" +
                "<div class='dropdown'>" +
                "<i class='fa-solid fa-ellipsis'></i>" +
                "<div class='dropdown-content'>" +
                "<a href='javascript:void(0)' data-id='"+value.TASK_ID+"' data-status='"+value.STATUS+"' data-url='/kanban-board/task/update' class='change-status-to-done'>Done</a>" +
                "<a href='javascript:void(0)' data-id='"+value.TASK_ID+"' data-status='"+value.STATUS+"' data-url='/kanban-board/task/delete/"+value.TASK_ID+"' class='delete-task'>Delete</a>" +
                "</div>" +
                "</div>" +
                "<span class='font-weight-bold'>" + value.DESCRIPTION + "</span>" +
                "</div>");

            $("#in-progress .kanban-drag").append(row);
        });

    }

    function showDoneData(data){

        $("#done .kanban-drag").html("");

        $.each(data, function( index, value ) {
            var row = $("<div class='kanban-item' id='done-"+value.TASK_ID+"'>" +
                "<div class='dropdown'>" +
                "<i class='fa-solid fa-ellipsis'></i>" +
                "<div class='dropdown-content'>" +
                "<a href='javascript:void(0)' data-id='"+value.TASK_ID+"' data-status='"+value.STATUS+"' data-url='/kanban-board/task/delete/"+value.TASK_ID+"' class='delete-task'>Delete</a>" +
                "</div>" +
                "</div>" +
                "<span class='font-weight-bold'>" + value.DESCRIPTION + "</span>" +
                "</div>");

            $("#done .kanban-drag").append(row);
        });

    }


    /* Add task */

    $(".task-add-btn").click(function(e){

        e.preventDefault();
        var dataString = $('#taskForm').serialize();

        // alert(dataString);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:"{{ route('task.ajaxInsert') }}",
            data:dataString,
            success:function(data){
                // alert(data);
                $("#taskForm")[0].reset();
                
                swal.fire({
                    title:"Success!",
                    text:"You have inserted the task!",
                    icon:"success",
                    button:"Aww yiss!"
                });

                var tasks = showtoDoData(data);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });


    /* Update task */

    $(document).on('click', '.change-status-to-in-progress', function () {

        var userURL = $(this).data('url');
        var taskID = $(this).data('id');
        var taskStatus = $(this).data('status');
        var newStatus = "in-progress";

        // alert(taskStatus);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:userURL,
            data:{TASK_ID:taskID,STATUS:newStatus},
            success:function(data){

                // alert(data.success);

                $("#"+taskStatus+"-"+taskID).remove();

                swal.fire({
                    title:"Success!",
                    text:"You have upadted the task!",
                    icon:"success",
                    button:"Aww yiss!"
                });

                var tasks = showInProgressData(data);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });


    $(document).on('click', '.change-status-to-done', function () {

        var userURL = $(this).data('url');
        var taskID = $(this).data('id');
        var taskStatus = $(this).data('status');
        var newStatus = "done";

        // alert(taskStatus);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:userURL,
            data:{TASK_ID:taskID,STATUS:newStatus},
            success:function(data){

                // alert(data.success);

                $("#"+taskStatus+"-"+taskID).remove();

                swal.fire({
                    title:"Success!",
                    text:"You have upadted the task!",
                    icon:"success",
                    button:"Aww yiss!"
                });

                var tasks = showDoneData(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });


    /* Delete task */
    
    $(document).on('click', '.delete-task', function () {

        var userURL = $(this).data('url');
        var taskID = $(this).data('id');
        var taskStatus = $(this).data('status');
        // alert(userURL);

        $.ajax({
            type:'get',
            // url:'/kanban-board/task/delete/'+taskID,
            url:userURL,
            success:function(data){

                $("#"+taskStatus+"-"+taskID).remove();

                swal.fire({
                    title:"Success!",
                    text:"You have deleted the task!",
                    icon:"success",
                    button:"Aww yiss!"
                });
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });


});