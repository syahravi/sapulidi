{{-- resources/views/filament/pages/rekap-laporan-sampah.blade.php --}}
<x-filament-panels::page>
    {{-- Render formulir filter tanggal yang didefinisikan di kelas Livewire --}}
    {{ $this->form }}

    <h2 class="text-xl font-bold mt-4">Rekap Sampah Masuk ({{ $this->startDate }} - {{ $this->endDate }})</h2>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 filament-tables-table">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Jenis Sampah</th>
                    <th scope="col" class="px-6 py-3">Total Berat (kg)</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop melalui ringkasan sampah masuk --}}
                @forelse($this->getIncomingWasteSummary() as $summary)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $summary->wasteType->name }}</td>
                        <td class="px-6 py-4">{{ number_format($summary->total_weight, 2) }} kg</td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="2" class="px-6 py-4 text-center">Tidak ada data sampah masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h2 class="text-xl font-bold mt-8">Rekap Sampah Sortir ({{ $this->startDate }} - {{ $this->endDate }})</h2>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 filament-tables-table">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Jenis Sampah</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Total Berat (kg)</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop melalui ringkasan sampah sortir --}}
                @forelse($this->getSortedWasteSummary() as $summary)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $summary->wasteType->name }}</td>
                        <td class="px-6 py-4">{{ ucfirst($summary->status) }}</td>
                        <td class="px-6 py-4">{{ number_format($summary->total_weight, 2) }} kg</td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="3" class="px-6 py-4 text-center">Tidak ada data sampah sortir.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-filament-panels::page>
