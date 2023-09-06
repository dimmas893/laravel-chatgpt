<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f7f6;
            margin-top: 20px;
        }

        .card {
            background: #fff;
            transition: .5s;
            border: 0;
            margin-bottom: 30px;
            border-radius: .55rem;
            position: relative;
            width: 100%;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
        }



        .chat .chat-header {
            padding: 15px 20px;
            border-bottom: 2px solid #f4f7f6
        }

        .chat .chat-header img {
            float: left;
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-header .chat-about {
            float: left;
            padding-left: 10px
        }

        .chat .chat-history {
            padding: 20px;
            border-bottom: 2px solid #fff
        }

        .chat .chat-history ul {
            padding: 0
        }

        .chat .chat-history ul li {
            list-style: none;
            margin-bottom: 30px
        }

        .chat .chat-history ul li:last-child {
            margin-bottom: 0px
        }

        .chat .chat-history .message-data {
            margin-bottom: 15px
        }

        .chat .chat-history .message-data img {
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-history .message-data-time {
            color: #434651;
            padding-left: 6px
        }

        .chat .chat-history .message {
            color: #444;
            padding: 18px 20px;
            line-height: 26px;
            font-size: 16px;
            border-radius: 7px;
            display: inline-block;
            position: relative
        }

        .chat .chat-history .message:after {
            bottom: 100%;
            left: 7%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #fff;
            border-width: 10px;
            margin-left: -10px
        }

        .chat .chat-history .my-message {
            background: #efefef
        }

        .chat .chat-history .my-message:after {
            bottom: 100%;
            left: 30px;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #efefef;
            border-width: 10px;
            margin-left: -10px
        }

        .chat .chat-history .other-message {
            background: #e8f1f3;
            text-align: end
        }

        .chat .chat-history .other-message:after {
            border-bottom-color: #e8f1f3;
            left: 93%
        }

        .chat .chat-message {
            padding: 20px
        }

        .online,
        .offline,
        .me {
            margin-end: 2px;
            font-size: 8px;
            vertical-align: middle
        }

        .online {
            color: #86c541
        }

        .offline {
            color: #e47297
        }

        .me {
            color: #1d8ecd
        }

        .float-end {
            float: end
        }

        .clearfix:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0
        }

        @media only screen and (max-width: 767px) {
            .chat-app .people-list {
                height: 465px;
                width: 100%;
                overflow-x: auto;
                background: #fff;
                left: -400px;
                display: none
            }

            .chat-app .people-list.open {
                left: 0
            }

            .chat-app .chat {
                margin: 0
            }

            .chat-app .chat .chat-header {
                border-radius: 0.55rem 0.55rem 0 0
            }

            .chat-app .chat-history {
                height: 300px;
                overflow-x: auto
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 992px) {
            .chat-app .chat-list {
                height: 650px;
                overflow-x: auto
            }

            .chat-app .chat-history {
                height: 600px;
                overflow-x: auto
            }
        }

        @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
            .chat-app .chat-list {
                height: 480px;
                overflow-x: auto
            }

            .chat-app .chat-history {
                height: calc(100vh - 350px);
                overflow-x: auto
            }
        }
    </style>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">

                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="{{ asset('gambar.jpg') }}" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0">Ananda Dimmas</h6>
                                        <small>Online</small>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0">
                                <div id="chat-content" class="mb-3"></div>
                                <div id="mengetik" style="display: none;"></div>
                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" id="user-input"
                                    placeholder="Enter text here..."><button id="send-button"
                                    class="input-group-text"><i class="fa fa-send"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan jQuery dan Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    <!-- Tambahkan ini sebelum </body> -->
    <script>
        function scrollChatToBottom() {
            var chatHistory = $('.chat-history');
            chatHistory.scrollTop(chatHistory[0].scrollHeight);
        }

        function playSilahkanAudio() {
            var source = "{{ asset('silahkan.wav') }}";
            var audio = document.createElement("audio");

            audio.autoplay = true;

            audio.load();
            audio.addEventListener("load", function() {
                audio.play();
            }, true);

            audio.src = source;
        }

        function playMembalasAudio() {
            var source = "{{ asset('membalas.wav') }}";
            var audio = document.createElement("audio");

            audio.autoplay = true;

            audio.load();
            audio.addEventListener("load", function() {
                audio.play();
                // Setelah pemutaran audio selesai, lakukan pengucapan teks
                bacaText(response);
            }, true);

            audio.src = source;
        }


        function bacaText(text) {

            var msg = new SpeechSynthesisUtterance();

            // Atur teks yang ingin diucapkan
            msg.text = text;

            // Atur bahasa menjadi Bahasa Indonesia
            msg.lang = "id-ID";

            // Dapatkan daftar suara yang tersedia
            var voices = window.speechSynthesis.getVoices();

            // Cari suara laki-laki dalam bahasa Indonesia
            var indonesianMaleVoice = voices.find(function(voice) {
                return voice.lang === "id-ID" && voice.gender === "male";
            });

            // Atur suara laki-laki dalam bahasa Indonesia
            msg.voice = indonesianMaleVoice;

            // Atur kecepatan suara (1 adalah kecepatan normal)
            msg.rate = 0.8;

            // Ucapkan teks
            window.speechSynthesis.speak(msg);
        }

        function getCurrentTime() {
            const now = new Date();
            const options = {
                hour: 'numeric',
                minute: 'numeric',
                hour12: false // Mengubahnya menjadi false untuk menghilangkan AM/PM
            };
            const idLocale = 'id-ID';
            const timeString = now.toLocaleTimeString(idLocale, options);
            const daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const day = daysOfWeek[now.getDay()];

            return `${timeString}, ${day}`;
        }
        $('#mengetik').append(
            ' <li class="clearfix"> <div class="message-data"><span class="message-data-time">' +
            getCurrentTime() +
            '</span></div><div class="message my-message">sedang mengetik.....</div></li>'
        );

        function playAudio() {
            // Buat objek Audio
            var audio = new Audio();

            // Setel sumber audio (URL atau data base64)
            audio.src = "{{ asset('silahkan.wav') }}"

            // Memainkan audio
            audio.play();
        }
        var audio = document.getElementById("myAudio");

        // Fungsi untuk memainkan audio pada perangkat seluler
        function playAudioOnMobile() {
            if (window.innerWidth <= 768 && audio.paused) {
                audio.play();
            }
        }
        $(document).ready(function() {
            Swal.fire({
                title: 'Apakah anda masih ingin melanjutkan?',
                text: "Selamat datang di silahkan tanya ananda dimmas budiarto",
                icon: 'question',
                showCancelButton: false, // Menghilangkan tombol Cancel
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, lanjutkan!',
                allowOutsideClick: false, // Mencegah interaksi di luar SweetAlert
                allowEscapeKey: false, // Mencegah pengguna menutup SweetAlert dengan tombol Escape
            }).then((result) => {
                if (result.isConfirmed) {
                    // Di sini Anda dapat menambahkan kode apa pun yang ingin dijalankan setelah tombol "Ya, lanjutkan!" diklik
                    playAudio();
                }
            });
        });
        var audioPlayer = null;

        function sendMessage() {
            var userMessage = $('#user-input').val();

            // Tambahkan pertanyaan pengguna ke tampilan chat
            $('#chat-content').append(
                ' <li class="clearfix"> <div class="message-data text-end"> <span class="message-data-time">' +
                getCurrentTime() + '</span></div> <div class="message other-message float-end">' +
                userMessage + ' </div> </li>');

            $('#user-input').val('');

            $('#mengetik').show();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Kirim pertanyaan ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('ask') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Sertakan token CSRF dalam header
                },
                data: {
                    message: userMessage
                },
                success: function(response) {
                    // Potong respons menjadi 7 kata pertama
                    var responsePreview = response.split(' ').slice(0, 7).join(' ');

                    // Tambahkan jawaban dari server ke tampilan chat
                    $('#chat-content').append(
                        ' <li class="clearfix"> <div class="message-data"><span class="message-data-time">' +
                        getCurrentTime() +
                        '</span></div><div class="message my-message">' +
                        response +
                        '</div></li>');

                    if (response.split(' ').length <= 7) {
                        // Jika respons kurang dari atau sama dengan 7 kata, lakukan scroll ke bawah
                        scrollChatToBottom();
                    }

                    $('#mengetik').hide();

                    bacaText(response); // Auto-scroll tampilan chat ke bawah
                    // Hapus teks input pengguna
                }
            });
        }

        $('#user-input').keypress(function(event) {
            if (event.which == 13) { // 13 adalah kode tombol "Enter"
                event
                    .preventDefault(); // Mencegah tindakan default dari tombol "Enter" (yaitu, mengirimkan formulir)
                sendMessage(); // Panggil fungsi sendMessage ketika tombol "Enter" ditekan
            }
        });

        // Tangani peristiwa klik pada tombol "Kirim"
        $('#send-button').on('click', function() {
            sendMessage(); // Panggil fungsi sendMessage ketika tombol diklik
        });
    </script>

</body>

</html>
