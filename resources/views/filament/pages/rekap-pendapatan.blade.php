{{-- resources/views/filament/pages/rekap-pendapatan.blade.php --}}
<x-filament-panels::page>
    {{-- Render formulir filter tanggal --}}
    {{ $this->form }}

    <h2 class="text-xl font-bold mt-4">Rekap Pendapatan dari Warga ({{ $this->startDate }} - {{ $this->endDate }})</h2>
    <p class="text-lg font-semibold mb-4">Total Pendapatan: {{ number_format($this->getTotalCitizenRevenue(), 2, ',', '.') }} Rp</p>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 filament-tables-table">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Warga</th>
                    <th scope="col" class="px-6 py-3">Total Berat Sampah (kg)</th>
                    <th scope="col" class="px-6 py-3">Total Jumlah Dibayar (Rp)</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop melalui ringkasan pendapatan warga --}}
                @forelse($this->getCitizenRevenueSummary() as $summary)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $summary->citizen_name }}</td>
                        <td class="px-6 py-4">{{ number_format($summary->total_weight, 2) }} kg</td>
                        <td class="px-6 py-4">{{ number_format($summary->total_amount, 2, ',', '.') }} Rp</td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="3" class="px-6 py-4 text-center">Tidak ada data pendapatan dari warga.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h2 class="text-xl font-bold mt-8">Rekap Pendapatan dari Sampah Dijual ({{ $this->startDate }} - {{ $this->endDate }})</h2>
    <p class="text-lg font-semibold mb-4">Total Pendapatan: {{ number_format($this->getTotalSortedWasteRevenue(), 2, ',', '.') }} Rp</p>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 filament-tables-table">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Jenis Sampah</th>
                    <th scope="col" class="px-6 py-3">Total Berat Dijual (kg)</th>
                    <th scope="col" class="px-6 py-3">Total Jumlah Diterima (Rp)</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop melalui ringkasan pendapatan sampah dijual --}}
                @forelse($this->getSortedWasteRevenueSummary() as $summary)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $summary->wasteType->name }}</td>
                        <td class="px-6 py-4">{{ number_format($summary->total_weight, 2) }} kg</td>
                        <td class="px-6 py-4">{{ number_format($summary->total_amount, 2, ',', '.') }} Rp</td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="3" class="px-6 py-4 text-center">Tidak ada data pendapatan dari sampah dijual.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-filament-panels::page>
