@if($errors->any())
<div class="col-lg-12 col-md-12">
    <div class="alert alert-danger alert-dismissible">
       {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close"aria-label="Close"> <span aria-hidden="true"></span> </button>
    </div>
</div>
@endif

@if(session()->has('msg'))
<div class="col-lg-12 col-md-12">
    <div class="alert alert-success alert-dismissible">
    {{ session()->get('msg') }}  
        <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close"aria-label="Close"> <span aria-hidden="true"></span> </button>
    </div>
</div>
@endif

