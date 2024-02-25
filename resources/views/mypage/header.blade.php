<div class="row mt-5 mb-3">
    <div class="col-1 p-0 ms-3">
        @if ($user->avatar)
            <img src="{{$user->avatar}}" alt="{{$user->name}}" class="img-thumbnail rounded-circle avatar-md">
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block icon-md"></i>
        @endif
    </div>
    <div class="col-4 ms-3">
        <div class="row">
            <div class="col-auto">
                <h3>{{$user->name}}</h3>
            </div>
            <div class="col-auto">
                @if (Auth::user()->id === $user->id)
                    <a href="{{route('profile.edit')}}" class="btn btn-outline-dark btn-sm" title="Edit Profile">
                        <i class="fa-solid fa-user-pen"></i> Edit
                    </a>
                @else
                    {{-- TODO : follow --}}
                    <form action="#" method="post">
                        @csrf
                        <button type="submit" class="btn">Follow</button>
                    </form>
                @endif
            </div>
        </div>
        
        <p>{{$user->introduction}}</p>
    </div>
    <div class="col">
        <div class="card w-75 p-2 ms-3 rounded-4 bg-light">
            <div class="row">
                <div class="col pe-0">
                    <div class="text-center">
                        <strong>20</strong>
                        <p class="m-0">book</p>
                    </div>
                </div>
                <div class="col">
                    <div class="text-center">
                        <strong>20</strong>
                        <p class="m-0">review</p>
                    </div>
                </div>
                <div class="col">
                    <div class="text-center">
                        <strong>3</strong>
                        <p class="m-0">followers</p>
                    </div>
                </div>
                <div class="col">
                    <div class="text-center">
                        <strong>3</strong>
                        <p class="m-0">following</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>