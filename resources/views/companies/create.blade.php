<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Company') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="needs-validation" action="{{ route('companies.store') }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <strong>{{__('Company Name')}}<span class="text-danger">*</span></strong>
                                <input type="text" name="name" class="form-control"  value="{{old('name')}}"  placeholder="Name" required>
                                <div class="invalid-feedback">
                                    {{__('Field is required')}}
                                </div>
                            </div>

                            <div class="form-group">
                                <strong>{{__('Email')}}<span class="text-danger">*</span></strong>
                                <input type="email" class="form-control" name="email"  value="{{old('email')}}" placeholder="Email" required/>
                                <div class="invalid-feedback">
                                    {{__('Please enter a valid Email')}}
                                </div>
                                <small id="emailHelp" class="form-text text-muted">{{__('Example:')}} test@gmail.com</small>
                            </div>

                            <div class="form-group">
                                <strong>{{__('Website')}}<span class="text-danger">*</span></strong>
                                <input type="url" class="form-control" name="website" value="{{old('website')}}" placeholder="Website" required/>
                                <div class="invalid-feedback">
                                    {{__('Please enter a valid URL')}}
                                </div>
                                <small id="urlHelp" class="form-text text-muted">{{__('Example:')}} https://monkesbiznis.com</small>
                            </div>

                            <div class="form-group">
                                <strong for="logo">{{__('Company Logo')}}<span class="text-danger">*</span></strong>
                                <img id="image-preview" class="img-thumbnail img-fluid">
                                <input type="file" class="form-control-file"  name="logo" id="logo" onchange="loadFile(event)" required>
                                <div class="invalid-feedback">
                                    {{__('Image is required')}}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>
    @include('components.boostrap-validation')
    @include('components.image-script')
</x-app-layout>
