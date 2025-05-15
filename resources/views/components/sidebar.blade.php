<!-- resources/views/components/sidebar.blade.php -->
<div x-data="{ open: false }" class="flex h-screen">
    <!-- Sidebar -->
    <div :class="open ? 'w-60' : 'w-16'" class="bg-gray-200 border-r border-gray-500 text-dark transition-all duration-300 flex flex-col">
        <div :class="open ? 'justify-between' : 'gap-4 mx-auto'" class="p-4 flex items-center border-b border-gray-500">
            <h1 x-show="open" class="text-xl font-bold tracking-wide leading-none">Dashboard</h1>
            <button @click="open = !open" class="focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <nav :class="open ? 'justify-between px-2' : 'gap-4 mx-auto'" class="flex-1 mt-4 space-y-2">
            <a href="{{ route('home') }}" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-home"></i>
                <span x-show="open">Home</span>
            </a>

            <a href="{{ route('receivingFee') }}" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-briefcase"></i>
                <span x-show="open">Receiving Fee</span>
            </a>

            <a href="{{ route('employeeList') }}" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-comments"></i>
                <span x-show="open">Fee List</span>
            </a>
        </nav>

        <div class="p-2 border-t border-gray-500">
            <a href="{{ route('logout') }}" class="w-full flex items-center justify-center space-x-2 p-2 py-3 bg-gray-400 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-sign-out-alt"></i>
                <span x-show="open">Logout</span>
            </a>
        </div>
    </div>
</div>
