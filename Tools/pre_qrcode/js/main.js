$(document).ready(function() {
                var value = 'http://tools.yum6.cn/';
                var filter = 'color';
                var imagePath = 'img/favicon.ico';

                var self = this;

                function makeQR() {
                    var qr = qrcode.QRCode(10, 'H');
                    qr.addData(value);
                    qr.make();
                    document.getElementById('combine').innerHTML = qr.createImgTag(3);
                }

                function makeQArt() {
                    new QArt({
                        value: value,
                        imagePath: imagePath,
                        filter: filter
                    }).make(document.getElementById('combine'));
                }

                function getBase64(file, callback) {
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        callback(reader.result);
                    };
                }

                $('#value').keyup(function() {
                    value = $(this).val();
                    makeQR();
                    makeQArt();
                });

                $('#file').change(function() {
                    getBase64(this.files[0], function(base64Img) {
                        var regex = /data:(.*);base64,(.*)/gm;
                        var parts = regex.exec(base64Img);
                        imagePath = parts[0];
                        $('#image img').attr('src', imagePath);
                        makeQArt();
                    });
                });

                $('input[type=radio]').click(function() {
                    filter = $(this).val();
                    makeQArt();
                });

                makeQR();
                makeQArt();
            });