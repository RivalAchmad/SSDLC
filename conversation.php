<?php

function getConversation()
{
    return [
        '1' => [
            'question' => 'Dalam suasana hujan deras, Anda melihat seseorang yang duduk sendirian di sudut cafe. Gali lah informasi sebanyak-banyaknya dari orang tersebut menggunakan metode elisitasi yang telah dipelajari. <br>Apa yang pertama kali Anda katakan?',
            'options' => [
                'A' => ['text' => 'Hai! Hujan deras ya? Bolehkah saya bergabung di bawah tempat berteduh ini?', 'next' => '1.1', 'point' => 10],
                'B' => ['text' => 'Hai! Anda tinggal dimana?', 'next' => 'GAGAL.1', 'point' => 0],
                'C' => ['text' => 'Dekati target, jangan langsung mengajak berbicara, cukup senyum saja', 'next' => '1n', 'point' => 3],
            ],
        ],
        'GAGAL.1' => [
            'answer' => '&#10060; ELISITASI GAGAL &#10060;<br><br>Anda secara tiba-tiba menanyakan informasi pribadi saat pertama kali bertemu target<br><br> &#128161;Tips: Buka suasana persahabatan, dan buka perbincangan dengan sesuatu yang umum dan ringan dengan suasana ramah. Dapatkan informasi secara macro to micro',
        ],
        
        '1n' => [
            'question' => '*Target membalas senyum',
            'options' => [
                'A' => ['text' => 'Hai! Anda tinggal dimana?', 'next' => 'GAGAL.1', 'point' => 0],
                'B' => ['text' => 'Ngomong-ngomong Anda terlihat basah sekali, sudah kehujanan dari tadi ya', 'next' => '1.2', 'point' => 7],
            ],
        ],

        '1.1' => [
            'question' => '&#129333;Target: Oh, tentu saja! Hujannya deras di luar sana. Senang ada teman',
            'options' => [
                'A' => ['text' => 'Tentu saja. Anda tau tempat berteduh ini dari mana ya?', 'next' => '2n', 'point' => 3],
                'B' => ['text' => 'Tentu saja. Ngomong-ngomong Anda terlihat basah sekali, sudah kehujanan dari tadi ya', 'next' => '1.2', 'point' => 10],
            ],
        ],

        '1.2' => [
            'question' => '&#129333;Target: Ya sudah 10 menit saya kehujanan sebelum ke tempat berteduh ini',
            'options' => [
                'A' => ['text' => 'Untung saja Anda menemukan tempat ini ya ', 'next' => '1.3', 'point' => 10],
                'B' => ['text' => 'Tentu saja. Anda tau tempat berteduh ini dari mana ya?', 'next' => '2n', 'point' => 3],
            ],
        ],

        '1.3' => [
            'question' => '&#129333;Target: Saya memang sengaja memilih berteduh ke tempat ini karena sudah tau tempatnya. Biar bisa berteduh sambil nongkrong juga',
            'options' => [
                'A' => ['text' => 'Wah sama, saya juga memang sengaja ke sini untuk berteduh. Saya tau tempat ini karena saya dulu pernah tinggal di sekitar sini. Apakah Anda tinggal di sekitar sini juga atau bagaimana?', 'next' => '1.4', 'point' => 10],
                'B' => ['text' => 'Oh begitu, berarti Anda tinggal di sekitar sini?', 'next' => '2n.1', 'point' => 3],
                'C' => ['text' => 'Rumah Anda dimana kalau boleh tau?', 'next' => 'GAGAL', 'point' => 0],
            ],
        ],
        'GAGAL' => [
            'answer' => '&#10060; ELISITASI GAGAL &#10060; <br><br>Anda langsung menanyakan informasi pribadi secara blak-blakan<br><br> &#128161;Tips: Dapatkan informasi secara macro to micro',
        ],

        '1.4' => [
            'question' => '&#129333;Target: Tempat tinggal saya masih lumayan jauh dari sini, di dekat Polres Bogor. Saya tau tempat ini karena pernah diajak teman saya nongkrong di sini',
            'options' => [
                'A' => ['text' => 'Sudah berapa lama Anda tinggal di sana?', 'next' => '2n.2', 'point' => 3],
                'B' => ['text' => 'Oh begitu ya. Di daerah sana seharusnya aman ya karena dekat Polres. Soalnya di daerah-daerah yang pernah saya tinggali pasti ada saja tindak kriminal yang terjadi di depan mata saya. Nasib nomaden haha', 'next' => '2', 'point' => 10],
                'C' => ['text' => 'Kalau boleh tau berapa umur Anda?', 'next' => 'GAGAL', 'point' => 0],
            ],
        ],

        '2n' => [
            'question' => '&#129333;Target: Saya tau tempat ini karena pernah diajak teman saya nongkrong di sini',
            'options' => [
                'A' => ['text' => 'Oh begitu. Kalau boleh tau Anda bekerja dimana?', 'next' => 'GAGAL', 'point' => 0],
                'B' => ['text' => 'Hmm menarik sekali. Berbicara tentang hujan, saya tidak bisa jika tidak memperhatikan payung Anda. Unik sekali. Dapat dari mana?', 'next' => '2.1', 'point' => 7],
            ],
        ],

        '2n.1' => [
            'question' => '&#129333;Target: Tidak, rumah saya masih jauh dari sini',
            'options' => [
                'A' => ['text' => 'Oh begitu. Kalau boleh tau Anda bekerja dimana?', 'next' => 'GAGAL', 'point' => 0],
                'B' => ['text' => 'Hmm menarik sekali. Berbicara tentang hujan, saya tidak bisa jika tidak memperhatikan payung Anda. Unik sekali. Dapat dari mana?', 'next' => '2.1', 'point' => 7],
            ],
        ],

        '2n.2' => [
            'question' => '&#129333;Target: Sudah lebih dari 30 tahun',
            'options' => [
                'A' => ['text' => 'Oh begitu. Kalau boleh tau Anda bekerja dimana?', 'next' => 'GAGAL', 'point' => 0],
                'B' => ['text' => 'Hmm menarik sekali. Berbicara tentang hujan, saya tidak bisa jika tidak memperhatikan payung Anda. Unik sekali. Dapat dari mana?', 'next' => '2.1', 'point' => 7],
            ],
        ],

        '2' => [
            'question' => '&#129333;Target: Ya lumayan aman. Berbeda dengan Anda, dari lahir saya tidak pernah pindah tempat tinggal. 35 tahun hidup di Bogor tapi tidak pernah bosan karena ada saja hal atau kejadian unik baru yang saya temui di Kota Hujan ini',
            'options' => [
                'A' => ['text' => 'Oh begitu. Kalau boleh tau Anda bekerja dimana?', 'next' => 'GAGAL', 'point' => 0],
                'B' => ['text' => 'Hmm menarik sekali. Berbicara tentang hujan, saya tidak bisa jika tidak memperhatikan payung Anda. Unik sekali. Dapat dari mana?', 'next' => '2.1', 'point' => 10],
            ],
        ],

        '2.1' => [
            'question' => '&#129333;Target: Oh, ini? Sebenarnya, saya mendapatkannya sebagai hadiah dari rekan kerja. Kami sedang bekerja pada suatu proyek bersama',
            'options' => [
                'A' => ['text' => 'Berbicara tentang pekerjaan, semakin banyak saja hal baru di dunia pekerjaan sekarang ini ya. Harus lebih update terhadap perkembangan. Menambah beban saja hahaha', 'next' => '2.2', 'point' => 10],
                'B' => ['text' => 'Kalau boleh tau proyek apa yang sedang Anda kerjakan dan dimana Anda bekerja?', 'next' => 'GAGAL.2', 'point' => 0],
                'C' => ['text' => 'Berbicara tentang pekerjaan, Di zaman sekarang ini sudah semakin banyak saja lapangan pekerjaan di bidang baru yang masih asing bagi masyarakat indonesia', 'next' => '2.1n', 'point' => 3],
            ],
        ],
        'GAGAL.2' => [
            'answer' => '&#10060; ELISITASI GAGAL &#10060; <br><br>Anda langsung menanyakan dua informasi pribadi secara blak-blakan <br><br> &#128161;Tips: Jangan terburu waktu, harus sabar dan lontarkan pertanyaan satu per satu. Dapatkan informasi secara macro to micro',
        ],

        '2.1n' => [
            'question' => '&#129333;Target: Ya, benar sekali. Kita jadi harus lebih up to date terhadap perkembangan',
            'options' => [
                'A' => ['text' => 'Sudah lah tidak usah membahas itu, buat pusing saja', 'next' => 'GAGAL.3', 'point' => 0],
                'B' => ['text' => 'Begitu ya, memangnya Anda bekerja dimana kalau boleh tau', 'next' => '21n.1', 'point' => 3],
            ],
        ],
        'GAGAL.3' => [
            'answer' => '&#10060; ELISITASI GAGAL &#10060; <br><br>Anda langsung menunjukkan ketidaktertarikan terhadap topik yang menyebabkan target merubah sikap<br><br> &#128161;Tips: Tunjukkan ketertarikan setiap topik yang dibicarakan dengan target. Elisitor harus mampu menjadi pendengar yang baik dan tidak terkesan menggurui',
        ],

        '21n.1' => [
            'question' => '&#129333;Target: Saya bekerja di perusahaan Teknologi Informasi',
            'options' => [
                'A' => ['text' => 'Sudah berapa lama Anda bekerja di sana?', 'next' => '21n.2', 'point' => 3],
                'B' => ['text' => 'Teknologi informasi? Bisa lebih spesifik lagi?', 'next' => 'GAGAL.4', 'point' => 0],
            ],
        ],
        'GAGAL.4' => [
            'answer' => '&#10060; ELISITASI GAGAL &#10060; <br><br>Anda tidak sabar dalam mendapatkan infomasi. Membuat target merasa dipaksa<br><br> &#128161;Tips: Jangan terburu-buru, harus sabar, tidak emosional. Dapatkan informasi secara macro to micro',
        ],

        '21n.2' => [
            'question' => '&#129333;Target: Bisa dibilang baru beberapa tahun',
            'options' => [
                'A' => ['text' => 'Tepatnya berapa tahun ya? Bisah lebih spesifik lagi?', 'next' => 'GAGAL.4', 'point' => 0],
                'B' => ['text' => 'Memangnya sebelumnya bekerja dimana kalau boleh tau?', 'next' => '21n.3', 'point' => 3],
            ],
        ],

        '21n.3' => [
            'question' => '&#129333;Target: Sebelumnya saya PNS',
            'options' => [
                'A' => ['text' => 'Saya juga punya teman yang mengundurkan diri dari PNS. Sekarang dia bekerja di salah satu perusahaan besar di Jakarta dan pendapatannya lebih besar dari pada ketika dia menjadi PNS', 'next' => '3n', 'point' => 3],
                'B' => ['text' => 'Saya juga punya teman yang mengundurkan diri dari PNS di sebuah instansi. Ini off the record ya, alasannya karena banyak uang kotor yang berkeliaran. Dia bukan orang yang mau terlibat dengan hal seperti itu', 'next' => '3.1', 'point' => 7],
            ],
        ],

        '2.2' => [
            'question' => '&#129333;Target: Ya, benar sekali. Proyek yang sedang saya kerjakan juga merupakan hal baru bagi saya, apalagi proyek yang sedang saya kerjakan berkaitan dengan Artificial Intelligent dimana sumber untuk belajar masih sedikit. Membuat semuanya agak kacau',
            'options' => [
                'A' => ['text' => 'Wow, hebat sekali pekerjaan Anda. Saya baru tau kalau di indonesia sudah ada pekerjaan yang melibatkan AI', 'next' => '2.3', 'point' => 10],
                'B' => ['text' => 'Begitu ya. Terdengar sulit sekali walaupun saya tidak mengerti apa-apa tentang artificial intelligent', 'next' => 'GAGAL.5', 'point' => 0],
            ],
        ],
        'GAGAL.5' => [
            'answer' => '&#10060; ELISITASI GAGAL &#10060; <br><br>Anda terlalu jelas dalam menunjukkan ketidaktahuan terhadap topik yang dibawa target<br><br> &#128161;Tips: Tanggapi perbincangan dengan cerdas, jangan terlihat tidak tau karena akan membuat target berubah sikap',
        ],

        '2.3' => [
            'question' => '&#129333;Target: Sebenarnya sudah lumayan banyak pekerjaan yang melibatkan AI di Indonesia, hanya masih belum terlalu populer saja. Ya salah satunya di tempat saya bekerja',
            'options' => [
                'A' => ['text' => 'Begitu ya, saya baru tau. Soalnya saya kurang tertarik dengan masalah perteknologian haha', 'next' => 'GAGAL.3', 'point' => 0],
                'B' => ['text' => 'Begitu ya, memangnya Anda bekerja dimana kalau boleh tau?', 'next' => '2.4', 'point' => 10],
            ],
        ],

        '2.4' => [
            'question' => '&#129333;Target: Saya bekerja di Xapiens',
            'options' => [
                'A' => ['text' => 'Xapiens itu perusahaan di bidang apa ya kalau boleh tau?', 'next' => '2.4n', 'point' => 3],
                'B' => ['text' => 'Xapiens? Baru kali ini saya mendengar nama perusahaan itu', 'next' => 'GAGAL.6', 'point' => 0],
                'C' => ['text' => 'Oh Xapiens itu perusahaan khusus Artificial Intelligent', 'next' => '2.5', 'point' => 10],
            ],
        ],
        
        'GAGAL.6' => [
            'answer' => '&#10060; ELISITASI GAGAL &#10060; <br><br>Anda secara tidak langsung mengatakan bahwa tempat target bekerja adalah perusahaan kecil sehingga membuat target merubah sikap<br><br> &#128161;Tips: Berhati-hati dalam memilih perkataan. Jangan sampai membuat target tersinggung secara langsung atau tidak langsung',
        ],

        '2.4n' => [
            'question' => '&#129333;Target: Itu perusahaan di bidang teknologi informasi',
            'options' => [
                'A' => ['text' => 'Sudah berapa lama Anda bekerja di sana?', 'next' => '21n.2', 'point' => 3],
                'B' => ['text' => 'Teknologi informasi? Bisa lebih spesifik lagi?', 'next' => 'GAGAL.4', 'point' => 0],
            ],
        ],

        '2.5' => [
            'question' => '&#129333;Target: Bukan, itu perusahaan cyber security, tapi juga melibatkan AI karena sekarang AI sudah bisa diimplementasikan di dunia cyber security',
            'options' => [
                'A' => ['text' => 'Cyber security itu apa ya?', 'next' => 'GAGAL.5', 'point' => 0],
                'B' => ['text' => 'Anda memangnya lulusan mana? Karena saya pernah membaca kalau cyber security itu bidang yang sedang berkembang pesat namun jurusannya masih asing bagi pelajar Indonesia', 'next' => '2.6', 'point' => 10],
            ],
        ],

        '2.6' => [
            'question' => '&#129333;Target: Saya lulusan Sekolah Kedinasan X',
            'options' => [
                'A' => ['text' => 'Bukannya lulus dari sana langsung jadi PNS? Apakah Anda drop out atau bagaimana?', 'next' => 'GAGAL.7', 'point' => 0],
                'B' => ['text' => 'Itu kampus kedinasan kan? Bukannya lulusan dari kampus kedinasan itu langsung ditempatkan di instansi pemerintahan sebagai PNS ya? ', 'next' => '3', 'point' => 10],
            ],
        ],
        'GAGAL.7' => [
            'answer' => '&#10060; ELISITASI GAGAL &#10060; <br><br>Anda secara tidak langsung menyinggung target dengan menanyakan pertanyaan asumsi bahwa target drop out dari kampus<br><br> &#128161;Tips: Berhati-hati dalam memilih perkataan. Jangan sampai membuat target tersinggung secara langsung atau tidak langsung',
        ],

        '3' => [
            'question' => '&#129333;Target: Ya, memang benar. Setelah lulus saya langsung ditempatkan di Instansi X. 10 tahun bekerja di sana lalu saya memutuskan untuk mengundurkan diri',
            'options' => [
                'A' => ['text' => 'Saya juga punya teman yang mengundurkan diri dari PNS. Sekarang dia bekerja di salah satu perusahaan besar di Jakarta dan pendapatannya lebih besar dari pada ketika dia menjadi PNS', 'next' => '3n', 'point' => 3],
                'B' => ['text' => 'Saya juga punya teman yang mengundurkan diri dari PNS di sebuah instansi. Ini off the record ya, alasannya karena banyak uang kotor yang berkeliaran. Dia bukan orang yang mau terlibat dengan hal seperti itu', 'next' => '3.1', 'point' => 10],
            ],
        ],

        '3n' => [
            'question' => '&#129333;Target: Ya saya juga seperti itu',
            'options' => [
                'A' => ['text' => 'Wah hujannya sudah berhenti. Saya pemit dulu ya, harus melanjutkan perjalan', 'next' => 'end.n', 'point' => 0],
                'B' => ['text' => 'Wah bagus sekali kalau begitu. Rezeki memang tidak akan kemana. Senang juga ternyata berbagi pengalaman ya. Ngomong-ngomong dari tadi kita belum berkenalan, nama saya Charles', 'next' => 'end', 'point' => 7],
            ],
        ],

        '3.1' => [
            'question' => '&#129333;Target: Memang, lingkungan kerja di PNS itu masih banyak hal buruk seperti itu. Kalau saya sendiri mengundurkan diri karena lingkungan di tampat saya dulu itu toxic sekali',
            'options' => [
                'A' => ['text' => 'Sudah menjadi rahasia umum juga jika ingin menjadi PNS atau masuk ke sekolah kedinsan itu bisa lewat jalur belakang alias nyogok', 'next' => '3.2', 'point' => 10],
                'B' => ['text' => 'Memang PNS itu rata-rata orangnya toxic dan korup', 'next' => 'GAGAL', 'point' => 0],
                'C' => ['text' => 'Kalau boleh tau lingkungan toxic di tempat Anda bekerja dulu itu seperti apa ya? Apakah orang-orangnya atau keseluruhan instansi itu sendiri', 'next' => '3.1n', 'point' => 3],
            ],
        ],
        'GAGAL.8' => [
            'answer' => '&#10060; ELISITASI GAGAL &#10060; <br><br>Anda membuat target tersinggung karena terget sebelumnya merupakan seorang PNS<br><br> &#128161;Tips: Berhati-hati dalam memilih perkataan. Jangan sampai membuat target tersinggung secara langsung atau tidak langsung',
        ],

        '3.1n' => [
            'question' => '&#129333;Target: Waduh kalau itu saya kurang enak juga rasanya jika menceritakannya ke orang lain',
            'options' => [
                'A' => ['text' => 'Jadi begitu. Kalau boleh tau gaji Anda ketika jadi PNS dan gaji sekarang berapa ya?', 'next' => 'GAGAL.2', 'point' => 0],
                'B' => ['text' => 'Jadi begitu. Kalau boleh tau pendapatannya lebih besar mana? PNS atau pekerjaan sekarang?', 'next' => '3.3', 'point' => 3],
                'C' => ['text' => 'Jadi begitu. Tapi sayang juga ya keluar dari PNS, pendapatannya stabil dan jumlahnya lumayan juga. Mungkin sekitar 5 - 6 juta/bulan', 'next' => '3.3', 'point' => 7],
            ],
        ],

        '3.2' => [
            'question' => '&#129333;Target: Ya memang masih banyak instansi yang seperti itu. Namun berbeda dengan sekolah saya dulu. Benar-benar bersih dari sogok-menyogok, sudah banyak juga yang mengakuinya. Mungkin satu-satunya jalur belakang yang bisa dilakukan adalah melalui relasi pejabat tinggi',
            'options' => [
                'A' => ['text' => 'Jadi begitu. Kalau boleh tau gaji Anda ketika jadi PNS dan gaji sekarang berapa ya?', 'next' => 'GAGAL.2', 'point' => 0],
                'B' => ['text' => 'Jadi begitu. Kalau boleh tau pendapatannya lebih besar mana? PNS atau pekerjaan sekarang?', 'next' => '3.2n', 'point' => 3],
                'C' => ['text' => 'Jadi begitu. Tapi sayang juga ya keluar dari PNS, pendapatannya stabil dan jumlahnya lumayan juga. Mungkin sekitar 5 - 6 juta/bulan', 'next' => '3.3', 'point' => 10],
            ],
        ],

        '3.2n' => [
            'question' => '&#129333;Target: Hmm, perkerjaan yang sekarang',
            'options' => [
                'A' => ['text' => 'Wah hujannya sudah berhenti. Saya pemit dulu ya, harus melanjutkan perjalan', 'next' => 'end.n', 'point' => 0],
                'B' => ['text' => 'Wah bagus sekali kalau begitu. Rezeki memang tidak akan kemana. Senang juga ternyata berbagi pengalaman ya. Ngomong-ngomong dari tadi kita belum berkenalan, nama saya Charles', 'next' => 'end', 'point' => 7],
            ],
        ],

        '3.3' => [
            'question' => '&#129333;Target: Hmm sedikit di atas itu. Tapi saya tidak menyesal karena pendapatan di tempat kerja yang sekarang masih lebih tinggi dari pada ketika saya menjadi PNS',
            'options' => [
                'A' => ['text' => 'Wah hujannya sudah berhenti. Saya pemit dulu ya, harus melanjutkan perjalan', 'next' => 'end.n', 'point' => 0],
                'B' => ['text' => 'Wah bagus sekali kalau begitu. Rezeki memang tidak akan kemana. Senang juga ternyata berbagi pengalaman ya. Ngomong-ngomong dari tadi kita belum berkenalan, nama saya Charles', 'next' => 'end', 'point' => 10],
            ],
        ],

        'end' => [
            'answer' => '&#129333;Target: Hahaha saking asiknya ngobrol sampai lupa. Saya Justin<br>' .
                        '<br>' .                          
                        '*Melanjutkan percakapan ringan<br>' .
                        '<br>' .
                        '&#128373;Elicitor: Akhirnya, berhenti juga hujannya. Kalau begitu saya pemit dulu ya, harus melanjutkan perjalanan. Senang bisa berbicara dengan Anda. Jika Anda perlu seseorang untuk berdiskusi, jangan ragu untuk menghubungi saya!<br>' .
                        '<br>' .
                        '&#129333;Target: Tentu saja! Hati-hati di jalan ya<br>' .
                        '<br>' .
                        '&#128079; SELAMAT ANDA TELAH MENYELESAIKAN GAME &#128079;',
        ],

        'end.n' => [
            'answer' => '&#128079; SELAMAT ANDA TELAH MENYELESAIKAN GAME &#128079;<br>' .       
                        '<br>' .
                        '(&#128161; Seharusnya Anda bisa mengakhiri percakapan secara natural dan tidak terburu-buru agar tidak menimbulkan kecurigaan sehingga meninggalkan kesan yang baik)',
        ],
    ];
}

?>