$(document).ready(function () {
    // 大カテゴリが変更された時の処理
    $('#firstCategory').change(function () {
        // ユーザーが選んだカテゴリーを取得
        var selectedCategory = $(this).val();

        // Ajaxリクエストを送信
        $.ajax({
            url: '/getSecondCategories',
            type: 'GET',
            data: {
                firstCategory: selectedCategory,
            },
            success: function (data) {
                // 取得したデータをsecondCategoryに反映
                var secondCategorySelect = $('#secondCategory');
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

    // 中カテゴリが変更された時の処理
    $('#secondCategory').change(function () {
        var selectedCategory = $(this).val();
        $.ajax({
            url: '/getThirdCategories',
            type: 'GET',
            data: {
                secondCategory: selectedCategory,
            },
            success: function (data) {
                var thirdCategorySelect = $('#thirdCategory');
                thirdCategorySelect.find('option:not(:first-child)').remove();
                $.each(data.thirdCategories, function (_, thirdCategory) {
                    thirdCategorySelect.append(
                        $('<option>').text(thirdCategory).attr('value', thirdCategory)
                    );
                });
            }
        })
    })
});