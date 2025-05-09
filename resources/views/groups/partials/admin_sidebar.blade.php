<aside class="sidebar bg-white shadow h-full w-64 flex flex-col">
    <div class="p-6 border-b">
        <h3 class="text-lg font-bold text-slate-800">Group Admin</h3>
    </div>
    <ul class="flex-1 p-6 space-y-2">
        <li>
            <a href="#" class="block px-4 py-2 rounded hover:bg-slate-100 text-slate-700">Overview</a>
        </li>
        <li>
            <a href="#" class="block px-4 py-2 rounded hover:bg-slate-100 text-slate-700">Members</a>
        </li>
        <li>
            <a href="#" class="block px-4 py-2 rounded hover:bg-slate-100 text-slate-700">Payments</a>
        </li>
        <li>
            <a href="#" class="block px-4 py-2 rounded hover:bg-slate-100 text-slate-700">Settings</a>
        </li>
        <li>
            <a href="{{ route('chat.index', ['groupId' => $groupId]) }}" class="block px-4 py-2 rounded bg-blue-100 text-blue-700 font-semibold">Chat</a>
        </li>
    </ul>
    <form action="{{ route('dashboard') }}" method="get" class="p-6 border-t">
        <button type="submit" class="w-full px-4 py-2 rounded bg-red-100 text-red-700 hover:bg-red-200">Exit</button>
    </form>
</aside>
