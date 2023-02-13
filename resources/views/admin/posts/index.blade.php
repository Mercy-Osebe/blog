<x-admin-master>
    @section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Body</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Body</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->title}}</td>
                            <td>
                                <img src="{{URL::to('/') }}/images/{{$post->text_image}}" alt="image" height="40px">
                            </td>
                            <td>{{Str::limit($post->body,50,'...')}}</td>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td>{{$post->updated_at}}</td>
                            <td>
                                <form action="{{route('post.destroy',$post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary" style="color:white" >DELETE</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route('post.update',$post->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary" style="color:white" >UPDATE</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection

    <!-- Blog Post
<div class="row">
@foreach($posts as $post)
    <div class="col-6">
    <div class="card mb-4">
    <div class="home-img">
      <img class="card-img-top img-fluid" src="{{ URL::to('/') }}/images/{{$post->text_image}}" alt="Card image cap">

    </div>

    <div class="card-body">
      <h2 class="card-title">Post Title: {{$post->title}}</h2>
      <p class="card-text">Body: {{Str::limit($post->body,50,'...')}}</p>
      <a href="{{route('blog-post')}}" class="btn btn-primary">Read More &rarr;</a>
    </div>
    <div class="card-footer text-muted">
      {{$post->created_at}}
      <a href="#">Start Bootstrap</a>
    </div>
  </div>
    </div>
    @endforeach
</div> -->

    
    @section('scripts')
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="v{{asset('endor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection

</x-admin-master>