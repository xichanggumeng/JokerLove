<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>JokerLove</title>


    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <script
        src="https://cdn.bootcdn.net/ajax/libs/browser-image-compression/2.0.2/browser-image-compression.min.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        body > .container {
            margin-top: 20px;
        }

        .body {
            overflow: hidden;
        }

        .chat-container {
            width: 320px;
            height: 680px;
            margin: 20px auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #ededed;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .chat-container .navbar {
            height: 42px;
            margin-top: 4px;
            margin-bottom: 4px;
            padding-left: 6px;
            padding-right: 10px;
        }

        .chat-container .navbar .back {
            font-size: 17px;
            margin-left: 3px;
        }

        .chat-container .navbar .more {
            font-size: 17px;
            margin-right: 3px;
        }

        .chat-container .navbar .name {
            font-size: 14px;
            font-weight: 500;
        }

        /* 聊天消息样式 */
        .chat-message {
            padding: 8px;
            display: flex;
        }

        /* 文本消息样式 */
        .message-text {
            flex: 1;
            font-size: 14px;
            line-height: 1.2;
            word-wrap: break-word;
            text-align: justify;
            letter-spacing: 0;
        }

        .user-message {
            position: relative;
            margin-right: 10px;
            background-color: #95ec69;
            border-radius: 4px;
            padding: 8px;
            max-width: 80%;
            min-height: 34px;
            float: right;
        }


        .user-message:before {
            content: '';
            width: 0;
            height: 0;
            top: 10px;
            border: 6px solid transparent;
            position: absolute;
            left: 100%;
            margin-left: -1px;
        }

        .user-message:after {
            content: "";
            width: 0;
            height: 0;
            top: 10px;
            border: 6px solid transparent;
            border-left-color: #95ec69;
            position: absolute;
            left: 100%;
            margin-left: -1px;
        }


        .chat-message .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 10%;
            /*background-color: #4CAF50;*/
            background-image: url('{{ asset('src/img/me.jpg') }}');
            background-size: cover; /* 背景图尺寸覆盖整个 div */
            background-position: center;
        }

        .other-message {
            position: relative;
            margin-left: 10px;
            background-color: #fff;
            /*border: 1px solid #ddd;*/
            border-radius: 4px;
            padding: 8px;
            max-width: 80%;
            min-height: 34px;
            float: left;
        }


        .other-message:before {
            content: '';
            width: 0;
            height: 0;
            top: 10px;
            border: 6px solid transparent;
            position: absolute;
            /*border-right-color: #ddd;*/
            border-right-color: #ededed;
            right: 100%;
            margin-right: 0.6px;
        }

        .other-message:after {
            content: "";
            width: 0;
            height: 0;
            top: 10px;
            border: 6px solid transparent;
            border-right-color: #fff; /* 将 border-left-color 改为 border-right-color */
            position: absolute;
            right: 100%; /* 将 right 改为 left */
            margin-right: -1px; /* 将 margin-left 改为 margin-right */
        }

        .system-information {
            text-align: center;
            margin: 10px auto 6px;
            font-size: 10px;
            color: #999;
            max-width: 70%;
        }


        .chat-container .footer {
            padding: 10px 10px 6px;
            display: flex;
            align-items: center;
            margin-top: auto;
            background-color: #f7f7f7;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .chat-container .footer .input {
            height: 30px;
            width: 72%;
            margin-right: 9px;
            margin-left: 3px;
            border: none; /* 移除边框 */
            outline: none; /* 移除聚焦时的边框 */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            font-size: 14px;

        }

        .chat-container .footer .icon {
            font-size: 22px;
            margin-right: 6px;
        }

        .chat-container .footer .more {
            margin-left: 4px;
            margin-right: 0;
        }

        .function-area {
            margin-top: 20px;
        }

        .message-input {
            margin-bottom: 10px;
        }

        .avatar-input {
            display: none;
        }

        i {
            display: inline-block;
        }

        /*.one-line {*/
        /*    text-align: center !important;*/
        /*    line-height: 24px !important;*/
        /*}*/

    </style>

</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand mb-0 h1 mx-auto">小丑の爱</span>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="chat-container">
                <div class="navbar">
                    <i class="bi bi-chevron-left icon back"></i>
                    <span class="name">女神</span>
                    <i class="bi bi-three-dots icon more"></i>
                </div>


                <div class="body">
                    <div class="chat-message" data-type="user">
                        <div class="message-text">
                            <div class="user-message">小姐姐，下午出去打羽毛球嘛</div>
                        </div>
                        <div class="user-avatar"></div>
                    </div>

                    <div class="chat-message" data-type="user">
                        <div class="message-text">
                            <div class="user-message">去嘛去嘛~</div>
                        </div>
                        <div class="user-avatar"></div>
                    </div>

                    <div class="chat-message">
                        <div class="system-information">23:15</div>
                    </div>

                    <div class="chat-message" data-type="other">
                        <div class="user-avatar"></div>
                        <div class="message-text">
                            <div class="other-message one-line">不去，忙着陪男朋友打游戏</div>
                        </div>
                    </div>
                </div>

                <div class="footer">
                    <i class="bi bi-filter-circle icon voice" style="transform: rotate(90deg);"></i>
                    <input class="input"/>
                    <i class="bi bi-emoji-smile icon emoji"></i>
                    <i class="bi bi-plus-circle icon more"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 function-area">
            <div class="form-group">
                <label for="message-input">
                    请输入内容：
                </label>
                <textarea class="form-control message-input" id="message-input" rows="4"></textarea>
            </div>
            <button class="btn btn-primary add-message-btn">添加消息</button>
            <button class="btn btn-primary add-message2-btn">添加对方消息</button>
            <button class="btn btn-primary add-information-btn">添加提示</button>
            <button class="btn btn-secondary" onclick="$('.chat-container .body').empty();">清空</button>
            <hr>
            <button class="btn btn-primary set-nickname-btn">设置昵称</button>
            <button class="btn btn-primary set-avatar-btn">设置头像</button>
            <button class="btn btn-primary set-other-avatar-btn">设置对方头像</button>
            <input type="file" class="avatar-input" data-type="user">
            <hr>
            <button class="btn btn-success generate-screenshot-btn">生成截图</button>
            <!-- 其他功能按钮将在此处添加 -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        const e_msg_input = $(".message-input");

        const e_avatar_input = $('.avatar-input');

        $(".add-message-btn").click(function () {
            let msg = e_msg_input.val();
            e_msg_input.val('');
            $('.chat-container .body').append(`
                    <div class="chat-message" data-type="user">
                        <div class="message-text">
                            <div class="user-message">${msg}</div>
                        </div>
                        <div class="user-avatar"></div>
                    </div>`);

            let e = $('.chat-message:last');
            if (e.height() === 34) {
                e.find('.user-message').addClass('one-line');
            }
        });

        $(".add-message2-btn").click(function () {
            let msg = e_msg_input.val();
            e_msg_input.val('');
            $('.chat-container .body').append(`
                    <div class="chat-message" data-type="other">
                        <div class="user-avatar"></div>
                        <div class="message-text">
                            <div class="other-message">${msg}</div>
                        </div>
                    </div>`);

            let e = $('.chat-message:last');
            if (e.height() === 34) {
                e.find('.other-message').addClass('one-line');
            }
        });

        $(".add-information-btn").click(function () {
            let msg = e_msg_input.val();
            e_msg_input.val('');
            $('.chat-container .body').append(`
                    <div class="chat-message">
                        <div class="system-information">${msg}</div>
                    </div>`);
        });

        $(".generate-screenshot-btn").click(function () {
            html2canvas($(".chat-container")[0]).then(function (canvas) {
                const image = canvas.toDataURL("image/png");
                console.log('%c ', 'padding:100px 200px; line-height:300px; background:url(' + image + ') no-repeat;');
                const downloadLink = document.createElement('a');
                downloadLink.href = image;
                downloadLink.download = 'image.png';
                downloadLink.click();
            });
        });

        $('.set-nickname-btn').click(function () {
            let msg = e_msg_input.val();
            e_msg_input.val('');
            $('.navbar .name').text(msg);
        });

        $('.set-avatar-btn').click(function () {
            e_avatar_input.data('type', 'user');
            e_avatar_input.click();
        });

        $('.set-other-avatar-btn').click(function () {
            e_avatar_input.data('type', 'other');
            e_avatar_input.click();
        });

        $('.body').on('wheel', function (event) {
            const delta = event.originalEvent.deltaY;
            const currentScrollTop = $(this).scrollTop();
            $(this).scrollTop(currentScrollTop + delta * 0.1);
            event.preventDefault();
        });

        e_avatar_input.change(async function () {
            if (e_avatar_input[0].files && e_avatar_input[0].files[0]) {
                let file = e_avatar_input[0].files[0];
                let options = {
                    maxSizeMB: 0.08,
                    //maxWidthOrHeight: 256,
                    useWebWorker: true
                    // onProgress: function (progress) {
                    //     console.log('压缩进度:', progress);
                    // }
                };
                const compressedFile = await imageCompression(file, options);
                console.log('压缩后文件大小:', Math.ceil(compressedFile.size / 1024)+'KB');
                const reader = new FileReader();
                reader.onload = function (e) {
                    let type = e_avatar_input.data('type');
                    $(`.chat-message[data-type="${type}"] .user-avatar`).css('background-image', 'url(' + e.target.result + ')');
                };
                reader.readAsDataURL(compressedFile);
            }
        });
    });

</script>

</body>
</html>
