<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company info') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __('Company info') }}
                    <a class="btn btn-success float-right" href="{{route('companies.edit', $company)}}">{{__('Edit')}}</a>
                </div>
                @include('components/success-alert-messages')
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-thumbnail img-fluid" src="{{ asset('storage/'.$company->logo) }}" alt="{{$company->name}} logo">
                    </div>
                    <div class="col-md-9">
                        <p><b>{{__('Company Name')}}</b></p>
                        <p>{{$company->name}}</p>
                        <p><b>{{__('Company Email')}}</b></p>
                        <p>{{$company->email}}</p>
                        <p><b>{{__('Company Website')}}</b></p>
                        <p>{{$company->website}}</p>
                        <p><b>{{__('Company Employee count')}}</b></p>
                        <p>{{$company->getEmployeeCount()}}</p>
                    </div>

                </div>
                <form class="float-right" action="{{ route('companies.destroy', $company) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                </form>

                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __('Company employees') }}
                </div>
                <table class="table"  id="employee-table">
                    <thead>
                    <tr>
                        @php($rank = 1)
                        <th>{{__('Number')}}</th>
                        <th scope="col">{{__('Name')}}</th>
                        <th scope="col">{{__('Telephone')}}</th>
                        <th scope="col">{{__('Email')}}</th>
                        <th scope="col">{{__('Actions')}}</th>
                    </tr>
                    @foreach($company->employees as $employee)
                        <tr>
                            <th>{{$rank++}}</th>
                            <td>  {{ __(':employeeName', ['employeeName'=> $employee->name ]) }}</td>
                            <td><a href="tel:{{$employee->telephone}}">{{$employee->telephone}}</a></td>
                            <td><a href="mailto:{{$employee->email}}">{{$employee->email}}</a></td>
                            <td>
                                <div>
                                    <a class="btn btn-light" href="{{route('employees.show',$employee)}}">{{__('View')}}</a>
                                </div>
                                <div>
                                    <a  class="btn btn-success" href="{{route('employees.edit',$employee)}}">{{__('Edit')}}</a>
                                </div>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </thead>

                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        jQuery(document).ready( function () {
            jQuery('#employee-table').DataTable();
        } );
    </script>
</x-app-layout>
