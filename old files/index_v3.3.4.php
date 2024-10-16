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
        margin: 0;
        padding: 0;
    }

    p {
        color: #D3B188; /*light wood color*/ 
        text-align: center;
        margin: 5px 0;
        padding-left: 2px;
        padding-right: 2px;
    }
    
    .custom-cursor {
        cursor: url('fireextinguisher.png'), auto;
    }

    .header {
        color: #808080;
        text-align: center;
        padding: 15px;
        width: 100%;
    }

    .h1 {
        color: #D3B188; /*light wood color*/
        background-color: transparent;
        margin: 0;
        padding: 0;
        font-size: 2em;
    }

    .lowHead {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        width: 100%;
        max-width: 800px;
        padding: 10px 15px;
        margin: 10px 5px;
        border-radius: 10px;
    }

    .input-area {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        width: 100%;
        max-width: 400px;
        margin-bottom: 10px;
    }

    .lowHead input {
        font-size: 1em;
        font-family: Verdana, sans-serif;
        color: black;
        border: 1px solid #000000;
        border-radius: 5px;
        padding: 10px;
        margin-right: 10px;
        background-color: white;
        width: 100%;
        box-shadow: 0 0 15px rgba(255, 165, 0, 0.5);
    }

    .lowHead button {
        font-size: 1em;
        border: none;
        border-radius: 5px;
        background-color: #FF5733;
        color: white;
        cursor: pointer;
        min-width: 80px;
        padding: 10px;
        box-shadow: 0 0 10px rgba(255, 165, 0, 0.5);
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .lowHead button:hover {
        background-color: #993C1B;
        box-shadow: 0 0 15px rgba(255, 165, 0, 0.8);
    }

    .container {
        display: flex;
        width: 100%;
        justify-content: center;
        padding: 15px;
    }

    .columnLogs {
        width: 100%;
        max-width: 800px;
        background-image: url('campfire.jpeg');
        background-size: cover;
        border-radius: 10px;
        min-height: 60vh;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        padding: 20px;
        overflow-y: auto;
    }

    .task {
        display: inline-block;
        padding: 10px;
        margin: 12px;
        background-image: url('1log.png');
        background-size: cover;
        border: 1px solid #D3B188;
        border-radius: 5px;
        white-space: normal;
        max-width: calc(100% - 40px);
    }

    .done-task {
        color: #d3d3d3;
        background-image: url('charred wood2.jpeg');
        background-size: cover;
        border: 1px solid #36454F;
        text-decoration: line-through;
    }

    .task-counter {
        margin: 0;
    }

    /* Mobile-Specific Improvements */
    @media (max-width: 600px) {
        body {
            padding: 10px;
        }

        .h1 {
            font-size: 1.5em; /* Reduce font size for small screens */
        }

        .lowHead {
            flex-direction: column;
            align-items: stretch;
            padding: 10px;
            margin: 5px;
        }

        .input-area {
            flex-direction: column;
            width: 100%;
        }

        .lowHead input {
            margin-right: 0;
            margin-bottom: 10px;
            width: calc(100% - 20px);
        }

        .lowHead button {
            width: calc(100% - 20px);
            padding: 10px;
        }

        .container {
            padding: 10px;
        }

        .columnLogs {
            padding: 10px;
        }

        .task {
            margin: 10px 0;
            padding: 8px;
        }
    }
</style>

<!-- 
    *********** HTML *************************************
    *********** GOES *************************************
    *********** HERE *************************************
-->

</head>
<body class="custom-cursor">
    <div class="header custom-cursor">
        <h1 class="h1">
            🔥 A Fire To-Do List
        </h1>
        <p>Add chores. Tap to burn 'em once complete.</p>
    </div>
    <div class="lowHead">
        <div class="input-area">
            <input type="text" id="new-task" placeholder="Enter a new task...">
            <button id="add-task">Add</button>
        </div>
        <p>☕ <b><span id="completed-counter">0</span></b> Complete</p>
    </div>
    <div class="container">
        <div id="backlog" class="columnLogs custom-cursor">
        </div>
    </div>

<!-- 
    *********** HTML *************************************
    *********** GOES *************************************
    *********** HERE *************************************
-->

    <script>
    $(document).ready(function() {
        let taskTimers = {}; // Store task timers by task ID

        // Handle adding a new task
        function addTask() {
            const newTaskText = $('#new-task').val().trim();
            if (newTaskText) {
                const taskId = Date.now(); // Unique ID for each task
                const $task = $('<span class="task"></span>').attr('id', taskId);
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

                updateCompletedCounter(); // Update the counter when task is done
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

        // Function to update the completed tasks counter
        function updateCompletedCounter() {
            const completedTasks = $('.done-task').length;
            $('#completed-counter').text(completedTasks);
        }

        // Load tasks from sessionStorage
        function loadTasks() {
            const tasks = JSON.parse(sessionStorage.getItem('tasks')) || [];
            tasks.forEach(function(task) {
                const $task = $('<span class="task"></span>').attr('id', task.id);
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

            updateCompletedCounter(); // Update the counter after loading tasks
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
