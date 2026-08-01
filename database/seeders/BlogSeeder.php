<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Tips Memilih Jasa Bubut yang Berkualitas untuk Kebutuhan Industri',
                'slug' => 'tips-memilih-jasa-bubut-yang-berkualitas-untuk-kebutuhan-industri',
                'content' => '<h2>Pendahuluan</h2>
                <p>Memilih jasa bubut yang berkualitas adalah langkah penting untuk memastikan komponen logam yang Anda butuhkan diproduksi dengan presisi tinggi dan sesuai standar industri. Dalam artikel ini, kami akan membahas tips-tips penting dalam memilih penyedia jasa bubut yang tepat untuk kebutuhan industri Anda.</p>
                
                <h2>1. Perhatikan Pengalaman dan Reputasi</h2>
                <p>Penyedia jasa bubut yang berpengalaman biasanya memiliki track record yang baik dalam menghasilkan komponen berkualitas. PT. Borneo Iban Jaya Perkasa telah melayani kebutuhan industri sejak 2003 dengan berbagai proyek sukses di berbagai sektor industri.</p>
                
                <h2>2. Teknologi dan Peralatan Modern</h2>
                <p>Pastikan penyedia jasa bubut menggunakan mesin dan peralatan modern yang dapat menghasilkan presisi tinggi. Mesin bubut CNC dengan kontrol komputer memastikan akurasi yang konsisten untuk setiap komponen yang diproduksi.</p>
                
                <h2>3. Kemampuan Material yang Beragam</h2>
                <p>Penyedia jasa bubut yang baik harus mampu bekerja dengan berbagai jenis material seperti besi, stainless steel, aluminium, dan material logam lainnya sesuai kebutuhan spesifik Anda.</p>
                
                <h2>4. Kontrol Kualitas yang Ketat</h2>
                <p>Sistem kontrol kualitas yang ketat memastikan setiap komponen yang dihasilkan memenuhi standar yang ditetapkan. Pastikan penyedia jasa memiliki prosedur inspeksi dan pengujian yang jelas.</p>
                
                <h2>5. Ketepatan Waktu Pengiriman</h2>
                <p>Ketepatan waktu pengiriman sangat penting dalam industri. Pilih penyedia jasa yang dapat diandalkan dalam memenuhi deadline tanpa mengorbankan kualitas produk.</p>
                
                <h2>6. Layanan Konsultasi dan Dukungan</h2>
                <p>Penyedia jasa bubut yang baik akan memberikan konsultasi dan dukungan teknis untuk membantu Anda menentukan spesifikasi yang tepat untuk kebutuhan proyek Anda.</p>
                
                <h2>Kesimpulan</h2>
                <p>Memilih jasa bubut yang berkualitas memerlukan pertimbangan yang matang. Dengan memperhatikan faktor-faktor di atas, Anda dapat menemukan partner yang tepat untuk kebutuhan produksi komponen logam Anda. PT. Borneo Iban Jaya Perkasa siap membantu mewujudkan kebutuhan industri Anda dengan kualitas terbaik.</p>',
                'image' => 'assets/img/barfi/Landscaping/blog/blog-thumb-5.1.png',
                'status' => 'published',
                'meta_title' => 'Tips Memilih Jasa Bubut Berkualitas - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Panduan lengkap memilih jasa bubut berkualitas untuk kebutuhan industri. Tips memilih penyedia jasa bubut dengan presisi tinggi dan kualitas terjamin.',
                'meta_keywords' => 'jasa bubut, bubut presisi, komponen logam, industri, machining'
            ],
            [
                'title' => 'Panduan Lengkap Memahami Proses Stamping dan Moulding',
                'slug' => 'panduan-lengkap-memahami-proses-stamping-dan-moulding',
                'content' => '<h2>Pendahuluan</h2>
                <p>Stamping dan moulding adalah dua proses penting dalam industri manufaktur logam yang memiliki peran krusial dalam produksi komponen dengan berbagai bentuk dan ukuran. Artikel ini akan menjelaskan secara detail tentang kedua proses tersebut.</p>
                
                <h2>Proses Stamping</h2>
                <p>Stamping adalah proses pembentukan logam menggunakan cetakan (die) dan mesin press untuk menghasilkan komponen dengan bentuk yang diinginkan. Proses ini meliputi:</p>
                <ul>
                    <li><strong>Cutting (Pemotongan):</strong> Memotong logam sesuai pola yang diinginkan</li>
                    <li><strong>Bending (Penekukan):</strong> Membentuk logam dengan sudut tertentu</li>
                    <li><strong>Forming (Pembentukan):</strong> Membentuk logam menjadi bentuk 3D</li>
                    <li><strong>Deep Drawing:</strong> Membentuk logam menjadi bentuk cekung dalam</li>
                </ul>
                
                <h2>Proses Moulding</h2>
                <p>Moulding adalah proses pembuatan komponen menggunakan cetakan (mold) untuk menghasilkan produk dengan bentuk yang konsisten. Proses ini meliputi:</p>
                <ul>
                    <li><strong>Injection Moulding:</strong> Menyuntikkan material cair ke dalam cetakan</li>
                    <li><strong>Compression Moulding:</strong> Menekan material ke dalam cetakan</li>
                    <li><strong>Transfer Moulding:</strong> Memindahkan material ke cetakan dengan tekanan</li>
                </ul>
                
                <h2>Keunggulan Stamping dan Moulding</h2>
                <ul>
                    <li>Produksi dalam jumlah besar dengan efisiensi tinggi</li>
                    <li>Konsistensi bentuk dan ukuran yang tinggi</li>
                    <li>Biaya produksi yang lebih ekonomis untuk volume besar</li>
                    <li>Kualitas produk yang konsisten</li>
                </ul>
                
                <h2>Aplikasi dalam Industri</h2>
                <p>Stamping dan moulding banyak digunakan dalam berbagai industri seperti otomotif, elektronik, konstruksi, dan industri lainnya untuk memproduksi berbagai komponen dengan presisi tinggi.</p>
                
                <h2>Kesimpulan</h2>
                <p>Memahami proses stamping dan moulding penting untuk memilih metode produksi yang tepat untuk kebutuhan Anda. PT. Borneo Iban Jaya Perkasa memiliki pengalaman luas dalam kedua proses ini dan siap membantu mewujudkan kebutuhan produksi Anda.</p>',
                'image' => 'assets/img/barfi/Landscaping/blog/blog-thumb-5.2.png',
                'status' => 'published',
                'meta_title' => 'Panduan Proses Stamping dan Moulding - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Panduan lengkap memahami proses stamping dan moulding dalam industri manufaktur. Penjelasan detail tentang kedua proses penting ini.',
                'meta_keywords' => 'stamping, moulding, proses manufaktur, komponen logam, industri'
            ],
            [
                'title' => 'Memilih Sparepart Berkualitas untuk Kebutuhan Otomotif Anda',
                'slug' => 'memilih-sparepart-berkualitas-untuk-kebutuhan-otomotif-anda',
                'content' => '<h2>Pendahuluan</h2>
                <p>Memilih sparepart berkualitas untuk kendaraan Anda adalah investasi penting yang mempengaruhi performa, keamanan, dan umur pakai kendaraan. Artikel ini akan memberikan panduan dalam memilih sparepart otomotif yang tepat.</p>
                
                <h2>1. Kenali Jenis Sparepart yang Dibutuhkan</h2>
                <p>Setiap kendaraan memiliki kebutuhan sparepart yang berbeda. Mulai dari komponen rem, suspensi, mesin, hingga aksesori. Pastikan Anda mengetahui dengan jelas sparepart apa yang dibutuhkan untuk kendaraan Anda.</p>
                
                <h2>2. Pilih Material yang Tepat</h2>
                <p>Material sparepart sangat mempengaruhi kualitas dan ketahanannya. Sparepart berkualitas biasanya terbuat dari material premium seperti stainless steel, besi berkualitas tinggi, atau material khusus sesuai aplikasinya.</p>
                
                <h2>3. Perhatikan Standar Kualitas</h2>
                <p>Pastikan sparepart yang Anda pilih memenuhi standar kualitas industri. Sparepart yang baik biasanya memiliki sertifikasi dan telah melalui proses kontrol kualitas yang ketat.</p>
                
                <h2>4. Kompatibilitas dengan Kendaraan</h2>
                <p>Pastikan sparepart yang Anda pilih kompatibel dengan model dan tahun kendaraan Anda. Sparepart yang tidak kompatibel dapat menyebabkan masalah serius pada kendaraan.</p>
                
                <h2>5. Reputasi Produsen</h2>
                <p>Pilih sparepart dari produsen yang memiliki reputasi baik dan telah teruji kualitasnya. PT. Borneo Iban Jaya Perkasa telah memproduksi sparepart berkualitas tinggi selama lebih dari 20 tahun dengan standar kualitas internasional.</p>
                
                <h2>6. Harga vs Kualitas</h2>
                <p>Jangan hanya mempertimbangkan harga murah. Sparepart berkualitas mungkin lebih mahal, tetapi akan lebih tahan lama dan memberikan performa yang lebih baik, sehingga lebih hemat dalam jangka panjang.</p>
                
                <h2>7. Garansi dan Dukungan</h2>
                <p>Pilih sparepart yang dilengkapi dengan garansi dan dukungan purna jual. Ini memberikan jaminan bahwa produsen bertanggung jawab atas kualitas produknya.</p>
                
                <h2>Jenis Sparepart yang Kami Produksi</h2>
                <ul>
                    <li>Pedal rem depan dan belakang</li>
                    <li>Komponen sistem rem</li>
                    <li>Bracket dan mounting</li>
                    <li>Aksesori otomotif</li>
                    <li>Komponen custom sesuai kebutuhan</li>
                </ul>
                
                <h2>Kesimpulan</h2>
                <p>Memilih sparepart berkualitas adalah investasi penting untuk kendaraan Anda. Dengan memperhatikan faktor-faktor di atas, Anda dapat memastikan kendaraan Anda mendapatkan sparepart terbaik yang akan memberikan performa optimal dan keamanan maksimal.</p>',
                'image' => 'assets/img/barfi/Landscaping/blog/blog-thumb-5.3.png',
                'status' => 'published',
                'meta_title' => 'Tips Memilih Sparepart Otomotif Berkualitas - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Panduan lengkap memilih sparepart otomotif berkualitas untuk kendaraan Anda. Tips memilih sparepart dengan kualitas terjamin dan tahan lama.',
                'meta_keywords' => 'sparepart otomotif, komponen kendaraan, pedal rem, bracket, aksesori otomotif'
            ],
            [
                'title' => 'Keunggulan Jasa Plong dan Tekuk untuk Produksi Komponen Logam',
                'slug' => 'keunggulan-jasa-plong-dan-tekuk-untuk-produksi-komponen-logam',
                'content' => '<h2>Pendahuluan</h2>
                <p>Jasa plong dan tekuk adalah layanan penting dalam industri manufaktur logam yang memungkinkan produksi komponen dengan berbagai bentuk dan ukuran. Artikel ini akan membahas keunggulan dan manfaat dari layanan ini.</p>
                
                <h2>Apa itu Jasa Plong?</h2>
                <p>Plong adalah proses pemotongan logam menggunakan cetakan khusus untuk menghasilkan bentuk yang diinginkan. Proses ini sangat efisien untuk produksi dalam jumlah besar dengan bentuk yang konsisten.</p>
                
                <h2>Apa itu Jasa Tekuk?</h2>
                <p>Tekuk adalah proses pembentukan logam dengan menekuknya pada sudut tertentu sesuai kebutuhan. Proses ini memungkinkan pembuatan komponen dengan bentuk yang kompleks tanpa merusak struktur material.</p>
                
                <h2>Keunggulan Jasa Plong</h2>
                <ul>
                    <li><strong>Presisi Tinggi:</strong> Hasil pemotongan yang akurat dan konsisten</li>
                    <li><strong>Efisiensi Produksi:</strong> Dapat memproduksi dalam jumlah besar dengan cepat</li>
                    <li><strong>Bentuk Kompleks:</strong> Dapat menghasilkan bentuk yang sulit dicapai dengan metode lain</li>
                    <li><strong>Minimal Waste:</strong> Mengurangi material yang terbuang</li>
                    <li><strong>Kualitas Konsisten:</strong> Setiap produk memiliki kualitas yang sama</li>
                </ul>
                
                <h2>Keunggulan Jasa Tekuk</h2>
                <ul>
                    <li><strong>Fleksibilitas Desain:</strong> Dapat membuat berbagai bentuk dan sudut</li>
                    <li><strong>Kekuatan Material:</strong> Tidak mengurangi kekuatan material asli</li>
                    <li><strong>Akurasi Sudut:</strong> Dapat mencapai sudut yang sangat presisi</li>
                    <li><strong>Berbagai Material:</strong> Dapat bekerja dengan berbagai jenis logam</li>
                    <li><strong>Biaya Efektif:</strong> Lebih ekonomis dibanding metode pembentukan lain</li>
                </ul>
                
                <h2>Aplikasi dalam Industri</h2>
                <p>Jasa plong dan tekuk banyak digunakan dalam berbagai industri:</p>
                <ul>
                    <li>Industri otomotif untuk komponen kendaraan</li>
                    <li>Industri konstruksi untuk komponen bangunan</li>
                    <li>Industri elektronik untuk casing dan komponen</li>
                    <li>Industri furniture untuk komponen logam</li>
                    <li>Industri umum untuk berbagai kebutuhan custom</li>
                </ul>
                
                <h2>Proses Kerja</h2>
                <p>Proses plong dan tekuk dimulai dengan perencanaan desain, pembuatan cetakan atau tooling, kemudian proses produksi dengan kontrol kualitas yang ketat untuk memastikan setiap komponen memenuhi spesifikasi yang ditetapkan.</p>
                
                <h2>Mengapa Memilih PT. Borneo Iban Jaya Perkasa?</h2>
                <ul>
                    <li>Pengalaman lebih dari 20 tahun</li>
                    <li>Peralatan modern dan teknologi terkini</li>
                    <li>Tim ahli berpengalaman</li>
                    <li>Kontrol kualitas yang ketat</li>
                    <li>Ketepatan waktu pengiriman</li>
                    <li>Layanan konsultasi dan dukungan teknis</li>
                </ul>
                
                <h2>Kesimpulan</h2>
                <p>Jasa plong dan tekuk adalah solusi efisien untuk produksi komponen logam dengan berbagai bentuk dan ukuran. Dengan memilih penyedia jasa yang berpengalaman dan menggunakan teknologi modern, Anda dapat memastikan hasil produksi yang berkualitas tinggi dan sesuai kebutuhan. PT. Borneo Iban Jaya Perkasa siap membantu mewujudkan kebutuhan produksi komponen logam Anda dengan layanan plong dan tekuk yang profesional.</p>',
                'image' => 'assets/img/barfi/Landscaping/blog/blog-thumb-5.4.png',
                'status' => 'published',
                'meta_title' => 'Keunggulan Jasa Plong dan Tekuk - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Panduan lengkap tentang keunggulan jasa plong dan tekuk untuk produksi komponen logam. Manfaat dan aplikasi dalam berbagai industri.',
                'meta_keywords' => 'jasa plong, jasa tekuk, komponen logam, produksi logam, metalworking'
            ]
        ];

        foreach ($blogs as $blog) {
            Blog::updateOrCreate(
                ['slug' => $blog['slug']],
                $blog
            );
        }
    }
}
