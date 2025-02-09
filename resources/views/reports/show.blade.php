<!DOCTYPE html>
<html>
<head>
    <title>Report Details - Inventory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Report Details</h1>
                <a href="{{ route('reports.index') }}" class="text-blue-600 hover:text-blue-900">Back to Reports</a>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Report Name</h2>
                        <p class="mt-1 text-sm text-gray-900">{{ $report->name }}</p>
                    </div>
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Email</h2>
                        <p class="mt-1 text-sm text-gray-900">{{ $report->email }}</p>
                    </div>
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Status</h2>
                        <p class="mt-1">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($report->status === 'completed') bg-green-100 text-green-800
                                @elseif($report->status === 'processing') bg-yellow-100 text-yellow-800
                                @elseif($report->status === 'failed') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($report->status) }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Created At</h2>
                        <p class="mt-1 text-sm text-gray-900">{{ $report->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>

                @if($report->parameters)
                    <div class="mb-6">
                        <h2 class="text-sm font-medium text-gray-500 mb-2">Parameters</h2>
                        <div class="bg-gray-50 rounded p-4">
                            <pre class="text-sm text-gray-700">{{ json_encode($report->parameters, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    </div>
                @endif

                @if($report->error_message)
                    <div class="mb-6">
                        <h2 class="text-sm font-medium text-gray-500 mb-2">Error Message</h2>
                        <div class="bg-red-50 border border-red-200 rounded p-4">
                            <p class="text-sm text-red-700">{{ $report->error_message }}</p>
                        </div>
                    </div>
                @endif

                @if($report->file_path)
                    <div class="mb-6">
                        <h2 class="text-sm font-medium text-gray-500 mb-2">Report File</h2>
                        <div class="bg-gray-50 rounded p-4">
                            <p class="text-sm text-gray-700">File: {{ $report->file_path }}</p>
                            <p class="text-sm text-gray-700">Completed at: {{ $report->completed_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html> 