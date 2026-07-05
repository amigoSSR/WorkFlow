@include('admin.topbarAdmin')

<main class="min-h-screen">
    <div class="pt-10 px-container-padding pb-10">
        
        @if(session('success'))
            <div class="bg-primary/10 border-l-4 border-primary text-primary p-4 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-error/10 border-l-4 border-error text-error p-4 mb-6 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex items-end justify-between mb-8">
            <div>
                <h2 class="font-headline-xl text-headline-xl text-on-background mb-1">Weekly Check-up Report</h2>
                <p class="text-on-surface-variant font-body-md text-body-md">Monitor and generate weekly progress reports for all users and projects.</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="col-span-1 space-y-6">
                <!-- Info Card -->
                <div class="bg-white rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] p-6 border-t-4 border-primary">
                    <h3 class="font-headline-md text-headline-md mb-4">Generate Master Report</h3>
                    <p class="text-sm text-on-surface-variant mb-4">
                        Buat laporan mingguan tunggal yang menggabungkan semua project dan aktivitas semua user sekaligus.
                    </p>
                    
                    <div class="bg-surface-container-low p-4 rounded-lg mb-6">
                        <p class="font-semibold text-sm mb-1">Periode Saat Ini:</p>
                        <p class="text-primary font-bold">{{ $period['start']->format('d M Y') }} - {{ $period['end']->format('d M Y') }}</p>
                        
                        @if(!$canGenerate)
                            <div class="mt-3 text-xs text-error bg-error/10 p-2 rounded flex items-start gap-2">
                                <span class="material-symbols-outlined text-[16px]">info</span>
                                <span>Laporan minggu ini belum dapat dibuat. Silakan tunggu hingga periode berakhir.</span>
                            </div>
                        @else
                            <div class="mt-3 text-xs text-primary bg-primary/10 p-2 rounded flex items-start gap-2">
                                <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                <span>Periode selesai. Anda dapat men-generate laporan untuk minggu ini.</span>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('admin.checkup.generate_master') }}" method="POST" class="mb-8">
                        @csrf
                        <button type="submit" class="w-full bg-secondary text-on-secondary px-4 py-2.5 rounded-lg font-semibold flex items-center justify-center gap-2 hover:brightness-110 shadow-sm transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed" {{ !$canGenerate ? 'disabled' : '' }}>
                            <span class="material-symbols-outlined">library_books</span>
                            Generate Master Report (Semua Project)
                        </button>
                    </form>

                    <hr class="border-outline-variant mb-8">

                    <h3 class="font-headline-md text-headline-md mb-4">Generate Laporan Personal</h3>
                    <form action="{{ route('admin.checkup.generate') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-2" for="user_id">Pilih User</label>
                            <select name="user_id" id="user_id" class="w-full rounded-lg border-outline-variant bg-white focus:ring-primary focus:border-primary" required>
                                <option value="" disabled selected>-- Pilih User --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-2" for="project_id">Pilih Project</label>
                            <select name="project_id" id="project_id" class="w-full rounded-lg border-outline-variant bg-white focus:ring-primary focus:border-primary" required>
                                <option value="" disabled selected>-- Pilih Project --</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-primary text-on-primary px-4 py-2.5 rounded-lg font-semibold flex items-center justify-center gap-2 hover:brightness-110 shadow-sm transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed" {{ !$canGenerate ? 'disabled' : '' }}>
                            <span class="material-symbols-outlined">picture_as_pdf</span>
                            Generate PDF Personal
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] p-6">
                    <h3 class="font-headline-md text-headline-md mb-6">Semua Riwayat Laporan</h3>
                    
                    @if($reports->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="border-b border-outline-variant/50 text-on-surface-variant font-label-md uppercase">
                                    <tr>
                                        <th class="py-3 px-4">Periode</th>
                                        <th class="py-3 px-4">User</th>
                                        <th class="py-3 px-4">Project</th>
                                        <th class="py-3 px-4">Tgl Generate</th>
                                        <th class="py-3 px-4 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reports as $report)
                                        <tr class="border-b border-outline-variant/20 hover:bg-surface-container-lowest transition-colors">
                                            <td class="py-3 px-4 font-semibold whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($report->period_start)->format('d M') }} - {{ \Carbon\Carbon::parse($report->period_end)->format('d M y') }}
                                            </td>
                                            <td class="py-3 px-4">
                                                @if(is_null($report->user_id))
                                                    <span class="bg-secondary/10 text-secondary px-2 py-0.5 rounded text-xs font-semibold">Semua User</span>
                                                @else
                                                    {{ $report->user->name ?? 'Unknown' }}
                                                @endif
                                            </td>
                                            <td class="py-3 px-4">
                                                @if(is_null($report->project_id))
                                                    <span class="bg-secondary/10 text-secondary px-2 py-0.5 rounded text-xs font-semibold">Semua Project</span>
                                                @else
                                                    {{ $report->project->name ?? 'Unknown' }}
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 text-on-surface-variant">{{ $report->created_at->format('d M Y') }}</td>
                                            <td class="py-3 px-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ route('admin.checkup.download', $report->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary/10 text-primary hover:bg-primary/20 rounded-md font-semibold transition-colors" target="_blank">
                                                        <span class="material-symbols-outlined text-[16px]">download</span>
                                                        Download
                                                    </a>
                                                    <form action="{{ route('admin.checkup.destroy', $report->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-error/10 text-error hover:bg-error/20 rounded-md font-semibold transition-colors">
                                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 bg-surface-container-low rounded-lg border border-dashed border-outline-variant">
                            <span class="material-symbols-outlined text-4xl text-outline mb-2">folder_off</span>
                            <p class="text-on-surface-variant">Belum ada laporan mingguan yang dibuat di sistem.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>