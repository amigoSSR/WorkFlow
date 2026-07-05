@include('admin.topbarAdmin')
<!-- Main Content Canvas -->
<div class="relative" x-data="houseRules()">
    <!-- Content Header -->
    <section class="bg-white border-b border-outline-variant px-container-padding py-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <h2 class="font-headline-lg text-headline-lg text-on-surface font-bold">House Rules</h2>
            <button @click="openCreateModal()" class="px-5 py-2.5 bg-primary text-white font-semibold rounded-lg hover:brightness-110 transition-all shadow-sm flex items-center gap-2 active:scale-95">
                <span class="material-symbols-outlined text-lg">add</span>
                Add Rule
            </button>
        </div>
    </section>

    <!-- Document Content -->
    <div class="px-container-padding py-12">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-6 md:gap-12">
            
            <!-- Table of Contents Sticky -->
            <aside class="w-full md:w-48 flex-shrink-0 hidden md:block" role="navigation" aria-label="Table of contents">
                <div class="sticky top-28 space-y-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-outline">Contents</p>
                    <ul class="space-y-4" id="toc-list">
                        @foreach($houseRules as $rule)
                            <li>
                                <a class="toc-link text-sm font-medium text-on-surface-variant hover:text-primary flex items-center gap-2" href="#rule-{{ $rule->id }}" data-target="rule-{{ $rule->id }}">
                                    {{ $rule->judul_rule }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Policy Sections -->
            <div class="md:hidden mb-6 px-2">
                <label for="mobile-toc" class="sr-only">Pilih bagian</label>
                <select id="mobile-toc" class="w-full p-3 rounded-lg border border-outline-variant bg-white" onchange="window.location.hash = this.value">
                    @foreach($houseRules as $rule)
                        <option value="rule-{{ $rule->id }}">{{ $rule->judul_rule }}</option>
                    @endforeach
                </select>
            </div>

            <article class="flex-1 min-w-0 space-y-16 pb-24">
                @forelse($houseRules as $rule)
                <section class="section-anchor relative group" id="rule-{{ $rule->id }}">
                    <!-- Admin Actions Overlay -->
                    <div class="absolute top-0 right-0 opacity-0 group-hover:opacity-100 transition-opacity flex gap-2">
                        <button @click="openEditModal({{ $rule }})" class="p-2 bg-surface-container rounded-lg text-primary hover:bg-primary-container transition-colors">
                            <span class="material-symbols-outlined text-sm">edit</span>
                        </button>
                        <button @click="openDeleteModal({{ $rule->id }})" class="p-2 bg-surface-container rounded-lg text-error hover:bg-error-container transition-colors">
                            <span class="material-symbols-outlined text-sm">delete</span>
                        </button>
                    </div>

                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-surface-container-high flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'opsz' 40;">gavel</span>
                        </div>
                        <div>
                            <h3 class="font-headline-lg text-headline-lg text-on-surface">{{ $rule->judul_rule }}</h3>
                            <p class="text-xs text-on-surface-variant mt-1">Kategori: {{ $rule->kategori }} | Ditambahkan oleh: {{ $rule->creator->name ?? 'Admin' }}</p>
                            @if(!$rule->is_active)
                            <span class="inline-block px-2 py-1 mt-2 text-[10px] font-bold bg-error-container text-on-error-container rounded-full">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-outline-variant/30 space-y-6 prose max-w-none text-on-surface">
                        {!! nl2br(e($rule->deskripsi_rule)) !!}
                    </div>
                </section>
                @empty
                <div class="text-center py-20 bg-surface-container-low rounded-2xl border border-dashed border-outline">
                    <span class="material-symbols-outlined text-4xl text-outline mb-4">gavel</span>
                    <h3 class="text-on-surface font-semibold mb-2">Belum Ada House Rule</h3>
                    <p class="text-on-surface-variant text-sm mb-6">Silahkan tambahkan aturan baru untuk mengatur pedoman di perusahaan.</p>
                    <button @click="openCreateModal()" class="px-6 py-2 bg-primary text-white font-semibold rounded-lg hover:brightness-110">
                        Tambah Aturan
                    </button>
                </div>
                @endforelse
                
                <!-- Feedback Callout -->
            </article>
        </div>
    </div>

    <!-- Modals -->
    <!-- Create / Edit Modal -->
    <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4">
        <div @click.away="closeModal()" class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center">
                <h3 class="font-headline-sm text-on-surface" x-text="isEdit ? 'Edit House Rule' : 'Tambah House Rule'"></h3>
                <button @click="closeModal()" class="text-on-surface-variant hover:text-error transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-6 overflow-y-auto flex-1">
                <form :action="isEdit ? `/admin/house-rules/${currentRule.id}` : '{{ route('admin.house.rules.store') }}'" method="POST" id="ruleForm">
                    @csrf
                    <template x-if="isEdit">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-on-surface mb-1">Judul Aturan</label>
                            <input type="text" name="judul_rule" x-model="currentRule.judul_rule" required class="w-full p-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-on-surface mb-1">Kategori</label>
                            <input type="text" name="kategori" x-model="currentRule.kategori" required class="w-full p-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-on-surface mb-1">Deskripsi / Detail Aturan</label>
                            <textarea name="deskripsi_rule" x-model="currentRule.deskripsi_rule" required rows="6" class="w-full p-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none"></textarea>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_active" id="is_active" x-model="currentRule.is_active" value="1" class="w-5 h-5 text-primary border-outline-variant rounded focus:ring-primary">
                            <label for="is_active" class="text-sm text-on-surface font-medium">Aktifkan aturan ini</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="px-6 py-4 border-t border-outline-variant bg-surface-container-lowest flex justify-end gap-3">
                <button @click="closeModal()" class="px-6 py-2 border border-outline text-on-surface font-semibold rounded-lg hover:bg-surface-container-low transition-all">Batal</button>
                <button type="submit" form="ruleForm" class="px-6 py-2 bg-primary text-white font-semibold rounded-lg hover:brightness-110 transition-all shadow-sm">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div x-show="isDeleteModalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4">
        <div @click.away="closeDeleteModal()" class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
            <div class="p-6 text-center space-y-4">
                <div class="w-16 h-16 bg-error-container text-error rounded-full flex items-center justify-center mx-auto">
                    <span class="material-symbols-outlined text-3xl">warning</span>
                </div>
                <h3 class="font-headline-sm text-on-surface">Hapus Aturan?</h3>
                <p class="text-body-md text-on-surface-variant">Tindakan ini tidak dapat dibatalkan. Aturan akan dihapus secara permanen.</p>
                <form :action="`/admin/house-rules/${deleteId}`" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            <div class="px-6 py-4 border-t border-outline-variant bg-surface-container-lowest flex justify-center gap-3">
                <button @click="closeDeleteModal()" class="px-6 py-2 border border-outline text-on-surface font-semibold rounded-lg hover:bg-surface-container-low transition-all">Batal</button>
                <button type="submit" form="deleteForm" class="px-6 py-2 bg-error text-white font-semibold rounded-lg hover:brightness-110 transition-all shadow-sm">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function houseRules() {
        return {
            isModalOpen: false,
            isDeleteModalOpen: false,
            isEdit: false,
            deleteId: null,
            currentRule: {
                id: null,
                judul_rule: '',
                kategori: '',
                deskripsi_rule: '',
                is_active: true
            },
            openCreateModal() {
                this.isEdit = false;
                this.currentRule = { id: null, judul_rule: '', kategori: '', deskripsi_rule: '', is_active: true };
                this.isModalOpen = true;
            },
            openEditModal(rule) {
                this.isEdit = true;
                this.currentRule = { ...rule };
                this.isModalOpen = true;
            },
            closeModal() {
                this.isModalOpen = false;
            },
            openDeleteModal(id) {
                this.deleteId = id;
                this.isDeleteModalOpen = true;
            },
            closeDeleteModal() {
                this.isDeleteModalOpen = false;
            }
        }
    }
</script>
</body></html>