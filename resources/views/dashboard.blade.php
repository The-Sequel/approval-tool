<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <select id="a_background" name="background" class="widget">
                        <option value="1">Yes</option>
                        <option value="0" selected="selected">No</option>
                    </select>

                    @foreach($projects as $project)
                        <a href="{{route('project.show', $project)}}">
                            <div class="container" name="{{$project->id}}">
                                <div>
                                    {{$project->title}}
                                </div>
                            </div>
                        </a>
                    @endforeach

                    <table>
                        <thead>
                            <tr>
                                <th>Project naam</th>
                                <th>Project beschrijving</th>
                                <th>Show</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                @if($customer->id == auth()->user()->customer_id)
                                    @foreach($customer->projects as $project)
                                        <tr>
                                            <td>{{$project->title}}</td>
                                            <td>{{$project->description}}</td>
                                            <td><a href="{{ route('project.show', $project->id) }}">Show</a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    {{-- @foreach($customers as $customer)
                        {{ $customer->name }}
                        
                        @foreach($customer->products as $product)
                            {{ $product->name }}
                        @endforeach
                    @endforeach --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
