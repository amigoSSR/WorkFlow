@include ('user.topbaruser')

<style>
    /* Modal Animations */
    .modal-overlay { animation: fadeIn 0.2s ease; }
    .modal-box { animation: slideUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(30px) scale(0.96); } to { opacity: 1; transform: translateY(0) scale(1); } }
</style>

<div class="p-container-padding max-w-7xl mx-auto">

    <!-- Header Section -->
    <div class="mb-8">
        <a href="{{ route('user.diaryuser') }}" class="text-primary text-label-md font-bold hover:underline mb-2 inline-block">
            &larr; Kembali ke List Project
        </a>
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mt-2">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h2 class="font-headline-xl text-headline-xl text-on-surface">{{ $project->name }}</h2>
                    <span class="px-3 py-1 rounded-full bg-{{ $project->status == 'Active' ? 'primary/10' : 'outline-variant' }} text-{{ $project->status == 'Active' ? 'primary' : 'on-surface-variant' }} text-xs font-bold uppercase tracking-wider border border-{{ $project->status == 'Active' ? 'primary/20' : 'outline-variant' }}">{{ $project->status }}</span>
                </div>
                <p class="text-on-surface-variant font-body-lg text-body-lg max-w-2xl">{{ $project->description }}</p>
            </div>
            
            <div class="bg-surface-container-low rounded-xl p-4 flex flex-col min-w-[200px]">
                <span class="text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Role Anda</span>
                @if($role == 'Owner')
                    <span class="font-bold text-tertiary">👑 Mentor (Owner)</span>
                @else
                    <span class="font-bold text-secondary">👥 Menti (Member)</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded-lg flex items-center gap-2 mb-6">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 text-red-800 p-4 rounded-lg flex items-center gap-2 mb-6">
        <span class="material-symbols-outlined">error</span>
        {{ session('error') }}
    </div>
    @endif
    @if($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Content Split -->
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- ROADMAPS COLUMN -->
        <div class="flex-1 space-y-6">
            <div class="flex items-center justify-between border-b border-outline-variant pb-2">
                <h3 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">map</span> Roadmaps
                </h3>
                
                @if($role == 'Owner')
                <button onclick="openRoadmapModal()" class="text-primary text-label-md font-bold flex items-center gap-1 hover:bg-primary/10 px-3 py-1.5 rounded-lg transition-colors">
                    <span class="material-symbols-outlined text-[18px]">add</span> Tambah Roadmap
                </button>
                @endif
            </div>

            @forelse($roadmaps as $roadmap)
            <div class="bg-white rounded-xl shadow-sm border border-outline-variant/50 overflow-hidden">
                <div class="p-5 bg-surface-container-lowest border-b border-outline-variant/50">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-headline-sm text-headline-sm text-on-surface mb-1">{{ $roadmap->title }}</h4>
                            @if($roadmap->description)
                            <p class="text-body-md text-on-surface-variant">{{ $roadmap->description }}</p>
                            @endif
                        </div>
                        <span class="text-[11px] text-outline">Oleh: {{ $roadmap->creator->name }}</span>
                    </div>
                </div>
                
                <div class="p-5 bg-surface-container-lowest">
                    <div class="flex items-center justify-between mb-4">
                        <h5 class="text-label-md font-bold text-on-surface-variant uppercase tracking-wider">Milestones</h5>
                        <button onclick="openMilestoneModal({{ $roadmap->id }})" class="text-secondary text-label-md font-bold flex items-center gap-1 hover:bg-secondary/10 px-2 py-1 rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-[16px]">add</span> Milestone Baru
                        </button>
                    </div>

                    <div class="space-y-3">
                        @forelse($roadmap->milestones as $ms)
                        <div class="flex items-center justify-between p-3 rounded-lg border border-outline-variant hover:bg-surface-bright transition-colors">
                            <div class="flex items-center gap-3">
                                @if($ms->status == 'Done')
                                    <span class="material-symbols-outlined text-green-600">check_circle</span>
                                @elseif($ms->status == 'In Progress')
                                    <span class="material-symbols-outlined text-orange-500">pending</span>
                                @else
                                    <span class="material-symbols-outlined text-outline">radio_button_unchecked</span>
                                @endif
                                <div>
                                    <p class="font-semibold text-body-md text-on-surface">{{ $ms->title }}</p>
                                    <p class="text-[11px] text-outline mt-0.5">
                                        Added by: {{ $ms->creator->name }} 
                                        @if($ms->due_date) | Due: {{ \Carbon\Carbon::parse($ms->due_date)->format('d M Y') }} @endif
                                    </p>
                                </div>
                            </div>
                            <span class="px-2 py-1 text-[10px] font-bold uppercase rounded border 
                                {{ $ms->status == 'Done' ? 'border-green-200 text-green-700 bg-green-50' : 
                                  ($ms->status == 'In Progress' ? 'border-orange-200 text-orange-700 bg-orange-50' : 'border-gray-200 text-gray-600 bg-gray-50') }}">
                                {{ $ms->status }}
                            </span>
                        </div>
                        @empty
                        <p class="text-body-md text-outline italic text-center py-2">Belum ada milestone di roadmap ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-10 bg-surface-container-low rounded-xl border border-dashed border-outline-variant">
                <span class="material-symbols-outlined text-[48px] text-outline opacity-50 mb-2">route</span>
                <p class="text-on-surface-variant font-body-md mb-2">Belum ada Roadmap yang dibuat.</p>
                @if($role == 'Owner')
                <p class="text-label-md text-outline">Gunakan tombol 'Tambah Roadmap' untuk memulai.</p>
                @else
                <p class="text-label-md text-outline">Tunggu Mentor Anda membuat Roadmap.</p>
                @endif
            </div>
            @endforelse
        </div>

        <!-- SHARED RESOURCES / LINK FILES COLUMN -->
        <div class="lg:w-1/3 space-y-6">
            <div class="flex items-center justify-between border-b border-outline-variant pb-2">
                <h3 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">link</span> Shared Resources
                </h3>
                <button onclick="openLinkModal()" class="text-secondary text-label-md font-bold flex items-center gap-1 hover:bg-secondary/10 px-2 py-1.5 rounded-lg transition-colors" title="Bagikan Link / File">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                </button>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-outline-variant/50 p-4 space-y-3">
                @forelse($projectLinks as $link)
                <div class="p-3 rounded-lg border border-outline-variant hover:bg-surface-bright transition-colors">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-1">
                            <p class="font-semibold text-body-md text-on-surface line-clamp-2">{{ $link->title }}</p>
                            <p class="text-[11px] text-outline mt-1">Dibagikan oleh: <span class="font-bold">{{ $link->creator->name }}</span></p>
                        </div>
                        <a href="{{ $link->url }}" target="_blank" class="w-8 h-8 rounded-full bg-secondary/10 text-secondary flex items-center justify-center hover:bg-secondary hover:text-white transition-colors flex-shrink-0" title="Buka Link">
                            <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="text-center py-6">
                    <span class="material-symbols-outlined text-[32px] text-outline opacity-50 mb-2">link_off</span>
                    <p class="text-body-md text-outline italic">Belum ada link/file yang dibagikan.</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<!-- ================================ -->
<!-- MODALS                           -->
<!-- ================================ -->

<!-- Add Roadmap Modal -->
<div id="roadmap-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="modal-overlay absolute inset-0 bg-on-background/50 backdrop-blur-sm" onclick="closeRoadmapModal()"></div>
    <div class="modal-box relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 z-10">
        <h3 class="font-headline-md text-headline-md text-on-background mb-4">Tambah Roadmap Baru</h3>
        <form method="POST" action="{{ route('user.diaryuser.roadmap.store', $project->id) }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="text-label-md font-bold text-on-surface block mb-1">Judul Roadmap</label>
                    <input name="title" type="text" required class="w-full px-3 py-2 border border-outline-variant rounded-lg" placeholder="Contoh: Phase 1 - UI Design">
                </div>
                <div>
                    <label class="text-label-md font-bold text-on-surface block mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="3" class="w-full px-3 py-2 border border-outline-variant rounded-lg resize-none" placeholder="Tujuan dari roadmap ini..."></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeRoadmapModal()" class="px-4 py-2 text-on-surface-variant font-semibold">Batal</button>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg font-semibold">Simpan Roadmap</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Milestone Modal -->
<div id="milestone-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="modal-overlay absolute inset-0 bg-on-background/50 backdrop-blur-sm" onclick="closeMilestoneModal()"></div>
    <div class="modal-box relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 z-10">
        <h3 class="font-headline-md text-headline-md text-on-background mb-4">Tambah Milestone</h3>
        <form method="POST" action="{{ route('user.diaryuser.milestone.store', $project->id) }}">
            @csrf
            <input type="hidden" name="roadmap_id" id="ms-roadmap-id" value="">
            
            <div class="space-y-4">
                <div>
                    <label class="text-label-md font-bold text-on-surface block mb-1">Judul Milestone</label>
                    <input name="title" type="text" required class="w-full px-3 py-2 border border-outline-variant rounded-lg" placeholder="Contoh: Selesaikan Wireframe">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-label-md font-bold text-on-surface block mb-1">Status</label>
                        <select name="status" class="w-full px-3 py-2 border border-outline-variant rounded-lg">
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-label-md font-bold text-on-surface block mb-1">Due Date</label>
                        <input name="due_date" type="date" class="w-full px-3 py-2 border border-outline-variant rounded-lg">
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeMilestoneModal()" class="px-4 py-2 text-on-surface-variant font-semibold">Batal</button>
                <button type="submit" class="px-4 py-2 bg-secondary text-white rounded-lg font-semibold">Simpan Milestone</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Link Modal -->
<div id="link-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="modal-overlay absolute inset-0 bg-on-background/50 backdrop-blur-sm" onclick="closeLinkModal()"></div>
    <div class="modal-box relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 z-10">
        <h3 class="font-headline-md text-headline-md text-on-background mb-4">Bagikan Link / File</h3>
        <form method="POST" action="{{ route('user.diaryuser.link.store', $project->id) }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="text-label-md font-bold text-on-surface block mb-1">Judul Link / Nama Dokumen</label>
                    <input name="title" type="text" required class="w-full px-3 py-2 border border-outline-variant rounded-lg" placeholder="Contoh: Dokumen Requirement V1">
                </div>
                <div>
                    <label class="text-label-md font-bold text-on-surface block mb-1">URL (Link)</label>
                    <input name="url" type="url" required class="w-full px-3 py-2 border border-outline-variant rounded-lg" placeholder="https://docs.google.com/...">
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeLinkModal()" class="px-4 py-2 text-on-surface-variant font-semibold">Batal</button>
                <button type="submit" class="px-4 py-2 bg-secondary text-white rounded-lg font-semibold">Bagikan Link</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRoadmapModal() {
        document.getElementById('roadmap-modal').classList.remove('hidden');
    }
    function closeRoadmapModal() {
        document.getElementById('roadmap-modal').classList.add('hidden');
    }

    function openMilestoneModal(roadmapId) {
        document.getElementById('ms-roadmap-id').value = roadmapId;
        document.getElementById('milestone-modal').classList.remove('hidden');
    }
    function closeMilestoneModal() {
        document.getElementById('milestone-modal').classList.add('hidden');
    }

    function openLinkModal() {
        document.getElementById('link-modal').classList.remove('hidden');
    }
    function closeLinkModal() {
        document.getElementById('link-modal').classList.add('hidden');
    }
</script>

</body>
</html>
