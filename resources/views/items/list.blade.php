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
            <a href="{{ route('item.add') }}" class="btn btn-default">Add New Item</a>
        </div>
        {{-- 検索フォーム --}}
        <div id="forms">
            <form action="{{ route('item.list') }}" class="form-inline" role="form" method="GET">
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
                            <option value="{{ $firstCategory->id }}" {{ $firstCategory->id == $selectedFirstCategory ? 'selected' : '' }}>{{ $firstCategory->name }}</option>
                        @endforeach
                    </select>
                    {{-- secondCategoryのプルダウンボックス --}}
                    <select name="secondCategory" id="secondCategory" class="form-control">
                        <option value="">- secondCategory -</option>
                        @foreach ($secondCategories as $secondCategory)
                            <option value="{{ $secondCategory->id }}" {{ $secondCategory->id == $selectedSecondCategory ? 'selected' : '' }}>{{ $secondCategory->name }}</option>
                        @endforeach
                    </select>
                    {{-- thirdCategoryのプルダウンボックス --}}
                    <select name="thirdCategory" id="thirdCategory" class="form-control">
                        <option value="">- thirdCategory -</option>
                        @foreach ($thirdCategories as $thirdCategory)
                            <option value="{{ $thirdCategory->id }}" {{ $thirdCategory->id == $selectedThirdCategory ? 'selected' : '' }}>{{ $thirdCategory->name }}</option>
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
            @if(session('success'))
                <div class="alert">
                    {{ session('success') }}
                </div>
            @endif
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
                            <a href="{{ route('item.detail', ['id' => $item->id, 'page' => $items->currentPage()]) }}">{{ $item->name }}</a>
                        </td>
                        <td class="item-price">
                            {{ number_format($item->price, 1) }}
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
        {{ $items->appends(request()->query())->links() }}
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/getCategory.js') }}"></script>
</body>
</html>