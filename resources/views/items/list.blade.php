<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/mercari.css') }}">
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
</head>
<body>
    {{-- navbar --}}
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapsed" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="" class="navbar-brand">Rakus Items</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            {{-- 認証機能 --}}
        </div>
    </nav>
    <div id="main" class="container-fluid">
        {{-- addItemlink --}}
        <div id="addItemButton">
            <a href="" class="btn btn-default">Add New Item</a>
        </div>
        {{-- 検索フォーム --}}
        <div id="forms">
            <form action="" class="form-inline" role="form">
                @csrf
                <div class="form-group">
                    <input type="input" class="form-control" id="name" placeholder="item name" autocomplete="off">
                </div>
                <div class="form-group">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="form-group">
                    <select name="" id="" class="form-control">
                        <option value="">- parentCategory -</option>
                        @foreach ($firstCategories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                    <select name="" id="" class="form-control">
                        <option value="">- childCategory -</option>
                        @foreach ($secondCategories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                    <select name="" id="" class="form-control">
                        <option value="">- grandChild -</option>
                        @foreach ($thirdCategories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="brand" autocomplete="off">
                </div>
                <div class="form-group"></div>
                <button type="submit" class="btn btn-default">search</button>
            </form>
        </div>
        {{-- pagination --}}
        <div class="pages">
            <nav class="page-nav">
                <ul class="pager">
                    <li class="previous">
                        <a href="#">← prev</a>
                    </li>
                    <li class="next">
                        <a href="#">next →</a>
                    </li>
                </ul>
            </nav>
        </div>
        {{-- table --}}
        <div class="table-responsive">
            <table id="item-table" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>price</th>
                        <th>category</th>
                        <th>brand</th>
                        <th>condition</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                    <tr>
                        <td class="item-name">
                            <a href="">{{ $item->name }}</a>
                        </td>
                        <td class="item-price">
                            {{ $item->price }}
                        </td>
                        <td class="item-category">
                            <a href="">{{ $categories[$index]['firstCategory'] }}</a>
                            /
                            <a href="">{{ $categories[$index]['secondCategory'] }}</a>
                            /
                            <a href="">{{ $categories[$index]['thirdCategory'] }}</a>
                        </td>
                        <td class="item-brand">
                            <a href="">{{ $item->brand }}</a>
                        </td>
                        <td class="item-condition">
                            {{ $item->condition_id }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- pagination --}}
        <div class="pages">
            <nav class="page-nav">
                <ul class="pager">
                    <li class="previous">
                        <a href="#">← prev</a>
                    </li>
                    <li class="next">
                        <a href="#">next →</a>
                    </li>
                </ul>
            </nav>
            {{-- ページ番号を検索して表示するフォーム --}}
            <div id="select-page">
                <form action="" class="form-inline">
                    <div class="form-group">
                        <div class="input-group col-xs-6">
                            <label></label>
                            <input type="text" class="form-control">
                            {{-- 総ページ数 --}}
                            <div class="input-group-addon">/ 20</div>
                        </div>
                        <div class="input-group col-xs-1">
                            <button type="submit" class="btn btn-default">Go</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{ $items->links() }}
    </div>
</body>
</html>