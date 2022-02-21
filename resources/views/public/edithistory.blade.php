<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Landing') }} --}}
            View/Edit Project Details
        </h2>
    </x-slot>

    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>
        <form method="POST" action="{{ url('updateproj') }}">
            @csrf

            <div class="hidden">
                <x-jet-label for="id" value="{{ __('ID') }}" />
                <x-jet-input id="id" class="block mt-1 w-full" type="text" name="id" value="{{$data->id}}" required />
            </div>

            <div>
                <x-jet-label for="proj_name" value="{{ __('Project Name') }}" />
                <x-jet-input id="proj_name" class="block mt-1 w-full" type="text" name="proj_name" value="{{$data->proj_name}}" required />
            </div>

            <div class="hidden">
                @if ($data->proj_type == 0)
                    {{$type = "Consultancy Project"}}
                @else
                    {{$type = "Research Grant Project"}}
                @endif
            </div>

            @if (Auth::user()->usertype != 1)
            <div class="mt-4">
                <x-jet-label for="proj_type1" value="{{ __('Project Type') }}" />
                <x-jet-input id="proj_type1" class="block mt-1 w-full text-gray-400" type="text" name="proj_type1"
                value="{{$type}}" readonly disabled />
            </div>
            @endif

            <div @if (Auth::user()->usertype != 1) class="hidden" @else class="mt-4" @endif>
                <x-jet-label for="proj_type" value="{{ __('Project Type') }}" />
                <select id="proj_type" 
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                name="proj_type" required >
                    <option value="0" @if ($data->proj_type == 0) selected @endif>Consultancy Project</option>
                    <option value="1" @if ($data->proj_type == 1) selected @endif>Research Grant Project</option>
                </select>
            </div>

            @if (Auth::user()->usertype != 1)
            <div class="mt-4">
                <x-jet-label for="leader1" value="{{ __('Project Leader') }}" />
                <x-jet-input id="leader1" class="block mt-1 w-full text-gray-400" type="text" name="leader1" value="{{$data->name}}" readonly disabled />
            </div>
            @endif

            <div @if (Auth::user()->usertype != 1) class="hidden" @else class="mt-4" @endif>
                <div class="hidden">
                    {{$lect = DB::table('users')->get()}}
                </div>
                <x-jet-label for="leader" value="{{ __('Project Leader') }}" />
                <select id="leader" 
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                name="leader" required >
                    @foreach ($lect as $lect)
                        <option value="{{$lect->id}}" @if ($data->leader == $lect->id) selected @endif>{{$lect->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="hidden">
                {{$count = $data->proj_mem_num}}
            </div>

            <div class="mt-4">
                <x-jet-label for="proj_mem_num" value="{{ __('No. of Project Members (Up to three(3) members)') }}" />
                <div class="flex mt-1">
                    <select id="proj_mem_num" 
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full text-left" 
                    name="proj_mem_num" >
                    @for ($i = 0; $i < 4; $i++)
                        <option value="{{$i}}" @if ($data->proj_mem_num == $i) selected @endif>
                            @if ($i == '0')
                                None 
                            @elseif ($i == '1')
                                1 Member
                            @else
                                {{$i}} Members
                            @endif
                        </option>
                    @endfor
                    </select>
                    
                </div>
            </div>

            <div class="mt-4">
                <x-jet-label for="start_date" value="{{ __('Start Date') }}" />
                <x-jet-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" value="{{$data->start_date}}" />
            </div>

            <div class="mt-4">
                <x-jet-label for="end_date" value="{{ __('End Date') }}" />
                <x-jet-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" value="{{$data->end_date}}" />
            </div>

            <div class="mt-4">
                <x-jet-label for="duration" value="{{ __('Duration (Months)') }}" />
                <x-jet-input id="duration" class="block mt-1 w-full" type="text" name="duration" value="{{$data->duration}}" />
            </div>

            <div class="mt-4">
                <x-jet-label for="cost" value="{{ __('Cost (RM)') }}" />
                <x-jet-input id="cost" class="block mt-1 w-full" type="text" name="cost" value="{{$data->cost}}" />
            </div>

            <div class="mt-4">
                <x-jet-label for="client" value="{{ __('Client') }}" />
                <select id="client" 
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                name="client" required >
                    @foreach ($client as $client)
                        <option value="{{$client['id']}}" @if ($client['id'] == $data->client)
                            {{{'selected'}}}
                        @endif>{{$client['cl_name']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="proj_stage" value="{{ __('Project Stage') }}" />
                <select id="proj_stage" 
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                name="proj_stage" required >
                    @foreach ($stage as $stage)
                        <option value="{{$stage['id']}}" @if ($stage['id'] == $data->proj_stage)
                            {{{'selected'}}}
                        @endif>{{$stage['stage_desc']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="proj_status" value="{{ __('Project Status') }}" />
                <select id="proj_status" 
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                name="proj_status" required >
                    @foreach ($stat as $stat)
                    <option value="{{$stat['id']}}" @if ($stat['id'] == $data->proj_status)
                        {{{'selected'}}}
                    @endif>{{$stat['stat_desc']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Update Project Details') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
    <div class="py-12"></div>
</x-app-layout>