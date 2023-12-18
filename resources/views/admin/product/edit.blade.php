 @extends('admin.layouts.master')

 @section('title', 'Category List Page')

 @section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
         <div class="row">
             <div class="mb-2">
                 @if (session('updateSuccess'))
                     <div class="col-4 offset-8">
                         <div class="alert alert-success alert-dismissible fade show" role="alert">
                             <i class=" fa-solid fa-circle-xmark"></i> {{ session('updateSuccess') }}
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                         </div>
                     </div>
                 @endif
             </div>
         </div>
         <div class="section__content section__content--p30">
             <div class="container-fluid">
                 <div class="col-8 offset-1">
                     <div class="card">
                         <div class="card-body">
                             <div class="ms-3">
                                 <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                             </div>
                             <div class="card-title">
                                 <h3 class="text-center title-2">Pizzas Info</h3>
                             </div>
                             <hr>
                             <div class="row">
                                 <div class="col-3 offset-2 mt-2">
                                     <img src="{{ asset('storage/' . $pizza->image) }}" class=" shadow-sm" alt="">
                                 </div>
                                 <div class="col-7">

                                     <div class=" btn btn-danger text-white d-block fs-5 w-50 text-center">
                                         {{ $pizza->name }}</div>

                                     <span class=" my-3 btn btn-dark text-white"><i
                                             class="fa-solid fs-4 fa-money-bill-1-wave me-2"></i>{{ $pizza->price }} Kyarts
                                     </span>
                                     <span class=" my-3 btn btn-dark text-white"> <i
                                             class="fa-solid fa-clone me-2"></i>{{ $pizza->category_name }}
                                     </span>
                                     <span class=" my-3 btn btn-dark text-white"><i
                                             class="fa-solid fs-4 fa-stopwatch me-2"></i>
                                         {{ $pizza->waiting_time }}</span>
                                     <span class=" my-3 btn btn-dark text-white"><i
                                             class="fa-solid fs-4 fa-eye me-2"></i>{{ $pizza->view_count }}
                                     </span>
                                     <span class=" my-3 btn btn-dark  text-white"><i
                                             class="fa-solid fs-4 fa-calendar-plus me-2"></i>{{ $pizza->created_at->format('j-F-Y') }}
                                     </span>
                                     <div class=" my-3"><i class="fa-solid fs-4 fa-align-left d-block"></i>Details
                                     </div>
                                     <div class="">{{ $pizza->description }}</div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- END MAIN CONTENT-->
 @endsection
