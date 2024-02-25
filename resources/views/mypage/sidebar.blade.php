<ul class="nav nav-pills flex-column bg-light mt-5">
    <li class="nav-item">
        <a href="{{route('home')}}" class="nav-link text-dark">
            <i class="fa-solid fa-house me-2"></i> Home
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('book.index')}}" class="nav-link text-dark">
            <i class="fa-solid fa-book me-2"></i> Book List
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('mypage.index', Auth::user()->id)}}" class="nav-link active bg-secondary">
            <i class="fa-solid fa-user me-2"></i> My Page
        </a>
    </li>                       
</ul>