@extends('layouts.app')
@include('layouts.header')
@section('content')

<!-- Main Content -->
<main class="container mx-auto my-10 p-5 bg-white shadow-lg rounded-lg">
  <!-- Search Bar -->
  <div class="mb-6 flex">
    <input
      type="text"
      id="searchInput"
      placeholder="Cari materi..."
      class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500"
      onkeypress="if(event.key === 'Enter'){ search(); }"
    />
    <button
      onclick="search()"
      class="ml-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors duration-200"
    >
      Cari
    </button>
  </div>

  <!-- Featured Materials -->
  @if($featuredMaterials->count() > 0)
  <section id="featuredSection" class="mb-12">
    <h2 class="text-2xl font-bold text-center mb-6">Materi Terpopuler</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
      @foreach ($featuredMaterials as $material)
        @include('edukasi._material_card', ['material' => $material])
      @endforeach
    </div>
  </section>
  @endif

  <!-- Tips & Trik Section -->
  <div id="tipsSection">
    <h2 class="text-2xl font-bold text-center mb-6">Tips & Trik</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
      @foreach ($articles as $material)
        @include('edukasi._material_card', ['material' => $material])
      @endforeach
    </div>
  </div>

  <!-- Video Edukasi -->
  <section id="videoSection" class="mt-12">
    <h2 class="text-2xl font-bold text-center mb-6">Video Edukasi</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
      @foreach ($videos as $material)
        @include('edukasi._material_card', ['material' => $material])
      @endforeach
    </div>
  </section>

  <!-- Notification Toast -->
  <div id="toast" class="hidden fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg transition-all duration-300 transform translate-y-2 opacity-0">
    Link YouTube berhasil disalin!
  </div>
</main>

<script>
  function search() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    const items = document.querySelectorAll('[data-searchable]');
    let hasTipsResults = false;
    let hasVideoResults = false;

    // First pass to check what sections have matches
    items.forEach(item => {
      const text = item.innerText.toLowerCase();
      if (text.includes(query)) {
        if (item.dataset.section === 'tips') {
          hasTipsResults = true;
        } else if (item.dataset.section === 'video') {
          hasVideoResults = true;
        }
      }
    });

    // Second pass to actually show/hide elements
    items.forEach(item => {
      const text = item.innerText.toLowerCase();
      item.style.display = text.includes(query) ? 'block' : 'none';
    });

    // Show/hide section headers based on results
    document.getElementById('tipsSection').style.display = hasTipsResults ? 'block' : 'none';
    document.getElementById('videoSection').style.display = hasVideoResults ? 'block' : 'none';
  }

  function copyYoutubeUrl(url) {
    navigator.clipboard.writeText(url).then(() => {
      const toast = document.getElementById('toast');
      toast.classList.remove('hidden', 'opacity-0', 'translate-y-2');
      toast.classList.add('flex', 'opacity-100', 'translate-y-0');
      setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-2');
        setTimeout(() => toast.classList.add('hidden'), 300);
      }, 3000);
    }).catch(err => {
      alert("Gagal menyalin link: " + err);
    });
  }
</script>
@endsection