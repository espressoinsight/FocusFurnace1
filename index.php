<!DOCTYPE html>
<html lang="en">
<head class="custom-cursor">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8MWQJR8PJP"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8MWQJR8PJP');
</script>

<!-- Microsoft Clarity -->
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "o7clnx9626");
</script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FocusFurnace</title>
    <style>
        body {
            font-family: Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
            margin-bottom: 20px;
            background-color: #22312B; /* forest green */
            color: #D3B188; /*light wood color*/
        }

        p {
            color: #D3B188; /*light wood color*/ 
        }
        
        .custom-cursor {
            cursor: url('fireextinguisher.png'), auto;
        }

        .header {
            /*padding: 5px;*/
            color: #808080;
        }

        .h1 {
            color: #D3B188; /*light wood color*/
            background-color: #22312B; /* forest green 
            position: sticky;
            top: 10px;
            */
        }

        .lowHead {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .input-area {
            display: flex;
            flex-direction: row; /* Stack input and button vertically */
            justify-content: center; /* Center them vertically */
            width: 66.67%; /* Two-thirds of the width */
            text-align: center; /* Center text alignment */
            margin-left: 20px;
            margin-right: 10px;
        }

        .drop-zone {
            min-width: 140px;
            max-width: 300px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid #36454F;
            display: flex;
            background-image: url('charred wood.jpeg');
            width: 33.33%;
            justify-content: center;
            align-items: center;
            margin-left: 10px;
            margin-right: 20px;
            margin-bottom: 20px;
        }

        .textDropZone {
            color: white;
            justify-content: center;
            align-items: center;
            font-size: 20px;
        }

        ::placeholder {
        color: white;
        opacity: 1; /* Firefox */
        }

        .lowHead input {
            font-size: 1em;
            font-family: Verdana, sans-serif;
            color: white;
            border: 1px solid #000000;
            border-radius: 4px;
            padding: 10px;
            margin-right: 10px;
            background-color: #808080;
            max-width: 300px;
            min-width: 150px;
        }
        .lowHead button {
            padding: 10px;
            font-size: 1em;
            border: none;
            border-radius: 4px;
            background-color: #808080;
            color: white;
            cursor: pointer;
            max-width: 120px;
            min-width: 100px;
        }
        .lowHead button:hover {
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
            background-image: url('logs.jpeg');
            border: 3px solid #413629;
            border-radius: 20px;
            min-height: 50vh;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .columnFire {
            width: 30%;
            padding: 10px;
            background-image: url('campfire.jpeg');
            border: 3px solid #4B3D32;
            border-radius: 20px;
            min-height: 50vh;
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
            min-height: 50vh;
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

    </style>
</head>
<body class="custom-cursor">
    <div class="header custom-cursor">
            <h1 class="h1">Focus Furnace 🔥 your cozy to-do list ☕</h1>
            <p>Put out fires, burn down back logs.</p>
    </div>
        <div class="lowHead">
            <div class="input-area">
                <input type="text" id="new-task" placeholder="Enter task">
                <button id="add-task">Add to log</button>
            </div>
            <div class="drop-zone textDropZone custom-cursor" id="drop-zone">🧯 Extinguish</div>
        </div>
    <div class="container">
        <div id="backlog" class="columnLogs custom-cursor">
        </div>
        <div id="in-progress" class="columnFire custom-cursor">
        </div>
        <div id="complete" class="columnCoal custom-cursor">
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
            function addTask() {
                const newTaskText = $('#new-task').val().trim();
                if (newTaskText) {
                    $('<div class="task" draggable="true"></div>').text(newTaskText).appendTo('#backlog');
                    $('#new-task').val(''); // Clear the input field
                    saveTasks(); // Save the updated tasks
                }
            }

            // Add task when button is clicked
            $('#add-task').on('click', function() {
                addTask();
            });

            // Add task when "Enter" or "Return" key is pressed
            $('#new-task').on('keypress', function(e) {
                if (e.key === 'Enter' || e.key === 'Return') {
                    addTask();
                }
            });

            

/*
            // Function to add a new task to the backlog
            $('#add-task').on('click', function() {
                const newTaskText = $('#new-task').val().trim();
                if (newTaskText) {
                    $('<div class="task" draggable="true"></div>').text(newTaskText).appendTo('#backlog');
                    $('#new-task').val(''); // Clear the input field
                    saveTasks(); // Save the updated tasks
                }
            });
*/
            // Load tasks on page load
            loadTasks();
        });
    </script>
</body>
</html>