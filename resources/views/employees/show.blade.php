<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee info') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __('Employee info') }}
                    <a class="btn btn-success float-right" href="{{route('employees.edit', $employee)}}">{{__('Edit')}}</a>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <img src="https://eu.ui-avatars.com/api/?name={{$employee->name}}" alt="emloyee_photo">
                    </div>
                    <div class="col-md-3">
                        <p><b>{{__('Name')}}</b></p>
                        <p>  {{ __(':employeeName', ['employeeName'=> $employee->name ]) }} </p>

                        <p><b>{{__('Company')}}</b></p>
                        <div>
                            <a title="{{__('View')}}" href="{{route('companies.show', $employee->company)}}">
                                <img class="img-thumbnail img-fluid" src="{{ asset('storage/'.$employee->company->logo) }}" alt="{{$employee->company->name}} logo">
                                <p>{{$employee->company->name}}</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <p><b>{{__('Email')}}</b></p>
                        <p><a href="mailto:{{$employee->email}}">{{$employee->email}}</a></p>
                        <p><b>{{__('Telephone')}}</b></p>
                        <p><a href="tel:{{$employee->telephone}}">{{$employee->telephone}}</a></p>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form class="float-right" action="{{ route('employees.destroy', $employee) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
