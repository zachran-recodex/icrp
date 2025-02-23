<div class="fixed bottom-0 right-0 p-4 space-y-4 z-50">
    @foreach ($messages as $message)
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false;
            $wire.remove('{{ $message['id'] }}') }, 3000)"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @class([
                'min-w-[350px] shadow-lg rounded-lg pointer-events-auto overflow-hidden',
                'bg-green-50 ring-1 ring-green-200' => $message['type'] === 'success',
                'bg-red-50 ring-1 ring-red-200' => $message['type'] === 'error',
                'bg-blue-50 ring-1 ring-blue-200' => $message['type'] === 'info',
                'bg-yellow-50 ring-1 ring-yellow-200' => $message['type'] === 'warning',
            ])>
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @if ($message['type'] === 'success')
                            <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        @elseif($message['type'] === 'error')
                            <i class="fas fa-times-circle text-red-400 text-xl"></i>
                        @elseif($message['type'] === 'info')
                            <i class="fas fa-info-circle text-blue-400 text-xl"></i>
                        @elseif($message['type'] === 'warning')
                            <i class="fas fa-exclamation-circle text-yellow-400 text-xl"></i>
                        @endif
                    </div>
                    <div class="ml-3 flex-1">
                        <p @class([
                            'text-sm font-medium',
                            'text-green-800' => $message['type'] === 'success',
                            'text-red-800' => $message['type'] === 'error',
                            'text-blue-800' => $message['type'] === 'info',
                            'text-yellow-800' => $message['type'] === 'warning',
                        ])>
                            {{ $message['message'] }}
                        </p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="show = false; $wire.remove('{{ $message['id'] }}')"
                            class="inline-flex rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2"
                            @class([
                                'text-green-500 hover:text-green-600 focus:ring-green-500' =>
                                    $message['type'] === 'success',
                                'text-red-500 hover:text-red-600 focus:ring-red-500' =>
                                    $message['type'] === 'error',
                                'text-blue-500 hover:text-blue-600 focus:ring-blue-500' =>
                                    $message['type'] === 'info',
                                'text-yellow-500 hover:text-yellow-600 focus:ring-yellow-500' =>
                                    $message['type'] === 'warning',
                            ])>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
