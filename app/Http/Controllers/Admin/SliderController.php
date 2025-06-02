<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Slider; // Pastikan model Slider ada di App\Models

class SliderController extends Controller
{
    /**
     * Menampilkan halaman pengelolaan slider.
     */
    public function index()
    {
        // Ambil data slider dari database, diurutkan berdasarkan slot_number
        // dan di-key berdasarkan slot_number untuk memudahkan pencarian
        $sliders = Slider::orderBy('slot_number')->get()->keyBy('slot_number');


        return view('admin.slider', [
            'currentSlidersData' => $sliders
        ]);
    }


    /**
     * Memperbarui gambar slider untuk slot tertentu.
     */
    public function update(Request $request, $slot_number)
    {
        $errorBagName = 'slider_slot_' . $slot_number;

        // Validasi input
        $validator = Validator::make($request->all(), [
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Maks 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.sliders') // Koreksi nama route
                ->withErrors($validator, $errorBagName) // Menggunakan named error bag
                ->withInput();
        }

        if ($request->hasFile('slider_image')) {
            $file = $request->file('slider_image');

            // Buat nama file yang unik namun deskriptif
            $filename = 'slider_slot_' . $slot_number . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke 'storage/app/public/sliders'
            // Metode storeAs mengembalikan path relatif terhadap root disk 'public' (misal: 'sliders/namafile.jpg')
            $imagePath = $file->storeAs('sliders_images', $filename, 'public');

            // Debugging: Periksa apakah file berhasil disimpan
            if (!$imagePath || !Storage::disk('public')->exists($imagePath)) {
                return redirect()->route('admin.sliders')
                    ->with('error_slot_' . $slot_number, 'Gagal menyimpan file gambar ke disk untuk Slider #' . $slot_number . '.');
            }

            // Cari slider yang ada untuk slot ini
            $slider = Slider::where('slot_number', $slot_number)->first();


            // Update atau buat record slider baru
            $sliderRecord = Slider::updateOrCreate(
                ['slot_number' => (int) $slot_number],
                ['image_path' => $imagePath]
            );

            // Debugging: Periksa apakah record database berhasil disimpan/diperbarui
            if (!$sliderRecord || !$sliderRecord->exists) {
                // Jika gagal simpan DB, hapus file yang baru diunggah untuk konsistensi
                Storage::disk('public')->delete($imagePath);
                return redirect()->route('admin.sliders')
                    ->with('error_slot_' . $slot_number, 'Gagal menyimpan informasi slider ke database untuk Slot #' . $slot_number . '.');
            }

            return redirect()->route('admin.sliders') // Koreksi nama route
                ->with('success_slot_' . $slot_number, 'Gambar untuk Slider #' . $slot_number . ' berhasil diperbarui.');
        }
        // Jika tidak ada file yang diunggah (seharusnya tidak terjadi jika validasi 'required' aktif)
        return redirect()->route('admin.sliders') // Koreksi nama route
            ->with('error_slot_' . $slot_number, 'Gagal memperbarui Slider #' . $slot_number . '. Tidak ada gambar yang diunggah.');
    }
}