<form method="GET" action="{{ route('products.search') }}">
    <label for="search">商品検索</label>
    <input type="text" id="search" name="search" value="{{ request('search') }}">

    <label for="sort">並び替え</label>
    <select name="sort" id="sort">
        <option value="">-- 選択してください --</option>
        <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>価格が高い順</option>
        <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>価格が安い順</option>
    </select>

    <button type="submit">検索</button>
</form>
