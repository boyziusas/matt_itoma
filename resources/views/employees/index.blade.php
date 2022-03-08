<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __('Employees') }}
                </div>

                @include('components/success-alert-messages')

                <table class="table" id="employee-table">
                    <thead>
                    <tr>
                        <th>{{__('Number')}}</th>
                        <th scope="col">{{__('Photo')}}</th>
                        <th scope="col">{{__('Name')}}</th>
                        <th scope="col">{{__('Email')}}</th>
                        <th scope="col">{{__('Telephone')}}</th>
                        <th scope="col">{{__('Company')}}</th>
                        <th scope="col">{{__('Actions')}}</th>
                    </tr>
                    </thead>

                    @foreach($employees as $employee)
                        <tr>
                            <th scope="row">{{$rank++}}</th>
                            <td>
                                <img src="https://eu.ui-avatars.com/api/?name={{$employee->name}}" alt="emloyee_photo">
                            </td>
                            <td>
                                {{ __(':employeeName', ['employeeName'=> $employee->name ]) }}
                            </td>
                            <td>
                                <a href="mailto:{{$employee->email}}">{{$employee->email}}</a>
                            </td>
                            <td>
                                <a href="tel:{{$employee->telephone}}">{{$employee->telephone}}</a>
                            </td>
                            <td>
                                @if($employee->company)
                                <a href="{{route('companies.show', $employee->company)}}">{{$employee->company->name}}</a>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <a class="btn btn-light" href="{{route('employees.show',$employee)}}">{{__('View')}}</a>
                                </div>
                                <div>
                                    <a class="btn btn-success" href="{{route('employees.edit',$employee)}}">{{__('Edit')}}</a>
                                </div>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </table>


            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/employee-table.js')}}"></script>
</x-app-layout>
