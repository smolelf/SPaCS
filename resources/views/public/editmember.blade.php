@if (Auth::user()->usertype == 1)
@else
<script type="text/javascript">
    window.location = "{{ url('/') }}"
</script>
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="`font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Landing') }} --}}
            Manage Members
        </h2>
    </x-slot>

    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>
        <div class=" text-2xl">Team Members ({{$data->proj_mem_num}} @if ($data->proj_mem_num > 1) Members) @else Member) @endif</div>
        <form method="POST" action="{{ url('updatememb') }}">
            @csrf
            <div class="hidden">
                <x-jet-label for="id" value="{{ __('ID') }}" />
                <x-jet-input id="id" class="block mt-1 w-full" type="text" name="id" value="{{$data->id}}" required />
            </div>

            <div class="hidden">
                {{$count = $data->proj_mem_num}}
                {{$i = 1}}
                {{$l1 = $lect}}
                {{$l2 = $lect}}
                {{$l3 = $lect}}
            </div>

            @if ($i <= $count)
            <div class="mt-4">
                <x-jet-label for="proj_mem_num1" value="{{ __('Project Member ('.$i.')') }}" />
                <select id="proj_mem_num1" 
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                name="proj_mem_num1" >
                <option value="" @if ($data->proj_mem_num1 == null) selected @endif>NOT SELECTED</option>
                @foreach ($l1 as $l1)
                    <option value="{{$l1->id}}" @if ($data->proj_mem_num1 == $l1->id) selected @endif>{{$l1->name}}</option>
                @endforeach
                </select>
            </div>
            <div class="hidden">
                {{$i = $i + 1}}
            </div>
            @endif
            
            @if ($i <= $count)
            <div class="mt-4">
                <x-jet-label for="proj_mem_num2" value="{{ __('Project Member ('.$i.')') }}" />
                <select id="proj_mem_num2" 
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                name="proj_mem_num2" >
                <option value="" @if ($data->proj_mem_num2 == null) selected @endif>NOT SELECTED</option>
                @foreach ($l2 as $l2)
                    <option value="{{$l2->id}}" @if ($data->proj_mem_num2 == $l2->id) selected @endif>{{$l2->name}}</option>
                @endforeach
                </select>
            </div>
            <div class="hidden">
                {{$i = $i + 1}}
            </div>
            @endif

            @if ($i <= $count)
            <div class="mt-4">
                <x-jet-label for="proj_mem_num3" value="{{ __('Project Member ('.$i.')') }}" />
                <select id="proj_mem_num3" 
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                name="proj_mem_num3" >
                <option value="" @if ($data->proj_mem_num3 == null) selected @endif>NOT SELECTED</option>
                @foreach ($l3 as $l3)
                    <option value="{{$l3->id}}" @if ($data->proj_mem_num3 == $l3->id) selected @endif>{{$l3->name}}</option>
                @endforeach
                </select>
            </div>
            <div class="hidden">
                {{$i = $i + 1}}
            </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Update Project Member(s)') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-app-layout>