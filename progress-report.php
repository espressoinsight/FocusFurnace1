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

    <!-- MS CLARITY -->
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
        /**trying to add tasks verticalls */
        display: flex;
        flex-direction: column; /* Stack tasks vertically */
        align-items: flex-start; /* Align tasks to the left */
    }

    .task {
        display: inline-flex;
        flex-direction: row;
        align-items: center;
        padding: 10px;
        margin: 5px 0;
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
        /*margin: 3;*/
        padding-right: 10px;
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
        <br><br>
        <h1 class="h1">
Coming Soon!
</h1><br><br>
<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdCeF9cSHQf02rkjRDGnwJVsQwA6oqF4ZL3S67UyvHDgEHUMg/viewform?embedded=true" width="350" height="470" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
    </div>

</body>