<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management Board</title>
    <style>

        .header {
            padding: 10px;
            color: #808080;
            display: flex;
        }

        .left-column {
        flex: 3;
        justify-content: center;
        }

        .right-column {
        flex: 1;
        padding: 10px;
        }

        .textDropZone {
            color: #808080;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .drop-zone {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 4px solid #36454F;
            /*
            background-color: grey;
             justify-content: right;
             align-items: right;
            */
            margin: auto;
            display: flex;
            background-image: url('disintigrate.png');
        }

        body {
            font-family: Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            /*
            align-items: center;
            */
            height: 100vh;
            margin: 0;
            background-color: #22312B; /* forest green */
            color: #D3B188; /*light wood color*/
        }

        p {
            color: #D3B188; /*light wood color*/ 
        }

        ::placeholder {
            color: white;
            opacity: 1; /* Firefox */
        }

        .header input {
            padding: 10px;
            font-size: 1em;
            font-family: Verdana, sans-serif;
            color: white;
            border: 1px solid #000000;
            border-radius: 4px;
            margin-right: 10px;
            width: 300px;
            background-color: #B0B3B8;
        }

        .header button {
            padding: 10px;
            font-size: 1em;
            border: none;
            border-radius: 4px;
            background-color: #B0B3B8;
            color: white;
            cursor: pointer;
        }

        .header button:hover {
            background-color: #36454F;
        }

        .container {
            display: flex;
            width: 95%;
            justify-content: space-between;
            align-items: center;
            height: 95%
        }

        .columnLogs {
            width: 30%;
            padding: 10px;
            background-image: url('logs.jpeg');
            border: 4px solid #4B3D32;
            border-radius: 20px;
            min-height: 80%;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            /**display flex messed it up...height of the things are too big.

             */
            flex-wrap: wrap;
            display: flex;
            justify-items: normal;

        }

        .columnFire {
            width: 30%;
            padding: 10px;
            background-image: url('campfire.jpeg');
            border: 4px solid #FFD700;
            border-radius: 20px;
            min-height: 80%;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .columnCoal {
            width: 30%;
            padding: 10px;
            background-image: url('charred wood.jpeg');
            border: 4px solid #36454F;
            border-radius: 20px;
            min-height: 80%;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .custom-cursor {
            cursor: url('fireextinguisher.png'), auto;
        }

        .h1 {
            color: #D3B188; /*light wood color*/
        }

        .column h2 {
            margin-top: 10px;
            font-size: 1.5em;
            color: #D3B188; /*light wood color*/
        }

        .task {
            padding: 10px;
            margin: 3px;
            background-image: url('1log.png');
            border: 1px solid #D3B188;
            border-radius: 4px;
            cursor: move;
            width: fit-content;
            height: fit-content;
        }

    </style>
</head>
<body>
    <div class="header containerHead">
        <div class="left-column">
        <h1 class="h1">Feature Fire - cozy to do list</h1>
        <p>Don't burn yourself! Logs not saved.</p>
        <input type="text" id="new-task" placeholder="Enter new task">
        <button id="add-task">Add Task</button>
        </div>
        <div class="right-column">
        <div class="drop-zone textDropZone" id="drop-zone">disintigrate</div>
        </div>
    </div>
    <div class="container">
        <div id="backlog" class="columnLogs">
            <h2>Back Logs</h2>
        </div>
        <div id="in-progress" class="columnFire custom-cursor">
            <h2>In Progress</h2>
        </div>
        <div id="complete" class="columnCoal">
            <h2>Complete</h2>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle dragging tasks
            $('.columnLogs, .columnFire, .columnCoal, #drop-zone').on('dragover', function(event) {
                event.preventDefault(); // Allow dropping
            });

            $('.columnLogs, .columnFire, .columnCoal').on('drop', function(event) {
                event.preventDefault();
                const task = $('.dragging');
                $(this).append(task);
                saveTasks();
            });

            $('#drop-zone').on('drop', function(event) {
                event.preventDefault();
                const task = $('.dragging');
                if (task.length) {
                    task.remove(); // Remove the task
                    saveTasks(); // Save the updated tasks after deletion
                }
            });

            $('.columnLogs, .columnFire, .columnCoal').on('dragstart', '.task', function(event) {
                $(this).addClass('dragging');
            });

            $('.columnLogs, .columnFire, .columnCoal').on('dragend', '.task', function(event) {
                $(this).removeClass('dragging');
            });

            // Function to save tasks to session storage
            function saveTasks() {
                const tasks = {};
                $('.columnLogs, .columnFire, .columnCoal').each(function() {
                    const columnId = $(this).attr('id');
                    tasks[columnId] = $(this).find('.task').map(function() {
                        return $(this).text();
                    }).get();
                });
                sessionStorage.setItem('tasks', JSON.stringify(tasks));
            }

            // Function to load tasks from session storage
            function loadTasks() {
                const tasks = JSON.parse(sessionStorage.getItem('tasks'));
                if (tasks) {
                    $('.columnLogs, .columnFire, .columnCoal').each(function() {
                        const columnId = $(this).attr('id');
                        if (tasks[columnId]) {
                            $(this).empty(); // Clear existing tasks
                            tasks[columnId].forEach(function(task) {
                                $('<div class="task" draggable="true"></div>').text(task).appendTo('#' + columnId);
                            });
                        }
                    });
                }
            }

            // Function to add a new task to the backlog
            $('#add-task').on('click', function() {
                const newTaskText = $('#new-task').val().trim();
                if (newTaskText) {
                    $('<div class="task" draggable="true"></div>').text(newTaskText).appendTo('#backlog');
                    $('#new-task').val(''); // Clear the input field
                    saveTasks(); // Save the updated tasks
                }
            });

            // Load tasks on page load
            loadTasks();
        });
    </script>
</body>
</html>