<div class="row my-3">
    <div class="col-1 ms-3">
        @if ($user->avatar)
            <img src="{{$user->avatar}}" alt="{{$user->name}}" class="avatar-md">
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block icon-md"></i>
        @endif
    </div>
    <div class="col-4 ms-3">
        <h3>{{$user->name}}</h3>
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