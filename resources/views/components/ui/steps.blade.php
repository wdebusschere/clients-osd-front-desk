@props([
    'steps' => [],
    'currentStep' => 0
])
<ol class="grid xl:grid-flow-col gap-2 xl:gap-4">
    @foreach($steps as $key => $step)
        @php
            $itemClasses = 'border-gray-300 dark:border-slate-600';
            $textClasses = 'text-gray-400 dark:text-slate-500';
            $iconClasses = 'border-gray-400 dark:border-slate-500';

            if ($key === $currentStep) {
                $itemClasses = 'border-gray-500';
                $textClasses = 'text-gray-500';
                $iconClasses = 'border-gray-500';
            } elseif ($key < $currentStep) {
                $textClasses = 'text-teal-500';
                $iconClasses = 'border-teal-500';
            }
        @endphp
        <li class="flex items-center space-x-3 p-3 rounded-lg border {{ $itemClasses }}">
            <div class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0 {{ $textClasses }} {{ $iconClasses }}">
                @if($key < $currentStep)
                    <x-icons.outline.check class="w-4 h-4"/>
                @else
                    {{ $key + 1 }}
                @endif
            </div>
            <div>
                <h3 class="font-medium {{ $textClasses }}">{{ $step['label'] }}</h3>

                @isset($step['description'])
                    <p class="text-sm">{{ $step['description'] }}</p>
                @endisset
            </div>
        </li>
    @endforeach
</ol>
