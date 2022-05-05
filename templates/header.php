<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="script.js"></script>
    <style type="text/css">
        .brand{
            background: #cbb09c !important;
        }
        .brand-text{
            color: #cbb09c !important;
        }
        div.detalhe{
            max-width: 460px;
            display: flex;
            padding: 20px;
            justify-content: center;
        }
        .pizza{
            width: 100px;
            margin: 40px auto -30px;
            display: block;
            position: relative;
            top: -30px;
        }
        .box{
            display: inline-flex;
            gap: 10px;
            margin-top: 10px;
        }
        section.detalhe{
            background: white;
            border-radius: 10px;
            padding: 45px;
            width: 700px;
            /* margin: auto; */
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.525);

        }
        .container > section{
            margin-top: 10px;
        }
    </style>


    <title>Restaurante etc</title>
</head>


<body class="grey lighten-4">
    <nav class="white">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Restaurante etc</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><a href="add.php" class="btn brand">Add item</a></li>
            </ul>
        </div>
    </nav>