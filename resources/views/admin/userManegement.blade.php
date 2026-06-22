@include('admin.topbarAdmin')

<!-- Main Content Area -->
<div class="min-h-screen flex flex-col">
<!-- Page Content -->
<div class="pt-24 px-container-padding pb-10">
<!-- Page Header Area -->
<div class="flex items-end justify-between mb-8">
<div>
<h2 class="font-headline-xl text-headline-xl text-on-background mb-1">User Management</h2>
<p class="text-on-surface-variant font-body-md text-body-md">Manage team members, roles, and access permissions across the enterprise.</p>
</div>
<button class="bg-primary text-on-primary px-6 py-2.5 rounded-lg font-semibold flex items-center gap-2 hover:brightness-110 shadow-sm transition-all active:scale-95">
<span class="material-symbols-outlined">person_add</span>
                    Add New Member
                </button>
</div>
@if(session('success'))
    <div class="mb-4 p-4 bg-primary-container/20 text-primary-fixed border-l-4 border-primary rounded-r-lg">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mb-4 p-4 bg-error-container/20 text-error border-l-4 border-error rounded-r-lg">
        {{ session('error') }}
    </div>
@endif
<!-- Management Tools -->
<div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 p-4 mb-6 flex flex-wrap items-center justify-between gap-4">
<div class="flex items-center gap-3 flex-1 min-w-[300px]">
<div class="relative flex-1">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm">search</span>
<input class="w-full pl-9 pr-4 py-2 bg-surface border border-outline-variant/50 rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary transition-all" placeholder="Filter by name, email or department..." type="text"/>
</div>
<button class="flex items-center gap-2 px-4 py-2 border border-outline-variant/50 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface transition-all">
<span class="material-symbols-outlined text-[18px]">filter_list</span>
                        Filters
                    </button>
</div>
<div class="flex items-center gap-4">
<div class="flex items-center gap-2 px-3 py-1.5 bg-secondary-container/20 rounded-lg text-on-secondary-container font-label-md text-label-md">
<span class="w-2 h-2 rounded-full bg-primary-container"></span>
                        {{ $users->count() }} Total Users
                    </div>
<div class="flex items-center gap-2 px-3 py-1.5 bg-surface-container-highest/30 rounded-lg text-on-surface-variant font-label-md text-label-md">
<span class="w-2 h-2 rounded-full bg-outline"></span>
                        12 Pending
                    </div>
</div>
</div>
<!-- Main Data Table Container -->
<div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low/50 border-b border-outline-variant">
<th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Name</th>
<th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Role</th>
<th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Department</th>
<th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Status</th>
<th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/20">
@foreach($users as $user)
<tr class="group hover:bg-surface-container-lowest transition-colors duration-150">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full border-2 border-primary/10 overflow-hidden flex items-center justify-center bg-primary-container text-on-primary-container font-bold text-lg">
{{ strtoupper(substr($user->name, 0, 1)) }}
</div>
<div>
<div class="font-body-md text-body-md font-semibold text-on-background">{{ $user->name }}</div>
<div class="text-[12px] text-outline">{{ $user->email }}</div>
</div>
</div>
</td>
<td class="px-6 py-4">
<form action="{{ route('admin.users.role.update', $user->id) }}" method="POST" class="m-0">
    @csrf
    @method('PUT')
    <select name="role" onchange="this.form.submit()" class="bg-surface-container border border-outline-variant/50 text-secondary font-body-md text-sm rounded focus:ring-primary focus:border-primary block w-full p-1.5" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
        <option value="user" {{ ($user->role ?? 'user') === 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
    </select>
</form>
</td>
<td class="px-6 py-4">
<span class="px-2 py-1 bg-surface-container text-on-secondary-container rounded font-label-md text-[11px]">General</span>
</td>
<td class="px-6 py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-primary-container/10 text-primary font-label-md text-[12px]">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                    Active
                                </span>
</td>
<td class="px-6 py-4 text-right">
<div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-lg transition-all" title="Edit User">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-error hover:bg-error/5 rounded-lg transition-all" title="Delete User">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</div>
</td>
</tr>
@endforeach
</tbody>
</table>
<!-- Pagination Footer -->
<div class="px-6 py-4 bg-surface-container-low/30 border-t border-outline-variant flex items-center justify-between">
<span class="font-label-md text-label-md text-on-surface-variant">Showing all {{ $users->count() }} users</span>
<div class="flex items-center gap-2">
<button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-all disabled:opacity-30" disabled="">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-on-primary font-label-md text-label-md">1</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container-low font-label-md text-label-md text-on-surface-variant transition-all">2</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container-low font-label-md text-label-md text-on-surface-variant transition-all">3</button>
<span class="text-on-surface-variant">...</span>
<button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container-low font-label-md text-label-md text-on-surface-variant transition-all">26</button>
<button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-all">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
</div>
</div>
</div>
</div>
<script>
        // Simple micro-interaction for active scaling
        document.querySelectorAll('button').forEach(btn => {
            btn.addEventListener('mousedown', () => btn.classList.add('scale-95'));
            btn.addEventListener('mouseup', () => btn.classList.remove('scale-95'));
            btn.addEventListener('mouseleave', () => btn.classList.remove('scale-95'));
        });

        // Search highlight simulation
        const searchInput = document.querySelector('input[placeholder="Global search..."]');
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('ring-2', 'ring-primary-container/20');
        });
        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('ring-2', 'ring-primary-container/20');
        });
    </script>
</main>