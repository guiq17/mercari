// IDがfirstCategoryの要素が変更されたら発動
$('#firstCategory').change(function () {
    // ユーザーが選んだカテゴリーを取得
    var selectedCategory = $(this).val();
    // CSRFトークンを取得
    // var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Ajaxリクエストを送信
    $.ajax({
        url: '/getSecondCategories',
        type: 'GET',
        data: {
            category: selectedCategory,
            // _token: csrfToken //トークンをリクエストに含める
        },
        success: function (data) {
            console.log(data);
            // 取得したデータをsecondCategoryに反映
            var secondCategorySelect = $("#secondCategory");
            // デフォルトのオプション（- secondCategory -）以外を削除
            secondCategorySelect.find('option:not(:first-child)').remove();
            // 中カテゴリを追加
            $.each(data.secondCategories, function (_, secondCategory) {
                secondCategorySelect.append(
                    $('<option>').text(secondCategory).attr('value', secondCategory)
                );
            });
        }
    });
});