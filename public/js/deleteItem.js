document.getElementById('#deleteBtn').addEventListener('click', function () {
    // 確認ポップアップを表示
    if (confirm('商品を削除しますか？')) {
        // ユーザーが「はい」を選択した場合の処理
        // Laravelのルートから削除アクションを呼び出す
        axios.delele(itemDeleteRoute).then(function (response) {
            window.location.href = itemListRoute;
        }).catch(function (error) {
            console.error(error);
        });
    }
});