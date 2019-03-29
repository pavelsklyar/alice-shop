<form action="/admin/news/add/status/" enctype="multipart/form-data" method="post" class="addform">
    <input type="text" name="title" placeholder="Заголовок" class="addinput">
    <textarea name="content" placeholder="Содержание" id="" rows="10" class="addtext"></textarea>
    <div class="file-upload">
    <label>
        <input type="file" name="images[]" id="" multiple>        
        <span>Выберите файл</span>
    </label>
    </div>
    <input type="submit" class="btn" value="Добавить">
</form>