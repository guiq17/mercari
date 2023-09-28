// IDがfirstCategoryの要素が変更されたら発動
$('#firstCategory').change(function () {
    // ユーザーが選んだカテゴリーを取得
    var selectedCategory = $(this).val();
    // Ajaxリクエストを送信
    $.ajax({
        url: '/getSecondCategories',
        type: 'GET',
        data: { category: selectedCategory },
        success: function (data) {
            // 取得したデータをsecondCategoryに反映
            var secondCategorySelect = $('#secondCategory');
            secondCategorySelect.empty();
            $.each(data, function (key, value) {
                secondCategorySelect.append($('<option>').text(value).attr('value', key));
            });
        }
    });
});