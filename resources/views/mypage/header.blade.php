<div class="row mt-5 mb-3">
    <div class="col-1 p-0 ms-3">
        @if ($user->avatar)
            <img src="{{$user->avatar}}" alt="{{$user->name}}" class="img-thumbnail rounded-circle avatar-md p-0">
        @else
            <i class="fa-solid fa-circle-user text-secondary icon-md mb-2"></i>
        @endif
    </div>
    <div class="col-4 ms-3">
        <div class="row mb-2">
            <div class="col-auto">
                <h3>{{$user->name}}</h3>
            </div>
            <div class="col-auto">
                @if (Auth::user()->id === $user->id)
                    <a href="{{route('profile.edit')}}" class="btn btn-outline-dark btn-sm fw-bold" title="Edit Profile">
                        <i class="fa-solid fa-user-pen"></i> Edit
                    </a>
                @else
                    @if ($user->isFollowed())
                        <form action="{{route('follow.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                        </form>
                    @else
                        <form action="{{route('follow.store', $user->id)}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
        
        <p class="mb-0">{{$user->introduction}}</p>
    </div>
    <div class="col">
        <div class="card w-75 p-2 ms-3 rounded-4 bg-light">
            <div class="row">
                <div class="col pe-0">
                    <div class="text-center">
                        <a href="{{route('bookmark.show', $user->id)}}" class="text-decoration-none text-dark">
                            <strong>{{$user->bookmarks->count()}}</strong>
                            <p class="m-0">{{$user->bookmarks->count() == 1 ? 'book' : 'books'}}</p>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="text-center">
                        {{-- TODO : review --}}
                        <a href="#" class="text-decoration-none text-dark">
                            <strong>2</strong>
                            <p class="m-0">{{$user->bookmarks->count() == 1 ? 'review' : 'reviews'}}</p>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="text-center">
                        <a href="{{route('profile.followers', $user->id)}}" class="text-decoration-none text-dark">
                            <strong>{{$user->followers->count()}}</strong>
                            <p class="m-0">{{$user->followers->count() == 1 ? 'follower' : 'followers'}}</p>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="text-center">
                        <a href="{{route('profile.following', $user->id)}}" class="text-decoration-none text-dark">
                            <strong>{{$user->following->count()}}</strong>
                            <p class="m-0">{{$user->following->count() == 1 ? 'following' : 'following'}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>