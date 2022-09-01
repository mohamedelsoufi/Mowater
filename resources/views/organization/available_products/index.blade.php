@extends('organization.layouts.app')
@section('title','Mawatery | Available products')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.available_products')}}  <small class="text-secondary">({{ $available_products->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.available_products')}}</li>
                    </ol>
                </div>
                @include('organization.includes.alerts.success')
                @include('organization.includes.alerts.errors')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <a href = "{{route('organization.available_product.create')}}" class="btn btn-primary">{{__('words.create')}}</a>
                        
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.image')}}</th>
                                        <th>{{__('words.name')}}</th>
                                        <th>{{__('words.product_status')}}</th>
                                        <th>{{__('words.price')}}</th>
                                        <th>{{__('words.type')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($available_products as $available_product)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$available_product->one_image)
                                                    <a href="{{asset('uploads/default_image.png')}}" data-toggle="lightbox">
                                                        <img class="slider_image" src="{{asset('uploads/default_image.png')}}" alt="">
                                                    </a>
                                                @else
                                                    <a href="{{$available_product->one_image}}" data-toggle="lightbox">
                                                        <img class="slider_image" src="{{$available_product->one_image}}" onerror="this.src='{{asset('uploads/default_image.png')}}'" alt="">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$available_product->name}}</td>
                                            <td>{{$available_product->status}}</td>
                                            <td>{{__('words.' . $available_product->type)}}</td>
                                            <td>{{$available_product->price}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @include('organization.available_products.delete')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
   <script>
       function delete_available_product(id)
        {
            var url = "{{route('organization.available_product.destroy' , ':id')}}";
            url = url.replace(':id' , id);
            $('#ModalDelete form').attr('action' , url);
            $('#ModalDelete').modal('show');
        }

   </script>
@endsection

