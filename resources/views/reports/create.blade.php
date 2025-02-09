<!DOCTYPE html>
<html>
<head>
    <title>Generate Report - Inventory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Generate New Report</h1>
                <a href="{{ route('reports.index') }}" class="text-blue-600 hover:text-blue-900">Back to Reports</a>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ url('/reports') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Report Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Report Parameters</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="categories" class="block text-gray-700 text-sm mb-1">Categories</label>
                                <select name="parameters[categories][]" id="categories" multiple
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="Electronics">Electronics</option>
                                    <option value="Accessories">Accessories</option>
                                    <option value="Office Supplies">Office Supplies</option>
                                    <option value="Furniture">Furniture</option>
                                    <option value="Software">Software</option>
                                    <option value="Networking">Networking</option>
                                    <option value="Storage">Storage</option>
                                    <option value="Peripherals">Peripherals</option>
                                    <option value="Components">Components</option>
                                    <option value="Gaming">Gaming</option>
                                </select>
                                <p class="text-sm text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple categories</p>
                            </div>
                            <div>
                                <label for="min_quantity" class="block text-gray-700 text-sm mb-1">Minimum Quantity</label>
                                <input type="number" name="parameters[min_quantity]" id="min_quantity" value="{{ old('parameters.min_quantity') }}"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Generate Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 
