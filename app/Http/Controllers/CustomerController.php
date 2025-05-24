<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

use function PHPUnit\Framework\callback;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Customer::orderBy('updated_at', 'desc')->get();
        return view('backend.v_customer.index', [
            'judul' => 'Customer',
            'sub' => 'Data Customer',
            'index' => $user
        ]);
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.v_customer.edit', [
            'judul' => 'Customer',
            'sub' => 'Ubah Customer',
            'edit' => $user,
        ]);
    }
    public function destroy(string $id)
    {
        $user = user::findOrFail($id);
        if ($user->foto) {
            $oldImagePath = public_path('storage/img-user/') . $user->foto;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $role = $user->role;
        $user->delete();
        if ($role == 2) {
            return redirect()->route('backend.customer.index')->with('success', 'Customer berhasil dihapus');
        } else {
            return redirect()->route('backend.user.index')->with('success', 'Data berhasil dihapus');
        }
    }

    public function update(Request $request, $id)
    {
    $customer = Customer::with('user')->where('user_id', $id)->firstOrFail();

    $rules = [
        'nama' => 'required|max:255',
        'hp' => 'required|min:10|max:13',
        'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
    ];

    $messages = [
        'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
        'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
    ];

    // Validasi email di tabel users, bukan customer
    if ($request->email != $customer->user->email) {
        $rules['email'] = 'required|max:255|email|unique:user,email,' . $customer->user_id;
    }

    if ($request->alamat != $customer->alamat) {
        $rules['alamat'] = 'required';
    }
    if ($request->pos != $customer->pos) {
        $rules['pos'] = 'required';
    }

    $validatedData = $request->validate($rules, $messages);

    // Handle upload foto baru
    if ($request->file('foto')) {
        if ($customer->foto) {
            $oldImagePath = public_path('storage/img-customer/') . $customer->user->foto;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
        $directory = 'storage/img-customer/';

        ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
        $validatedData['foto'] = $originalFileName;
    }
    // Update nama & email ke tabel `user`
    $customer->user->update([
    'nama' => $request->input('nama'),
    'email' => $request->input('email'),
    ]);

    // Update alamat dan pos ke tabel customer
    $customer->update([
    'alamat' => $request->input('alamat'),
    'pos' => $request->input('pos'),
    ]);

    

    return redirect()->route('backend.customer.index', $id)->with('success', 'Data berhasil diperbarui');
    }
    

    // Redirect ke Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function detail($id) // Tambahkan parameter ID
{
    $user = User::findOrFail($id); // Ambil single user
    return view('backend.v_customer.detail', [
        'judul' => 'Customer',
        'sub' => 'Detail Customer',
        'row' => $user // Ubah menjadi $row untuk konsisten dengan view
    ]);
}

    

    // Callback dari Google
    public function callback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
            

            // Cek apakah email sudah terdaftar
            $registeredUser = User::where('email', $socialUser->email)->first();


            
            if ($registeredUser == null) {
                // Buat user baru
                $data = [
                    'nama' => $socialUser->name,
                    'email' => $socialUser->email,
                    'hp' =>  null, // hp default (opsional)
                    'role' => '2', // Role customer
                    'status' => 1, // Status aktif
                    'password' => Hash::make('default_password'), // Password default (opsional)
                ];

               
                $user = User::create($data);
                

                // Buat data customer
                $customer = Customer::create([
                    'user_id' => $user->id,
                    'google_id' => $socialUser->id,
                    'google_token' => $socialUser->token
                ]);

                // dd($customer);


                // Login pengguna baru
                Auth::login($user);
            } else {
                // Jika email sudah terdaftar, langsung login
                Auth::login($registeredUser);
            }

            // Redirect ke halaman utama
            return redirect()->intended('beranda');
        } catch (\Exception $e) {
            // Redirect ke halaman utama jika terjadi kesalahan
            
            return redirect('/')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerate token CSRF

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }

    public function akun($id)
    {
        $loggedInCustomerId = Auth::user()->id;
        // Cek apakah ID yang diberikan sama dengan ID customer yang sedang login
        if ($id != $loggedInCustomerId) {
            // Redirect atau tampilkan pesan error
            return redirect()->route('customer.akun', ['id' => $loggedInCustomerId])->with('msgError', 'Anda tidak berhak mengakses akun ini.');
        }
        $customer = Customer::where('user_id', $id)->firstOrFail();
        return view('frontend.v_customer.edit', [
            'judul' => 'Customer',
            'subJudul' => 'Akun Customer',
            'edit' => $customer
        ]);
    }

    public function updateAkun(Request $request, $id)

    {
    $customer = Customer::where('user_id', $id)->firstOrFail();
    $rules = [
        'nama' => 'required|max:255',
        'hp' => 'required|min:10|max:13',
        'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
    ];
    $messages = [
        'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
        'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
    ];

    if ($request->email != $customer->user->email) {
        $rules['email'] = 'required|max:255|email|unique:customer';
    }
    if ($request->alamat != $customer->alamat) {
        $rules['alamat'] = 'required';
    }
    if ($request->pos != $customer->pos) {
        $rules['pos'] = 'required';
    }

    $validatedData = $request->validate($rules, $messages);
    // menggunakan ImageHelper
    if ($request->file('foto')) {
        //hapus gambar lama
        if ($customer->user->foto) {
            $oldImagePath = public_path('storage/img-customer/') . $customer->user->foto;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
        $directory = 'storage/img-customer/';
        // Simpan gambar dengan ukuran yang ditentukan
        ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400); // null (jika tinggi otomatis)
        // Simpan nama file asli di database
        $validatedData['foto'] = $originalFileName;
    }

    $customer->user->update($validatedData);

    $customer->update([
        'alamat' => $request->input('alamat'),
        'pos' => $request->input('pos'),
    ]);
    return redirect()->route('customer.akun', $id)->with('success', 'Data berhasil diperbarui');
    }


}
