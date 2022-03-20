<x-backend>
    @php
    $id=$category->id;
    $name=$category->name;
    $photo=$category->photo;
    @endphp
	<main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Category  Edit Form </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="{{route('backside.category.index')}}" class="btn btn-outline-primary">
                        <i class="icofont-double-left icofont-1x"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <form action="{{route('backside.category.update',$id)}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @method('PUT')
                                <input type="hidden" name="oldPhoto" value="{{$photo}}">
                                
                                <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="name_id" name="name" value="{{$name}}"><div class="text-danger form-control-feedback">{{$errors->first('name')}}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                        <label for="photo_id" class="col-sm-2 col-form-label"> Photo </label>
                                        <div class="col-sm-9">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile-home" role="tab" aria-controls="home" aria-selected="true" name="oldPhoto">Old photo</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#new-profile" role="tab" aria-controls="profile" aria-selected="false" name="photo">New photo</a>
                                        </li>

                                        </ul>
                            <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="profile-home" role="tabpanel" aria-labelledby="home-tab">
                                <img src="{{asset($photo)}}" alt="" width="200" height="150">
                              </div>
                              <div class="tab-pane fade" id="new-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <input type="file" name="photo" >
                              </div>
                              
                            </div>
                            
                            

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="icofont-save"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>
                        

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</x-backend>