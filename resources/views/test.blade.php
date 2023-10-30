{{-- <!DOCTYPE html>
<html>
<head>
    <style>
        /* Add this CSS to blur the content when the popup is open */
        body.popup-open {
            filter: blur(5px);
            transition: filter 0.5s;
        }

        .popup {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .popup .popuptext {
            visibility: hidden;
            width: 350px;
            height: 270px;
            background-color: white;
            box-shadow: 0 0 5px #999;
            color: black;
            text-align: center;
            border-radius: 6px;
            padding: 8px 0;

            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .popup .popuptext::after {
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        .popup .show {
            visibility: visible;
            -webkit-animation: fadeIn 1s;
            animation: fadeIn 1s;
        }

        @-webkit-keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>

    <div class="popup" onclick="myFunction()">
        <span class="popuptext" id="myPopup" class="show">
            <!-- Your popup content -->
            <h2>Deadline vandaag</h2>
            <p>test</p>
        </span>
    </div>

    <script>
        function myFunction() {
            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");

            // Toggle class on the body to apply blur effect
            document.body.classList.toggle("popup-open");
        }

        // Show popup when site loads
        window.onload = function() {
            myFunction();
        };
    </script>

</body>
</html> --}}