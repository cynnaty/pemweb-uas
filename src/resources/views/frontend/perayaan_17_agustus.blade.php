<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perayaan Kemerdekaan 17 Agustus</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f0f0; 
        }
        .theme-red {
            background-color: #EF4444; 
            color: #FFFFFF;
        }
        .theme-white {
            background-color: #FFFFFF;
            color: #EF4444; 
        }
        .card-shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }
        .loading-spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #EF4444; /* Merah */
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center p-4 bg-gradient-to-br from-red-600 to-white">
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg p-6 md:p-8 my-8">
        <!-- Header Bertema 17 Agustus -->
        <header class="text-center mb-10 p-6 rounded-lg theme-red card-shadow">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-2 tracking-tight">
                🇮🇩 Perayaan Kemerdekaan 🇮🇩
            </h1>
            <p class="text-xl md:text-2xl font-semibold">
                Semangat 17 Agustus! Mari Rayakan Bersama!
            </p>
        </header>

        <main class="space-y-12">
            <!-- Bagian Daftar Lomba Seru! (Sudah ada) -->
            <section>
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Daftar Lomba Seru!</h2>
                <div id="loading-lomba" class="flex justify-center items-center py-10 hidden">
                    <div class="loading-spinner"></div>
                    <p class="ml-3 text-lg text-gray-600">Memuat data lomba...</p>
                </div>
                <div id="error-lomba" class="text-center text-red-600 text-lg py-10 hidden">
                    Terjadi kesalahan saat memuat data lomba.
                </div>
                <div id="lomba-list" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Lomba cards will be injected here by JavaScript -->
                </div>
            </section>

            <!-- Bagian Pendaftaran Peserta -->
            <section class="bg-gray-50 p-6 rounded-lg card-shadow border-t-4 border-blue-500">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Daftar Sebagai Peserta!</h2>
                <form id="peserta-registration-form" class="space-y-4">
                    <div>
                        <label for="peserta-nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="peserta-nama" name="nama" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                    </div>
                    <div>
                        <label for="peserta-email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="peserta-email" name="email" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                    </div>
                    <div>
                        <label for="peserta-asal_sekolah" class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
                        <input type="text" id="peserta-asal_sekolah" name="asal_sekolah" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                    </div>
                    <div>
                        <label for="peserta-lomba" class="block text-sm font-medium text-gray-700">Pilih Lomba</label>
                        <select id="peserta-lomba" name="lomba_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                            <option value="">-- Pilih Lomba --</option>
                            <!-- Options will be populated by JavaScript -->
                        </select>
                    </div>
                    <button type="submit"
                            class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Daftar Sekarang
                    </button>
                    <div id="peserta-form-message" class="mt-3 text-center text-sm font-medium hidden"></div>
                </form>
            </section>

            <!-- Bagian Data Nilai (Hanya Lihat) -->
            <section class="bg-gray-50 p-6 rounded-lg card-shadow border-t-4 border-green-500">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Data Nilai Peserta</h2>
                <div id="loading-nilai" class="flex justify-center items-center py-10 hidden">
                    <div class="loading-spinner"></div>
                    <p class="ml-3 text-lg text-gray-600">Memuat data nilai...</p>
                </div>
                <div id="error-nilai" class="text-center text-red-600 text-lg py-10 hidden">
                    Terjadi kesalahan saat memuat data nilai.
                </div>
                <div id="nilai-table-container" class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Peserta
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Lomba
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Juri
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Skor
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Komentar
                                </th>
                            </tr>
                        </thead>
                        <tbody id="nilai-table-body" class="bg-white divide-y divide-gray-200">
                            <!-- Nilai rows will be injected here by JavaScript -->
                        </tbody>
                    </table>
                    <p id="no-nilai-data" class="text-center text-gray-600 text-lg py-4 hidden">Belum ada data nilai yang tersedia.</p>
                </div>
            </section>

            <!-- Bagian Data Panitia (Hanya Lihat) -->
            <section class="bg-gray-50 p-6 rounded-lg card-shadow border-t-4 border-purple-500">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Daftar Panitia</h2>
                <div id="loading-panitia" class="flex justify-center items-center py-10 hidden">
                    <div class="loading-spinner"></div>
                    <p class="ml-3 text-lg text-gray-600">Memuat data panitia...</p>
                </div>
                <div id="error-panitia" class="text-center text-red-600 text-lg py-10 hidden">
                    Terjadi kesalahan saat memuat data panitia.
                </div>
                <div id="panitia-table-container" class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Panitia
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tugas
                                </th>
                            </tr>
                        </thead>
                        <tbody id="panitia-table-body" class="bg-white divide-y divide-gray-200">
                            <!-- Panitia rows will be injected here by JavaScript -->
                        </tbody>
                    </table>
                    <p id="no-panitia-data" class="text-center text-gray-600 text-lg py-4 hidden">Belum ada data panitia yang tersedia.</p>
                </div>
            </section>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // --- Konfigurasi Base URL API ---
            // Ganti dengan URL domain Anda (misalnya 'https://uas.test')
            const BASE_URL = 'https://uas.test'; 

            // --- Elemen DOM ---
            const lombaListContainer = document.getElementById('lomba-list');
            const loadingLomba = document.getElementById('loading-lomba');
            const errorLomba = document.getElementById('error-lomba');

            const pesertaLombaSelect = document.getElementById('peserta-lomba');
            const pesertaRegistrationForm = document.getElementById('peserta-registration-form');
            const pesertaFormMessage = document.getElementById('peserta-form-message');

            const nilaiTableBody = document.getElementById('nilai-table-body');
            const loadingNilai = document.getElementById('loading-nilai');
            const errorNilai = document.getElementById('error-nilai');
            const noNilaiData = document.getElementById('no-nilai-data');

            const panitiaTableBody = document.getElementById('panitia-table-body');
            const loadingPanitia = document.getElementById('loading-panitia');
            const errorPanitia = document.getElementById('error-panitia');
            const noPanitiaData = document.getElementById('no-panitia-data');

            // --- Fungsi untuk mengambil dan menampilkan Lomba ---
            async function fetchLombas() {
                loadingLomba.classList.remove('hidden');
                errorLomba.classList.add('hidden');
                lombaListContainer.innerHTML = '';
                pesertaLombaSelect.innerHTML = '<option value="">-- Pilih Lomba --</option>'; // Reset dropdown

                try {
                    const response = await fetch(`${BASE_URL}/api/lombas`); // Menggunakan BASE_URL
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const lombas = await response.json();

                    loadingLomba.classList.add('hidden');

                    if (lombas.length === 0) {
                        lombaListContainer.innerHTML = '<p class="text-center text-gray-600 text-lg col-span-full">Belum ada lomba yang tersedia saat ini.</p>';
                    } else {
                        lombas.forEach(lomba => {
                            const lombaCard = `
                                <div class="bg-white p-6 rounded-lg card-shadow border-t-4 border-red-500">
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2">${lomba.nama_lomba}</h3>
                                    <p class="text-gray-700 mb-4">${lomba.deskripsi}</p>
                                    <div class="flex items-center text-gray-600 mb-2">
                                        <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>${new Date(lomba.tanggal_mulai).toLocaleDateString('id-ID')} - ${new Date(lomba.tanggal_selesai).toLocaleDateString('id-ID')}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243m10.606-10.607l4.243-4.243m-10.606 10.607l4.243-4.243"></path></svg>
                                        <span>${lomba.lokasi}</span>
                                    </div>
                                </div>
                            `;
                            lombaListContainer.innerHTML += lombaCard;

                            // Populate lomba selection for peserta registration
                            const option = document.createElement('option');
                            option.value = lomba.id;
                            option.textContent = lomba.nama_lomba;
                            pesertaLombaSelect.appendChild(option);
                        });
                    }

                } catch (error) {
                    console.error('Error fetching lomba data:', error);
                    loadingLomba.classList.add('hidden');
                    errorLomba.classList.remove('hidden');
                }
            }

            // --- Fungsi untuk mengambil dan menampilkan Nilai ---
            async function fetchNilais() {
                loadingNilai.classList.remove('hidden');
                errorNilai.classList.add('hidden');
                noNilaiData.classList.add('hidden');
                nilaiTableBody.innerHTML = ''; // Clear previous content

                try {
                    const response = await fetch(`${BASE_URL}/api/nilais`); // Menggunakan BASE_URL
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const nilais = await response.json();

                    loadingNilai.classList.add('hidden');

                    if (nilais.length === 0) {
                        noNilaiData.classList.remove('hidden');
                    } else {
                        nilais.forEach(nilai => {
                            const row = `
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        ${nilai.peserta ? nilai.peserta.nama : 'N/A'}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${nilai.peserta && nilai.peserta.lomba ? nilai.peserta.lomba.nama_lomba : 'N/A'}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${nilai.juri}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${nilai.skor}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${nilai.komentar}
                                    </td>
                                </tr>
                            `;
                            nilaiTableBody.innerHTML += row;
                        });
                    }

                } catch (error) {
                    console.error('Error fetching nilai data:', error);
                    loadingNilai.classList.add('hidden');
                    errorNilai.classList.remove('hidden');
                }
            }

            // --- Fungsi untuk mengambil dan menampilkan Panitia ---
            async function fetchPanitias() {
                loadingPanitia.classList.remove('hidden');
                errorPanitia.classList.add('hidden');
                noPanitiaData.classList.add('hidden');
                panitiaTableBody.innerHTML = ''; // Clear previous content

                try {
                    const response = await fetch(`${BASE_URL}/api/panitias`); // Menggunakan BASE_URL
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const panitias = await response.json();

                    loadingPanitia.classList.add('hidden');

                    if (panitias.length === 0) {
                        noPanitiaData.classList.remove('hidden');
                    } else {
                        panitias.forEach(panitia => {
                            const row = `
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        ${panitia.nama}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${panitia.email}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${panitia.tugas}
                                    </td>
                                </tr>
                            `;
                            panitiaTableBody.innerHTML += row;
                        });
                    }

                } catch (error) {
                    console.error('Error fetching panitia data:', error);
                    loadingPanitia.classList.add('hidden');
                    errorPanitia.classList.remove('hidden');
                }
            }

            // --- Event Listener untuk Form Pendaftaran Peserta ---
            pesertaRegistrationForm.addEventListener('submit', async (event) => {
                event.preventDefault(); // Mencegah refresh halaman

                const formData = new FormData(pesertaRegistrationForm);
                const data = Object.fromEntries(formData.entries());

                pesertaFormMessage.classList.remove('hidden', 'text-green-600', 'text-red-600');
                pesertaFormMessage.classList.add('text-gray-600');
                pesertaFormMessage.textContent = 'Sedang mendaftar...';

                try {
                    const response = await fetch(`${BASE_URL}/api/pesertas`, { // Menggunakan BASE_URL
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json', // Penting untuk Laravel agar mengembalikan JSON
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (response.ok) {
                        pesertaFormMessage.classList.remove('text-gray-600', 'text-red-600');
                        pesertaFormMessage.classList.add('text-green-600');
                        pesertaFormMessage.textContent = result.message || 'Pendaftaran berhasil!';
                        pesertaRegistrationForm.reset(); // Bersihkan form
                        // Opsional: Refresh data nilai atau peserta jika ada di halaman yang sama
                    } else {
                        pesertaFormMessage.classList.remove('text-gray-600', 'text-green-600');
                        pesertaFormMessage.classList.add('text-red-600');
                        pesertaFormMessage.textContent = result.message || 'Pendaftaran gagal. Silakan coba lagi.';
                        // Tampilkan error validasi jika ada
                        if (result.errors) {
                            for (const key in result.errors) {
                                pesertaFormMessage.textContent += ` ${key}: ${result.errors[key].join(', ')}`;
                            }
                        }
                    }
                } catch (error) {
                    console.error('Error submitting peserta registration:', error);
                    pesertaFormMessage.classList.remove('text-gray-600', 'text-green-600');
                    pesertaFormMessage.classList.add('text-red-600');
                    pesertaFormMessage.textContent = 'Terjadi kesalahan jaringan atau server.';
                }
            });

            // --- Panggil fungsi saat halaman dimuat ---
            fetchLombas();
            fetchNilais();
            fetchPanitias();
        });
    </script>
</body>
</html>
