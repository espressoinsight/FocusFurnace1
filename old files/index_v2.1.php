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
            height: 100%;
            /*margin-bottom: 5px;*/
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
            /*padding: 5px;*/
            color: #808080;
        }

        .h1 {
            color: #D3B188; /*light wood color*/
            background-color: #22312B; /* forest green */
            text-align: center;
            /*
            position: sticky;
            top: 10px;
            */
        }

        .lowHead {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 5px;
            
        }

        .input-area {
            display: flex;
            flex-direction: row; /* Stack input and button vertically */
            justify-content: center; /* Center them vertically */
            width: 100%; /* part of width */
            text-align: center; /* Center text alignment*/
        }

        ::placeholder {
        color: grey;
        opacity: 1; /* Firefox */
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
            margin: 3px 3px;
            background-image: url('1log.png');
            border: 1px solid #D3B188;
            border-radius: 2px;
            cursor: move;
        }

        .green-task {
            color: green;
            background-image: url('coals.jpeg');
        }

        .dark-grey-task {
            color: black;
            background-image: url('charred wood.jpeg');
        }

        .red-task {
            color: red;
            background-image: url('logs.jpeg');
        }

    </style>
</head>
<body class="custom-cursor">
    <div class="header custom-cursor">
            <h1 class="h1">Focus Furnace 🔥</h1>
            <h2 class="h1"> your cozy to-do list ☕</h2>
            <p>Complete your tasks, put out fires, burn down back logs.</p>
    </div>
        <div class="lowHead">
            <div class="input-area">
                <input type="text" id="new-task" placeholder="Enter task">
                <button id="add-task">Add Task</button>
            </div>
            <!--<div class="drop-zone textDropZone custom-cursor" id="drop-zone">🧯 Extinguish</div>-->
        </div>
    <div class="container">
        <div id="backlog" class="columnLogs custom-cursor">
        </div>
        <!--
        <div id="in-progress" class="columnFire custom-cursor">
        </div>
        <div id="complete" class="columnCoal custom-cursor">
        </div>
        -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
   
<script>
    $(document).ready(function() {
        // Handle adding a new task
        function addTask() {
            const newTaskText = $('#new-task').val().trim();
            if (newTaskText) {
                $('<div class="task" draggable="true"></div>')
                    .text(newTaskText)
                    .appendTo('#backlog');
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

        // Cycle through color classes on click/tap
        $(document).on('click touchstart', '.task', function() {
            if ($(this).hasClass('green-task')) {
                $(this).removeClass('green-task').addClass('dark-grey-task');
            } else if ($(this).hasClass('dark-grey-task')) {
                $(this).removeClass('dark-grey-task').addClass('red-task');
            } else if ($(this).hasClass('red-task')) {
                $(this).removeClass('red-task'); // Back to default color
            } else {
                $(this).addClass('green-task'); // First click turns it green
            }
        });

        // A method to delete tasks
        $('#task').on('pointerdown', function(event) {
    const task = $(event.target).closest('.task');

    if (task.length) {
        if (event.pointerType === 'touch') {
            // Long press on mobile
            setTimeout(() => {
                if (confirm('Are you sure you want to delete this task?')) {
                    task.remove();
                    saveTasks();
                }
            }, 500); // Adjust the timeout as needed
        } else if (event.pointerType === 'mouse') {
            // Double click on desktop
            if (event.detail === 2) {
                if (confirm('Are you sure you want to delete this task?')) {
                    task.remove();
                    saveTasks();
                }
            }
        }
    }
});

        // Function to save tasks to session storage
        function saveTasks() {
            const tasks = {};
            $('.columnLogs').each(function() {
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
                $('.columnLogs').each(function() {
                    const columnId = $(this).attr('id');
                    if (tasks[columnId]) {
                        $(this).empty(); // Clear existing tasks
                        tasks[columnId].forEach(function(task) {
                            $('<div class="task" draggable="true"></div>')
                                .text(task)
                                .appendTo('#' + columnId);
                        });
                    }
                });
            }
        }

        // Load tasks on page load
        loadTasks();
    });
</script>

</body>
</html>