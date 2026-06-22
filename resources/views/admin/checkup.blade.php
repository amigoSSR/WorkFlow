@include('admin.topbarAdmin')

<main class="min-h-screen">
    <div class="pt-24 px-container-padding pb-10">
        <div class="flex items-end justify-between mb-8">
            <div>
                <h2 class="font-headline-xl text-headline-xl text-on-background mb-1">Weekly Check-up</h2>
                <p class="text-on-surface-variant font-body-md text-body-md">Monitor weekly progress, task health, and operational readiness.</p>
            </div>
            <button class="bg-primary text-on-primary px-6 py-2.5 rounded-lg font-semibold flex items-center gap-2 hover:brightness-110 shadow-sm transition-all active:scale-95">
                <span class="material-symbols-outlined">pulse_auto</span>
                Refresh Status
            </button>
        </div>
        <div class="grid grid-cols-12 gap-card-gap">
            <div class="col-span-8 space-y-card-gap">
                <div class="bg-white rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="font-label-md text-label-md text-secondary uppercase tracking-[0.18em]">Team Readiness</p>
                            <h3 class="font-headline-md text-headline-md">Weekly Health Snapshot</h3>
                        </div>
                        <span class="inline-flex items-center gap-2 rounded-full bg-primary-container/20 px-3 py-1 text-primary font-semibold text-[12px]">Live</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-2xl bg-surface-container-low p-5">
                            <p class="text-label-md text-label-md text-outline mb-4">Shift coverage</p>
                            <div class="flex items-end gap-3">
                                <div class="h-36 w-20 rounded-t-3xl bg-primary"></div>
                                <div class="h-28 w-20 rounded-t-3xl bg-secondary"></div>
                                <div class="h-24 w-20 rounded-t-3xl bg-tertiary"></div>
                                <div class="h-20 w-20 rounded-t-3xl bg-surface-container-highest"></div>
                            </div>
                        </div>
                        <div class="rounded-2xl bg-surface-container-low p-5">
                            <p class="text-label-md text-label-md text-outline mb-4">Issue health</p>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-body-md text-on-surface">Open issues</span>
                                    <span class="font-semibold text-primary">4</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-body-md text-on-surface">On-time tasks</span>
                                    <span class="font-semibold text-secondary">86%</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-body-md text-on-surface">Escalations</span>
                                    <span class="font-semibold text-tertiary">1</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] p-6">
                    <h3 class="font-headline-md text-headline-md mb-4">Key Updates</h3>
                    <div class="space-y-4">
                        <div class="rounded-2xl bg-surface-container-low p-4">
                            <p class="font-semibold text-on-surface">Security team completed compliance checks.</p>
                            <p class="text-[13px] text-outline mt-1">All critical access badges verified for the week.</p>
                        </div>
                        <div class="rounded-2xl bg-surface-container-low p-4">
                            <p class="font-semibold text-on-surface">Server room rotation staffed at 100%.</p>
                            <p class="text-[13px] text-outline mt-1">No overlap gaps identified across current roster.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-4 space-y-card-gap">
                <div class="bg-primary text-white rounded-xl p-6 shadow-lg">
                    <p class="font-label-md text-label-md uppercase opacity-80 tracking-[0.18em] mb-4">Weekly Score</p>
                    <div class="text-headline-xl font-headline-xl">92%</div>
                    <p class="text-xs opacity-90 mt-2">Strong operational readiness based on current checklist.</p>
                </div>
                <div class="bg-white rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] p-6">
                    <h3 class="font-headline-md text-headline-md mb-4">Checklist</h3>
                    <ul class="space-y-3 text-body-md text-on-surface">
                        <li class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 rounded-full bg-primary mt-1"></span>
                            All zones staffed
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 rounded-full bg-primary mt-1"></span>
                            Backup systems verified
                        </li>
                        <li class="flex items-center gap-3 text-on-surface-variant">
                            <span class="w-2.5 h-2.5 rounded-full bg-outline mt-1"></span>
                            Pending incident triage
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>