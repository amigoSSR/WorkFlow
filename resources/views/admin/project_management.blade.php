@include('admin.topbarAdmin')

<!-- Main Content Area -->
<div class="min-h-screen flex flex-col">
<div class="pt-24 px-container-padding pb-10">

    <!-- Page Header -->
    <div class="flex items-end justify-between mb-8">
        <div>
            <h2 class="font-headline-xl text-headline-xl text-on-background mb-1">Project Monitoring</h2>
            <p class="text-on-surface-variant font-body-md text-body-md">Monitor all projects, members, and progress across the organization.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-primary-container/20 text-primary-fixed border-l-4 border-primary rounded-r-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-outline-variant/30 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-primary">folder_open</span>
            </div>
            <div>
                <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider mb-1">Total Projects</p>
                <p class="text-headline-xl font-headline-xl text-on-background">{{ $totalProjects }}</p>
            </div>
        </div>
        <!-- Active -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-outline-variant/30 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-primary-container/30 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-primary">play_circle</span>
            </div>
            <div>
                <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider mb-1">Active</p>
                <p class="text-headline-xl font-headline-xl text-on-background">{{ $activeProjects }}</p>
            </div>
        </div>
        <!-- Draft -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-outline-variant/30 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-secondary/10 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-secondary">draft</span>
            </div>
            <div>
                <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider mb-1">Draft</p>
                <p class="text-headline-xl font-headline-xl text-on-background">{{ $draftProjects }}</p>
            </div>
        </div>
        <!-- Completed -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-outline-variant/30 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-tertiary/10 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-tertiary">check_circle</span>
            </div>
            <div>
                <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider mb-1">Completed</p>
                <p class="text-headline-xl font-headline-xl text-on-background">{{ $completedProjects }}</p>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 p-4 mb-6 flex flex-wrap items-center gap-4">
        <div class="relative flex-1 min-w-[240px]">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm">search</span>
            <input id="projectSearch" type="text" placeholder="Search by project name, category, or creator..." class="w-full pl-9 pr-4 py-2 bg-surface border border-outline-variant/50 rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary transition-all" />
        </div>
        <div class="flex items-center gap-2">
            <label class="text-label-md font-label-md text-on-surface-variant">Status:</label>
            <select id="statusFilter" class="bg-surface border border-outline-variant/50 text-on-surface font-body-md text-sm rounded-lg px-3 py-2 focus:outline-none focus:border-primary">
                <option value="">All</option>
                <option value="Draft">Draft</option>
                <option value="Active">Active</option>
                <option value="Completed">Completed</option>
                <option value="On Hold">On Hold</option>
            </select>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="bg-white rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
        <table class="w-full text-left border-collapse" id="projectsTable">
            <thead>
                <tr class="bg-surface-container-low/50 border-b border-outline-variant">
                    <th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Project</th>
                    <th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Category</th>
                    <th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Creator</th>
                    <th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Members</th>
                    <th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Deadline</th>
                    <th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider text-center">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20" id="projectsTbody">
                @forelse($projects as $project)
                <tr class="group hover:bg-surface-container-lowest transition-colors duration-150 project-row"
                    data-name="{{ strtolower($project->name) }}"
                    data-category="{{ strtolower($project->category) }}"
                    data-creator="{{ strtolower($project->creator?->name ?? '') }}"
                    data-status="{{ $project->status }}">
                    <!-- Project Name & ID -->
                    <td class="px-6 py-4">
                        <div>
                            <div class="font-body-md text-body-md font-semibold text-on-background">{{ $project->name }}</div>
                            <div class="text-[12px] text-outline">{{ $project->project_id }}</div>
                        </div>
                    </td>
                    <!-- Category -->
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-surface-container text-on-secondary-container rounded font-label-md text-[11px]">{{ $project->category }}</span>
                    </td>
                    <!-- Creator -->
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-xs flex-shrink-0">
                                {{ strtoupper(substr($project->creator?->name ?? '?', 0, 1)) }}
                            </div>
                            <span class="text-body-md font-body-md text-on-background">{{ $project->creator?->name ?? 'N/A' }}</span>
                        </div>
                    </td>
                    <!-- Members -->
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="flex -space-x-2">
                                @foreach($project->users->take(4) as $member)
                                    <div class="w-7 h-7 rounded-full bg-secondary/30 text-secondary border-2 border-white flex items-center justify-center font-bold text-xs" title="{{ $member->name }}">
                                        {{ strtoupper(substr($member->name, 0, 1)) }}
                                    </div>
                                @endforeach
                                @if($project->users_count > 4)
                                    <div class="w-7 h-7 rounded-full bg-outline/20 text-on-surface-variant border-2 border-white flex items-center justify-center font-bold text-[10px]">
                                        +{{ $project->users_count - 4 }}
                                    </div>
                                @endif
                            </div>
                            <span class="text-[12px] text-outline">{{ $project->users_count }} / {{ $project->max_members }}</span>
                        </div>
                    </td>
                    <!-- Status -->
                    <td class="px-6 py-4">
                        @php
                            $statusStyles = [
                                'Active'    => 'bg-primary-container/20 text-primary',
                                'Draft'     => 'bg-secondary/10 text-secondary',
                                'Completed' => 'bg-tertiary/10 text-tertiary',
                                'On Hold'   => 'bg-error/10 text-error',
                            ];
                            $dotStyles = [
                                'Active'    => 'bg-primary',
                                'Draft'     => 'bg-secondary',
                                'Completed' => 'bg-tertiary',
                                'On Hold'   => 'bg-error',
                            ];
                            $style = $statusStyles[$project->status] ?? 'bg-outline/10 text-outline';
                            $dot   = $dotStyles[$project->status]   ?? 'bg-outline';
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-label-md text-[12px] {{ $style }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $dot }}"></span>
                            {{ $project->status }}
                        </span>
                    </td>
                    <!-- Deadline -->
                    <td class="px-6 py-4">
                        @if($project->deadline)
                            @php
                                $isOverdue = \Carbon\Carbon::parse($project->deadline)->isPast() && $project->status !== 'Completed';
                            @endphp
                            <span class="font-body-md text-body-md {{ $isOverdue ? 'text-error font-semibold' : 'text-on-background' }}">
                                {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}
                                @if($isOverdue) <span class="text-[10px] ml-1">(Overdue)</span> @endif
                            </span>
                        @else
                            <span class="text-outline">—</span>
                        @endif
                    </td>
                    <!-- Detail button -->
                    <td class="px-6 py-4 text-center">
                        <button onclick="showProjectDetail({{ $project->id }})" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary/5 text-primary hover:bg-primary/15 font-label-md text-label-md transition-all">
                            <span class="material-symbols-outlined text-[16px]">visibility</span>
                            View
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <span class="material-symbols-outlined text-5xl text-outline/40">folder_off</span>
                            <p class="text-on-surface-variant font-body-md">No projects found.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Footer count -->
        <div class="px-6 py-4 bg-surface-container-low/30 border-t border-outline-variant flex items-center justify-between">
            <span id="tableCount" class="font-label-md text-label-md text-on-surface-variant">Showing all {{ $totalProjects }} projects</span>
        </div>
    </div>
</div>
</div>

<!-- Project Detail Modal -->
<div id="projectDetailModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4" style="background:rgba(0,0,0,0.45);">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[92vh] flex flex-col">
        <!-- Modal Header -->
        <div class="bg-white border-b border-outline-variant px-6 py-4 flex items-center justify-between rounded-t-2xl flex-shrink-0">
            <div>
                <h3 class="font-headline-md text-headline-md text-on-background" id="modalProjectName">Project Detail</h3>
                <p class="text-xs text-outline mt-0.5" id="modalProjectId"></p>
            </div>
            <button onclick="closeProjectDetail()" class="p-2 rounded-full hover:bg-surface-container-low transition-all text-on-surface-variant">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <!-- Tabs -->
        <div class="flex border-b border-outline-variant flex-shrink-0 bg-white px-6">
            <button onclick="switchTab('overview')" id="tab-overview"
                class="modal-tab px-4 py-3 text-sm font-semibold border-b-2 transition-all -mb-px">
                <span class="material-symbols-outlined text-[16px] align-middle mr-1">info</span>Overview
            </button>
            <button onclick="switchTab('roadmap')" id="tab-roadmap"
                class="modal-tab px-4 py-3 text-sm font-semibold border-b-2 transition-all -mb-px">
                <span class="material-symbols-outlined text-[16px] align-middle mr-1">map</span>Roadmap
            </button>
            <button onclick="switchTab('milestones')" id="tab-milestones"
                class="modal-tab px-4 py-3 text-sm font-semibold border-b-2 transition-all -mb-px">
                <span class="material-symbols-outlined text-[16px] align-middle mr-1">flag</span>Milestones
            </button>
            <button onclick="switchTab('links')" id="tab-links"
                class="modal-tab px-4 py-3 text-sm font-semibold border-b-2 transition-all -mb-px">
                <span class="material-symbols-outlined text-[16px] align-middle mr-1">link</span>Links
            </button>
        </div>

        <!-- Modal Body -->
        <div class="overflow-y-auto flex-1 p-6">

            <!-- Overview Tab -->
            <div id="panel-overview" class="tab-panel space-y-5">
                <div class="flex flex-wrap gap-2 items-center" id="modal-badges"></div>

                <div>
                    <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider mb-1">Description</p>
                    <p class="text-body-md font-body-md text-on-background" id="modal-description">—</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider mb-1">Creator</p>
                        <p class="text-body-md font-body-md text-on-background font-semibold" id="modal-creator"></p>
                        <p class="text-xs text-outline" id="modal-creator-email"></p>
                    </div>
                    <div>
                        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider mb-1">Deadline</p>
                        <p class="text-body-md font-body-md text-on-background font-semibold" id="modal-deadline"></p>
                    </div>
                    <div>
                        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider mb-1">Members</p>
                        <p class="text-body-md font-body-md text-on-background font-semibold" id="modal-members-count"></p>
                    </div>
                </div>

                <div>
                    <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider mb-3" id="modal-members-label">Members</p>
                    <div class="bg-surface rounded-xl border border-outline-variant/30 px-4 py-2 max-h-52 overflow-y-auto" id="modal-members-list"></div>
                </div>
            </div>

            <!-- Roadmap Tab -->
            <div id="panel-roadmap" class="tab-panel hidden space-y-4">
                <p class="text-xs text-on-surface-variant mb-3">Roadmap berisi tahapan utama proyek beserta milestone-nya.</p>
                <div id="roadmap-list"></div>
            </div>

            <!-- Milestones Tab -->
            <div id="panel-milestones" class="tab-panel hidden">
                <p class="text-xs text-on-surface-variant mb-4">Semua milestone yang ada di proyek ini.</p>
                <div id="milestones-list" class="space-y-2"></div>
            </div>

            <!-- Links Tab -->
            <div id="panel-links" class="tab-panel hidden">
                <p class="text-xs text-on-surface-variant mb-4">Link referensi dan resource yang terkait dengan proyek.</p>
                <div id="links-list" class="space-y-3"></div>
            </div>

        </div>
    </div>
</div>

<style>
.modal-tab { color: #6b7280; border-color: transparent; }
.modal-tab.active { color: var(--md-sys-color-primary, #6750a4); border-color: var(--md-sys-color-primary, #6750a4); }
.modal-tab:hover:not(.active) { background: #f3f4f6; }
</style>

@php
    // Encode all project data for JS modal use
    $projectsJson = $projects->map(function($p) {
        return [
            'id'          => $p->id,
            'project_id'  => $p->project_id,
            'name'        => $p->name,
            'description' => $p->description,
            'category'    => $p->category,
            'status'      => $p->status,
            'deadline'    => $p->deadline ? \Carbon\Carbon::parse($p->deadline)->format('d M Y') : null,
            'max_members' => $p->max_members,
            'reference_links' => $p->reference_links,
            'creator'     => $p->creator?->name ?? 'N/A',
            'creator_email' => $p->creator?->email ?? '',
            'users_count' => $p->users_count,
            'users'       => $p->users->map(fn($u) => ['name' => $u->name, 'email' => $u->email, 'role' => $u->pivot->role]),
            'roadmaps'    => $p->roadmaps->map(fn($r) => [
                'id'          => $r->id,
                'title'       => $r->title,
                'description' => $r->description,
                'milestones'  => $r->milestones->map(fn($m) => [
                    'title'    => $m->title,
                    'status'   => $m->status,
                    'due_date' => $m->due_date ? \Carbon\Carbon::parse($m->due_date)->format('d M Y') : null,
                ]),
            ]),
            'milestones'  => $p->milestones->map(fn($m) => [
                'title'    => $m->title,
                'status'   => $m->status,
                'due_date' => $m->due_date ? \Carbon\Carbon::parse($m->due_date)->format('d M Y') : null,
            ]),
            'links'       => $p->projectLinks->map(fn($l) => [
                'title' => $l->title,
                'url'   => $l->url,
            ]),
        ];
    });
@endphp

{{-- Inject PHP data so the external JS can access it --}}
<script>
    window.projectsData = @json($projectsJson);
</script>

{{-- All modal / filter / tab logic lives in a separate, maintainable JS file --}}
<script src="{{ asset('js/project_management.js') }}"></script>
