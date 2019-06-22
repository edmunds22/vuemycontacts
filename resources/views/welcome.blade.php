<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
    window.laravel = {
        csrfToken: '{{ csrf_token() }}'
    };
    </script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">VueContacts</a>
            <ul class="navbar-nav px-3 list-group-horizontal">

                <li class="nav-item text-nowrap" v-if="authenticated" style="padding-left:7px;">
                    <a class="nav-link" href="#">
                        <router-link to="/">Contacts</router-link>
                    </a>
                </li>

                <li class="nav-item text-nowrap" v-if="authenticated" style="padding-left:7px;">
                    <a class="nav-link" href="#">
                        <router-link to="/new">New Contact</router-link>
                    </a>
                </li>

                <li class="nav-item text-nowrap" v-if="!authenticated" style="padding-left:7px;">
                    <a class="nav-link" href="#">
                        <router-link to="/register">Register</router-link>
                    </a>
                </li>

                <li class="nav-item text-nowrap" v-if="!authenticated" style="padding-left:7px;">
                    <a class="nav-link" href="#">
                        <router-link to="/login">Login</router-link>
                    </a>
                </li>

                <li class="nav-item text-nowrap" style="padding-left:7px;">
                    <a class="nav-link" href="https://github.com/edmunds22/vuemycontacts" target="_blank">
                        My source code
                    </a>
                </li>

                <li class="nav-item text-nowrap" v-if="authenticated" style="padding-left:7px;">
                    <a class="nav-link" href="#" v-on:click="logout()">Sign out</a>
                </li>

            </ul>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <sidebar :authenticated="authenticated"></sidebar>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <br />
                    <flash-message></flash-message>
                    <router-view></router-view>

                </main>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}">
    </script>
</body>

</html>