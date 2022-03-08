<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __('All Companies') }}
                </div>

                @include('components/success-alert-messages')

                <table class="table" id="companies-table">
                    <thead>
                        <tr>
                            <th>{{__('Number')}}</th>
                            <th scope="col">{{__('Company Logo')}}</th>
                            <th scope="col">{{__('Company Name')}}</th>
                            <th scope="col">{{__('Email')}}</th>
                            <th scope="col">{{__('Company Website')}}</th>
                            <th scope="col">{{__('Employee count')}}</th>
                            <th scope="col">{{__('Actions')}}</th>
                        </tr>
                    </thead>

                    @foreach($companies as $company)
                        <tr>
                            <th scope="row">{{$rank++}}</th>
                            <td>
                                <img class="img-thumbnail img-fluid" src="{{ asset('storage/'.$company->logo) }}" alt="{{$company->name}} logo">
                            </td>
                            <td>
                                {{$company->name}}
                            </td>
                            <td>
                                <a href="mailto:{{$company->email}}">{{$company->email}}</a>
                            </td>
                            <td>
                                <a href="{{$company->website}}">{{$company->website}}</a>
                            </td>
                            <td>
                                {{$company->getEmployeeCount()}}
                            </td>
                            <td>
                                <div>
                                    <a class="btn btn-light" href="{{route('companies.show',$company)}}">{{__('View')}}</a>
                                </div>
                                <div>
                                    <a class="btn btn-success" href="{{route('companies.edit',$company)}}">{{__('Edit')}}</a>
                                </div>
                                <form action="{{ route('companies.destroy', $company) }}" method="POST">
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
    <script src="{{ asset('js/companies-table.js')}}"></script>
</x-app-layout>
