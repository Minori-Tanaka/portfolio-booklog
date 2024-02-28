<div class="modal" id="delete-review-{{$book->id}}">
    <div class="modal-dialog">
      <div class="modal-content border-danger">
        <div class="modal-header border-danger">
          <h3 class="h5 modal-title text-danger">
            <i class="fa-solid fa-circle-exclamation"></i> Delete Review
          </h3>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this review?</p>
          <div class="row mt-3">
            <div class="col-3">
                <img src="{{$book->cover_photo}}" alt="book id {{$book->id}}" class="w-100">
            </div>
            <div class="col">
                <p class="mt-1 text-muted">{{$book->title}}</p>
                <p class="mt-1 text-muted small">{{$book->author}}</p>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <form action="{{route('review.destroy', $book->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>