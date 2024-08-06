function confirmDelete(id) {
    if (confirm('本当に削除しますか？')) {
        location.href = 'delete_process.php?customer_id=' + id;
    }
}