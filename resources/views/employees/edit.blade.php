<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}
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

                    <form class="needs-validation" action="{{ route('employees.update', $employee) }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group">
                                <strong>{{__('Name')}}<span class="text-danger">*</span></strong>
                                <input type="text" name="name" class="form-control"
                                       @if(old('name'))
                                       value="{{old('name')}}"
                                       @else
                                       value="{{$employee->name}}"
                                       @endif
                                       placeholder="Name" required>
                                <div class="invalid-feedback">
                                    {{__('Field is required')}}
                                </div>
                            </div>

                            <div class="form-group">
                                <strong>{{__('Email')}}<span class="text-danger">*</span></strong>
                                <input type="email" class="form-control" name="email"
                                       @if(old('telephone'))
                                       value="{{old('email')}}"
                                       @else
                                       value="{{$employee->email}}"
                                       @endif
                                       placeholder="Email" required/>
                                <div class="invalid-feedback">
                                    {{__('Please enter a valid Email')}}
                                </div>
                                <small id="emailHelp" class="form-text text-muted">{{__('Example:')}} test@gmail.com</small>
                            </div>

                            <div class="form-group">
                                <strong>{{__('Telephone')}}<span class="text-danger">*</span></strong>
                                <input type="tel" class="form-control" name="telephone"
                                       @if(old('telephone'))
                                       value="{{old('telephone')}}"
                                       @else
                                       value="{{$employee->telephone}}"
                                       @endif
                                       minlength="11" maxlength="11" placeholder="Telephone" required/>
                                <div class="invalid-feedback">
                                    {{__('Please enter a valid Telephone number')}}
                                </div>
                                <small id="urlHelp" class="form-text text-muted">{{__('Example:')}} 37068855121</small>
                            </div>

                            <div class="form-group">
                                <strong>{{__('Company')}}:</strong>

                                <select class="form-control" id="company" name="company">
                                    @php
                                    $value = $employee->company_id;
                                    if(old('company')){
                                        $value = old('company');
                                    }
                                    @endphp
                                    @foreach($companies as $company)
                                        <option
                                            @if($company->id == $value)
                                                selected
                                            @endif
                                            value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('components.boostrap-validation')
</x-app-layout>
