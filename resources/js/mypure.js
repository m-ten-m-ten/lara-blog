function delete_alert(){
  if(!confirm('本当に削除しますか？')){
    alert('キャンセルされました'); 
    return false;
  }
  document.submit();
}