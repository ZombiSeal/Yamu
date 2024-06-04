<div class="wrapper">
    <h1 class="wrapper__title">Меню</h1>
    <nav class="menu">
        @foreach($categories as $category)
            <a class="menu__link" href="{{route('catalog', ['category' => $category->code])}}" data-code="{{$category->code}}">
                <svg width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="/images/svg/{{$category->icon}}#svg"></use>
                </svg>
                {{$category->title}}
            </a>
        @endforeach
            <a class="menu__link" href="{{route('catalog', ['category' => 'new'])}}" data-code="new">
                <svg width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="/images/svg/icon-new.svg#svg"></use>
                </svg>
                Новинки
            </a>
            <a class="menu__link" href="{{route('catalog', ['category' => 'popular'])}}" data-code="popular">
                <svg width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="/images/svg/icon-popular.svg#svg"></use>
                </svg>
                Популярные
            </a>
            <a class="menu__link" href="{{route('catalog', ['category' => 'sale'])}}" data-code="sale">
                <svg width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="/images/svg/icon-sale.svg#svg"></use>
                </svg>
                Скидки
            </a>
    </nav>
</div>
<link rel="stylesheet" href="{{asset('/css/menu.css')}}">

