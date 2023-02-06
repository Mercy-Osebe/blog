<x-admin-master>
    @section('content')
    <h1>
        Admin post page
    </h1>
    <form class="form-card" enctype="multipart/form-data" method="post" action="{{route('post.store')}}">
                    @csrf
                   

                    <div class="row justify-content-center">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3" for="title">Title:<span class="text-danger"> *</span></label> <input type="text" id="title" name="title" class="form-control" > </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3" for="user_id">User Id<span class="text-danger"> *</span></label> <input type="number" id="user_id" name="user_id" class="form-control" > </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="form-group col-sm-6 flex-column d-flex"><label for="text_image" class="form-label form-control-file">Upload Image:<span class="text-danger"> *</span></label><input class="form-control" type="file" id="text_image" name="text_image" multiple></div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3" for="body">body:</label> <textarea name="body" id="" cols="30" rows="10" class="form-control" ></textarea> </div>
                    </div>
                    
                    <div class="row justify-content-center mt-3">
                        <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-primary" name=submit>Post Item</button> </div>
                    </div>
                </form>
    @endsection
</x-admin-master>