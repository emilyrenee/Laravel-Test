<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .form-inner {
            display: flex;
            flex-direction: column;
            align-items: center
        }

        .form-input,
        .form-input-row {
            display: flex;
            width: 300px;
            margin: .5rem 0;
        }

        .form-input {
            flex-direction: column;
        }

        .form-input-row {
            flex-direction: row;
        }

        .form-input label,
        .form-input-row label {
            align-self: flex-start;
        }
    </style>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>


        const handleCreateDeveloper = async (e) => {
            console.log('e?', e);
            const fields = ['name', 'email', 'avatar', 'is_local', 'timezone', 'team_option'];

            let data = {};
            fields.forEach(field => {
                value = document.getElementById(field) && document.getElementById(field).value ? document.getElementById(field).value : null;
                data = {
                    ...data,
                    [field]: value
                };
            });

            Object.keys(data).forEach((key) => (data[key] == null) && delete data[key]);


            await axios.post('/developer/create', {
                    ...data,
                    "_token": "{{ csrf_token() }}",
                })
                .then(function(response) {
                    console.log('what now?');
                    console.log('response', response);
                })
                .catch(function(error) {
                    console.log('there was sad error')
                    console.log(error);
                });

            
            console.log('after calling');       
        }
    </script>

</head>

<body>