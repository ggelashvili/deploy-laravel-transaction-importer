<div class="flex flex-wrap">
    @foreach($stats as $stat)
        <div class="w-full lg:w-6/12 xl:w-3/12 px-5">
            <div @class([
                'relative flex flex-col min-w-0 break-words bg-white rounded mb-3 xl:mb-0 shadow-lg shadow-blue-50',
                'shadow-green-50' => ! empty($stat['colored']) && $stat['value'] > 0,
                'shadow-red-50'   => ! empty($stat['colored']) && $stat['value'] < 0,
            ])>
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-gray-800 uppercase font-bold text-xs">{{ $stat['title'] }}</h5>
                            <span @class([
                                'font-semibold text-xl text-gray-700',
                                'text-red-400'   => ! empty($stat['colored']) && $stat['value'] < 0,
                                'text-green-500' => ! empty($stat['colored']) && $stat['value'] > 0,
                            ])>
                                {{ $stat['formatted'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
