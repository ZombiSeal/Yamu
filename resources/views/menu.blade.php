<div class="wrapper">
    <h1 class="wrapper__title">Меню</h1>
    <nav class="menu">
        @foreach($categories as $category)
            <a class="menu__link" href="{{route('catalog', ['category' => $category->code])}}">
                <svg width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="/images/svg/{{$category->icon}}#svg"></use>
                </svg>
                {{$category->title}}
            </a>
        @endforeach
    </nav>
</div>
<link rel="stylesheet" href="{{asset('/css/menu.css')}}">

