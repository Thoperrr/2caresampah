<div id="assignModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg w-full max-w-md p-6 shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Atur Jadwal Penjemputan</h2>
        <form action="{{ route('bank.pickup.schedule') }}" method="POST">
            @csrf
            <input type="hidden" name="pickup_request_id" id="pickupRequestId">
            <div class="mb-4">
                <label class="block mb-1 text-gray-700">Tanggal Penjemputan</label>
                <input type="date" name="tanggal" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeAssignModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function openAssignModal(requestId) {
    document.getElementById('assignModal').classList.remove('hidden');
    document.getElementById('pickupRequestId').value = requestId;
}
function closeAssignModal() {
    document.getElementById('assignModal').classList.add('hidden');
}
</script>