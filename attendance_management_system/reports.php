<?php if (!empty($records)): ?>
    <!-- Attendance Summary -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
        <div>
            <p class="text-lg"><strong>Total Records:</strong> <?= $total ?></p>
            <p class="text-lg"><strong>Present:</strong> <?= $present ?></p>
            <p class="text-lg"><strong>Attendance %:</strong> <?= $attendance_percentage ?>%</p>
        </div>

        <!-- Circular Progress Indicator -->
        <div class="flex justify-center">
            <div class="relative w-32 h-32">
                <svg class="transform -rotate-90" width="100%" height="100%" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" stroke="#e5e7eb" stroke-width="10" fill="none" />
                    <circle
                        cx="50"
                        cy="50"
                        r="45"
                        stroke="#4f46e5"
                        stroke-width="10"
                        fill="none"
                        stroke-dasharray="282.6"
                        stroke-dashoffset="<?= 282.6 - (282.6 * $attendance_percentage / 100) ?>"
                        stroke-linecap="round"
                    />
                </svg>
                <div class="absolute inset-0 flex items-center justify-center text-indigo-700 font-semibold text-xl">
                    <?= $attendance_percentage ?>%
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
