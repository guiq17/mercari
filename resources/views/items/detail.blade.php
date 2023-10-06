<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- css -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" 
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/mercari.css')}}"/>
    <title>Rakus Items</title>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./list.html">Rakus Items</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a id="logout" href="./login.html">Logout&nbsp;<i class="fa fa-power-off"></i></a></li>
                </ul>
                <p class="navbar-text navbar-right">
                    <span id="loginName">user: userName</span>
                </p>
            </div>
        </div>
    </nav>

    <!-- details -->
    <div class="container">
        <a type="button" class="btn btn-default" href="{{ route('item.list') }}"><i class="fa fa-reply"></i> back</a>
        <h2>Details</h2>
        <div id="details">
            @if(session('success'))
                <div class="alert">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $item->id }}</td>
                    </tr>
                    <tr>
                        <th>name</th>
                        <td>{{ $item->name }}</td>
                    </tr>
                    <tr>
                        <th>price</th>
                        <td>${{ number_format($item->price, 1) }}</td>
                    </tr>
                    <tr>
                        <th>category</th>
                        <td>
                            @foreach($categories as $category)
                                {{ $category['firstCategory'] }}
                                /
                                {{ $category['secondCategory'] }}
                                /
                                {{ $category['thirdCategory'] }}
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>brand</th>
                        <td>{{ $item->brand }}</td>
                    </tr>
                    <tr>
                        <th>condition</th>
                        <td>{{ $item->condition_id }}</td>
                    </tr>
                    <tr>
                        <th>description</th>
                        <td>{{ $item->description }}</td>
                    </tr>
                </tbody>
            </table>
            <a type="button" class="btn btn-default" href="{{ route('item.edit', ['id' => $item->id]) }}"><i class="fa fa-pencil-square-o"></i>&nbsp;edit</a>
            <form action="{{ route('item.delete', ['id' => $item->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-default" id="deleteBtn">
                    <i class="fa fa-pencil-square-o"></i>&nbsp;delete
                </button>
            </form>
        </div>
    </div>

    <script>
        var itemId = {{ $item->id }};
        var itemDeleteRoute = "{{ route('item.delete', ['id' => ':itemId']) }}".replace(':itemId', itemId);
        var itemListRoute = "{{ route('item.list') }}";
    </script>

    <script src="{{ asset('js/deleteItem.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>