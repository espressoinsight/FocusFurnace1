<!DOCTYPE html>
<html lang="en">
<head class="custom-cursor">
    <!-- *****  JQUERY CDN  ***** -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8MWQJR8PJP"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-8MWQJR8PJP');
    </script>

    <!-- UNCOMMENT BEFORE GOING LIVE.
        Microsoft Clarity 
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "o7clnx9626");
    </script>
    -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FocusFurnace</title>
    <style>
    body {
        font-family: Verdana, sans-serif;
        display: flex;
        flex-direction: column;
        height: 100%;
        align-items: center;
        background-color: #22312B; /* forest green */
        color: #D3B188; /*light wood color*/
    }

    p {
        color: #D3B188; /*light wood color*/ 
        text-align: left; /* Center text alignment */
    }
    
    .custom-cursor {
        cursor: url('fireextinguisher.png'), auto;
    }

    .header {
        color: #808080;
    }

    .h1 {
        color: #D3B188; /*light wood color*/
        background-color: #22312B; /* forest green */
        text-align: center;
    }

    .lowHead {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 5px;
    }

    .input-area {
        display: flex;
        flex-direction: row;
        justify-content: center;
        width: 100%;
        text-align: center;
    }

    .lowHead input {
        font-size: 1em;
        font-family: Verdana, sans-serif;
        color: black;
        border: 1px solid #000000;
        border-radius: 3px;
        padding: 10px;
        margin-right: 10px;
        background-color: white;
        max-width: 300px;
        min-width: 150px;
        box-shadow: 0 0 10px rgba(255, 165, 0, 0.5);
    }

    .lowHead button {
        font-size: 1em;
        border: 1px solid #000000;
        border-radius: 4px;
        background-color: #FF5733;
        color: black;
        cursor: pointer;
        max-width: 120px;
        min-width: 100px;
        box-shadow: 0 0 10px rgba(255, 165, 0, 0.5);
    }

    .lowHead button:hover {
        background-color: #36454F;
        border: 1px solid #000000;
        color: white;
    }

    .container {
        display: flex;
        width: 100%;
    }

    .columnLogs {
        min-width: 100%;
        background-image: url('campfire.jpeg');
        border-radius: 2px;
        min-height: 70vh;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .task {
        padding: 7px;
        margin: 12px 12px;
        background-image: url('1log.png');
        border: 1px solid #D3B188;
        border-radius: 2px;
        white-space: normal;
    }

    .done-task {
        color: #d3d3d3;
        background-image: url('charred wood2.jpeg');
        border: 1px solid #36454F;
        text-decoration: line-through;
    }

    .task-counter {
        margin-right: 10px;
    }
    </style>
</head>
<body class="custom-cursor">
    <div class="header custom-cursor">
        <h1 class="h1">🔥 A Fire To-Do List. ☕</h1>
        <p>Add chores. Tap to burn 'em once complete.</p>
    </div>
    <div class="lowHead">
        <div class="input-area">
            <input type="text" id="new-task" placeholder="Enter task">
            <button id="add-task">Add Task</button>
        </div>
    </div>
    <div class="container">
        <div id="backlog" class="columnLogs custom-cursor"></div>
    </div>

    <script>
    $(document).ready(function() {
        let taskTimers = {}; // Store task timers by task ID

        // Handle adding a new task
        function addTask() {
            const newTaskText = $('#new-task').val().trim();
            if (newTaskText) {
                const taskId = Date.now(); // Unique ID for each task
                const $task = $('<div class="task"></div>').attr('id', taskId);
                const $counter = $('<span class="task-counter">00:00.0</span>');
                const $taskText = $('<span></span>').text(newTaskText);

                $task.append($counter).append($taskText);
                $('#backlog').append($task);
                $('#new-task').val(''); // Clear input field

                // Initialize timer data for this task
                taskTimers[taskId] = {
                    elapsedTime: 0,
                    intervalId: null,
                    isPaused: false
                };

                startTimer(taskId);
                saveTasks(); // Save tasks to sessionStorage
            }
        }

        // Function to start the timer
        function startTimer(taskId) {
            if (taskTimers[taskId].intervalId) return; // Timer already running

            taskTimers[taskId].intervalId = setInterval(() => {
                taskTimers[taskId].elapsedTime += 100; // Add 100ms (0.1 seconds)
                updateTimerDisplay(taskId);
            }, 100);
        }

        // Function to pause the timer
        function pauseTimer(taskId) {
            clearInterval(taskTimers[taskId].intervalId);
            taskTimers[taskId].intervalId = null;
        }

        // Function to update the timer display
        function updateTimerDisplay(taskId) {
            const elapsedTime = taskTimers[taskId].elapsedTime;
            const formattedTime = formatElapsedTime(elapsedTime);
            $('#' + taskId).find('.task-counter').text(formattedTime);
        }

        // Helper function to format elapsed time
        function formatElapsedTime(ms) {
            const elapsedSeconds = ms / 1000;
            const minutes = String(Math.floor(elapsedSeconds / 60)).padStart(2, '0');
            const seconds = String(Math.floor(elapsedSeconds % 60)).padStart(2, '0');
            const fractions = String(Math.floor((elapsedSeconds % 1) * 10));
            return `${minutes}:${seconds}.${fractions}`;
        }

        // Function to handle task click
        $(document).on('click', '.task', function() {
            const taskId = $(this).attr('id');

            // If task is not already marked as done
            if (!$(this).hasClass('done-task')) {
                // Add done-task class
                $(this).addClass('done-task');

                // Pause the timer
                pauseTimer(taskId);
                taskTimers[taskId].isPaused = true;

                saveTasks(); // Save updated state
            }
            // If task is already done, do nothing
        });

        // Save tasks to sessionStorage
        function saveTasks() {
            const tasks = $('.columnLogs .task').map(function() {
                const taskId = $(this).attr('id');
                const text = $(this).find('span').eq(1).text(); // Get the task text
                const elapsedTime = taskTimers[taskId].elapsedTime;
                const isPaused = taskTimers[taskId].isPaused;
                const isDone = $(this).hasClass('done-task');
                return { id: taskId, text, elapsedTime, isPaused, isDone };
            }).get();
            sessionStorage.setItem('tasks', JSON.stringify(tasks));
        }

        // Load tasks from sessionStorage
        function loadTasks() {
            const tasks = JSON.parse(sessionStorage.getItem('tasks')) || [];
            tasks.forEach(function(task) {
                const $task = $('<div class="task"></div>').attr('id', task.id);
                const $counter = $('<span class="task-counter"></span>').text(formatElapsedTime(task.elapsedTime));
                const $taskText = $('<span></span>').text(task.text);
                $task.append($counter).append($taskText);
                if (task.isDone) $task.addClass('done-task');
                $('#backlog').append($task);

                taskTimers[task.id] = {
                    elapsedTime: task.elapsedTime,
                    intervalId: null,
                    isPaused: task.isPaused
                };

                if (!task.isPaused && !task.isDone) {
                    startTimer(task.id); // Resume timer if it's not paused and not done
                }
            });
        }

        // Add task when the button is clicked
        $('#add-task').on('click', function() {
            addTask();
        });

        // Add task when "Enter" key is pressed
        $('#new-task').on('keypress', function(e) {
            if (e.key === 'Enter') {
                addTask();
            }
        });

        // Load tasks on page load
        loadTasks();
    });
    </script>

</body>
</html>
