<div class="p-6 bg-gray-100 rounded-lg shadow-lg max-h-96 overflow-y-auto">
    <h3 class="text-lg font-semibold mb-4">Console Logs</h3>
    <ul class="space-y-2">
        @if($logs->count() > 0)
            @foreach($logs as $log)
                <li class="bg-white p-4 rounded-lg shadow-sm border-l-4 @if (strpos($log->action, 'Barang Masuk') !== false) border-blue-500 @else border-red-500 @endif">
                    <span class="text-sm text-gray-500">{{ $log->created_at->format('Y-m-d H:i:s') }}</span>
                    <p>{{ $log->action }}</p>
                </li>
            @endforeach
        @else
            <li class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-gray-300">
                No logs found.
            </li>
        @endif
    </ul>
</div>
