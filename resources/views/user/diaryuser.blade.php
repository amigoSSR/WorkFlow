@include ('user.topbaruser')

<!-- Page Content -->
<div class="p-container-padding max-w-7xl mx-auto">
    <!-- Header Section with CTA -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="font-headline-xl text-headline-xl text-on-surface">My Project Diaries</h2>
            <p class="text-on-surface-variant font-body-lg text-body-lg">Pilih project untuk melihat dan mengelola Roadmap serta Milestone.</p>
        </div>
        <a class="bg-primary text-on-primary px-6 py-3 rounded-lg font-semibold flex items-center justify-center gap-2 shadow-lg shadow-primary/20 hover:bg-surface-tint transition-all active:scale-95 text-center" href="{{ route('user.joinproject') }}">
            <span class="material-symbols-outlined">search</span>
            Cari Project Baru
        </a>
    </div>

    {{-- BARU - pakai Tailwind grid native --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-white p-6 rounded-xl custom-shadow border-l-4 border-primary">
        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider mb-2">Total Project Joined</p>
        <div class="flex items-end justify-between">
            <span class="text-headline-xl font-headline-xl text-on-surface">{{ $projects->count() }}</span>
            <span class="text-primary flex items-center text-sm font-semibold mb-1">
                <span class="material-symbols-outlined text-sm">folder</span>
            </span>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl custom-shadow border-l-4 border-tertiary">
        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider mb-2">Total Submissions</p>
        <div class="flex items-end justify-between">
            <span class="text-headline-xl font-headline-xl text-on-surface">{{ $totalSubmissions }}</span>
            <span class="text-tertiary flex items-center text-sm font-semibold mb-1">
                Roadmaps & Milestones
            </span>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl custom-shadow border-l-4 border-secondary">
        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider mb-2">Pending Milestones</p>
        <div class="flex items-end justify-between">
            <span class="text-headline-xl font-headline-xl text-on-surface">{{ $pendingReview }}</span>
            <span class="text-secondary flex items-center text-sm font-semibold mb-1">
                To Do
            </span>
        </div>
    </div>
</div>

    <!-- Main Diary List Card -->
    <div class="bg-white rounded-xl custom-shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-outline-variant flex items-center justify-between bg-surface-container-lowest">
            <h3 class="font-headline-md text-headline-md text-on-surface">Your Projects</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Project Name</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Kapasitas</th>
                        <th class="px-6 py-4">Role Anda</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($projects as $project)
                    <tr class="hover:bg-surface-bright transition-colors duration-150 cursor-pointer group" onclick="window.location='{{ route('user.diaryuser.show', $project->id) }}'">
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="font-semibold text-on-surface font-body-lg text-body-lg">{{ $project->name }}</span>
                                <span class="text-label-md text-on-surface-variant">{{ $project->category }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-3 py-1 rounded-full bg-{{ $project->status == 'Active' ? 'primary/10' : 'outline-variant' }} text-{{ $project->status == 'Active' ? 'primary' : 'on-surface-variant' }} text-xs font-bold uppercase tracking-wider border border-{{ $project->status == 'Active' ? 'primary/20' : 'outline-variant' }}">{{ $project->status }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <span class="font-body-md text-body-md text-on-surface">{{ $project->users_count }} / {{ $project->max_members }} Member</span>
                        </td>
                        <td class="px-6 py-5">
                            @if($project->pivot->role == 'Owner')
                                <span class="px-3 py-1 rounded-full bg-tertiary-fixed-dim/20 text-tertiary-fixed-variant text-xs font-bold uppercase tracking-wider">Mentor (Owner)</span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-secondary-fixed-dim/20 text-secondary-fixed-variant text-xs font-bold uppercase tracking-wider">Menti (Member)</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right">
                            <a href="{{ route('user.diaryuser.show', $project->id) }}" class="text-primary hover:text-primary-container transition-colors font-bold text-label-md">
                                Buka Diary <span class="material-symbols-outlined align-middle text-sm">arrow_forward</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-[48px] mb-2 opacity-50">folder_off</span>
                            <p>Anda belum bergabung dengan project apapun.</p>
                            <a href="{{ route('user.joinproject') }}" class="text-primary mt-2 inline-block">Cari Project Sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
