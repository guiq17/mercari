document.addEventListener('DOMContentLoaded', function () {
    var deleteButton = document.getElementById('deleteBtn');
    if (deleteButton) {
        deleteButton.addEventListener('click', function (event) {
            // 確認ポップアップを表示
            if (confirm('商品を削除しますか？')) {
                // ユーザーが「OK」を選択した場合の処理
                // Laravelのルートから削除アクションを呼び出す
                axios.delete(itemDeleteRoute).then(function (response) {
                    window.location.href = itemListRoute;
                }).catch(function (error) {
                    console.error(error);
                });
            } else {
                // ユーザーがキャンセルを選択した場合の処理
                // フォームのデフォルトの送信動作を阻止
                event.preventDefault();
            }
        });
    }
});