<div class="modal" id="create-category">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('category.store')}}" method="post">
            @csrf
            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" autocomplete="off">
            <div class="text-end mt-3">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-dark">
                <i class="fa-solid fa-plus"></i> Add
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>