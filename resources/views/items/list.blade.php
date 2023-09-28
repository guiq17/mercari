<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/mercari.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" 
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
    integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"/>
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
            <form action="{{ route('item.list') }}" class="form-inline" role="form" method="GET">
                @csrf
                <div class="form-group">
                    <input type="input" class="form-control" id="name" placeholder="item name" autocomplete="off" name="keyword" value="{{ $keyword }}">
                </div>
                <div class="form-group">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="form-group">
                    {{-- firstCategoryのプルダウンボックス --}}
                    <select name="firstCategory" id="firstCategory" class="form-control">
                        <option value="">- firstCategory -</option>
                        @foreach ($firstCategories as $firstCategory)
                            <option value="{{ $firstCategory }}">{{ $firstCategory }}</option>
                        @endforeach
                    </select>
                    {{-- secondCategoryのプルダウンボックス --}}
                    <select name="secondCategory" id="secondCategory" class="form-control">
                        <option value="">- secondCategory -</option>
                        @foreach ($secondCategories as $secondCategory)
                            <option value="{{ $secondCategory }}">{{ $secondCategory }}</option>
                        @endforeach
                    </select>
                    {{-- thirdCategoryのプルダウンボックス --}}
                    <select name="thirdCategory" id="thirdCategory" class="form-control">
                        <option value="">- thirdCategory -</option>
                        @foreach ($thirdCategories as $thirdCategory)
                            <option value="{{ $thirdCategory }}">{{ $thirdCategory }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="brand" autocomplete="off" name="brandKeyword" value="{{ $brandKeyword }}">
                </div>
                <div class="form-group"></div>
                <button type="submit" class="btn btn-default">search</button>
            </form>
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
                            <a href="">{{ isset($categories[$index]['firstCategory']) ? $categories[$index]['firstCategory'] : '' }}</a>
                            /
                            <a href="">{{ isset($categories[$index]['secondCategory']) ? $categories[$index]['secondCategory'] : '' }}</a>
                            /
                            <a href="">{{ isset($categories[$index]['thirdCategory']) ? $categories[$index]['thirdCategory'] : '' }}</a>
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
    <script src="{{ asset('js/getCategory.js') }}"></script>
</body>
</html>