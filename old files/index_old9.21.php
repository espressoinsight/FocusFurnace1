<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management Board</title>
    <style>
        body {
            font-family: Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #22312B; /* forest green */
            color: #D3B188; /*light wood color*/
            height:100vh; 
        }

        p {
            color: #D3B188; /*light wood color*/ 
        }
        
        .custom-cursor {
            cursor: url('fireextinguisher.png'), auto;
        }

        .header {
            padding: 5px;
            margin-bottom: 5px;
            color: #808080;
        }

        .h1 {
            color: #D3B188; /*light wood color*/
            
            background-color: #22312B; /* forest green 
            top: 10px;
            */
            position: sticky;
        }

        .textDropZone {
            color: #808080;
            justify-content: center;
            align-items: center;
        }

        .drop-zone {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 4px solid #36454F;
            margin: auto;
            display: flex;
            background-image: url('charred wood.jpeg');
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
            width: 95%;
            justify-content: space-between;
            gap: 10px;
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
            background-image: url('coals.jpeg');
            /* image link:
            https://www.pexels.com/photo/close-up-of-coal-on-ground-18911748/ 
            */
            border: 3px solid #36454F;
            border-radius: 20px;
            min-height: 80vh;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .task {
            padding: 7px;
            margin: 5px 5px;
            background-image: url('1log.png');
            border: 1px solid #D3B188;
            border-radius: 4px;
            cursor: move;
        }


        /*
        .column h2 {
            margin-top: 10px;
            font-size: 1.5em;
            color: #D3B188; light wood color
        }*/


    </style>
</head>
<body>
    <div class="header">
        <h1 class="h1">Feature Fire 🧯 cozy to-do list ☕</h1>
        <p>Burnin' down your task logs.</p>
        <input type="text" id="new-task" placeholder="Fire to put out">
        <button id="add-task">Add to log</button>
        <div class="drop-zone textDropZone" id="drop-zone">Extinguish</div>
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
