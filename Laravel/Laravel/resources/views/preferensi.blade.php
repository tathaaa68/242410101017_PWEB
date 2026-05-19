@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-white">
        <h2 class="text-2xl font-bold mb-6">Pengaturan Preferensi</h2>

        <form id="preferensiForm">
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Pilih Tema Tampilan:</label>
                <select id="themeSelect" name="theme"
                    class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="light">Light Mode</option>
                    <option value="dark">Dark Mode</option>
                    <option value="system">System Default</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-semibold">Ukuran Font:</label>
                <select id="fontSelect" name="font_size"
                    class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="small">Kecil</option>
                    <option value="medium" selected>Sedang</option>
                    <option value="large">Besar</option>
                </select>
            </div>

            <button type="submit"
                style="background-color: #1e3a8a; color: white; padding: 8px 16px; border-radius: 6px; cursor: pointer;">
                Simpan Preferensi
            </button>
        </form>

        <div id="feedbackMsg" class="mt-4 p-3 bg-green-100 text-green-800 rounded hidden"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const currentTheme = getCookie('theme') || 'system';
            const currentFont = getCookie('font_size') || 'medium';
            document.getElementById('themeSelect').value = currentTheme;
            document.getElementById('fontSelect').value = currentFont;


            document.getElementById('preferensiForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch('/preferensi', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {

                        const feedback = document.getElementById('feedbackMsg');
                        feedback.textContent = data.message + " (Tema yang tersimpan di cookie: " + data
                            .cookie_dibaca + ")";
                        feedback.classList.remove('hidden');


                        if (data.tema_baru === 'dark') {
                            document.documentElement.classList.add('dark');
                        } else if (data.tema_baru === 'light') {
                            document.documentElement.classList.remove('dark');
                        } else {

                            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                                document.documentElement.classList.add('dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                            }
                        }



                        const isDark = document.documentElement.classList.contains('dark');
                        document.getElementById('icon-sun').style.display = isDark ? 'inline' : 'none';
                        document.getElementById('icon-moon').style.display = isDark ? 'none' : 'inline';


                        const selectedFont = document.getElementById('fontSelect').value;
                        document.documentElement.classList.remove('font-small', 'font-medium',
                            'font-large');
                        document.documentElement.classList.add('font-' + selectedFont);
                    })
                    .catch(error => console.error('Error saving preferensi:', error));
            });
        });
    </script>
@endsection
