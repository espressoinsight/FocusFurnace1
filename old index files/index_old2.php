<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management Board</title>
    <style>
        .custom-cursor {
            cursor: url('fireextinguisher.png'), auto;
        }

        body {
            font-family: Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #22312B; /* forest green */
            color: #D3B188; /*light wood color*/
        }

        p {
            color: #D3B188; /*light wood color*/ 
        }

        .header {
            padding: 10px;
            margin-bottom: 20px;
            color: #808080;
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
            background-color: #808080;

        }
        .header button {
            padding: 10px;
            font-size: 1em;
            border: none;
            border-radius: 4px;
            background-color: #808080;
            color: white;
            cursor: pointer;
        }
        .header button:hover {
            background-color: #36454F;
            border: 1px solid #000000;
        }
        .container {
            display: flex;
            width: 80%;
            justify-content: space-between;
        }

        .columnLogs {
            width: 30%;
            padding: 10px;
            /*background: #8F5337;*/
            background-image: url('logs.jpeg');
            border: 3px solid #413629;
            border-radius: 20px;
            min-height: 80vh;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .columnFire {
            width: 30%;
            padding: 10px;
            /*background: #FF8C00;*/
            background-image: url('campfire.jpeg');
            /*border: 3px solid #FF4500;*/
            border: 3px solid #4B3D32;
            border-radius: 20px;
            min-height: 80vh;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .columnCoal {
            width: 30%;
            padding: 10px;
            /*background: #262626;*/
            background-image: url('charred wood.jpeg');
            border: 3px solid #36454F;
            border-radius: 20px;
            min-height: 80vh;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
            margin: 5px 0;
            background-image: url('1log.png');
            border: 1px solid #D3B188;
            border-radius: 4px;
            cursor: move;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="h1">Feature Fire - cozy to-do list</h1>
        <p>Don't burn yourself! Logs not saved.</p>
        <input type="text" id="new-task" placeholder="Enter new task">
        <button id="add-task">Add Task</button>
    </div>
    <div class="container">
        <div id="backlog" class="columnLogs">
        </div>
        <div id="in-progress" class="columnFire custom-cursor">
        </div>
        <div id="complete" class="columnCoal">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle dragging tasks
            $('.columnLogs, .columnFire, .columnCoal').on('dragover', function(event) {
                event.preventDefault(); // Allow dropping
            });

            $('.columnLogs, .columnFire, .columnCoal').on('drop', function(event) {
                event.preventDefault();
                const task = $('.dragging');
                $(this).append(task);
                saveTasks();
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
