<!-- 3.2 updates the function to save done-task as session data -->

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

    </style>
</head>
<body class="custom-cursor">
    <div class="header custom-cursor">
            <h1 class="h1">🔥 Fire to-do list. ☕</h1>
            <p>Add chores. Tap to finish / burn 'em. (Yes that's it lmao.)</p>
    </div>
        <div class="lowHead">
            <div class="input-area">
                <input type="text" id="new-task" placeholder="Enter task">
                <button id="add-task">Add Task</button>
            </div>
        </div>
    <div class="container">
        <div id="backlog" class="columnLogs custom-cursor">
        </div>
    </div>
   
<script>
    $(document).ready(function() {
        // Handle adding a new task
        function addTask() {
            const newTaskText = $('#new-task').val().trim();
            if (newTaskText) {
                $('<div class="task"></div>')
                    .text(newTaskText)
                    .appendTo('#backlog');
                $('#new-task').val(''); // Clear the input field
                saveTasks(); // Save the updated tasks
            }
        }

        // Add task when Button is clicked -- this runs addTask() function (defined above) when conditions are met.
        $('#add-task').on('click tap swipe', function() {
            addTask();
        });

        // Add task when "Enter" or "Return" key is pressed -- this runs addTask() function (defined above) when conditions are met.
        $('#new-task').on('keypress', function(e) {
            if (e.key === 'Enter' || e.key === 'Return') {
                addTask();
            }
        });

        // Toggle between complete / to do on tap.
        $(document).on('click tap swipe', '.task', function() {
            if ($(this).hasClass('task')) {
                $(this).toggleClass('done-task');
                saveTasks(); // Save the updated tasks
            }            
        });

// Function to save tasks to session storage
    function saveTasks() {
    const tasks = $('.columnLogs .task').map(function() {
        const classes = $(this).attr('class');
        return {
            text: $(this).text(),
            classes: classes.split(' '),
            isToggled: $(this).hasClass('done-task')
        };
    }).get();

    sessionStorage.setItem('tasks', JSON.stringify(tasks));
    }

    function loadTasks() {
  const tasks = JSON.parse(sessionStorage.getItem('tasks'));
  if (tasks) {
    $('.columnLogs').empty(); // Clear existing tasks
    tasks.forEach(function(task) {
      const $taskElement = $('<div class="task"></div>');
      $taskElement.text(task.text);

      // Ensure the "done-task" class is added only if it's present in the stored classes
      if (task.classes.includes('done-task')) {
        $taskElement.addClass('done-task');
      }

      $('.columnLogs').append($taskElement);
    });
  }
}

        // Load tasks on page load
        loadTasks();
    });
</script>

</body>
</html>